#!/usr/bin/php
<?php
//  Script to produce a Daily Summary File for each cage group.
// Each file is a concatenation of all existing trip files in each group folder.
// Run from chron once a day. 
//  
// Shows the Trip file data for each group.
// This code is part of the Mouse Cage Logger System. Copyright 2015 Frank Hage
// See the License file distributed with the source for details on the right to use, modify and redistribute.

// Grab configuration
include 'config.php';

// Build a Table for each group with files
for($i=1; $i < 17; $i++) {
  $fpath = sprintf("%s/Group%02d",$topdir, $i);
  if(file_exists($fpath)) {
    // Build the Daily total file name
    $dfname = sprintf("%s/G%02d_Daily.csv",$fpath,$i);
    // Remove the concatinated daily trip file
    `rm $dfname`;
    // Pull the header off the latest trip file
    `ls $fpath/*trip.csv | tail -n1 | xargs  head -n1 -q > $dfname`;
    // Add all present data to the file 
    //`tail -n1 -q $fpath/*trip | sort >> $dfname`;
    `tail -n1 -q $fpath/*trip.csv | sort >> $dfname`;
  }
}

?>
