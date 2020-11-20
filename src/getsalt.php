<?php
  session_start();
  include('config.php');
  include('connect.php');
  $name = isset($_GET['name']) ? $_GET['name'] : '';
  function generateSalt() {
    $salt = '';
    if(empty($salt)) {
      $charset = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r',
            's','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J',
            'K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','Ã–','Ãœ',
            '0','1','2','3','4','5','6','7','8','9','.','-','^','*','~','Â°','%','&',
            '(',']','[',')','Â§','?','!','#','|','$','>','<','+','_','{','}','Â´','Â¸');
      for($i = 0; $i < 16; $i++) {
        $salt .= $charset[mt_rand(0, (count($charset)-1))];
      }
    }
    return $salt;
  }
  function saveSalt($db, $salt, $name) {}
  $usalt = '';
  $usalt = generateSalt();
  saveSalt($db, $usalt, $name);
  exit(json_encode(array('salt' => sha1($usalt))));
?>