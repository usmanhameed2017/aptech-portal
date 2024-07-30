<?php
session_start();
date_default_timezone_set("Asia/Karachi");
include('db_connect.php');
$id = $_GET['id']??"";
$from = $_GET['from']??"";
$to = $_GET['to']??"";

// For extracting counselor's name
$query = "SELECT * FROM payments WHERE counselor_id='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result); 
$name = $data['INPUTTER'];
if($from==="" || $to==="")
{
    $msg = "PAYMENTS OF ".strtoupper(date("l jS \of F Y"));
}
else
{
    $msg = strtoupper("PAYMENTS FROM ".date('M-d-Y',strtotime($from))." TO ".date('M-d-Y',strtotime($to)));
}
$table = "<table border='1' class='table table-condensed table-bordered table-hover table-striped text-center' id='counselorsTable' style='text-align: center;'>
<thead>
<tr>
<th style='background-color: #8ea9db;' colspan='9'>$msg RECEIVED BY ".strtoupper($name)."</th>
</tr>
</thead>
<thead class='text-center text-uppercase'>
    <tr> 
        <th class='text-center' style='background-color: #8ea9db;'>S.NO.</th>
        <th class='text-center' style='background-color: #8ea9db;'>Counselors</th>
        <th class='text-center' style='background-color: #8ea9db;'>Student Name</th>
        <th class='text-center' style='background-color: #8ea9db;'>Receipt No</th>
        <th class='text-center' style='background-color: #8ea9db;'>Payment Mode</th>
        <th class='text-center' style='background-color: #8ea9db;'>Fee Type</th>
        <th class='text-center' style='background-color: #8ea9db;'>Amount</th>
        <th class='text-center' style='background-color: #8ea9db;'>Month Of Payment</th>
        <th class='text-center' style='background-color: #8ea9db;'>Receiving Date</th>
    </tr><tbody>";

    if($from==="" || $to==="") // If date range is not selected
    {
        $query = "SELECT * FROM payments
        WHERE counselor_id='$id' AND date_created >= DATE(NOW()) AND date_created < DATE(NOW() + INTERVAL 1 DAY)
        ORDER BY Receipt_no DESC";
    }
    else
    {
        $query = "SELECT * FROM payments
        WHERE counselor_id='$id' AND date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)
        ORDER BY Receipt_no ASC"; 
    }
    $result = mysqli_query($conn,$query); 
    $i = 1; 
    $FEE_TYPE = '';
    $totalAmount = 0;
    while($data = mysqli_fetch_assoc($result))
    {
        if($data['FEE_TYPE']==1)
        {
            $FEE_TYPE = "Monthly Fee";
        }
        else if($data["FEE_TYPE"]== 2)
        {
            $FEE_TYPE = "Prospectus Fee";
        }
        else if($data["FEE_TYPE"]== 3)
        {
            $FEE_TYPE = "Books Fee";
        }
        else if($data["FEE_TYPE"]== 4)
        {
            $FEE_TYPE = "Fine";
        }
        else if($data["FEE_TYPE"]== 5)
        {
            $FEE_TYPE = "Registration Fee";
        }
        else if($data["FEE_TYPE"]== 6)
        {
            $FEE_TYPE = "Other Income Fee";
        }
        else
        {
            $FEE_TYPE = "Unknown";
        }
        $table.= "<tr>
        <td style='text-align: center;'>".$i++."</td>
        <td style='text-align: center;'>".$data['INPUTTER']."</td>
        <td style='text-align: center;'>".$data['FULL_NAME']."</td>
        <td style='text-align: center;'>".$data['Receipt_no']."</td>
        <td style='text-align: center;'>".$data['PAYMENT_MODE']."</td>
        <td style='text-align: center;'>".$FEE_TYPE."</td>
        <td style='text-align: center;'>".number_format($data['amount'],2)."</td>
        <td style='text-align: center;'>".date('M-Y',strtotime($data['Month_Of_Payment']))."</td>
        <td style='text-align: center;'>".date('M-d-Y h:i a',strtotime($data['date_created']))."</td>";
    }
    $table .= "</tbody>";

    // For total
    if($from==="" || $to==="") // If date range is not selected
    {
        $query = "SELECT SUM(amount) AS totalAmount FROM payments
        WHERE counselor_id='$id' AND date_created >= DATE(NOW()) 
        AND date_created < DATE(NOW() + INTERVAL 1 DAY)";
    }
    else
    {
        $query = "SELECT SUM(amount) AS totalAmount FROM payments
        WHERE counselor_id='$id' AND date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";        
    }

    
    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($result);
    $totalAmount = $data['totalAmount'];
    $table .= "<tfoot>
    <tr>
    <td style='text-align: right;' colspan='6'> TOTAL </td>
    <td style='text-align: left;' colspan='3'> ".number_format($totalAmount,2)." </td>
    </tr>
    </tfoot>";
$table .="</tbody></table>";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=CounselorsPayment(".date('d-M-Y').").xls");
echo $table;
?>