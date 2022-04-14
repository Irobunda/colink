<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION["loggedin"]) === true){
    header("location: index.php");
    exit;
}
 
// Include db file
require_once "db.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$captcha = $captcha_err = "";

  if(isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
    if(!$captcha){
        $captcha_err =  ' Please check the the captcha form. ';
      }else{
        $secretKey = "6LfibkkfAAAAAPMVMgLhUICcgydLDNx7q_6AI6lk";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
          include 'log-in.php';
        } else {

            $_SESSION['message'] = ' Robo Bot. Bye!';
            header("location: error.php");
        }
      }
      
  }
  
?>

