<?php
  // print_r($_POST);
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  $myFile = "../assets/treeData/treeData.json";
  $existing_arr_data = array(); // create empty array
  try
  {
    //Get form data
	  $formdata = array(
      'id' => $_POST['treeid'],
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
    $existing_arr_data = json_decode($jsondata, true);
    
    

    if (strlen($formdata['id']) > 0) { // if the client sends an id it is an update
      print_r($formdata['id']);
      // lets find the tree to update by the id

    } else {
      $lastTreeCpy = end($existing_arr_data['features']);// copy the last element
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
	    array_push($existing_arr_data['features'],$lastTreeCpy);
    }
    
    //Convert updated array to JSON
    $jsondata = json_encode($existing_arr_data, JSON_PRETTY_PRINT);
	   
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
  // exit(header("location:../index.php"));
?>
