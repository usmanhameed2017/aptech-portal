<?php
include('db_connect.php');
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];
$query = "SELECT * FROM payments WHERE remarks !='dummyvalue' AND FULL_NAME LIKE '%$searchValue%'";
if (!empty($searchValue)) {
    $query .= " OR (Receipt_no LIKE '%$searchValue%' OR Month_Of_Payment LIKE '%$searchValue%' OR
    amount LIKE '%$searchValue%' OR FULL_NAME LIKE '%$searchValue%')";
}
$query .= " ORDER BY Receipt_no DESC LIMIT $start, $length";
$result = mysqli_query($conn, $query);
$increment = 1;
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
    $data[] = [
        'sr_no' => $increment--,
        'date_created' => $row['date_created'],
        'Receipt_no' => $row['Receipt_no'],
        'Month_Of_Payment' => $row['Month_Of_Payment'],
        'FULL_NAME' => $row['FULL_NAME'],
        'amount' => $row['amount'],
    ];
}
$totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM payments WHERE remarks !='dummyvalue' AND FULL_NAME LIKE '%$searchValue%'
OR Receipt_no LIKE '%$searchValue%' OR Month_Of_Payment LIKE '%$searchValue%' OR amount LIKE '%$searchValue%'"));
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
?>