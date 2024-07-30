<?php
session_start();
include('db_connect.php');
$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$query1 = "SELECT s.*
                            FROM student s
                            WHERE s.student_status = 1 and s.ex_id_no IN (SELECT p.ef_no FROM payments p WHERE p.FEE_TYPE=1 and date_format(Month_Of_Payment,'%Y-%m') = '$month' )";
$result1 = mysqli_query($conn,$query1);
$i = 1;
$total = 0;
$table = "<table border='1'>
          <thead>
          <tr>
          <th style='text-align:center;' colspan=7>DUE FEE</th>
          </tr>

          <tr>
          <th style='text-align:center;'>S.NO.</th>
          <th style='text-align:center;'>STUDENT ID</th>
          <th style='text-align:center;'>STUDENT NAME</th>
          <th style='text-align:center;'>FATHER NAME</th>
          <th style='text-align:center;'>COURSE</th>
          <th style='text-align:center;'>CONTACT NO.</th>
          <th style='text-align:center;'>FEE</th>
          </tr>
          </thead>";

          while($data1=mysqli_fetch_assoc($result1)):
        
            $total += $data1['monthly_fee'];
             $table .= 
            '<tr>
            <td style="text-align:center;">
            <p>'.$i++.'</p>
             </td>
             
             <td style="text-align:center;">
                 <p>'.$data1['ex_id_no'].'</p>
             </td>

             <td style="text-align:center;">
             <p>'.$data1['name'].'</p>
             </td>

             <td style="text-align:center;">
             <p>'.$data1['father_name'].'</p>
             </td>

             <td style="text-align:center;">
             <p>'.$data1['course'].'</p>
             </td>

             <td style="text-align:center;">
             <p>'.$data1['contact'].'</p>
             </td>

             <td style="text-align:center;">
             <p>'.number_format($data1['monthly_fee']).'</p>
             </td>
             </tr>';
          endwhile;

          $table .= "<tfoot>
          <tr>
              <th colspan='6' class='text-right'>Total</th>
              <th colspan='1' class='text-center'>".number_format($total,2)."</th>
              

          </tr>
      </tfoot>";

          $table .= "</table>";
          header("Content-Type: application/xls");
          header("Content-Disposition: attachment; filename=PaidFeeReport(".date('d-M-Y').").xls");
          echo $table;


?>