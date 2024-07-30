<?php
include("../db_connect.php");
session_start();
if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']))
{
    $name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = MD5($_POST['password']); 
	$type = $_POST['type'];
    $query = "insert into users (name,username,email,password,type)
	values('$name','$username','$email','$password','$type')";
	$exec = mysqli_query($conn,$query);
}
?>