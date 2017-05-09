
<!DOCTYPE html>
<html lang="en">

<head>
<style>
body{
	background-image: url("wal.jpg");
.a{
	width:20px;
	height:10px;
}
}

</style>
</head>
<body>
<center>
<div class="a">
<center><h1>Welcome to your wallet</h1></center>
<img  src="wal1.png" style="width:5px,height:10px;">
</div>
</center>
</body>
</html>


<?php
include('db_login.php');
session_start();

$userid=$_SESSION['uname'];
$connection = mysql_connect($db_host, $db_username, $db_password);
mysql_select_db('book');
	$query1="select wallet from register where userid='".$userid."'";
					$result = mysql_query($query1) or die(mysql_error());
		if($row = mysql_fetch_assoc($result))
		{
    		  $count= $row['wallet'];
		}
		echo "<center><b><font size=10>";
		echo $count;
		echo "</font></b></center>";
		echo '<center><a href="\book\kart\front.html"><b><h3>Log Out<h3></b></a></center>';
?>

