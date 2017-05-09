<!--
<Ticket-Booking>
Copyright (C) <2013>  
<Abhijeet Ashok Muneshwar>
<openingknots@gmail.com>
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
 any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

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
	$q="select * from seat where date='".$doj."' , salable='yes' and number= '".$s."'";
	
	if(mysql_query($q))
	{
	
		$w=mysql_query($q);
		$row = mysql_fetch_assoc($w);	
		$count=0;
      	$uname= $row['userid'];
      	echo $uname;
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
echo "Congratulation  you have successfully booked your ticket!!";
echo "<a href='kart/front-login.html'>Click here to go back!</a>";
?>