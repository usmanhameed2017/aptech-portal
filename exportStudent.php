<?php
include('db_connect.php');
$query = "select * from student where student_status = 1 order by id desc";
$result = mysqli_query($conn,$query);


$table ='<table border="1">
        <thead>
        <tr>
        <th style="text-align:center; background-color: #8ea9db;"  colspan="16">STUDENTS REPORT</th>
        </tr>

        <tr>
        <th style="text-align:center; background-color: #8ea9db;" >S.NO.</th>
        <th style="text-align:center; background-color: #8ea9db;" >Student ID</th>
        <th style="text-align:center; background-color: #8ea9db;" >Name</th>
        <th style="text-align:center; background-color: #8ea9db;" >Father Name</th>
        <th style="text-align:center; background-color: #8ea9db;" >Email</th>
        <th style="text-align:center; background-color: #8ea9db;" >Contact</th>
        <th style="text-align:center; background-color: #8ea9db;" >Guardian Number</th>
        <th style="text-align:center; background-color: #8ea9db;" >Address</th>
        <th style="text-align:center; background-color: #8ea9db;" >Timings</th>
        <th style="text-align:center; background-color: #8ea9db;" >Course</th>
        <th style="text-align:center; background-color: #8ea9db;" >Admission Fee</th>
        <th style="text-align:center; background-color: #8ea9db;" >Monthly Fee</th>
        <th style="text-align:center; background-color: #8ea9db;" >Certification Fee</th>
        <th style="text-align:center; background-color: #8ea9db;" >Counselor</th>
        <th style="text-align:center; background-color: #8ea9db;" >Date Of Admission</th>
        <th style="text-align:center; background-color: #8ea9db;" >Total Course Fee</th>
        </tr>
        </thead>';
        $i = 1;
        while($data=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>
            <td style='text-align:center; width: 60px;' >".$i++."</td>
            <td style='text-align:center; width: 120px;' >".$data['ex_id_no']."</td>
            <td style='text-align:center; width: 260px;' >".$data['name']."</td>
            <td style='text-align:center; width: 260px;' >".$data['father_name']."</td>
            <td style='text-align:center; width: 260px;' >".$data['email']."</td>
            <td style='text-align:center; width: 160px;' >".$data['contact']."</td>
            <td style='text-align:center; width: 160px;' >".$data['Booking_Confirmation_Date']."</td>
            <td style='text-align:center; width: 260px;' >".$data['address']."</td>
            <td style='text-align:center; width: 160px;' >".$data['timings']."</td>
            <td style='text-align:center; width: 160px;' >".$data['course']."</td>
            <td style='text-align:center; width: 160px;' >".$data['admission_fee']."</td>
            <td style='text-align:center; width: 160px;' >".$data['monthly_fee']."</td>
            <td style='text-align:center; width: 260px;' >".$data['Original_Booking_Confirmation']."</td>
            <td style='text-align:center; width: 260px;' >".$data['Course_Family_Name']."</td>
            <td style='text-align:center; width: 160px;' >".date('M-d-Y',strtotime($data['Course_Code']))."</td>
            <td style='text-align:center; width: 260px;' >".$data['Short_Course_Total_Fee']."</td>
            </tr>";
        }
        $table .="</table>";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=StudentsReport(".date('d-M-Y').").xls"); 
        echo $table;
?>