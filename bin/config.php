<?php
///////////////////////////
// config.php
// Config For Mouse Cage Logger

// Where the data files are left on the local drive
//topdir = "./data"; // For testing
$topdir = "/home/pi/data";  // Runtime Config
$fname_format = "%Y%m%d";

// Header info for top of all CSV Files.
$header = array(
    "Author" => "Alberto Rossi",
    "Lab"=> "CU Boulder"
);

// Array of Group Configurations.  
$CageGroup = array (
  array(   ///////////////////////////// Cage Group 1 ////////////////////////
    "GroupID"=> "Group 1", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 1 Comments go here",
    "cage"=> array( 

      array(      // Cage 1 ////////
        "WheelSize" => 179.45, // mm 
	"AnimalID"=>	"G1C1",
        "CageID"=>	"G1C1",       
      ),

      array(       // Cage 2
        "WheelSize"=>	179.45, // mm 
	"AnimalID"=>	"G1C2",
        "CageID"=>	"G1C2",
      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=>	"G1C3",
        "CageID"=>	"G1C3",
	),

      array(       // Cage 4
        "WheelSize"=>	179.45, // mm 
	"AnimalID"=>	"G1C4",
        "CageID"=>	"G1C4",
	),

      array(       // Cage 5
        "WheelSize"=>	179.45, // mm 
	"AnimalID"=>	"G1C5",
        "CageID"=>	"G1C5",
       ),
    ),
  ),

  array(     ///////////////////////////// Cage Group 2 ////////////////////////
    "GroupID"=> "Group2 ID", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 2 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G2C1",
        "CageID"=>	"G2C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G2C2",
        "CageID"=>	"G2C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G2C3",
        "CageID"=>	"G2C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G2C4",
        "CageID"=>	"G2C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G2C5",
        "CageID"=>	"G2C5",
      )
    ),
  ),

  array(     ///////////////////////////// Cage Group 3 ////////////////////////
    "GroupID"=> "Group 3", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 3 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G3C1",
        "CageID"=>	"G3C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G3C2",
        "CageID"=>	"G3C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G3C3",
        "CageID"=>	"G3C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G3C4",
        "CageID"=>	"G3C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G3C5",
        "CageID"=>	"G3C5",
      )
    ),
  ),

  array(     ///////////////////////////// Cage Group 4 ////////////////////////
    "GroupID"=> "Group 4", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 4 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G4C1",
        "CageID"=>	"G4C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G4C2",
        "CageID"=>	"G4C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G4C3",
        "CageID"=>	"G4C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G4C4",
        "CageID"=>	"G4C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G4C5",
        "CageID"=>	"G4C5",
      )
    ),
  ),
  array(     ///////////////////////////// Cage Group 5 ////////////////////////
    "GroupID"=> "Group 5", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 5 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G5C1",
        "CageID"=>	"G5C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G5C2",
        "CageID"=>	"G5C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G5C3",
        "CageID"=>	"G5C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G5C4",
        "CageID"=>	"G5C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G5C5",
        "CageID"=>	"G5C5",
      )
    ),
  ),
  array(     ///////////////////////////// Cage Group 6 ////////////////////////
    "GroupID"=> "Group 6", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 6 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G6C1",
        "CageID"=>	"G6C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G6C2",
        "CageID"=>	"G6C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G6C3",
        "CageID"=>	"G6C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G6C4",
        "CageID"=>	"G6C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G6C5",
        "CageID"=>	"G6C5",
      )
    ),
  ),
  array(     ///////////////////////////// Cage Group 7 ////////////////////////
    "GroupID"=> "Test Group 7 ID", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 7 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G7C1",
        "CageID"=>	"G7C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=>	"G37C2",
        "CageID"=>	"G7C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G7C3",
        "CageID"=>	"G7C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G7C4",
        "CageID"=>	"G7C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G7C5",
        "CageID"=>	"G7C5",
      )
    ),
  ),

  array(     ///////////////////////////// Cage Group 8 ////////////////////////
    "GroupID"=> "Group 8", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 8 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G8C1",
        "CageID"=>	"G8C1",

      ),
      array(       // Cage 2
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	 "G8C2",
        "CageID"=>	"G8C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G8C3",
        "CageID"=>	"G8C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G8C4",
        "CageID"=>	"G8C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G8C5",
        "CageID"=>	"G8C5",
      )
    ),
  ),
  array(   ///////////////////////////// Cage Group 9 ////////////////////////
    "GroupID"=> "Group 1", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 9 Comments go here",
    "cage"=> array( 

      array(      // Cage 1 ////////
        "WheelSize" => 179.45, // mm 
	"AnimalID"=>	"G9C1",
        "CageID"=>	"G9C1",       
      ),

      array(       // Cage 2
        "WheelSize"=>	179.45, // mm 
	"AnimalID"=>	"G9C2",
        "CageID"=>	"G9C2",
      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=>	"G9C3",
        "CageID"=>	"G9C3",
	),

      array(       // Cage 4
        "WheelSize"=>	179.45, // mm 
	"AnimalID"=>	"G9C4",
        "CageID"=>	"G9C4",
	),

      array(       // Cage 5
        "WheelSize"=>	179.45, // mm 
	"AnimalID"=>	"G9C5",
        "CageID"=>	"G9C5",
       ),
    ),
  ),

  array(     ///////////////////////////// Cage Group 10 ////////////////////////
    "GroupID"=> "Group 10", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 10 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G10C1",
        "CageID"=>	"G10C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G10C2",
        "CageID"=>	"G10C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G10C3",
        "CageID"=>	"G10C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G10C4",
        "CageID"=>	"G10C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G10C5",
        "CageID"=>	"G10C5",
      )
    ),
  ),

  array(     ///////////////////////////// Cage Group 11 ////////////////////////
    "GroupID"=> "Group 11", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 11 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G11C1",
        "CageID"=>	"G11C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G11C2",
        "CageID"=>	"G11C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G11C3",
        "CageID"=>	"G11C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G11C4",
        "CageID"=>	"G11C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G11C5",
        "CageID"=>	"G11C5",
      )
    ),
  ),

  array(     ///////////////////////////// Cage Group 12 ////////////////////////
    "GroupID"=> "Group 12", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 12 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G12C1",
        "CageID"=>	"G12C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G12C2",
        "CageID"=>	"G12C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G12C3",
        "CageID"=>	"G12C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G12C4",
        "CageID"=>	"G12C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G12C5",
        "CageID"=>	"G12C5",
      )
    ),
  ),
  array(     ///////////////////////////// Cage Group 13 ////////////////////////
    "GroupID"=> "Group 13", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 13 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G13C1",
        "CageID"=>	"G13C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G13C2",
        "CageID"=>	"G13C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G13C3",
        "CageID"=>	"G13C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G13C4",
        "CageID"=>	"G13C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G13C5",
        "CageID"=>	"G13C5",
      )
    ),
  ),
  array(     ///////////////////////////// Cage Group 14 ////////////////////////
    "GroupID"=> "Group 14", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 14 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G14C1",
        "CageID"=>	"G14C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=> 	"G14C2",
        "CageID"=>	"G14C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G14C3",
        "CageID"=>	"G14C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G14C4",
        "CageID"=>	"G14C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G14C5",
        "CageID"=>	"G14C5",
      )
    ),
  ),
  array(     ///////////////////////////// Cage Group 15 ////////////////////////
    "GroupID"=> "Test Group 15 ID", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 15 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G15C1",
        "CageID"=>	"G15C1",

      ),
      array(       // Cage 2
        "WheelSize" => 179.45, // mm 
	"AnimalID"=>	"G15C2",
        "CageID"=>	"G15C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G15C3",
        "CageID"=>	"G15C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G15C4",
        "CageID"=>	"G15C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G15C5",
        "CageID"=>	"G15C5",
      )
    ),
  ),

  array(     ///////////////////////////// Cage Group 16 ////////////////////////
    "GroupID"=> "Group 16", 
    "ResetHour" => 17, // When the Daily records start. Local time - 0 to 23 hours
    "Comments"=> "Group 16 comments go here",
    "cage"=> array(  
      array(      // Cage 1
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G16C1",
        "CageID"=>	"G16C1",

      ),
      array(       // Cage 2
        "WheelSize" =>	179.45, // mm 
	"AnimalID"=>	"G16C2",
        "CageID"=>	"G16C2",

      ),

      array(       // Cage 3
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G16C3",
        "CageID"=>	"G16C3",

	),
      array(       // Cage 4
        "WheelSize"=>	 179.45, // mm 
	"AnimalID"=> 	"G16C4",
        "CageID"=>	"G16C4",

	),
      array(       // Cage 5
        "WheelSize" => 	179.45, // mm 
	"AnimalID"=> 	"G16C5",
        "CageID"=>	"G16C5",
      )
    ),
  ),
);
?>
