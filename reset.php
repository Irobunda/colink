<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token']) )
{
    $email = mysqli_real_escape_string($conn,$_GET['email']); 
    $token = mysqli_real_escape_string($conn,$_GET['token']); 

    // Make sure user email with matching hash exist
    $sql= "SELECT * FROM test_driverdb WHERE email='$email' AND token='$token'" ;
	$result = ($conn->query($sql));

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: errorpasswordreset.php");
    }
}
else { if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // Make sure the two passwords match
    if ( $_POST['password'] == $_POST['confirmpassword'] ) { 

        $password = "password" ;
		$password = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_BCRYPT));			
		
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $token = mysqli_real_escape_string($conn,$_POST['token']);
        
        $sql = "UPDATE test_driverdb SET password='$password', token='$token' WHERE email='$email'";

        if ( $conn->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: success.php");    

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: errorpasswordreset.php");    
    }
  } 
}
?>



<!DOCTYPE html>
<?php include "header.php";?>	
<br><br><br><br><br>
   
   
<body>
   <div class="container">								   
    <form class="form" action="reset.php" method="post">
     <div class="form-group">  
          <h4>Choose Your New Password</h4><br>       
          <form action="reset_password.php" method="post">              
          <div class="field-wrap">
            <label> New Password</label>          
            <input type="password" required  name="password" autocomplete="off" class="req"/>
          </div>   <br>           
          <div class="field-wrap">
            <label> Confirm New Password</label>     
            <input type="password"required name="confirmpassword" autocomplete="off" class="req"/>
          </div>        
         
		 <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="token" value="<?= $token ?>">                
          <button class="btn btn-primary"/>Apply</button>
          </form>
    </div>
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

						/* Full-width input fields */
					input[type=text], input[type=password] {
						width: 30%;
						padding: 10px;
						margin: 5px;
						display: inline-block;
						border: none;
						background: #f1f1f1;
					}

					/* Set a style for all buttons */
					.btn btn-primary {
						background-color: #f9d700;
						color: white;
						margin: 50px 0;
						cursor: pointer;
						width: 50%;
						opacity: 0.9;
					}


					</style>

				 <?php include 'footer.php';
	                   include 'script.php'?>
</body>
</html>