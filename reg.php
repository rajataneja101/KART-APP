<?php
session_start();



$con =mysqli_connect("localhost","root","root","book");
$uid=$_POST["uid"];
$name=$_POST["uname"];
$email=$_POST["email"];
$pass=$_POST["pass"];
if (empty($uid))
    $error = 'You must enter your name.';




// check that user id was entered
if (empty($name))
    $error = 'You must enter your user id.';

// check that an email address was entered
elseif (empty($email)) 
    $error = 'You must enter your email address.';
// check for a valid email address
elseif (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email))
    $error = 'You must enter a valid email address.';
	$select = mysql_query("select * from register where userid = '" . $userid . "'", $con);

//$query = mysql_real_escape_string($select);

$num_rows = mysql_num_rows($select);

if ( $num_rows )
	$error = 'You are already registered.';
	
	
// check if an error was found - if there was, send the user back to the form
if (isset($error)) {
    header('Location: book.php?e='.urlencode($error)); exit;
}

// check that a message was entered
if (empty($pass))
    $error = 'You must enter password.';
$q ='insert into register values("'.$uid.'" ,"'.$name.'","'.$email.'","'.$pass.'")';
	
	$r = mysqli_query($con ,$q);
	 //$_SESSION['message']="You are now logged in"; 
	$_SESSION['name']= $name;
	//header('Location:view.php');

header('Location:sign-in.html');
?>