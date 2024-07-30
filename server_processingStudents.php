<?php
include('db_connect.php');
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];
$query = "SELECT * FROM student WHERE name LIKE '%$searchValue%'";

if (!empty($searchValue)) {
    $query .= " OR (ex_id_no LIKE '%$searchValue%' OR father_name LIKE '%$searchValue%')";
}
$query .= " ORDER BY id DESC LIMIT $start, $length"; 
$result = mysqli_query($conn, $query);
$data = [];

$totalRecordsQuery = "SELECT COUNT(*) AS total FROM student";
$totalResult = mysqli_query($conn, $totalRecordsQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];
$page = ($start / $length) + 1;

// Serial Numbers in Ascending
// $increment = ($page - 1) * $length + 1;

// Serial Numbers in Descending
$increment = $totalRecords - $start;


while ($row = mysqli_fetch_assoc($result)) {
$data[] = [
        'id' => $row['id'],
        'sr_no' => $increment--,
        'ex_id_no' => $row['ex_id_no'],
        'name' => $row['name'],
        'father_name' => $row['father_name'],
        'email' => $row['email'],
        'contact' => $row['contact'],
        'Booking_Confirmation_Date' => $row['Booking_Confirmation_Date'], // this is guardian number
        'address' => $row['address'],
        'timings' => $row['timings'],
        'course' => $row['course'],
        'admission_fee' => $row['admission_fee'],
        'monthly_fee' => $row['monthly_fee'],
        'amount_in_words' => $row['amount_in_words'],
        'Original_Booking_Confirmation' => $row['Original_Booking_Confirmation'], // this is certification fee
        'Course_Family_Name' => $row['Course_Family_Name'], // this is counselor name
        'Course_Code' => date('M-d-Y',strtotime($row['Course_Code'])), // this is date of admission
        'Short_Course_Total_Fee' => $row['Short_Course_Total_Fee'],
    ];
}
$totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM student WHERE name LIKE '%$searchValue%' OR ex_id_no LIKE '%$searchValue%'
OR father_name LIKE '%$searchValue%'"));
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
?>
