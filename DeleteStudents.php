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
    $before_deleted_query = "select * from student where id='$id'";
    $before_deleted_result = mysqli_query($conn,$before_deleted_query);
    $before_deleted_data = mysqli_fetch_assoc($before_deleted_result);

    // (Details Of Deleted Record)
    $_SESSION['d_id'] = $before_deleted_data['id'];
    $_SESSION['d_name'] =  $before_deleted_data['name'];
    $_SESSION['d_father_name'] = $before_deleted_data['father_name'];
    $_SESSION['d_contact'] = $before_deleted_data['contact'];
    $_SESSION['d_address'] = $before_deleted_data['address'];
    $_SESSION['d_email'] = $before_deleted_data['email'];
    $_SESSION['d_timings'] = $before_deleted_data['timings'];
    $_SESSION['d_course'] = $before_deleted_data['course'];
    $_SESSION['d_Course_Family_Name'] = $before_deleted_data['Course_Family_Name'];
    $_SESSION['d_admission_fee'] = $before_deleted_data['admission_fee'];
    $_SESSION['d_monthly_fee'] = $before_deleted_data['monthly_fee'];



$dif1 = 'style="color: red; font-size: 13px;"';

$LEGGED_ON_PERSON = $_SESSION['name'];
$BEFORE_EDIT = "
<ul>
<li ".$dif1.">Student ID: ".$_SESSION['d_id']."</li>
<li ".$dif1.">Student Name: ".$_SESSION['d_name']."</li>
<li ".$dif1.">Father Name: ".$_SESSION['d_father_name']."</li>
<li ".$dif1.">Contact: ".$_SESSION['d_contact']."</li>
<li ".$dif1.">Address: ".$_SESSION['d_address']."</li>
<li ".$dif1.">Email: ".$_SESSION['d_email']."</li>
<li ".$dif1.">Timings: ".$_SESSION['d_timings']."</li>
<li ".$dif1.">Course: ".$_SESSION['d_course']."</li>
<li ".$dif1.">Counselor: ".$_SESSION['d_Course_Family_Name']."</li>
<li ".$dif1.">Admission Fee: ".$_SESSION['d_admission_fee']."</li>
<li ".$dif1.">Monthly Fee: ".$_SESSION['d_monthly_fee']."</li>
</ul>";
$AFTER_EDIT = "
<ul>
<li ".$dif1.">Student ID: ".$_SESSION['d_id']."</li>
<li ".$dif1.">Student Name: ".$_SESSION['d_name']."</li>
<li ".$dif1.">Father Name: ".$_SESSION['d_father_name']."</li>
<li ".$dif1.">Contact: ".$_SESSION['d_contact']."</li>
<li ".$dif1.">Address: ".$_SESSION['d_address']."</li>
<li ".$dif1.">Email: ".$_SESSION['d_email']."</li>
<li ".$dif1.">Timings: ".$_SESSION['d_timings']."</li>
<li ".$dif1.">Course: ".$_SESSION['d_course']."</li>
<li ".$dif1.">Counselor: ".$_SESSION['d_Course_Family_Name']."</li>
<li ".$dif1.">Admission Fee: ".$_SESSION['d_admission_fee']."</li>
<li ".$dif1.">Monthly Fee: ".$_SESSION['d_monthly_fee']."</li>
</ul>";


 // Inserting into Activity Log table
 $activity_query = "INSERT INTO `activity_log`(`ID`, `DESCRIPTION`, `AFTER_EDIT`, `ACTION_BY`, `REMARKS`) 
 VALUES (null,'$BEFORE_EDIT','$AFTER_EDIT','$LEGGED_ON_PERSON Deleted Student Details.','Deleted Record.')";
            
 $activity_exec = mysqli_query($conn,$activity_query);


 if($activity_exec==true)
 {

    $query = "delete from student where id='$id'";
    $exec = mysqli_query($conn,$query);
    if($exec==true)
    {


            echo "Student record has been deleted permanently!";
        }
        else
        {
            echo "Deletion failed!";
        }
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