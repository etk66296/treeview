<?php
  $userName = htmlspecialchars($_POST["name"]);
  $userPassword = htmlspecialchars($_POST["password"]);
  session_start();
  echo $userName . " " . $userPassword . " " . $_SESSION['passPhrase'];
?>
