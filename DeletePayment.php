<!doctype html>
<html lang="en">

<head>
<title>Aptech | University Road Center</title>
<link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
<link rel="icon" type="image/x-icon" href="assets/uploads/favicon.png">
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
if(isset($_POST['id']) && isset($_POST['id'])!=="")
{
    $id = $_POST['id'];
// (For Activity Log)
$before_deleted_query = "select * from payments where id='$id'";
$before_deleted_result = mysqli_query($conn,$before_deleted_query);
$before_deleted_data = mysqli_fetch_assoc($before_deleted_result);

// (Details Of Deleted Record)
$_SESSION['d_Receipt_no'] = $before_deleted_data['Receipt_no'];
$_SESSION['d_id'] = $before_deleted_data['id'];
$_SESSION['d_name'] =  $before_deleted_data['FULL_NAME'];
$_SESSION['d_amount'] = $before_deleted_data['amount'];
$_SESSION['d_remarks'] = $before_deleted_data['remarks'];
$_SESSION['d_fee_head'] = $before_deleted_data['FEE_HEAD'];
$_SESSION['d_payment_mode'] = $before_deleted_data['PAYMENT_MODE'];
$_SESSION['d_cheque_no'] = $before_deleted_data['CHEQUE_NO'];
$_SESSION['d_timings'] = $before_deleted_data['TIMINGS'];
$_SESSION['d_inputter'] = $before_deleted_data['INPUTTER'];
$_SESSION['d_amount_in_words'] = $before_deleted_data['AMOUNT_IN_WORDS'];
$_SESSION['d_month_of_payment'] = date('d-M-Y',strtotime($before_deleted_data['Month_Of_Payment']));
$_SESSION['d_fee'] = $before_deleted_data['FEE_TYPE'];


if($_SESSION['d_fee'] == 1)
            {
                $_SESSION['d_fee'] = "Tution Fee";
            }else if($_SESSION['d_fee'] == 2){
                $_SESSION['d_fee'] = "Prospectus Fee";
            }else if($_SESSION['d_fee'] == 3){
                $_SESSION['d_fee'] = "Books Fee";
            }else if($_SESSION['d_fee'] == 4){
                $_SESSION['d_fee'] = "Fine";
            }else if($_SESSION['d_fee'] == 5){
                $_SESSION['d_fee'] = "Registration";
            }else if($_SESSION['d_fee'] == 6){
                $_SESSION['d_fee'] = "Other Income";
            }
            
            
            
$dif1 = 'style="color: red; font-size: 13px;"';

$LEGGED_ON_PERSON = $_SESSION['name'];
$BEFORE_EDIT = "
<ul>
<li ".$dif1.">Receipt No.: ".$_SESSION['d_Receipt_no']."</li>
<li ".$dif1.">Student ID: ".$_SESSION['d_id']."</li>
<li ".$dif1.">Student Name: ".$_SESSION['d_name']."</li>
<li ".$dif1.">Amount: ".$_SESSION['d_amount']."</li>
<li ".$dif1.">Remarks: ".$_SESSION['d_remarks']."</li>
<li ".$dif1.">Fee Head: ".$_SESSION['d_fee_head']."</li>
<li ".$dif1.">Payment Mode: ".$_SESSION['d_payment_mode']."</li>
<li ".$dif1.">Cheque No: ".$_SESSION['d_cheque_no']."</li>
<li ".$dif1.">Timings: ".$_SESSION['d_timings']."</li>
<li ".$dif1.">Recieved By: ".$_SESSION['d_inputter']."</li>
<li ".$dif1.">Amount In Words: ".$_SESSION['d_amount_in_words']."</li>
<li ".$dif1.">Month Of Payment: ".$_SESSION['d_month_of_payment']."</li>
<li ".$dif1.">Fee Type: ".$_SESSION['d_fee']."</li>
</ul>";
$AFTER_EDIT = "
<ul>
<li ".$dif1.">Receipt No.: ".$_SESSION['d_Receipt_no']."</li>
<li ".$dif1.">Student ID: ".$_SESSION['d_id']."</li>
<li ".$dif1.">Student Name: ".$_SESSION['d_name']."</li>
<li ".$dif1.">Amount: ".$_SESSION['d_amount']."</li>
<li ".$dif1.">Remarks: ".$_SESSION['d_remarks']."</li>
<li ".$dif1.">Fee Head: ".$_SESSION['d_fee_head']."</li>
<li ".$dif1.">Payment Mode: ".$_SESSION['d_payment_mode']."</li>
<li ".$dif1.">Cheque No: ".$_SESSION['d_cheque_no']."</li>
<li ".$dif1.">Timings: ".$_SESSION['d_timings']."</li>
<li ".$dif1.">Recieved By: ".$_SESSION['d_inputter']."</li>
<li ".$dif1.">Amount In Words: ".$_SESSION['d_amount_in_words']."</li>
<li ".$dif1.">Month Of Payment: ".$_SESSION['d_month_of_payment']."</li>
<li ".$dif1.">Fee Type: ".$_SESSION['d_fee']."</li>
</ul>";


 // Inserting into Activity Log table
 $activity_query = "INSERT INTO `activity_log`(`ID`, `DESCRIPTION`, `AFTER_EDIT`, `ACTION_BY`, `REMARKS`) VALUES (null,'$BEFORE_EDIT','$AFTER_EDIT','$LEGGED_ON_PERSON Deleted Payment Details.','Deleted Record.')";
            
 $activity_exec = mysqli_query($conn,$activity_query);

 if($activity_exec==true)
 {

    $query = "Delete from payments where id='$id'";
    $exec = mysqli_query($conn,$query);
    if($exec==true)
    {
        echo "Payment has been deleted permanently!";
    }
    else
    {
        echo "Deletion failed!";
    }
  
 }
}
?>

</body>
</html>