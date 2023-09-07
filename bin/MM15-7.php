#!/usr/bin/php
<?php
// Poll every Attached Arduino for data
// Collate and save the data to daily files - Apply distance scaling and udo units conversions.
// Save Summary files containing daily trip files  and a total ODO file. 
//
// This code is part of the Mouse Cage Logger System. Copyright Frank Hage, 2015.
// See the License file distributed with the source for details on the right to use, modify and redistribute.

include 'config.php';

if($argc != 3) {
 printf("Usage: %s start_dev# end_dev#\n",$argv[0]);
 printf("     Valid start_dev, end_dev: 1-16\n",$argv[0]);
  exit(-1);
}

$maxdev = 15;

$start_dev = intval($argv[1]) -1; 
$end_dev = intval($argv[2]) -1;

if($start_dev < 0) $start_dev = 0;  
if($start_dev > $maxdev) $start_dev = $maxdev;  
if($end_dev < 0) $end_dev = 0;  
if($end_dev > $maxdev) $end_dev = $maxdev; 
if($start_dev > $end_dev) $start_dev = $end_dev;

// Try all Stock Uno's
for($i=$start_dev; $i <= $end_dev; $i++) {
  $devname = sprintf("/dev/ttyACM%d",$i);
  poll_dev($devname);
}

// Try all Spark Fun Uno's
for($i=$start_dev; $i <= $end_dev; $i++) {
  $devname = sprintf("/dev/ttyUSB%d",$i);
  poll_dev($devname);
}

exit(0);

////////////////////////////////////////////////////////////
// Poll the device - Process_Response if active 
function poll_dev($dev) {
  $done = false;
  $consc_nulls = 0;
  if(file_exists($dev)) {
    // The Arduino IDE settings for the USB serial ports on the RaspBerry Pi.
    // This gets the flow control signals right.
    // 115200 B 
    // echo `stty -hup -F $dev 10:0:18b2:0:3:1c:7f:15:4:0:0:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0`;
    // 38400 B
    do {
        system("stty -hup -F $dev 10:0:18b2:0:3:1c:7f:15:4:0:0:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0", $ret_val);
        //system("stty -hup -F $dev 10:0:8bf:0:3:1c:7f:15:4:0:0:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0", $ret_val);
    } while ($ret_val != 0);

    $timeout = microtime(true) + 2.0; // 2 sec timeout. 

    $fp=fopen($dev,"r+"); 

    $attempts = 0;
    $resp = "";
 
    do {
      $attempts++;
      stream_set_blocking($fp,1);

      fwrite($fp,"r",1);  // Send a Poll/Resmet command
      fflush($fp);
    
      stream_set_blocking($fp,0);


      do {                // Do reads until data arrive.
        $c = fgetc($fp);
        if($c === false) {
          usleep(5000);
          continue;
        } 
        $resp .= $c;
        if(ord($c) == 13) $done=true;
      }   while(! $done && microtime(true) < $timeout);

      if($done) {
         process_resp($resp);
      } else {
        echo "Time out on $dev\n"; 
      }
      
     } while(!$done && $attempts < 3) ;

     if(!$done) {
        echo "Failed to get data from $dev. Response:" . $resp . "\n";
     }

     fclose($fp);
  }
}

/////////////////////////////////////////////////////////////////
// Process response - Construct a Group Record - Save it
//
function process_resp($resp) {
  global $CageGroup;
  global $topdir;
  
  $out =  str_getcsv($resp); // Parse the CSV
  // var_dump($out);  // Debug

  if(count($out) != 19) {
    echo count($out) . "/19 Fields.  Response:\n" . $resp . "\n";
  } else {

    // Extract the group ID and do some sanity checking.    
    $group = hexdec($out[0]);
    $tdiff = (intval($out[1])/1000.0) - (intval($out[2])/1000.0); // seconds difference
    if($tdiff < 0 || $tdiff > 3600) {   // HACK - Trap and correct ERROR Condition
	$err_path = $topdir . "/errors.log";
	$fp = fopen($err_path,"a");
	fprintf($fp,"Group %d: Response: %s\n",$group, $resp);
	fprintf($fp,"T1: %d\n",(intval($out[1] / 1000.0)));
	fprintf($fp,"T2: %d\n",(intval($out[2] / 1000.0)));
	fclose($fp);

	$out[2] = "0";            // Set to one minute interval for CU
	$out[1] = "60000";
    }
    if(count($CageGroup) > $group) {  // We have a valid Config for this Group
      // Construct a Decoded Group from the raw record  + config for that group
      
      $Grec = new GroupRec($out,$CageGroup[$group]);
    
      // Save the data
      $Grec->save();
      
      // Update Odometer and Daily  Trip files
      $Grec->update_odometers();
    } else {
      echo "No Configuration for Group: " . $group . "\n";
    }
  }
}


////////////////////////////////////////////////////////////////
// Group Records Container Class
class GroupRec {
   public $GroupNum;
   public $TPoll;

   public $T1;  //  End time of measurement period - seconds
   public $T2;  // Start time of mesaurement period - seconds.
   public $Tdiff; // Time in this measurement period. - seconds.
   public $CageArr;

