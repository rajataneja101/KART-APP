

<?php
include('db_login.php');
session_start();

$userid=$_SESSION['uname'];
$connection = mysql_connect($db_host, $db_username, $db_password);
if (!$connection)
{
	die ("Could not connect to the database: <br />". mysql_error());
}
mysql_select_db('book');

// check for form submission - if it doesn't exist then send back to contact form
if (!isset($_POST['save']) || $_POST['save'] != 'contact') {
    header('Location: book.php'); exit;
}

$doj = strip_tags( utf8_decode( $_POST['journey_date'] ) );
$price=$_POST['price'];
$reward=$_POST['reward'];


$seatNumber = NULL;

for($i=1; $i<31; $i++)
{
	$chparam = "ch" . strval($i);
	$calcPNR = $doj . "-" . strval($i);
	if( !empty($_POST[$chparam]) )
	{
	$s=$_POST[$chparam];
	$q="select * from seat where date='".$doj."' and salable='yes' and number= '".$s."'";
	$w=mysql_query($q);
	if(mysql_query($q) or die(mysql_error()))
	{
	if($row = mysql_fetch_assoc($w))
	{
		$count=0;
      	$uname= $row['userid'];
      	$query1="select wallet from register where userid='".$uname."'";
					$result = mysql_query($query1) or die(mysql_error());
		if($row = mysql_fetch_assoc($result))
		{
    		  $count= $row['wallet'];
		}
		$count+=80;
		$query2 = "update register set wallet='".$count."' where userid='".$uname."'";
		$results = mysql_query($query2);
		if (!$results)
		{
			die ("Could not update seat: <br />". mysql_error());
		}
		$query3="update seat set userid='".$userid."', salable='no' where  date='".$doj."' and salable='yes' and number= '".$s."'";
		$r2=mysql_query($query3);
		echo $userid;
	}
	}
	else
	{
	
		
		if(isset($_POST['babysitting']))
		{
			$query = "INSERT INTO seat(userid, number, PNR, date,babysitting,price) VALUES ('". $userid ."', '" . intval($i) . "', '". $calcPNR ."', '". $doj ."','yes',100)";
			$query1 = "update register set wallet='".$reward."' where userid='".$userid."'";
			$r=mysql_query($query1);
		$results = mysql_query($query);
		if (!$results)
		{
			die ("Could not update seat: <br />". mysql_error());
		}
		$seatNumber = $seatNumber .", ". "$i";
		}
		else
		{
		$query = "INSERT INTO seat(userid, number, PNR, date) VALUES ('". $userid ."', '" . intval($i) . "', '". $calcPNR ."', '". $doj ."')";
		$query1 = "update register set wallet='".$reward."' where userid='".$userid."'";
			$r=mysql_query($query1);
		$results = mysql_query($query);
		if (!$results)
		{
			die ("Could not update seat: <br />". mysql_error());
		}
		$seatNumber = $seatNumber .", ". "$i";	
		}
		
	}
}

}
?>
