<?php
include("db_connect.php");
if(isset($_POST['from']) && isset($_POST['to']))
{
    $from = date('y-m-d',strtotime($_POST['from']));
    $to = date('y-m-d',strtotime($_POST['to']));
    $query = "SELECT SUM(amount) AS totalAmount
    FROM payments WHERE date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
}
else
{
    $query = "SELECT SUM(amount) AS totalAmount
    FROM payments";
}
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result);
$totalAmount = number_format($data["totalAmount"],2);
echo $totalAmount;
?>