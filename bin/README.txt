Files in this folder are produced by scripts, run on a schedule.
'chron' runs the script; start_data_collection, which starts gather_data.php if necessary.

The polling script; MM15-8.php contacts each logger, pulls the data and reformats them into nice csv files.

Change the schedule by editing start_data_collection, then run 'killall gather_data.php'.


MM15-8.php: Main Data gathering script. 
 It uses config.php for cage wheel sizes.
 It contacts each Arduino logger and polls it for data.
 It does all unit conversions. 
 It creates Group folders and all data files:
  G##_YYMMDD.csv: Daily file with raw, scaled, data from each polling 
  G##_YYMMDD_trip.csv: Daily Trip distance, speed and time - Resets each day.
  G##_odo.csv:  Reset by editing or when missing
  


Get_mm_rec.php: - Gathers data for Cacti from a single cage.

gather_data.php - Runs the polling script on a short interval.

send_IP.php - Sends the hosts IP address and a data summary to a web page.

start_data_collection - Starts up the polling scripts if necessary.

total_trips.php - Colates trip files into summary files. 

Notes:

Each Arduino logger must have a unique Group ID. (Set via switches inside the Arduino).
The Group Number is the binary value of the switch bits +1.

Group Sw: 1 2 3 4
---------------
Group01 - 0 0 0 0 
Group02 - 1 0 0 0
Group03 - 0 1 0 0 
Group04 - 1 1 0 0
Group05 - 0 0 1 0 
Group06 - 1 0 1 0
Group07 - 0 1 1 0 
Group08 - 1 1 1 0 
Group09 - 0 0 0 1 
Group10 - 1 0 0 1
Group11 - 0 1 0 1 
Group12 - 1 1 0 1
Group13 - 0 0 1 1 
Group14 - 1 0 1 1
Group15 - 0 1 1 1 
Group16 - 1 1 1 1


---------------- Sample raw data from constant speed test jig --------------------
2,864871,42335, 2 ,3350,3350,3350,3350,3350 ,253,235,260,229,249 ,237,234,230,228,242,40887
2,867073,42335, 2 ,3359,3359,3359,3359,3359 ,239,256,231,263,243 ,237,234,230,228,242,25144
2,869875,867073, 3 ,12,11,11,11,12 ,239,235,259,229,244 ,238,234,231,229,243,56538
2,955992,867073, 3 ,362,362,362,362,362 ,238,256,231,262,243 ,238,234,231,228,242,61020
2,111493797,867073, 3 ,450536,450536,450536,450536,450536 ,238,256,232,261,242 ,237,234,230,228,241,37098
2,111499953,867073, 3 ,450561,450561,450561,450561,450561 ,252,235,259,229,248 ,237,234,230,228,241,47465
2,111642811,111499953, 0 ,582,582,582,582,582 ,251,235,259,229,248 ,237,234,230,228,241,22135
2,111499953,867073, 3 ,450561,450561,450561,450561,450561 ,252,235,259,229,248 ,237,234,230,228,241,47465
-----------------------------
30.7313 hours 
450561 counts  = 14661.3062 counts/hour, 4.07258 counts/sec

179.45 mm for each tick.
max time - 259msec = 2.49498km/hr 
true - 245.544msec  2.63170 km/hr 
min time - 228msec = 2.83421 km/hr

Vel measurements are accurate to +/- 0.2 km/hr



