<?php
date_default_timezone_set("Asia/Karachi");
include("db_connect.php");
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $length = $_POST['length'];
    $searchValue = $_POST['search']['value'];
    $query = "SELECT * FROM activity_log WHERE ACTION_BY LIKE '%$searchValue%'
    ORDER BY ID DESC LIMIT $start, $length";
    $result = mysqli_query($conn, $query);
    $increment = 1;
    $data = [];
    
    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM activity_log";
    $totalResult = mysqli_query($conn, $totalRecordsQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalRecords = $totalRow['total'];
    $page = ($start / $length) + 1;
    // Serial Numbers in Ascending
    // $increment = ($page - 1) * $length + 1;
    // Serial Numbers in Descending
    $increment = $totalRecords - $start;

    while ($row = mysqli_fetch_assoc($result)) 
    {

        $data[] = [
            'sr_no' => $increment--,
            'ACTION_BY' => $row['ACTION_BY'],
            'DESCRIPTION' => $row['DESCRIPTION'],
            'AFTER_EDIT' => $row['AFTER_EDIT'],
            'REMARKS' => $row['REMARKS'],
            'DATE_CREATED' => date("M-d-Y H:i a",strtotime($row['DATE_CREATED'])),
        ];
    }
    $totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM activity_log WHERE ACTION_BY LIKE '%$searchValue%'"));
    $response = [
        "draw" => intval($draw),
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $totalRecords,
        "data" => $data
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
?>