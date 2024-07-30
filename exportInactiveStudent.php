<?php
include('db_connect.php');
$query = "SELECT * FROM student where student_status = 0 order by id_no desc";
$result = mysqli_query($conn,$query);

$table = '<table border="1">
<thead>
   <tr>
   <th class="text-center" style="background-color: #8ea9db;" colspan="10">INACTIVE STUDENT REPORT</th>
   </tr>
<tr>
        <th style="text-align:center;" style="background-color: #8ea9db;">S.NO.</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">STUDENT ID</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">NAME</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">FATHER NAME</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">CONTACT</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">ADDRESS</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">TIMINGS</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">COURSE</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">ADMISSION FEE</th>
        <th style="text-align:center;" style="background-color: #8ea9db;">MONTHLY FEE</th>
    </tr>
</thead>';
$i = 1;
while($data=mysqli_fetch_assoc($result))
{
    $table .= "<tr>
    <td style='text-align:center; width:100px;'>".$i++."</td>
    <td style='text-align:center; width:100px;'>".$data['id_no']."</td>
    <td style='text-align:center; width:100px;'>".$data['name']."</td>
    <td style='text-align:center; width:100px;'>".$data['father_name']."</td>
    <td style='text-align:center; width:100px;'>".$data['contact']."</td>
    <td style='text-align:center; width:100px;'>".$data['address']."</td>
    <td style='text-align:center; width:100px;'>".$data['timings']."</td>
    <td style='text-align:center; width:100px;'>".$data['course']."</td>
    <td style='text-align:center; width:100px;'>".$data['admission_fee']."</td>
    <td style='text-align:center; width:100px;'>".$data['monthly_fee']."</td>
    </tr>";
}

$table .= "</table>";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=InactiveStudentsReport(".date('d-M-Y').").xls");
echo $table;
?>