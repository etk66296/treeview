<?php
  $servername = "localhost";
  $username = "root";
  $password = "asdf";
  $db = "treeview_users";

  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
  
  // // Create connection
  $conn = new mysqli($servername, $username, $password, $db);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";


  // function generateRandomString($length = 10) {
  //   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  //   $charactersLength = strlen($characters);
  //   $randomString = '';
  //   for ($i = 0; $i < $length; $i++) {
  //     $randomString .= $characters[rand(0, $charactersLength - 1)];
  //   }
  //   return $randomString;
  // }
  // session_start();
  // $_SESSION['passPhrase'] = generateRandomString();
  // echo $_SESSION['passPhrase'];
?>