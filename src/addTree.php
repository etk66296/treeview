<?php
  // print_r($_POST);
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  $myFile = "../assets/treeData/treeData.json";
  $arr_data = array(); // create empty array
  try
  {
    //Get form data
	  $formdata = array(
	    'cultivar'=> $_POST['cultivar'],
	    'family'=> $_POST['family'],
	    'kind'=>$_POST['kind'],
      'plantingYear'=> $_POST['plantingYear'],
      'health'=> $_POST['health'],
      'situation'=> $_POST['situation'],
      'wikiLink'=> $_POST['wikiLink'],
      'long'=> $_POST['long'],
      'lat'=> $_POST['lat'],
	  );

	  //Get data from existing json file
    $jsondata = file_get_contents($myFile);
    

	  // converts json data into array
    $arr_data = json_decode($jsondata, true);
    $lastTreeCpy = end($arr_data['features']);
    
    $lastTreeCpy['id'] = $lastTreeCpy['id'] + 1;
    $lastTreeCpy['properties']['cultivar'] = $formdata['cultivar'];
    $lastTreeCpy['properties']['family'] = $formdata['family'];
    $lastTreeCpy['properties']['kind'] = $formdata['kind'];
    $lastTreeCpy['properties']['plantingYear'] = $formdata['plantingYear'];
    $lastTreeCpy['properties']['health'] = $formdata['health'];
    $lastTreeCpy['properties']['situation'] = $formdata['situation'];
    $lastTreeCpy['properties']['wikipediaLink'] = $formdata['wikiLink'];
    $lastTreeCpy['geometry']['coordinates'] = array($formdata['long'], $formdata['lat']);


	  // Push user data to array
	  array_push($arr_data['features'],$lastTreeCpy);

    //Convert updated array to JSON
    $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
	   
	  //write json data into data.json file
	  if(file_put_contents($myFile, $jsondata)) {
	    echo 'Data successfully saved';
	  }
	  else 
	     echo "error";
   }
   catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
      exit();
   }

  /*Return*/
  exit(header("location:../index.php"));
?>
