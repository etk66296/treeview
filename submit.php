<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
// print_r($_POST);
// enable this line when release the login
// if((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') or empty($_POST)){/*Detect AJAX and POST request*/
if(empty($_SERVER) or empty($_POST)){
  exit("Unauthorized Access");
}
require('src/config.php');
require('src/loginFunctions.php');

/* Check Login form submitted */
if(!empty($_POST) && $_POST['Action'] == 'login_form'){
    /* Define return | here result is used to return user data and error for error message */
    $Return = array('result'=>array(), 'error'=>'');

    $email = safe_input($con, $_POST['Email']);
    $password = safe_input($con, $_POST['Password']);

    /* Server side PHP input validation */
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $Return['error'] = "Please enter a valid Email address.";
    } elseif($password==='') {
        $Return['error'] = "Please enter Password.";
    }

    if($Return['error'] != ''){
        output($Return);
    }

    /* Check Email and Password existence in DB */
    $result = mysqli_query($con, "SELECT * FROM tbl_users WHERE email='$email' AND password='".md5($password)."' LIMIT 1");
    
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        /* Success: Set session variables and redirect to Protected page */
        $Return['result'] = $_SESSION['UserData'] = array('user_id'=>$row['user_id']);
    } else {
        /* Unsuccessful attempt: Set error message */
        $Return['error'] = 'Invalid Login Credential.';
        output($Return);
    }

    /*Return*/
    exit(header("location:index.php"));
}
?>