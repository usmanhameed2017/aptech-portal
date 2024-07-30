<?php
include("db_connect.php");
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = MD5($_POST['password']);
	$query = "select * from users where username='$username' and password='$password' and status=1";
	$result = mysqli_query($conn,$query);
	$data = mysqli_fetch_assoc($result);
	$row = mysqli_num_rows($result);
	
	if($row==1)
	{
		$_SESSION['id'] = $data['id'];
        $_SESSION['name'] = $data['name'];
		$_SESSION['login_type'] = $data['type'];
		
	    // echo "<script> window.location.href='index.php?page=payments'; </script>";
        echo "Login successful";
	}
	else
	{	
		echo "Invalid username or password";
	}
}
?>