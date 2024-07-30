<?php
include ('db_connect.php');
$query = "select * from payments where remarks !='dummyvalue' ORDER BY id DESC";
$result = mysqli_query($conn,$query);
$table = '<table border="1">
<thead>
<tr>
<th class="text-center" style="text-align:center; background-color: #8ea9db;" colspan="7">RECENT FEE REPORT</th>
</tr>

<tr>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">RECEIPT NO</th>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">RECEIVING DATE</th>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">MONTH OF FEE</th>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">NAME</th>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">FEE TYPE</th>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">RECEIVED BY</th>
<th class="text-center" style="text-align:center; background-color: #8ea9db;">AMOUNT</th>
</tr>
</thead><tbody>';
while($data=mysqli_fetch_assoc($result))
{
    $table.="<tr>
    <td class='text-center' style='text-align: center;'>".$data['Receipt_no']."</td>
    <td class='text-center' style='text-align: center;'>".date("M-d-Y h:i a",strtotime($data['date_created']))."</td>";
    if($data['Month_Of_Payment']!='' && $data['Month_Of_Payment']!=null) { $table.= "<td class='text-center' style='text-align: center;'>".date("M, Y",strtotime($data['Month_Of_Payment']))."</td>"; } else { $table.="<td class='text-center' style='text-align: center;'>Not Specified</td>"; }
    $table.="<td class='text-center' style='text-align: center;'>".$data['FULL_NAME']."</td>";
    if($data['FEE_TYPE']==1) { $table.="<td style='text-align: center;'> Monthly Fee </td>"; }
    if($data['FEE_TYPE']==2) { $table.="<td style='text-align: center;'> Prospectus Fee </td>"; }
    if($data['FEE_TYPE']==3) { $table.="<td style='text-align: center;'> Books Fee </td>"; }
    if($data['FEE_TYPE']==4) { $table.="<td style='text-align: center;'> Other Income Fee </td>"; }
    if($data['FEE_TYPE']==5) { $table.="<td style='text-align: center;'> Registration Fee </td>"; }
    if($data['FEE_TYPE']==6) { $table.="<td style='text-align: center;'>  Fine </td>"; }
    $table .= "<td style='text-align: center;'>".$data['INPUTTER']."</td>";
    $table .="<td class='text-center' style='text-align: center;'>".number_format($data['amount'])."</td>
    </tr>";
}
$table .="</tbody></table>";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=PaymentReport(".date('d-M-Y').").xls");
echo $table;
?>