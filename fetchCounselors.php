<?php
session_start();
include('db_connect.php');
$id = $_SESSION['id'];

if(isset($_POST['rd']) && isset($_POST['rd'])!='')
{
    $query = "";
    if($_SESSION['login_type']==1)
    {
        $query = "SELECT * FROM payments
        WHERE date_created >= DATE(NOW()) AND date_created < DATE(NOW() + INTERVAL 1 DAY)
        ORDER BY Receipt_no DESC";
    }
    else
    {
        $query = "SELECT * FROM payments
        WHERE counselor_id='$id' AND date_created >= DATE(NOW()) AND date_created < DATE(NOW() + INTERVAL 1 DAY)
        ORDER BY Receipt_no DESC";
    }
}
else if(isset($_POST['from']) && isset($_POST['to']))
{
    if($_SESSION['login_type']==1)
    {
        $from = date('y-m-d',strtotime($_POST['from']));
        $to = date('y-m-d',strtotime($_POST['to']));

        $query = "SELECT * FROM payments 
        WHERE date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)
        ORDER BY ID ASC";
    }
}

    $table = "<table class='table table-condensed table-bordered table-hover table-striped text-center' id='counselorsTable'>
                    <thead class='text-center text-uppercase'>
                        <tr> 
                            <th class='text-center'>S.NO.</th>
                            <th class='text-center'>Counselors</th>
                            <th class='text-center'>Student Name</th>
                            <th class='text-center'>Receipt No</th>
                            <th class='text-center'>Payment Mode</th>
                            <th class='text-center'>Fee Type</th>
                            <th class='text-center'>Amount</th>
                            <th class='text-center'>Month Of Payment</th>
                            <th class='text-center'>Receiving Date</th>";
                            
                            if($_SESSION['login_type']==1)
                            {
                                $table.= "<th class='text-center adminView'>View</th>";
                            }
                        $table.= "</tr>
                    </thead>
                    <tbody>";

                        $result = mysqli_query($conn,$query); 
                        $i = 1; 
                        $FEE_TYPE = "";
                        $totalAmount = 0;
                        while($data = mysqli_fetch_assoc($result))
                        {
                            if($data['FEE_TYPE']==1)
                            {
                                $FEE_TYPE = 'Monthly Fee';
                            }
                            else if($data['FEE_TYPE']== 2)
                            {
                                $FEE_TYPE = 'Prospectus Fee';
                            }
                            else if($data['FEE_TYPE']== 3)
                            {
                                $FEE_TYPE = 'Books Fee';
                            }
                            else if($data['FEE_TYPE']== 4)
                            {
                                $FEE_TYPE = 'Fine';
                            }
                            else if($data['FEE_TYPE']== 5)
                            {
                                $FEE_TYPE = 'Registration Fee';
                            }
                            else if($data['FEE_TYPE']== 6)
                            {
                                $FEE_TYPE = 'Other Income Fee';
                            }
                            else
                            {
                                $FEE_TYPE = 'Unknown';
                            }
                            $table.= '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$data['INPUTTER'].'</td>
                            <td>'.$data['FULL_NAME'].'</td>
                            <td>'.$data['Receipt_no'].'</td>
                            <td>'.$data['PAYMENT_MODE'].'</td>
                            <td>'.$FEE_TYPE.'</td>
                            <td>'.number_format($data['amount'],2).'</td>
                            <td>'.date('M-Y',strtotime($data['Month_Of_Payment'])).'</td>
                            <td>'.date('M-d-Y h:i a',strtotime($data['date_created'])).'</td>';
                            if($_SESSION['login_type']==1)
                            {
                                $table.= "<td class='adminView-button'><a href='ViewCounselorPayments.php?id=$data[counselor_id]&from=$from&to=$to' data-title='View Payments' class='btn btn-info'><i class='fas fa-eye'></i></a></td>";
                            }
                            $table.= "</tr>";
                        }          
                        
                    $table.= "</tbody>
                    <tfoot>";
                        
                        // Total Fee
                        if($_SESSION['login_type']==1)
                        {
                            $totalAmount - 0;
                            if(isset($_POST['from']) && isset($_POST['to']))
                            {
                                $from = date('y-m-d',strtotime($_POST['from']));
                                $to = date('y-m-d',strtotime($_POST['to']));

                                $query = "SELECT SUM(amount) AS totalAmount FROM payments 
                                WHERE date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
                            }
                            else
                            {
                                $query = "SELECT SUM(amount) AS totalAmount FROM payments
                                WHERE date_created >= DATE(NOW()) 
                                AND date_created < DATE(NOW() + INTERVAL 1 DAY)";
                            }
                        }
                        else
                        {
                            $query = "SELECT SUM(amount) AS totalAmount FROM payments
                            WHERE counselor_id='$id' AND date_created >= DATE(NOW()) 
                            AND date_created < DATE(NOW() + INTERVAL 1 DAY)";
                        }
                        $result = mysqli_query($conn,$query);
                        $data = mysqli_fetch_assoc($result);
                        $totalAmount = $data['totalAmount'];
                        
                        $table.= "<tr>
                            <td class='text-right' colspan='6'> TOTAL </td>
                            <td class='text-left' colspan='4'>".number_format($totalAmount,2)."</td>
                        </tr>
                    </tfoot>
                </table>";
                echo $table;
?>
<script>
    $("#counselorsTable").DataTable({
        pageLength: 100
    });
</script>