   private $cfg;

   public function __construct($msg_arr,$group_cfg) {
     $this->GroupNum = hexdec($msg_arr[0]) + 1;
     $this->T1 = intval($msg_arr[1]) / 1000.0;
     $this->T2 = intval($msg_arr[2]) / 1000.0;
     $this->Tdiff = $this->T1 - $this->T2;

     $this->TPoll = gettimeofday(TRUE); // request float
     $this->cfg = $group_cfg;
     $this->CageArr = array();
      for($i=0; $i < 5; $i++) {
	$this->CageArr[$i] = new CageRec($msg_arr,$group_cfg, $i);
      }
   }
 
   function __destruct() {
   }

   function fmtRec() {  // Produce a nicely formatted CSV record
     
     $tstamp = intval($this->TPoll);
     $fract_sec = $this->TPoll - $tstamp;
     $tstring = strftime("%Y-%m-%d %T",$tstamp);
     
     $outstr = sprintf("%d,%s,%.1f",$this->GroupNum,$tstring,$this->Tdiff);
     for($i=0; $i < 5; $i++) {
	$outstr .= $this->CageArr[$i]->fmtRec();
     }
     return $outstr;
   }
   
   function fmtHeader() { // Produce a nicely formatted CSV record Header
     $outstr = "Group, UTime, T_Period ";
     for($i=0; $i < 5; $i++) {
	$outstr .= $this->CageArr[$i]->fmtHeader();
     }
     return $outstr;
   }
   
  /////////////////////////////////////////////////////////////////
  // Save the data to a CSV file
  //
  function save() {
    global $topdir;
    global $fname_format;

    // Build the output data   
    $HeadOut = $this->fmtHeader() . "\n";
    $RecOut = $this->fmtRec() . "\n";

    // Make sure the directory exists.
    $folder = sprintf("%s/Group%02d/",$topdir,$this->GroupNum);

    if(!file_exists($folder)) {
      mkdir($folder,0777,true); // make the folder.

      // Make a file listing the Current configuration       
      ob_start();  // Method to capture var_dump,var_export.
      var_export($this->cfg);
      $out = ob_get_clean(); 

      $info_file = $folder . "/Group_info.txt";
      $fp = fopen($info_file,"w");
      if($fp) {
        fwrite($fp,$out);
        fclose($fp);
      } else {
	echo("Problem Writing $info_file");
      } 
    }

    // Build a file name
    $now = time(); // the current time in seconds
    $cur_hr = localtime()[2]; // Extract the local hour
    if($cur_hr < $this->cfg['ResetHour']) { // Use yesterdays date;
      $now -= 86400; // subtract a day of seconds
    }

    $csv_fname = strftime($fname_format,$now) . ".csv";

    $path = $folder . $csv_fname;
    if(!file_exists($path)) {
	$fp = fopen($path,"c");
	fputs($fp,$HeadOut);  // Output the header.
    } else {
	$fp = fopen($path,"a+");
    }
    fputs($fp,$RecOut);  // Output the data.
    fclose($fp);
    
  }

  /////////////////////////////////////////////////////////////////
  // Create and update total Odometer and Daily distance files.
  //
  function update_odometers() {
    global $topdir;
    global $fname_format;

    // Make sure the Group directory exists.
    $folder = sprintf("%s/Group%02d",$topdir,$this->GroupNum,$this->GroupNum);
    $prefix = sprintf("/G%02d_",$this->GroupNum);
    if(!file_exists($folder)) {
      mkdir($folder,0777,true); // make the folder.
    }
  
    // The ODO File.
    $odo_fname = "odo.csv";   
    $path = $folder . $prefix . $odo_fname;
    $this->update_odometer_file($path);
    
    // The Daily Distance (Trip) File.
    $now = time(); // the current time in seconds
    $cur_hr = localtime()[2]; // Extract the local hour
    if($cur_hr < $this->cfg['ResetHour']) { // Use yesterdays date;
      $now -= 86400; // subtract a day of seconds
    }

    $trip_fname = strftime($fname_format,$now) . "_trip.csv";
    $path = $folder . $prefix . $trip_fname;
    $this->update_odometer_file($path);
  }


