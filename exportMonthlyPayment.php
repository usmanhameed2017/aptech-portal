<?php
include ('db_connect.php');
$from = $_GET['from']??'';
$to = $_GET['to']??'';
$search = $_GET['search']??'';

if($from === "")
{
   $from = "1970-01-01 12:00:00";
}
if($to === "")
{
   $to = "3970-01-01 12:00:00";
}

$query = "SELECT * FROM payments WHERE remarks !='dummyvalue' 
AND DATE_CREATED BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
$result = mysqli_query($conn,$query);

$table = "<table border='no-border'>
         <thead>
         <tr>
         <th style='text-align:center;' style='text-align:center; background-color: #8ea9db;' colspan='13'>FEE REPORT</th>
         </tr>
 
         <tr>
         <th style='text-align:center; background-color: #8ea9db;'>DATE</th>
         <th style='text-align:center; background-color: #8ea9db;'>RECEIPT NO</th>
         <th style='text-align:center; background-color: #8ea9db;'>NAME</th>
         <th style='text-align:center; background-color: #8ea9db;'>COURSE</th>
         <th style='text-align:center; background-color: #8ea9db;'>REGISTRATION/EXAM/CERTIFICATION</th>
         <th style='text-align:center; background-color: #8ea9db;'>TUITION FEE</th>
         <th style='text-align:center; background-color: #8ea9db;'>PROSPECTUS</th>
         <th style='text-align:center; background-color: #8ea9db;'>BOOKS</th>
         <th style='text-align:center; background-color: #8ea9db;'>FINE</th>
         <th style='text-align:center; background-color: #8ea9db;'>OTHER INCOME</th>
         <th style='text-align:center; background-color: #8ea9db;'>PAYMENT MODE</th>
         <th style='text-align:center; background-color: #8ea9db;'>COUNSELOR</th>
         <th style='text-align:center; background-color: #8ea9db;'>REMARKS</th>
         </tr>
         </thead>";
         $total = 0;
         while($data=mysqli_fetch_assoc($result))
         {
            $total += $data['amount'];
            $table .= "<tr>
            <td style='text-align:center; width:200px;'>".date("M-d-Y h:i",strtotime($data['date_created']))."</td>
            <td style='text-align:center;'>".$data['Receipt_no']."</td>
            <td style='text-align:center; width:280px;'>".$data['FULL_NAME']."</td>
            <td style='text-align:center;'>".$data['FEE_HEAD']."</td>";

            if($data['FEE_TYPE']==5) { $table .="<td style='text-align:center; width:100px;'>".number_format($data['amount'])."</td>"; } else { $table .= "<td style='text-align:center; width:40px;'>-</td>"; }


            if($data['FEE_TYPE']==1) { $table .= "<td style='text-align:center; width:100px;'>".number_format($data['amount'])."</td>"; } else { $table .= "<td style='text-align:center; width:40px;'>-</td>"; }

            if($data['FEE_TYPE']==2) { $table .="<td style='text-align:center; width:100px;'>".number_format($data['amount'])."</td>"; } else { $table .= "<td style='text-align:center; width:40px;'>-</td>"; }
 
            if($data['FEE_TYPE']==3) { $table .="<td style='text-align:center; width:100px;'>".number_format($data['amount'])."</td>"; } else { $table .= "<td style='text-align:center; width:40px;'>-</td>"; }


            if($data['FEE_TYPE']==4) { $table .="<td style='text-align:center; width:100px;'>".number_format($data['amount'])."</td>"; } else { $table .= "<td style='text-align:center; width:40px;'>-</td>"; }
            
            if($data['FEE_TYPE']==6) { $table .="<td style='text-align:center; width:100px;'>".number_format($data['amount'])."</td>"; } else { $table .= "<td style='text-align:center;'>-</td>"; }

            $table .="<td style='text-align:center;'>".$data['PAYMENT_MODE']."</td>
            <td style='text-align:center;'>".$data['INPUTTER']."</td>
            <td style='text-align:center;'>".$data['remarks']."</td>
            
            </tr>";
         }

         $table .= "<tfoot>
         <tr>
         <th colspan='4' style='text-align: right;'>Total</th>
         <th colspan='6' style='text-align: center;'>".number_format($total,2)."</th>
         </tr>
         </tfoot>";

         $table .="</table>";
         header("Content-Type: application/xls");
         header("Content-Disposition: attachment; filename=MonthlyFeeReport(".date('d-M-Y').").xls");
         echo $table;
?>