<?php
session_start();



$con =mysqli_connect("localhost","root","root","book");
$uid=$_POST["uid"];
$name=$_POST["uname"];
$email=$_POST["email"];
$pass=$_POST["pass"];

$num_rows = mysql_num_rows($select);

if ( $num_rows )
	$error = 'You are already registered.';

$q ='insert into register values("'.$uid.'" ,"'.$name.'","'.$email.'","'.$pass.'")';
	
	$r = mysqli_query($con ,$q);
	 //$_SESSION['message']="You are now logged in"; 
	$_SESSION['name']= $name;
	//header('Location:view.php');

header('Location:sign-in.html');
?>