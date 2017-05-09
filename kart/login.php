<?php

session_start();

$con =mysqli_connect("localhost","root","root","book");



$uid=$_POST["uid"];
$pass=$_POST["pass"];
$sql= " SELECT  userid, email from register where  userid='$uid'  AND password='$pass'";
$result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['message']="You are now Loggged In";
        $_SESSION['uname']=$uid;
       
     header("location:rajat.php");
    }
   else
   {
                $_SESSION['message']="Username and Password combiation incorrect";
    }






?>