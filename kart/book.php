

<!DOCTYPE HTML>
<HTML>

	<HEAD>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Book the ticket</title>
		<link rel="stylesheet" type="text/css" href="css3/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css3/bootstrap-responsive.css">
	</HEAD>

	<BODY>

		<br>
		<div class="container">
	        <div class="page-header">
	            <h1>Book the tickets</h1>
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
			<form name="contactForm" action="register-booking.php" method="POST" class="form-horizontal">
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
							echo "<input type='checkbox' value='babysitting' name='babysitting'>";
							echo "<input type='checkbox' value='handicapped' name='Handicapped'>";
							
							echo "</div>";
							echo "</div>";
							echo "<div class='control-group'>";
							echo "<label class='control-label' for='price'>Price</label>";
							echo "<div class='controls'>";
							echo "<input type='text' value='$price' name='price' readonly>";
							echo "</div>";
							echo "</div>";
							echo "<input type='hidden' value='$c' name='reward'>";
					?>
	            
	            <div class="form-actions">
	                <input type="hidden" name="save" value="contact">
					<button type="submit" class="btn btn-info">
						<i class="icon-ok icon-white"></i> Book
					</button>

					<button type="reset" class="btn">
						<i class="icon-refresh icon-black"></i> Clear
					</button>
	            </div>

			</form>
		</div>

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="js3/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="js3/bootstrap.js"></script>
	</BODY>
</HTML>