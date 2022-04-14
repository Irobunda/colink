<?php include 'book.php';?>

<?php 
       if(isset($_SESSION["loggedin"])){
		   ?>
         <div class="col-lg-4  col-md-6 header-right">
		  <h4 class="pb-30">Reserve Your Seat!</h4>

		  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" autocomplete="off" ;?> 
		  <div class="from-group">
				  <input class="form-control txt-field" type="text" name="name" placeholder="Your name" required >
				  <input class="form-control txt-field" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"  type="text" name="email" placeholder="Email address" required>
				  <input class="form-control txt-field" type="tel" name="phone" placeholder="Phone number">
				  <input class="form-control txt-field" type="text" name="seat" placeholder="How many Seats" required>
				  
			  </div>								
			  <div class="form-group">
			  <div class="default-select" id="default-select2" required>
			  <select name="from">
					<option value="">From Destination</option>
					<option value="Bachelors Walk ">Bachelors Walk </option>
					<option value="Connolly Station">Connolly Station</option>
					<option value="Heuston Station">Heuston Station</option>
					<option value="kilcock">kilcock</option>
					<option value="Meath ">Meath </option>
					<option value="Mullingar">Mullingar</option>					
			</select>
					</div>
					</div>
			<div class="form-group">
			<div class="default-select" id="default-select2" required>
			<select name= "to">
				<option value="">To Destination</option>
				<option value="kilcock">kilcock</option>
				<option value="Meath ">Meath </option>
				<option value="Mullingar">Mullingar</option>
				<option value="Bachelors Walk ">Bachelors Walk </option>
				<option value="Connolly Station">Connolly Station</option>
				<option value="Heuston Station">Heuston Station</option>				
			</select>
					</div>
			  </div>					    
			  <div class="form-group">
				  <div class="input-group dates-wrap">                                              
					  <input id="datepicker2" class="dates form-control" name="date" placeholder="Date" type="text" required>                        
					  <div class="input-group-prepend">
						  <span  class="input-group-text"><span class="lnr lnr-calendar-full"></span></span>
					  </div>											
				  </div>
			  </div>							    
			  <div class="form-group">

					  <button class="btn btn-default btn-lg btn-block text-center text-uppercase" type="submit" value ="register" name="register">Make reservation</button>
					  <div class="alert alert-error"> <h4 class="pb-10"><?= $_SESSION['status'] ?></h4> </div>

			  </div>
		
	  </div>
	  </form>
		   <?php
	   }else{
		header( "location: index.php" );
	   }
				
?>