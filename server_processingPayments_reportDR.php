<?php
include("db_connect.php");
$start = $_POST['start'];
$chunkSize = $_POST['chunkSize'];
if(isset($_POST['from'])!="" && isset($_POST['to'])!="")
{
    $from = date('y-m-d',strtotime($_POST['from']));
    $to = date('y-m-d',strtotime($_POST['to']));
    $query = "SELECT date_created, Receipt_no, FULL_NAME, FEE_HEAD,
    FEE_TYPE, PAYMENT_MODE, INPUTTER, remarks, amount
    FROM payments WHERE date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)
    LIMIT $start, $chunkSize";
}
else
{
    $query = "SELECT date_created, Receipt_no, FULL_NAME, FEE_HEAD,
    FEE_TYPE, PAYMENT_MODE, INPUTTER, remarks, amount
    FROM payments ORDER BY id DESC LIMIT $start, $chunkSize";
}
$result = mysqli_query($conn, $query);
$table = "";
while($data = mysqli_fetch_assoc($result))
{
    $table.= "<tr>
    <td>".date('M-d-Y h:i a', strtotime($data['date_created']))."</td>
    <td>".$data['Receipt_no']."</td>
    <td>".$data['FULL_NAME']."</td>
    <td>".$data['FEE_HEAD']."</td>";

    if($data['FEE_TYPE']==5)
    {
        $table.= "<td>".number_format($data['amount'],2)."</td>";
    }
    else
    {
        $table.= "<td> - </td>";
    }

    if($data['FEE_TYPE']==1)
    {
        $table.= "<td>".number_format($data['amount'],2)."</td>";
    }
    else
    {
        $table.= "<td> - </td>";
    }

    if($data['FEE_TYPE']==2)
    {
        $table.= "<td>".number_format($data['amount'],2)."</td>";
    }
    else
    {
        $table.= "<td> - </td>";
    }

    if($data['FEE_TYPE']==3)
    {
        $table.= "<td>".number_format($data['amount'],2)."</td>";
    }
    else
    {
        $table.= "<td> - </td>";
    }

    if($data['FEE_TYPE']==4)
    {
        $table.= "<td>".number_format($data['amount'],2)."</td>";
    }
    else
    {
        $table.= "<td> - </td>";
    }

    if($data['FEE_TYPE']==6)
    {
        $table.= "<td>".number_format($data['amount'],2)."</td>";
    }
    else
    {
        $table.= "<td> - </td>";
    }

    $table.= "<td>".$data['PAYMENT_MODE']."</td>
    <td>".$data['INPUTTER']."</td>
    <td>".$data['remarks']."</td>
    </tr>";
}
echo $table;
?>