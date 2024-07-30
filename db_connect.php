<?php 
$conn = mysqli_connect('localhost','root','','aptechurc_db');
if($conn!=true)
{
    echo "<script>alert('Database not connected');</script>";
}
?>