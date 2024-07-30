<?php
date_default_timezone_set('Asia/Karachi');
include("../db_connect.php");
session_start();
if(isset($_SESSION['id']))
{
    $id = $_SESSION['id'];
} 

if(isset($_POST['name']))
{
    $student_id_FK = $_POST['id']; // Primary Key Of Student Table
    $ef_no = $_POST['ef_no'];
    $receipt_no1 = $_POST['receipt_no'];
    $name = $_POST['name'];
    $remarks = $_POST['remarks'];
    $date = $_POST['date'];
    $fee_head = $_POST['fee_head'];
    $cheque_no = $_POST['cheque_no'];
    $payment_mode = $_POST['payment_mode'];
    $timings = $_POST['timings'];
    $amount = $_POST['amount'];
    $fee_TYPE = $_POST['FEE_TYPE'];
    $inputter = $_POST['inputter'];
    $amount_in_words = $_POST['amount_in_words'];
    $month_of_payment = date('y-m-d',strtotime($_POST['month_of_payment']));

    $query = "select * from payments where Receipt_no='$receipt_no1' or Receipt_no>'$receipt_no1'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_num_rows($result);

    // Fee shall not be submitted if the student is not registered in database.
    $query_check1 = mysqli_query($conn,"select * from student where ex_id_no='$ef_no'");
    $number_of_rows1 = mysqli_num_rows($query_check1);

    $query_check2 = mysqli_query($conn,"select * from student where name='$name'");
    $number_of_rows2 = mysqli_num_rows($query_check2);

    if($number_of_rows1>0)
    {
        if($number_of_rows2>0)
        {
            if($row>0)
            {
                while($myData = mysqli_fetch_assoc($result))
                {
                    $receipt_no1 = $myData['Receipt_no'] + 1;
                }
            }
            $query = "insert into payments (id,ef_no,amount,remarks,FULL_NAME,FEE_HEAD,PAYMENT_MODE,AMOUNT_IN_WORDS,Month_Of_Payment,
            CHEQUE_NO,TIMINGS,INPUTTER,counselor_id,Receipt_no,FEE_TYPE,date_created,student_id_FK)
            values (Null,'$ef_no','$amount','$remarks','$name','$fee_head','$payment_mode','$amount_in_words','$month_of_payment','$cheque_no',
            '$timings','$inputter','$id','$receipt_no1','$fee_TYPE','$date','$student_id_FK')"; 
            $exec = mysqli_query($conn,$query);
            $_SESSION['tk'] = md5(uniqid($receipt_no1, true));
            echo $receipt_no1;  
        }
        else
        {
        ?>
            <script>
            swal.fire({
            title: 'FAILED TO SUBMIT!',
            text: "Invalid Student Name <?php echo $name." is not registered" ?>",
            icon: 'error',
            confirmButtonColor: 'blue',
            backdrop: 'gray',
            allowOutsideClick: false,
            timer:10000
            }).then(function(){
                window.location.href='index.php?page=payments'
            });
            </script>
            <?php
        }
    }
    else
    {
        ?>
            <script>
            swal.fire({
            title: 'FAILED TO SUBMIT!',
            text: "Invalid Student ID <?php echo $ef_no." is not registered" ?>",
            icon: 'error',
            confirmButtonColor: 'blue',
            backdrop: 'gray',
            allowOutsideClick: false,
            timer:10000
            }).then(function(){
                window.location.href='index.php?page=payments'
            });
            </script>
            <?php
    }
} 
?>