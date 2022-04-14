<?php 

require 'db.php';
session_start();

// Make sure email and token variables aren't empty
if($_GET['email'] && $_GET['token']) 
{
    $email =$_GET['email']; 
    $token = $_GET['token']; 
    
    // Select user with matching email and token, who hasn't verified their account yet (active = 0)
    $sql=  "SELECT * FROM `test_driverdb` WHERE email='$email' AND token='$token' LIMIT 0 ";
    $query = mysqli_query($conn, $sql);

    if ( $query->num_rows > 0 )
    { 
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";       
        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}     
?>