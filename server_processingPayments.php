<?php
date_default_timezone_set('Asia/Karachi');
include('db_connect.php');

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];
$query = "SELECT * FROM payments WHERE FULL_NAME LIKE '%$searchValue%'";

if (!empty($searchValue)) 
{
    $query .= " AND (Receipt_no LIKE '%$searchValue%' OR FULL_NAME LIKE '%$searchValue%')";
}
$query .= " ORDER BY Receipt_no DESC LIMIT $start, $length";
$result = mysqli_query($conn, $query);
$data = [];


$totalRecordsQuery = "SELECT COUNT(*) AS total FROM payments";
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
    $FEE_TYPE = '';
    switch ($row['FEE_TYPE']) {
        case 1:
            $FEE_TYPE = 1;
            break;
        case 2:
            $FEE_TYPE = 2;
            break;
        case 3:
            $FEE_TYPE = 3;
            break;
        case 4:
            $FEE_TYPE = 4;
            break;
        case 5:
            $FEE_TYPE = 5;
            break;
        case 6:
            $FEE_TYPE = 6;
            break;
        default:
            $FEE_TYPE = 7;
    } 

    // Set the timezone for date formatting
    $dateCreated = new DateTime($row['date_created'], new DateTimeZone('Asia/Karachi'));
    $formattedDateCreated = $dateCreated->format('M-d-Y H:i a');

    $monthOfPayment = new DateTime($row['Month_Of_Payment'], new DateTimeZone('Asia/Karachi'));
    $formattedMonthOfPayment = $monthOfPayment->format('M-Y');
    
    $data[] = [
        'id' => $row['id'],
        'sr_no' => $increment--,
        'Receipt_no' => $row['Receipt_no'],
        'date_created' => $formattedDateCreated,
        'Month_Of_Payment' => $formattedMonthOfPayment,
        'FULL_NAME' => $row['FULL_NAME'],
        'FEE_TYPE' => $FEE_TYPE,
        'INPUTTER' => $row['INPUTTER'],
    ];
}

$totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM payments WHERE FULL_NAME LIKE '%$searchValue%'
OR Receipt_no LIKE '%$searchValue%'"));
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
?>
