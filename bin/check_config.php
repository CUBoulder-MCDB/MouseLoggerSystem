#!/usr/bin/php
<?php
include 'config.php';

echo "----- TOPDIR -------\n";
//echo serialize($topdir) . "\n";
echo var_export($topdir) . "\n";

echo "----- FNAME  -------\n";
//echo serialize($fname_format) . "\n";
echo var_export($fname_format) . "\n";

echo "----- HEADER -------\n";
//echo serialize($header) . "\n";
echo var_export($header) . "\n";

echo "----- CAGE GROUPS -------\n";
//echo serialize($CageGroup) . "\n";
echo var_export($CageGroup) . "\n";

echo "== ** PASSED ** == \n";
?>
