
<?php
include('db_login.php');
session_start();
$connection = mysql_connect($db_host, $db_username, $db_password);
if (!$connection)
{
	die ("Could not connect to the database: <br />". mysql_error());
}
mysql_select_db('book');



	
// get the posted data
$userid = $_SESSION['uname'];


?>

<!DOCTYPE HTML>
<HTML>

	<HEAD>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ticket Cancelation</title>
		<link rel="stylesheet" type="text/css" href="css3/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css3/bootstrap-responsive.css">
	</HEAD>
3
	<BODY>
	<h4>PENDING</h4>
		<br><br><br>
		<div class="container">
			<div class="row">
				<div class="span10">
					<?php
						$query = "select * from seat where userid = '" . $userid . "' and salable='yes'";
						$result = mysql_query($query);
						if ( mysql_num_rows($result) == 0 )
						{
							echo "You have not booked any tickets.";
						}
						else
						{
							echo "<form action='cancelled.php' method='POST' id='myform' onsubmit='return validateCheckBox();'>";
								echo "<table align='center' class='table table-hover table-bordered table-striped span6' align='center'>";
									echo "<thead>";
										echo "<tr>";
											
											echo "<th>Seat Number</th>";
											echo "<th>PNR</th>";
											echo "<th>Date</th>";
												echo "<th>Price</th>";
										echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
								
									while($row = mysql_fetch_array($result))
									{
										echo "<tr>";
											
											echo "<td>". $row['number'] ."</td>";
											echo "<td>". $row['PNR'] ."</td>";
											echo "<td>". $row['date'] ."</td>";
											echo "<td>". $row['price'] ."</td>";
										echo "</tr>";				
									}
									
									echo "</tbody>";
								echo "</table>";
							echo "</form>";
						}
					?>
				</div>
			</div>
		</div>
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="js3/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="js3/bootstrap.js"></script>
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
			function resale()
			{
				var frm = document.getElementById("myform");
    frm.action = 'resale.php';
    return true;
			}
		</script>
	</BODY>
</HTML>
