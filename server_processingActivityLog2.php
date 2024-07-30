<?php
include("db_connect.php");
if(isset($_POST['from']) && isset($_POST['to']))
{
    $from = date('y-m-d',strtotime($_POST['from']));
    $to = date('y-m-d',strtotime($_POST['to']));
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $length = $_POST['length'];
    $searchValue = $_POST['search']['value'];
    $query = "SELECT * FROM activity_log 
    WHERE ACTION_BY LIKE '%$searchValue%' AND DATE_CREATED BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)
    ORDER BY ID ASC LIMIT $start, $length";
    $result = mysqli_query($conn, $query);
    $increment = 1;
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $data[] = [
        'id' => $increment++,
        'ACTION_BY' => $row['ACTION_BY'],
        'DESCRIPTION' => $row['DESCRIPTION'],
        'AFTER_EDIT' => $row['AFTER_EDIT'],
        'REMARKS' => $row['REMARKS'],
        'DATE_CREATED' => date("M-d-Y H:i a",strtotime($row['DATE_CREATED'])),
        ];
    }
    $query2 = "SELECT * FROM activity_log WHERE ACTION_BY LIKE '%$searchValue%' 
    AND DATE_CREATED BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
    $result2 = mysqli_query($conn,$query2);
    $totalRecords = mysqli_num_rows($result2);
    $response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords, 
    "data" => $data
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>