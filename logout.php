<?php
session_start();

include('db_connect.php');

session_destroy();
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['login_type']);


header('Location:login.php');
?>