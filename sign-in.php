<?php
require 'db.php';
session_start();
$_SESSION['message'] = '';



            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
			$modifiedname = htmlentities($_POST['name'], ENT_QUOTES,'ISO-8859-1', true);
			$name = mysqli_real_escape_string($conn,  $modifiedname);                               //escapes special characters in the db
			$modifiedusername = htmlentities($_POST['username'], ENT_QUOTES,'ISO-8859-1', true);
			$username = mysqli_real_escape_string($conn, $modifiedusername);                        //escapes special characters in the db
			$modifiedemail = htmlentities($_POST['email'], ENT_QUOTES,'ISO-8859-1', true);
			$email = mysqli_real_escape_string($conn,  $modifiedemail); 							 //escapes special characters in the db
			$modifiedaddress = htmlentities( $_POST['address'], ENT_QUOTES,'ISO-8859-1', true);
			$address = mysqli_real_escape_string($conn,  $modifiedaddress);							 //escapes special characters in the db
			$date = mysqli_real_escape_string($conn,  $_POST['date']); 								//escapes special characters in the db
			$password = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_BCRYPT)); //escapes special characters in the db			
		    $token = substr(md5(uniqid(rand(),1)),3,10); 
		   


			//two password are equal to each other
		    if ($_POST['password'] == $_POST['confirmpassword']){

			$sql = "SELECT * FROM test_driverdb WHERE username = '$username'";
			$query = mysqli_query($conn, $sql);
		    $username_check = mysqli_num_rows($query);
		    if($username_check >0) {
				 $_SESSION['message'] = 'This username has been used';
			 }
			 else {
				$sql = "SELECT * FROM test_driverdb WHERE email = '$email'";
				$query = mysqli_query($conn, $sql);
				 $email_check = mysqli_num_rows($query);
				if($email_check >0) {
					 $_SESSION['message'] = 'This email has been used';
				 }	
					 else {
				$sql = "INSERT INTO test_driverdb (name, username, email, address, dob, password, token) 
						VALUES ('$name', '$username', '$email', '$address', '$date','$password', '$token')";
						
	
						if ($conn->query($sql) === true) {
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username; 
                                $_SESSION['message'] = "Confirmation link has been sent to $email, please verify
												 your account by clicking on the link in the message!";
								
								 
							
									$to      = $email;
									$subject = ' IRELAND TRAVEL Account Verification ';
									$message_body = '
Hello '.$name.',
							
Thank you for signing up!Please click this to activate your account
http://localhost:8080/projectspw/verify.php?email='.$email.'&token='.$token'';
									 
							
							mail( $to, $subject, $message_body );							
							header("location: success.php");           
						}
						else {
							$_SESSION['message'] = "User coud not be added to the database";
							header("location: error.php");
						}       
				 }
					}

			
			}

			}


		

?>
