<?php
  function SplitTime($StartTime, $EndTime, $Duration="60"){
    $ReturnArray = array ();// Define output
    $StartTime    = strtotime ($StartTime); //Get Timestamp
    $EndTime      = strtotime ($EndTime); //Get Timestamp

    $AddMins  = $Duration * 60;

    while ($StartTime <= $EndTime) //Run loop
    {
        $ReturnArray[] = date ("G:i", $StartTime);
        $StartTime += $AddMins; //Endtime check
    }
    return $ReturnArray;
  }

  //Calling the function
  $Data = SplitTime("2018-05-12 12:15", "2018-05-12 15:30", "60");
  echo "<pre>";
  print_r($Data);
  echo "<pre>";
?>
  