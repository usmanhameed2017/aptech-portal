<?php
include("../db_connect.php");
session_start();
if(isset($_POST['name']) && isset($_POST['name'])!=="")
{
    $id_no = $_POST['id_no'];
    $ex_id_no = $_POST['ex_id_no'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $timings = $_POST['timings'];
    $course = $_POST['course'];
    $admission_fee = $_POST['admission_fee'];
    $monthly_fee = $_POST['monthly_fee'];
    $amount_in_words = $_POST['amount_in_words'];
    $obc = $_POST['obc'];
    $bcd = $_POST['bcd'];
    $cfn = $_POST['cfn'];
    $cc = $_POST['cc'];
    $scc = $_POST['scc'];

    // Adding Student With no external id
    if($_POST['ex_id_no']=='Student' && $_POST['ex_id_no']!=null)
    {
    $query = "insert into student(id_no,ex_id_no,name,father_name,contact,address,email,timings,course,admission_fee,monthly_fee,amount_in_words,Original_Booking_Confirmation,Booking_Confirmation_Date,Course_Family_Name,Course_Code,Short_Course_Total_Fee)
    values('$id_no','','$name','$fname','$contact','$address','$email','$timings','$course','$admission_fee','$monthly_fee','$amount_in_words','$obc','$bcd','$cfn','$cc','$scc')";
    $exec = mysqli_query($conn,$query);
        if($exec==true)
        {
            $query2 = "SELECT MAX(id) AS id FROM student";
            $result2 = mysqli_query($conn,$query2);
            $data = mysqli_fetch_assoc($result2);
            echo $data['id'];
        }
    }
    else
    {
        // Adding Student With external id
        $query = "insert into student(id_no,ex_id_no,name,father_name,contact,address,email,timings,course,admission_fee,monthly_fee,amount_in_words,Original_Booking_Confirmation,Booking_Confirmation_Date,Course_Family_Name,Course_Code,Short_Course_Total_Fee)
        values('$id_no','$ex_id_no','$name','$fname','$contact','$address','$email','$timings','$course','$admission_fee','$monthly_fee','$amount_in_words$va','$obc','$bcd','$cfn','$cc','$scc')";
    $exec = mysqli_query($conn,$query);
        if($exec==true)
        {
            $query2 = "SELECT MAX(id) AS id FROM student";
            $result2 = mysqli_query($conn,$query2);
            $data = mysqli_fetch_assoc($result2);
            echo $data['id'];
        }
    }
}
?>