<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Sweet Alert2 css file -->
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <!-- Sweet Alert2 Js file -->
    <script src="dist/sweetalert2.all.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php
session_start();
include('db_connect.php');
include('header.php');
if(isset($_POST['id']) && isset($_POST['id'])!=="")
{
    $id = $_POST['id'];

//Before Deleted
$before_deleted_query = "select * from users where id='$id'";
$before_deleted_result = mysqli_query($conn,$before_deleted_query);
$before_deleted_data = mysqli_fetch_assoc($before_deleted_result);

//Storing Deleted Record
$_SESSION['d_id'] = $before_deleted_data['id'];
$_SESSION['d_name'] = $before_deleted_data['name'];
$_SESSION['d_username'] = $before_deleted_data['username'];
$_SESSION['d_email'] = $before_deleted_data['email'];
$_SESSION['d_password'] = $before_deleted_data['password'];
$_SESSION['d_type'] = $before_deleted_data['type']; 
$_SESSION['d_status'] = $before_deleted_data['status'];


$query = "delete from users where id='$id'";
$exec = mysqli_query($conn,$query);
if($exec==true)
{
    $dif1 = 'style="color: red; font-size: 13px;"';
    $LEGGED_ON_PERSON = $_SESSION['name'];

    if($_SESSION['d_status'] == 1)
    {
        $_SESSION['d_status'] = "Active";
    }
    else if($_SESSION['d_status'] == 0)
    {
        $_SESSION['d_status'] = "Inactive";
    }
    if($_SESSION['d_type'] == 1)
    {
        $_SESSION['d_type'] = "Admin";
    }
    else if($$_SESSION['d_type'] == 2)
    {
        $_SESSION['d_type'] = "user";
    }

$BEFORE_EDIT = "
<ul>
 <li ".$dif1.">ID: ".$_SESSION['d_id']."</li>
 <li ".$dif1.">Name: ".$_SESSION['d_name']."</li>
 <li ".$dif1.">Username: ".$_SESSION['d_username']."</li>
 <li ".$dif1.">Email: ".$_SESSION['d_email']."</li>
 <li ".$dif1.">Type: ".$_SESSION['d_type']."</li>
 <li ".$dif1.">Status: ".$_SESSION['d_status']."</li>
 </ul>";
$AFTER_EDIT = "
<ul>
 <li ".$dif1.">ID: ".$_SESSION['d_id']."</li>
 <li ".$dif1.">Name: ".$_SESSION['d_name']."</li>
 <li ".$dif1.">Username: ".$_SESSION['d_username']."</li>
 <li ".$dif1.">Email: ".$_SESSION['d_email']."</li>
 <li ".$dif1.">Type: ".$_SESSION['d_type']."</li>
 <li ".$dif1.">Status: ".$_SESSION['d_status']."</li>
 </ul>";
     // Inserting into Activity Log table
    $activity_query = "INSERT INTO `activity_log`(`ID`, `DESCRIPTION`, `AFTER_EDIT`, `ACTION_BY`, `REMARKS`) 
    VALUES (null,'$BEFORE_EDIT','$AFTER_EDIT','$LEGGED_ON_PERSON Deleted User Details.','Deleted Record.')"; 
    $activity_exec = mysqli_query($conn,$activity_query);

        echo "User record has been deleted permanently!";
    }
    else
    {
        echo "Deletion failed!";
    }
}

?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>