  /////////////////////////////////////////////////////////////////
  // Create or Update an Odometer or Trip File. 
  // A CSV file with:
  // Group ID, Time, Elapsed TIme (min), and  Accumulated distance, Hours active, and Ave velocity
  // for each cage.
  //
  function update_odometer_file($path) {
    $tstamp = intval($this->TPoll);
    $fract_sec = $this->TPoll - $tstamp;
    $tstring = strftime("%Y-%m-%d %T",$tstamp);
    $hdr_str = "Group, Poll_T, Hours, D1,V1,T1,  D2,V2,T2, D3,V3,T3, D4,V4,T4, D5,V5,T5\n";
     
    if(!file_exists($path)) {  // Create the file with the latest distances
	$fp = fopen($path,"c");
	$odo_arr = array();
        
        fputs($fp,$hdr_str); // Output the header.
        $outstr = sprintf("%d,%s,%.2f,  ",$this->GroupNum,$tstring,$this->Tdiff/3600.0);
	fputs($fp,$outstr);  // Output GroupID , Time, Elaped Time in hours

	for($i=0; $i < 5; $i++)  {
            if($this->CageArr[$i]->counts > 1) {
              $hours_active =  $this->Tdiff / 3600.0; // convert to hours.
              $active_vel = $this->CageArr[$i]->mean_vel;
            } else {
               $hours_active = 0.0;
                $active_vel = 0.0;
            }

            $outstr = sprintf("%.1f,%.2f,%.2f",$this->CageArr[$i]->dist_m,$active_vel,$hours_active);
            fputs($fp,$outstr);
            if($i < 4) {
               fputs($fp,"  ,");
            } else {
               fputs($fp,"\n");
            }
         }
 	 fclose($fp);
    } else {                   // Update the file - Add the latest distances to the totals.
	$fp = fopen($path,"r+");

	$odo_arr = fgetcsv($fp,128);   // Read the header values
	$odo_arr = fgetcsv($fp,128);   // Read the existing values
	
	rewind($fp);   // Reset the file pointer

        fputs($fp,$hdr_str); // Output the header.

        $trip_time = $odo_arr[2] + $this->Tdiff / 3600.0; // Keep track of elapsed time in hours

        $outstr = sprintf("%d,%s,%.2f,  ",$this->GroupNum,$tstring,$trip_time);
	fputs($fp,$outstr);  // Output GroupID , Time, Elaped Time in hours
	
	for($i=0; $i < 5; $i++)  {
            // Cage values start at the 3rd column. Each has 3 values. 
            $tot_dist =  $odo_arr[(($i +1) * 3)] + $this->CageArr[$i]->dist_m;
            $hours_active =  $odo_arr[(($i+1) * 3) +2];

            if($this->CageArr[$i]->counts > 1) {
              $hours_active +=  $this->Tdiff / 3600.0; // convert to hours.
            }
            if($hours_active > 0) { 
              $active_vel = ($tot_dist/ 1000.0) / $hours_active; //  km/hr
            } else {
               $active_vel = 0.0;
            }

            $outstr = sprintf("%.1f,%.2f,%.2f",$tot_dist,$active_vel,$hours_active);
            fputs($fp,$outstr);
            if($i < 4) {
               fputs($fp,"  ,");
            } else {
               fputs($fp,"\n");
            }
         }
	ftruncate($fp,ftell($fp));
	fclose($fp);
    }
  }
}

///////////////////////////////////////////////////////////
// Cage Container Class
Class CageRec {
   public $cage_no;
   public $counts;   // 1/2 revolution counts in this period
   public $dist_m;   // Distance traveled in this period -meters.
   public $mean_vel; // Mean Velocity of wheel in this period - km/hr
   public $last_vel; // Last recorded velocity on wheel during this period in km/hr
   public $max_vel;   // The Max recorded velocity on wheel during this period in km/hr

   public function __construct($msg_arr,$group_cfg,$cur_index) {
      $this->cage_no = $cur_index + 1;
      $wheel_const = $group_cfg["cage"][$cur_index]["WheelSize"];

      $tdiff = (intval($msg_arr[1]) - intval($msg_arr[2])) / 1000.0; // Convert to seconds

      $indx = $cur_index + 3; // Skip over GID, T1, T2
      $this->counts = intval($msg_arr[$indx]);
      // Compute distance = counts * dist_mm  / 1000.0 mm/m
      $this->dist_m =  $this->counts * $wheel_const / 1000.0;  // converts to meters 
     // Compute velocity = (distance_m / time period_sec)  * (3600s/hr * 1km/1000m)
     $this->mean_vel =  ($this->dist_m /  $tdiff) * 3.6; // Convert to km/hr
       
     // Compute latest velocity = dist_mm / time_msec == m/sec 
     $indx += 5;
     $tmsec = intval($msg_arr[$indx]);
     if ($tmsec > 0) { 
      $this->last_vel = ($wheel_const / $tmsec) * 3.6;  // converts to km/hr
     } else {
      $this->last_vel = 0;
     }
            
     // Compute max velocity = dist_mm / time_msec == m/sec 
     $indx += 5;
     $tmsec = intval($msg_arr[$indx]);
     if ($tmsec > 0) { 
      $this->max_vel = ($wheel_const / $tmsec) * 3.6;  // converts to km/hr
     } else {
      $this->max_vel = 0;
     }
   }
 
   function __destruct() {
   }

   function fmtRec() {   // Produce a nicely formatted CSV record 
     $outstr = sprintf(", %d,%.1f,%.1f,%.1f,%.1f",
		$this->counts,$this->dist_m,$this->mean_vel,
		$this->last_vel,$this->max_vel);
   
     return $outstr;
   }
  
   function fmtHeader() {   // Produce a nicely formatted CSV record Header
     $outstr = sprintf(", Counts%d,Dist%d,VAve%d,VLast%d,VMax%d",
                    $this->cage_no,$this->cage_no,$this->cage_no,$this->cage_no,$this->cage_no);
     return $outstr;
   }
}
 
?>
