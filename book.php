


<!DOCTYPE HTML>
<HTML>

	<HEAD>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Booking Summary</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
	</HEAD>
	<style>
  .services-section {
  background-color: #F9F9F9;
}

.services-section hr {
  border-bottom: 2px solid #24b662;
  width: 40px;
  margin-left: 0px;
}

.services-section .services-detail {

  border-radius: 4px;
  border-bottom-right-radius: 20%;
  background-color: #ffffff;
  box-shadow: 0px 1px 2px 0px rgba(90, 91, 95, 0.15);
  transition: all 0.3s ease-in-out;
  position: relative;
  top: 0px;
  padding: 60px 40px 60px 40px;
  margin-top: 32px;
}

.services-section .services-detail:hover {
  border-bottom-right-radius: 4px;
  box-shadow: 0px 16px 22px 0px rgba(90, 91, 95, 0.3);
  top: -5px;
}

.services-section .services-detail .fa {
  font-size: 42px;
}
</style>


	<BODY>
	<nav class="navbar fixed-top navbar-toggleable-md navbar-dark" style="background: rgb(2,11,28); padding-bottom: 25px;">
    <div class="container">
        <a class="navbar-brand" href="/kart/front-login.html">
            <strong>SPI-Cinema</strong>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav1">
          <ul class="nav navbar-nav navbar-right">
              <li class="nav-item">
                  <a class="nav-link" href="sign-up.html"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign-Up</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="sign-in.html"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign-In</a>
              </li>
          </ul>
        </div>
    </div>
   </nav>
   <section id="services" class="services-section section-space-padding">
        <div class="container">
           
            <div class="span12">
            <div class="services-detail" style="padding-top:80px">

		<br>
		<div class="container">
	        <div class="page-header">
	            <center><h1>Book the tickets</h1></center>
	        </div>			
			<?php
			include('db_login.php');
	session_start();
	$connection = mysql_connect($db_host, $db_username, $db_password);
	if (!$connection)
	{
		die ("Could not connect to the database: <br />". mysql_error());
	}
	mysql_select_db('book');
			
			$userid=$_SESSION['uname'];
					$price=100;
					$c=10;
					$query1="select wallet from register where userid='".$userid."'";
					$result = mysql_query($query1) or die(mysql_error());
if($row = mysql_fetch_assoc($result))
{
      $count= $row['wallet'];
}
					// check for a successful form post
					if (isset($_GET['s'])) 
					{
						echo "<div class=\"alert alert-success\">".$_GET['s']." You will be automatically redirected after 5 seconds.</div>";
//						echo "You will be automatically redirected after 5 seconds.";
						header("refresh: 5; index.php");
					}

					// check for a form error
					elseif (isset($_GET['e'])) echo "<div class=\"alert alert-error\">".$_GET['e']."</div>";

			?> 
			<form name="contactForm" id="contactForm" action="register-booking.php" method="POST" class="form-horizontal">
				<div class='control-group'>
					<label class='control-label' for='input1'>Seat Numbers</label>
					<div class='controls'>
					<?php 
						for($i=1; $i<31; $i++)
						{
							$chparam = "ch" . strval($i);
							if(isset($_POST[$chparam]))
							{
								echo "<input type='text' class='span3' name=ch".$i." value=".$i." readonly/><br>";
								$price+=$price;
								$c+=$count;
							}
						}
					?>
	                </div>
	            </div>
	  
					<?php
					$price/=2;
						if(isset($_POST['doj']))
						{
							echo "<div class='control-group'>";
							echo "<label class='control-label' for='input1'>Date of Journey</label>";
								echo "<div class='controls'>";
									echo "<input type='text' name='journey_date' id='input1' class='span3' value=". $_POST['doj'] ." readonly />";
								echo "</div>";
							echo "</div>";

						}
						echo "<div class='control-group'>";
							echo "<label class='control-label' for='babysitting'>baby-sitting?</label>";

							
							echo "<div class='controls'>";
							echo '
							<select id="bs" name="baby-sitting">
  								<option value="0">0</option>
  								<option value="1">1</option>
  								<option value="2">2</option>
  								<option value="3">3</option>
  								<option value="4">4</option>
							</select> Price per service Rs.50/-' ;
							
							echo "</div>";
							echo "</div>";
							echo "<div class='control-group'>";
							echo "<label class='control-label' for='babysitting'>Handicapped people?</label>";

							
							echo "<div class='controls'>";
							echo '
							<select id="bs" name="baby-sitting">
  								<option value="0">0</option>
  								<option value="1">1</option>
  								<option value="2">2</option>
  								<option value="3">3</option>
  								<option value="4">4</option>
							</select> Price per service Rs.50/-' ;
							
							echo "</div>";

							echo "<div class='control-group'>";
							echo "<label class='control-label' for='price'>Price of Ticket</label>";
							echo "<div class='controls'>";
							echo "<input type='text' value='$price' name='price' id='price' readonly>";
							echo "</div>";
							echo "</div>";
							echo "<center>";
							echo "<div>";
							echo "<center><input type='hidden' value='$c' name='reward'></center>";
							
  							echo "</center>";
					?>
	            <center>
	            <div>
	                <input type="hidden" name="save" value="contact">
					<button type="submit" class="btn btn-info">
						<i class="icon-ok icon-white"></i> Book
					</button>

					<button type="reset" class="btn">
						<i class="icon-refresh icon-black"></i> Clear
					</button>
	            </div>
</center>
			</form>
		</div>
		 </div>
            </div>
                
            
        </div>
</section>

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript">
			<script>
var calculateTax = function(event) {
  event.preventDefault();
  var price = document.getElementById("price").value;
  var tax = .0825;
  document.getElementById("total").value = price * tax;
}
var form = document.getElementById('contactForm');
form.addEventListener('submit', calculateTax, false);
</script>
		</script>
		<footer class="page-footer center-on-small-only"  style="background: rgb(3,6,15);">

    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">

            <!--First column-->
            <div class="col-md-3 offset-md-1">
                <p>About Us</p>
                
            </div>
            
            
            
            
            
            <!--/.First column-->

            <hr class="hidden-md-up">

            <!--Copyright-->
    <div class="col-md-4 text-center">
            <div class="container-fluid">

            © 2015 Copyright 2017 team KART</a>
</div>
        
    </div>
    <!--/.Copyright-->

           

     <div class="col-md-3 offset-md-1">
                <p>Designed by KART</p>
                
            </div>      

        
    </div>
    </div>
    <!--/.Footer Links-->

    

    <!--Social buttons-->
    
    <!--/.Social buttons-->

    

</footer>
	</BODY>
</HTML>