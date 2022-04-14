
 <!DOCTYPE html>
<?php include 'header.php';?>
<?php include 'captcha.php';?>	

<br><br><br><br><br><br>


<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">            
		<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">      
		<h2>Login</h2><br>
        <p>Please fill in your credentials to login.</p>  
        <div class="help-block"><?php echo $username_err; ?></div>   
        <div class="help-block"><?php echo $password_err; ?></div>
			   <label>Username</label>
                <input type="tet" name="username" class="form-control" value="<?php echo $username; ?>">
             
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">

            </div>
            <div name="captcha" id="captcha" class="g-recaptcha" data-sitekey="6LfibkkfAAAAAP4ZIOrGsN9Hs-vuh_892hRUd3v_" ></div>
            <div class="alert alert-error"><?php echo $captcha_err; ?></div>
             <br><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
				<br><br>
					<p>Forgot Password? <a href="forgot.php">Click here</a>.</p>

            </div>
        </form>
    </div>
 <br><br><br>			  



			 			
			
				 <?php include 'footer.php';	
	                     include 'script.php'; ?>