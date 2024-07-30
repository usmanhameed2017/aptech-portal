<?php 
session_start();
include('db_connect.php');
include('header.php');
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
?>
<style>
img.aplogo {
    position: relative;
    width: 207px;
    float: left;
    left: -27px;
}

button#submit {
    display: none; 
}

button.hello.btn.btn-danger {
    display: none;
}
</style>


<!-- For Student ID -->
<?php
$query = "select MAX(id_no) from student";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
?>

<!-- <div class="container-fluid">

</div> -->

<style>
td {
    vertical-align: middle !important;
}

img {
    /* max-width:100px; */
    max-height: 150px;
}
</style>

<script src="js/num-to-words.js" type="text/javascript"></script>
<script src="./custom.js"></script>
<script>
    
</script>