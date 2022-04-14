<?php
require 'db.php';
$_SESSION['status'] = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
			$modifiedname = htmlentities($_POST['name'], ENT_QUOTES,'ISO-8859-1', true);
			$name = mysqli_real_escape_string($conn,  $modifiedname); //escapes special characters in the db
			$modifiedphone = htmlentities($_POST['phone'], ENT_QUOTES,'ISO-8859-1', true);
			$phone = mysqli_real_escape_string($conn, $modifiedphone);//escapes special characters in the db
			$modifiedemail = htmlentities($_POST['email'], ENT_QUOTES,'ISO-8859-1', true);
			$email = mysqli_real_escape_string($conn,  $modifiedemail); //escapes special characters in the db
            $seat= mysqli_real_escape_string($conn,  $_POST['seat']); //escapes special characters in the db
            $from= mysqli_real_escape_string($conn,  $_POST['from']); //escapes special characters in the db
			$going = mysqli_real_escape_string($conn,  $_POST['to']); //escapes special characters in the db
		    $date = mysqli_real_escape_string($conn,  $_POST['date']); 
			

			$sql = "INSERT INTO `booking` (`name`, `email`, `phone`, `seat`, `from`, `to`, `date`) 
					VALUES ('$name', '$email', '$phone', '$seat', '$from', '$going', '$date')";
			$query = mysqli_query($conn, $sql);			
	
			if ($query) {
				 
	      
			$to      = $email;
			$subject = ' IRELAND TRAVEL Ticket Registration ';
			$message_body = '
Hello '.$name.',
	
You have saved your seat(s) on bus '.$from.' to '.$going.'
 Please be at the stop atleast 10 minutes before departure time.' ; 
	
							mail( $to, $subject, $message_body );

							$_SESSION['status'] = 'Message sent. Check email for confirmation';
							       
						}
						else{
							$_SESSION['status'] = "Booking Failed";
						}
                    
		}	

?>