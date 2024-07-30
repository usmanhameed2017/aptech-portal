<?php
include("db_connect.php");
$ef_no = $_POST['ef_no'];

    $query = "select * from student where ex_id_no='$ef_no'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_num_rows($result);
    $response = array();
    if($row>0)
    {
        while($data = mysqli_fetch_assoc($result))
        {
            $response = $data;
        }
    }
    echo json_encode($response);
?>