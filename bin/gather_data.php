#!/usr/bin/php
<?php

// Run the data collection every N seconds.
if($argc != 2) {
  echo "Usage: " . $argv[0] . " Seconds_between _polls\n";
  exit -1;
}

$interval = intval($argv[1]);

// Wait until the next even interval
$now = microtime(true);
$next_t = (intval($now) + $interval) - (intval($now) % $interval);
$sleep_time = ($next_t - $now) * 1e6;
//echo "Collecting data every " . $interval . " Secs, sleeping " . $sleep_time . " usecs\n";
usleep($sleep_time);

while (1) {
   `killall -q MM15-8.php`; // make sure all old processes are dead;
   //echo `date`;
   usleep(1000);  

   `./MM15-8.php 1 16`;
  $now = microtime(true);
  $next_t = (intval($now) + $interval) - (intval($now) % $interval);
  $sleep_time = ($next_t - $now) * 1e6;

  //echo "Sleeping " . $sleep_time . " usecs\n";
  usleep(intval($sleep_time));
}

?>

  

  
   
