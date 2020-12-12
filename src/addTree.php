<?php
  // print_r($_POST);
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  // backup data
  if (!copy("../assets/treeData/treeData.json", "../assets/treeData/treeDataBackup.json")) {
    exit();
  }

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
    $lat_min = $existing_arr_data["maxBounds"][0][0];
    $long_min = $existing_arr_data["maxBounds"][0][1];
    $lat_max = $existing_arr_data["maxBounds"][1][0];
    $long_max = $existing_arr_data["maxBounds"][1][1];

    // does the coordiantes point to the map?
    if ($formdata['long'] < $long_min || $formdata['long'] > $long_max || $formdata['lat'] < $lat_min || $formdata['lat'] > $lat_max) {
      print_r('coordinates out of map range (Bitte Wendlinger Koordinaten vergeben)');
      print_r($existing_arr_data["maxBounds"]);
      exit();
    }
    
    if (strlen($formdata['id']) > 0) { // if the client sends an id it is an update  
      // lets find the tree to update by the id
      foreach($existing_arr_data['features'] as &$item) {
        if ((int)$item['id'] == (int)$formdata['id']) {
          // change the values by the reference &$item
          $item['properties']['cultivar'] = $formdata['cultivar'];
          $item['properties']['family'] = $formdata['family'];
          $item['properties']['kind'] = $formdata['kind'];
          $item['properties']['plantingYear'] = $formdata['plantingYear'];
          $item['properties']['health'] = $formdata['health'];
          $item['properties']['situation'] = $formdata['situation'];
          $item['properties']['wikipediaLink'] = $formdata['wikiLink'];
          $item['geometry']['coordinates'] = array($formdata['long'], $formdata['lat']);
        }
      }    
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

  ?>
    <script type="text/javascript">
      window.location.href = 'https://www.ogv-wendlingen.de/treeview/index.php';
    </script>
  <?php
?>
