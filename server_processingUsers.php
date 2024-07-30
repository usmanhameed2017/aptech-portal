<?php
include('db_connect.php');

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

$query = "SELECT * FROM users WHERE name LIKE '%$searchValue%'";
if (!empty($searchValue)) 
{
    $query .= " OR username LIKE '%$searchValue%'";
    if ($searchValue == "Admin" || $searchValue == "admin" || $searchValue == "Admins" || $searchValue == "admins") 
    {
        $query .= " OR type=1";
    } 
    else if ($searchValue == "Users" || $searchValue == "users" || $searchValue == "User" || $searchValue == "user") 
    {
        $query .= " OR type=2";
    }
}
$query .= " ORDER BY id DESC LIMIT $start, $length";
$result = mysqli_query($conn, $query);

$data = [];
$type = "";
$status = "";

$totalRecordsQuery = "SELECT COUNT(*) AS total FROM users";
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
    $type = $row['type'] == 1 ? "Admin" : "User";
    $status = $row['status'] == 1 ? "Active" : "Inactive";

    $data[] = [
        'id' => $row['id'],
        'sr_no' => $increment--,
        'name' => $row['name'],
        'username' => $row['username'],
        'email' => $row['email'],
        'type' => $type,
        'status' => $status,
    ];
}

$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response);
?>