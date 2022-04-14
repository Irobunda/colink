<?php 
session_start();
$_SESSION['message'] = "";
$_SESSION['status'] = "";

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     
    session_destroy(); 
}
$_SESSION['LAST_ACTIVITY'] = time(); 
?>
      

<!DOCTYPE html>
<?php include "header.php";
?>

			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-between">
					<div class="banner-content col-lg-6 col-md-6 ">		
					<?php if(isset($_SESSION["loggedin"]) === true) : ?> 
							<h4>Welcome,  <span class='user' style="color:red;"><?php echo $_SESSION['username'] ?></span></h4>
						<h4><a href=logout.php style="color:red;">Logout</a></h4>
						<?php endif ?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<h1 class="text"><a href="routes.php" style="color: #8ceb50">CLICK FOR BUS ROUTES </a></h1>
						</div>
								<?php if(isset($_SESSION["loggedin"])){include "banner.php";} ?>				
						</div>											
					</div>
				</div>					
			</section>


			<section class="home-about-area section-gap">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5 about-left">
							<img class="img-fluid" src="img/about-img.jpg" alt="">
						</div>					
						<div class="col-lg-7 about-right">
							<h1>About Us</h1>
						<h4>Co.Link Transport is an municipal transport service provider that
							commute people who live in other county's and work in the Dublin area.</h4>						
						 <h4><p> We aim to provide and promote inter-city public transportation choices 
							that support an accessible, sustainable, livable, healthy, prosperous 
							community. </p></h4>
							<a class="text-uppercase primary-btn" href="signupform.php">Reserve Your Seat </a>
						</div>
					</div>
				</div>	
			</section>		
			
			<section class="services-area pb-120">
				<div class="container">
					<div class="row section-title">
						<h1>Services we offer to our clients</h1>
					</div>
					<div class="row">
						<div class="col-lg-4 single-service">
							<span class="lnr lnr-car"></span>
							<a href="signupform.php"><h4>Online Bookings</h4></a>
							<p>
								Reduce stress and save your space.
							</p>
						</div>
						<div class="col-lg-4 single-service">
							<span class="lnr lnr-briefcase"></span>
							<a href="contact.php"><h4> Deliveries</h4></a>
							<p>
								Same day delivery if its along our route.
							</p>
						</div>
						<div class="col-lg-4 single-service">
							<span class="lnr lnr-bus"></span>
							<a href="contact.php"><h4>Inter-City Tour </h4></a>
							<p>Our tour service explores the island of Ireland .</p>
						</div>												
					</div>	
				</div>	
			</section>

			<section class="image-gallery-area section-gap">
				<div class="container">
					<div class="row section-title">
						<h1>Ireland Tours</h1>
						<p>Radharc álainn in Éirinn</p>
					</div>					
					<div class="row">
						<div class="col-lg-4 single-gallery">
							<a href="img/g1.jpg" class="img-gal"><img class="img-fluid" src="img/g1.jpg" ></a>
							<a href="img/g4.jpg" class="img-gal"><img class="img-fluid" src="img/g4.jpg" ></a>
						</div>	
						<div class="col-lg-4 single-gallery">
							<a href="img/g2.jpg" class="img-gal"><img class="img-fluid" src="img/g2.jpg" ></a>
							<a href="img/g5.jpg" class="img-gal"><img class="img-fluid" src="img/g5.jpg"></a>						
						</div>	
						<div class="col-lg-4 single-gallery">
							<a href="img/g3.jpg" class="img-gal"><img class="img-fluid" src="img/g3.jpg" ></a>
							<a href="img/g6.jpg" class="img-gal"><img class="img-fluid" src="img/g6.jpg"></a>
						</div>				
					</div>
				</div>	
			</section>

			<br><br>
			<section class="home-calltoaction-area relative">
				<div class="container">
					<div class="overlay overlay-bg"></div>
					<div class="row align-items-center section-gap">
						<div class="col-lg-8">
							<h1>Experience Great Support</h1>
							<p>We are ALWAYS available to serve you.</p> 				
						</div>
						<div class="col-lg-4 btn-left">
							<a href="contact.php" class="text-uppercase primary-btn" >Reach Our Support Team</a>
						</div>
					</div>
				</div>	
			</section>

			

			<button onclick="topFunction()" id="myBtn" class="arrow">↑	</button> 


			<?php 
			      include 'footer.php';	
				  include 'script.php';?>	