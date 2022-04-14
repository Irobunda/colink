<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<?php include "header.php";?>	
<br><br><br><br><br><br>  

   
				<div class="container">								   
					<form class="form" action="errordriver.php" method="post">
					 <div class="form-group"> 
					<h1>Error</h1>
					<p>
					<?php 
					if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
						echo $_SESSION['message'];    
					else:
						header( "location: index.php" );
					endif;
					?>
					</p>     
					<a href="reset.php">Try again</a>
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
			
					button {
						background-color: #f9d700;
						color: white;
						margin: 10px 0;
						cursor: pointer;
						width: 10%;
						opacity: 0.9;
						
					}
					</style>
					
					

				 <?php include 'footer.php';
                      include 'script.php' ; ?>