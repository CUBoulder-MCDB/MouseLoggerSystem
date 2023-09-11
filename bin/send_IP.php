#!/usr/bin/php
<?php
//  Script to produce a HTML status table from the Mouse Logger data files.
//  - Rsync the new HTML file to an external host. 
//  
// Shows the Trip file data for each group.
// This code is part of the Mouse Cage Logger System. Copyright 2015 Frank Hage
// See the License file distributed with the source for details on the right to use, modify and redistribute.

// Grab configuration
include 'config.php';

sleep(3);

// Set up Static HTML
$head = '<HTML>
<HEAD>
<TITLE> Animal Lab Cage Loggers</Title>
 <META http-equiv="content-type" content="text/html;charset=utf-8">
</HEAD>
<BODY bgcolor="white" link="blue" >
<div style="font-size: small; font-family: sans-serif; color: black; background-color: white">
<center> <H1>CU Boulder  Animal Lab Cage Status</H1> </center>
<H2>Current Cage Conditions</H2>
';

$tail = "</div></BODY> </HTML>\n";

// Get the latest IP address and status info.
$ip = rtrim(`hostname -I |  awk '{print $1};'`);
$update = `date`;

$link = "<p>Click <A HREF=\"http://" . $ip . "/cacti\"> Here ($ip)</A> for current plots (restricted access)</p>\n";
$update_ht = "<p>Last Update: " . $update . "</p>\n";


// Create a file for transfer to the public site.
$fp = fopen("/tmp/index.html","w");

///////// Start of Writing Output
fwrite($fp,$head);
fwrite($fp,$update_ht);

// Build a Table for each group with files
for($i=1; $i < 17; $i++) {
  $fpath = sprintf("%s/Group%02d",$topdir, $i);
  if(file_exists($fpath)) {
    // extract the last line from the latest trip file
    $trip = `ls -rt $fpath/*trip.csv | tail -n1 | xargs tail -n1`;
    $trip_arr = str_getcsv($trip);

    // Build the top of the table
    $table_title= sprintf("<h3> Group %d  Last Report:  %s</h3>\n", $trip_arr[0],$trip_arr[1]);
    $trip_hdr = sprintf("<div><table border=1 frame=above cellpadding=0><thead>\n<tr><td>Cage</td><td>Dist(m)</td><td>Ave Speed(km/hr)</td><td>Active Time (hrs)</td></tr></thead>\n");
    fputs($fp,$table_title);
    fputs($fp,$trip_hdr);
    
    // Build the table body
    for($j = 1; $j < 6; $j++ ) {    
      $table_row = sprintf("<tr><td>%d</td><td> %.1f</td><td> %.2f</td><td> %.2f</td></tr>\n",
		      $j, $trip_arr[($j*3)],$trip_arr[($j*3)+1],$trip_arr[($j*3)+2]);
      fputs($fp,$table_row);
    }

    // Close the table
    fputs($fp,"</table></div>\n");
  }
}

fwrite($fp,$link);

fwrite($fp,$tail);
fclose($fp);
//
`scp /tmp/index.html username@hostname.somedomain:/var/www/html/.`
//`rsync -a /tmp/index.html /var/www/`

?>
