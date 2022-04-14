<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'webhost2');
define('DB_USERNAME', 'carpooln');
define('DB_PASSWORD', 'uchecarpool123456');
define('DB_NAME', 'carpooln_cplng');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

/* Database connection settings */
$host = 'webhost2';
$user = 'carpooln';
$pass = 'uchecarpool123456';
$db = 'carpooln_cplng';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);


$servername = "webhost2";
$username = 'carpooln';
$password = "uchecarpool123456";
$dbname = "carpooln_cplng";

$conn = new mysqli($servername, $username, $password, $dbname);




// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

				    if(mysqli_stmt_fetch($stmt)){						
                        if(md5($password) == $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM driverscplng WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

				    if(mysqli_stmt_fetch($stmt)){						
                        if(md5($password) == $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}


if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token']) )
{
    $email = $mysqli->escape_string($_GET['email']); 
    $token = $mysqli->escape_string($_GET['token']); 

    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND token='$token'");

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
		$password = mysqli_real_escape_string($conn, $_POST['password']);			
		$password = md5($_POST['password']);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $mysqli->escape_string($_POST['email']);
        $token = $mysqli->escape_string($_POST['token']);
        
        $sql = "UPDATE driverscplng SET password='$password', token='$token' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

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



if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token']) )
{
    $email = $mysqli->escape_string($_GET['email']); 
    $token = $mysqli->escape_string($_GET['token']); 

    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM driverscplng WHERE email='$email' AND token='$token'");

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
		$password = mysqli_real_escape_string($conn, $_POST['password']);			
		$password = md5($_POST['password']);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $mysqli->escape_string($_POST['email']);
        $token = $mysqli->escape_string($_POST['token']);
        
        $sql = "UPDATE driverscplng SET password='$password', token='$token' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: success.php");    

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: errorpasswordresetdriver.php");    
    }
  } 
}





		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//two password are equal to each other
		    if ($_POST['password'] == $_POST['confirmpassword']){
				
		    $name = "name" ;
			$username = "username" ;
			$email = "email" ;
			$address = "address" ;
			$date = "date" ;
			$password = "password" ;
			
			$name = mysqli_real_escape_string($conn,  $_POST['name']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);//escapes special characters in the db
			$email = mysqli_real_escape_string($conn,  $_POST['email']); //escapes special characters in the db
			$address = mysqli_real_escape_string($conn,  $_POST['address']);
			$date = mysqli_real_escape_string($conn,  $_POST['date']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);			
			$password = md5($_POST['password']);
			
			$sql = "SELECT id FROM users WHERE username = '$username'";
			 $query = mysqli_query($conn, $sql);
			 $username_check = mysqli_num_rows($query);
			 if($username_check >0) {
				 $_SESSION['message'] = 'This username has been used';
			 }
				
            $sql = "SELECT id FROM users WHERE email = '$email'";
		    $query = mysqli_query($conn, $sql);
	     	$email_check = mysqli_num_rows($query);
		    if($email_check >0) {
				 $_SESSION['message'] = 'This email has been used';
			 }	
				 else {
			$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
					
					//if the query is successful, redirect to welcome.php
					if ($conn->query($sql) === true) {
					$_SESSION['message'] = "Registration Successful! ";
					}
					else {
						$_SESSION['message'] = "User could not be added to the databse";
					}       
             }
			}

					else {
						$_SESSION['message'] = "Two passwords do not match";
					}
		}
		
		        
		    
			
				
  	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//two password are equal to each other
		    if ($_POST['password'] == $_POST['confirmpassword']){
				
		    $name = "name" ;
			$username = "username" ;
			$email = "email" ;
			$address = "address" ;
			$date = "date" ;
			$password = "password" ;
			
			$name = mysqli_real_escape_string($conn,  $_POST['name']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);//escapes special characters in the db
			$email = mysqli_real_escape_string($conn,  $_POST['email']); //escapes special characters in the db
			$address = mysqli_real_escape_string($conn,  $_POST['address']);
			$date = mysqli_real_escape_string($conn,  $_POST['date']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);			
			$password = md5($_POST['password']);
			
			$sql = "SELECT id FROM driverscplng WHERE username = '$username'";
			 $query = mysqli_query($conn, $sql);
			 $username_check = mysqli_num_rows($query);
			 if($username_check >0) {
				 $_SESSION['message'] = 'This username has been used';
			 }
		
             $sql = "SELECT id FROM driverscplng WHERE email = '$email'";
			 $query = mysqli_query($conn, $sql);
			 $email_check = mysqli_num_rows($query);
			 if($email_check >0) {
				 $_SESSION['message'] = 'This email has been used';
			 }	
				 
				 else{
			$sql = "INSERT INTO driverscplng (name, username, email, address, dob, password) VALUES ('$name', '$username', '$email', '$address', '$date', '$password')";
					
					//if the query is successful, redirect to welcome.php
					if ($conn->query($sql) === true) {
					$_SESSION['message'] = "Registration Successful! Added $username to the database";
					header("location: welcome.php");
					}
					else {
						$_SESSION['message'] = "User could not be added to the database";
					}       
             }
           }

					else {
						$_SESSION['message'] = "Two passwords do not match";
					}
		}		    


?>