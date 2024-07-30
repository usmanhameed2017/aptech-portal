<?php
session_start();
include("db_connect.php");
// $idd = $_GET['ef_no']??'';
$std_name = $_GET['std_name']??'';
$query1 = "SELECT * from student where name='$std_name'";
$result1 = mysqli_query($conn,$query1);
$data1=mysqli_fetch_assoc($result1);

$table = '
<table border="1">
<thead>

         <tr>
         <th class="text-center" style="letter-spacing:12px; background-color: #8ea9db;" colspan="12">LEDGER REPORT OF '.strtoupper($std_name).'</th>
         </tr>
        <tr>
         <th style="text-align:left;">STUDENT NAME:</th>
         <td colspan="11">'.strtoupper($std_name).'</td>
         </tr>
         <tr>
         <th style="text-align:left;">FATHER NAME:</th>
         <td colspan="11">'.$data1['father_name'].'</td>
         </tr>
         <tr>
         <th style="text-align:left;">STUDENT ID:</th>
         <td colspan="11">'.$data1['ex_id_no'].'</td>
         </tr>
         <tr>
         <th style="text-align:left;">COURSE:</th> 
         <td colspan="11">'.$data1['course'].'</td>
         </tr>
          <tr>
         <th style="text-align:left;">TOTAL COURSE FEE:</th> 
         <td colspan="11" style="text-align:left;">'.$data1['Short_Course_Total_Fee'].'</td>
         </tr>
        <tr>

        <th style="text-align:center;">S.NO.</th>
        <th style="text-align:center;">DATE</th>
        <th style="text-align:center;">RECEIPT NO</th> 
        <th style="text-align:center;">PAYMENT MODE</th> 
        <th style="text-align:center;">REGISTRATION/EXAM/CERTIFICATION</th>
        <th style="text-align:center;">TUITION FEE</th>
        <th style="text-align:center;">PROSPECTUS</th>
        <th style="text-align:center;">BOOKS</th>
        <th style="text-align:center;">FINE</th>
        <th style="text-align:center;">OTHER INCOME</th>
        <th style="text-align:center;">RECEIVED BY</th>
        <th style="text-align:center;">REMARKS</th>
         </tr>
         </thead>';
         $query = "SELECT * from payments where FULL_NAME='$std_name'";
         $result = mysqli_query($conn,$query);
         $t1 = 0;
         $t2 = 0;
         $i =1;
         while($data=mysqli_fetch_assoc($result))
         {
            if($data['FEE_TYPE']==5) 
            { $t1 += $data['amount']; }
            if($data['FEE_TYPE']==1) 
            { $t2 += $data['amount']; } 
            $table .= "<tr>
            <td style='text-align:center;'>".$i++."</td>
            <td style='text-align:center;'>".date("d-M-Y h:i a", strtotime($data['date_created']))."</td>";
            $table .="<td style='text-align:center;' =>".$data['Receipt_no']."</td>
            <td style='text-align:center;'>".$data['PAYMENT_MODE']."</td>";
            if($data['FEE_TYPE']==5) { $table .="<td style='text-align:center;'>".number_format($data['amount'])."</td>"; } else { $table .="<td style='text-align:center;'>-</td>"; }
            if($data['FEE_TYPE']==1) { $table .="<td style='text-align:center;'>".number_format($data['amount'])."</td>"; } else { $table .="<td style='text-align:center;'>-</td>"; }
            if($data['FEE_TYPE']==2) { $table .="<td style='text-align:center;'>".number_format($data['amount'])."</td>"; } else { $table .="<td style='text-align:center;'>-</td>"; }
            if($data['FEE_TYPE']==3) { $table .="<td style='text-align:center;'>".number_format($data['amount'])."</td>"; } else { $table .="<td style='text-align:center;'>-</td>"; }
            if($data['FEE_TYPE']==4) { $table .="<td style='text-align:center;'>".number_format($data['amount'])."</td>"; } else { $table .="<td style='text-align:center;'>-</td>"; }
            if($data['FEE_TYPE']==6) { $table .="<td style='text-align:center;'>".number_format($data['amount'])."</td>"; } else { $table .="<td style='text-align:center;'>-</td>"; }
            $table .="<td style='text-align:center;'>".$data['INPUTTER']."</td>
            <td style='text-align:center;'>".$data['remarks']."</td>";
            $table .="</tr>";
         }
         $table .= '<tfoot>
         <tr>
             <th colspan="4" class="text-right" style="letter-spacing:1px;">TOTAL</th>
             <th colspan="8" class="text-center">'.number_format(($t1+$t2),2).'</th>
         </tr>
     </tfoot>
 </table>';
 header("Content-Type: application/xls");
 header("Content-Disposition: attachment; filename=StudentLedgerReport(".$std_name.")(".date('d-M-Y').").xls");
 echo $table;
?>