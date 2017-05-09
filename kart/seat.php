

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
    <title>Book Your Ticket Now</title>
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
		
	
		<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
</head>

	<BODY>
		<br /><br /><br />
		<div class="container">
		<div class="card text-center">
		 <h4 class="card-title"><strong><center>SCREEN THIS SIDE</center></strong></h4>
		 <hr>
		<div class="col-sm-8">
			<div class="card-block">
				<div class="span10">
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
												echo "<img src='img/available.png' alt='Available Seat'/>";
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
							<label>Date of Journey</label>
							<?php
								echo "<input type='text' class='span2' name='doj' value='". $date ."' readonly/>";
							?>
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
	</BODY>
</HTML>