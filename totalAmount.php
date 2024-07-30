<?php
include("db_connect.php");
$query = "SELECT SUM(amount) AS totalAmount
FROM payments";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result);
$totalAmount = number_format($data["totalAmount"],2);
echo $totalAmount;
?>