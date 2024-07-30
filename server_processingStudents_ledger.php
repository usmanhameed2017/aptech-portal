<?php
include('db_connect.php'); 
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];
$query = "SELECT * FROM student WHERE student_status='1'";

if (!empty($searchValue)) {
    
    $query .= " AND (name LIKE '%$searchValue%' OR father_name LIKE '%$searchValue%'  
    OR ex_id_no LIKE '%$searchValue%' OR course LIKE '%$searchValue%')";
}
$query .= " ORDER BY id DESC LIMIT $start, $length";
$result = mysqli_query($conn, $query);
$increment = 1;
$data = [];

$totalRecordsQuery = "SELECT COUNT(*) AS total FROM student WHERE student_status='1'";
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
        'id' => $row['id'],
        'sr_no' => $increment--,
        'name' => $row['name'],
        'course' => $row['course'],
        'father_name' => $row['father_name'],
        'ex_id_no' => $row['ex_id_no'],
        'date' => date('M-d-Y', strtotime($row['date_created'])),
    ];
}
$totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM student WHERE name LIKE '%$searchValue%' 
OR father_name LIKE '%$searchValue%' OR ex_id_no LIKE '%$searchValue%' OR course LIKE '%$searchValue%'"));

// Prepare the response data
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
?>