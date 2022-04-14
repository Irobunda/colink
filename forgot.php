<?php 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();
$errors = [];

if ( isset($_POST['email'] )) 
{   
  
    $email =  mysqli_real_escape_string($conn,  $_POST['email']);
	$sql = "SELECT * FROM test_driverdb WHERE email='$email'";
    $result =  mysqli_query($conn, $sql);

    if ( $result->num_rows == 0 ) // User doesn't exist
    {   $_SESSION['message'] = "If that email address is in our database, 
		we will send you an email to reset your password.";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)
	
        $forgot = mysqli_fetch_assoc($result);

		$email = $forgot['email'];
		$token = $forgot['token']; 
		
		
	        $sql ="UPDATE test_driverdb SET token='$token', 
                      active =DATE_ADD(NOW(), INTERVAL 30 MINUTE)
                      WHERE email='$email'
		 ";
				
		
        // Send registration confirmation link (reset.php)
        $to      = $email;
        $headers = "From: nci.projectemail@gmail.com  \r\n";
		$headers .= "Reply-To: nci.projectemail@gmail.com \r\n";    
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $message = "
	            Hi,<br><br>
	            
	            In order to reset your password, please click on the link below:<br>
	            <a href='
	            http://localhost:8080/projectspw/reset.php?email=$email&token=$token
	            '>click on this link</a><br><br>
	            
	            Kind Regards,<br>
	            Carpool Team
	        ";

        if ( @mail($to, $email, $message, $headers)){
			$_SESSION['message'] = "<p>Please check your email <span>$email</span>"
             . " for a confirmation link to complete your password reset!</p>";	
	             header("location: success.php");
				 			 
           }
		}
	}
?>


<!DOCTYPE html>
<?php include "header.php";?>	
<br><br><br><br><br>
 
   <div class="container">								   
    <form class="form" action="forgot.php" method="post">
     <div class="form-group">  
	 <h4>Enter your email address</h4><br>
      <label>Email Address<span class="req">*</span>  </label>   
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button type="submit" class="btn btn-primary"/>Reset</button>
    </form>
  </div>
   
		        <style>
					form {
						color: black;
						padding: 50px;
						margin: 80px auto;
						border: 10px ;
						background-color: white;
						width: 100%
					}
			


					button {
						background-color: #f9d700;
						color: white;
						margin: 10px 0;
						cursor: pointer;
						width: 10%;
						opacity: 0.9;
						
					}


					</style>
  
			<footer class="footer-area section-gap">
				 <?php include 'footer.php';
                    include 'script.php';?>