<?php
include("db_connect.php");
if(isset($_POST['name']) && isset($_POST['name'])!='')
{
    $name = $_POST['name'];
    $query = "select * from student where name='$name'";
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
}
?>