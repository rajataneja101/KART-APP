

<!DOCTYPE HTML>

<?php
	include('db_login.php');
	session_start();
	$connection = mysql_connect($db_host, $db_username, $db_password);
	if (!$connection)
	{
		die ("Could not connect to the database: <br />". mysql_error());
	}
	mysql_select_db('book');
?>

<HTML>

	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Seat Booking</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Moivie Ticket Booking</title>
	
		<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
		<link href="css2/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css2/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css2/style.css" rel="stylesheet">
</head>

	<BODY style="background-image: url('back.jpg')">
	<nav class="navbar fixed-top navbar-toggleable-md navbar-dark" style="background: rgb(2,11,28);">
    <div class="container">
        <a class="navbar-brand" href="/book/kart/front.html">
           <center> <strong>SPI-Cinema</strong></center>
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
		<br><br><br>
		<div class="container">
		<div class="card text-center">

		 <h4 class="card-title card-blue" style=" margin: 30px;
  background-color: #ffffff;
  border: 1px solid black;
  opacity: 0.6;
  filter: alpha(opacity=60); "><span><strong><center><br>SCREEN THIS SIDE</center></strong></h4>
		 <hr>
		<div class="col-sm-8" sytle="padding-left:40px;">
			<div class="card-block">
				<div class="span10" style="padding-left:150px">
					<form action="book.php" method="POST" onsubmit="return validateCheckBox();">
						<ul class="thumbnails">

						<?php
							$date = strip_tags( utf8_decode( $_POST['doj'] ) );
							$query = "select * from seat where date = '" . $date . "' and salable !='yes'";
							$result = mysql_query($query);

							if ( mysql_num_rows($result) == 0 )
							{
								for($i=1; $i<31; $i++)
								{


									echo "<li class='span1'>";
										echo "<a href='#' class='thumbnail' title='Available'>";
											echo "<img src='img/available.png' alt='Available Seat'/>";
											echo "<label class='checkbox'>";
												echo "<input type='checkbox' name='ch".$i."'/>Seat ".$i;
											echo "</label>";
										echo "</a>";
									echo "</li>";								
								}
								
								
							}
							else
							{
								$seats = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0,0,0,0,0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
								while($row = mysql_fetch_array($result))
								{
									$pnr = explode("-", $row['PNR']);
									$pnr[3] = intval($pnr[3]) - 1;
									$seats[$pnr[3]] = 1;
								}
								for($i=1; $i<31; $i++)
								{
									$j = $i - 1;
									if($seats[$j] == 1)
									{
										echo "<li class='span1'>";
											echo "<a href='#' class='thumbnail' title='Booked'>";
												echo "<img src='img/occupied.png' alt='Booked Seat'/>";
												echo "<label class='checkbox'>";
													echo "<input type='checkbox' name='ch".$i."' disabled/>Seat ".$i;
												echo "</label>";
											echo "</a>";
										echo "</li>";
									}
									else
									{
										echo "<li class='span1'>";
											echo "<a href='#' class='thumbnail' title='Available'>";
												echo "<img src='img/available.png' alt='Available Seat'  />";
												echo "<label class='checkbox'>";
													echo "<input type='checkbox' name='ch".$i."'/>Seat ".$i;
												echo "</label>";
											echo "</a>";
										echo "</li>";
									}
								}

								
							}
						?>
						</ul>
						<center>
							<label>Date of Booking</label>
							<center>
							<?php
								echo "<center><input type='text' class='span2' name='doj' value='". $date ."' readonly/></center>";
							?>
							</center>
							<br><br>
							<button type="submit" class="btn btn-info">
								<i class="icon-ok icon-white"></i> Submit
							</button>
							<button type="reset" class="btn">
								<i class="icon-refresh icon-black"></i> Clear
							</button>
							<a href="./index.php" class="btn btn-danger"><i class="icon-arrow-left icon-white"></i> Back </a>
						</center>
					</form>
				</div>
			
			</div>
			</div>

			</div>
		</div>

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript">
			function validateCheckBox()
			{
				var c = document.getElementsByTagName('input');
				for (var i = 0; i < c.length; i++)
				{
					if (c[i].type == 'checkbox')
					{
						if (c[i].checked) 
						{
							return true;
						}
					}
				}
				alert('Please select at least 1 ticket.');
				return false;
			}
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