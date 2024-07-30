<?php
include('db_connect.php');
if (isset($_GET['page'])) 
{
    $page = intval($_GET['page']);
} 
else 
{
    $page = 1;
}

if(isset($_GET['from']) && isset($_GET['to']))
{
    $from = date('y-m-d',strtotime($_GET['from']));
    $to = date('y-m-d',strtotime($_GET['to']));

    $limit = 10;
    $offset = ($page - 1) * $limit;


    $query = "SELECT * FROM payments where remarks !='dummyvalue' 
    AND DATE_CREATED BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
    $result = mysqli_query($conn, $query);
    $totalRecords = mysqli_num_rows($result);

    $query2 = "SELECT * FROM payments where remarks !='dummyvalue'
    AND DATE_CREATED BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY) ORDER BY id ASC LIMIT $limit OFFSET $offset";
    $result2 = mysqli_query($conn, $query2);
    $total = 0;

    $query3 = "SELECT SUM(amount) AS totalAmount from payments where remarks !='dummyvalue'
    AND DATE_CREATED BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
    $result3 = mysqli_query($conn,$query3);
    $data3 = mysqli_fetch_assoc($result3);
    $total = $data3['totalAmount'];

    $data = [];
    while ($row = mysqli_fetch_assoc($result2)) 
    {
        $data[] = [
            'id' => $row['id'],
            'date_created' => date('M-d-Y h:i a', strtotime($row['date_created'])),
            'Receipt_no' => $row['Receipt_no'],
            'FULL_NAME' => $row['FULL_NAME'],
            'FEE_HEAD' => $row['FEE_HEAD'],
            'FEE_TYPE' => $row['FEE_TYPE'],
            'PAYMENT_MODE' => $row['PAYMENT_MODE'],
            'INPUTTER' => $row['INPUTTER'],
            'remarks' => $row['remarks'],
            'amount' => $row['amount'],
            'total' => $total,
        ];
    }

    $response = [
        'data' => $data,
        'totalRecords' => $totalRecords,
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>