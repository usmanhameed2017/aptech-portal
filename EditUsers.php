<?php
session_start();
include('db_connect.php');
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
include('header.php');
include('topbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    label {
        position: relative;
        top: 10px;
    }
    </style>
</head>
<?php
$id = $_GET['id']??"";
$query = "select * from users where id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);
?>

<body>
    <div class="container" style="position:relative; top:174px;">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="form-group">
                    <!-- Form -->
                    <form method="post">
                        <!-- For Hidden Id -->
                        <input type="hidden" name="hiddenID" value="<?php echo $data['id']; ?>">

                        <!-- Name -->
                        <div class="col-lg-6">
                            <label for="" style="font-weight:900">NAME</label>
                            <input type="text" style="font-weight:900" name="name" value="<?php echo $data['name']; ?>"
                                class="form-control" required>
                        </div>

                        <!-- Username -->
                        <div class="col-lg-6">
                            <label for="" style="font-weight:900">USERNAME</label>
                            <input type="text" style="font-weight:900" name="username"
                                value="<?php echo $data['username']; ?>" class="form-control" required>
                        </div>
                        <!-- Email -->
                        <div class="col-lg-6">
                            <label for="" style="font-weight:900">Email</label>
                            <input type="text" style="font-weight:900" name="Email"
                                value="<?php echo $data['email']; ?>" class="form-control" required>
                        </div>
                        <!-- Active -->
                        <div class="col-lg-6">
                            <label for="" style="font-weight:900">Status</label>
                            <select name="Status" style="font-weight:900" class="form-control" required>
                                <?php
                    if($data['status']==1)
                    {
                        echo '<option value="1" selected>Active</option>
                              <option value="0">Inactive</option>';
                    }
                    else
                    {
                        echo '<option value="1">Active</option>
                              <option value="0" selected>Inactive</option>';
                    }
                    ?>
                            </select>
                        </div>

                        <!-- Role -->
                        <div class="col-lg-6">
                            <label for="" style="font-weight:900">ROLE</label>
                            <select name="type" style="font-weight:900" class="form-control" placeholder="Select Type"
                                required>
                                <?php
                        if($data['type']==1)
                        {
                            echo'<option value="1" selected>Admin</option>
                            <option value="2">User</option>';
                        }
                        else if($data['type']==2)
                        {
                            echo'<option value="1">Admin</option>
                            <option value="2" selected>User</option>';

                        }
                       
                        ?>
                            </select>
                        </div>
     
                <div class="col-lg-6">
                            <label for="" style="font-weight:900">ADMIN REMARKS</label>
                            <input type="text" style="font-weight:900" name="adminremarks" placeholder="Reason for editing user?" class="form-control" required>
                     </div>
                     </div>
                <!-- Update Button -->
                <div class="form-group">
                    <div class="col-lg-6">
                        <br>
                        <input type="submit" value="Update" onclick="return ConfirmUpdate()" name="BtnUpdate"
                            class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>
<?php
    if(isset($_POST['BtnUpdate']))
    {
        $hiddenID = $_POST['hiddenID'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['Email'];
        $status = $_POST['Status'];
        // $password_hash = md5($_POST['password']);
        $type = $_POST['type'];
        $adminremarks = $_POST['adminremarks'];
        $qry = "update users set name='$name',username='$username',email='$email',status='$status',type='$type',admin_remarks='$adminremarks' where id='$hiddenID'";
        $exec = mysqli_query($conn,$qry);
        if($exec==true)
        {
            // Before Edit
            $old_id = $data['id'];
            $old_name = $data['name'];
            $old_username = $data['username'];
            $old_email = $data['email'];
            $old_status = $data['status'];
            $old_type = $data['type'];

            //After Edit
            $new_query = "select * from users where id='$id'";
            $new_result = mysqli_query($conn,$new_query);
            $new_data = mysqli_fetch_assoc($new_result);

            //New record
            $new_id = $new_data['id'];
            $new_name = $new_data['name'];
            $new_username = $new_data['username'];
            $new_email = $new_data['email'];
            $new_status = $new_data['status'];
            $new_type = $new_data['type'];

            if($new_status == 1)
            {
                $new_status = "Active";
            }else if($new_status == 0){
                $new_status = "Inactive";
            }
            if($old_status== 0)
            {
                $old_status = "Inactive";
            }else if($old_status == 1){
                $old_status = "Active";
            }

            if($old_type == 1)
            {
                $old_type = "Admin";
            }else if($old_type == 2){
                $old_type = "User";
            }
            if($new_type == 1)
            {
                $new_type = "Admin";
            }else if($new_type == 2){
                $new_type = "User";

            }

            if($old_id!=$new_id){
                $dif1 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif1pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_name!=$new_name){
                $dif2 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif2pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_username!=$new_username){
                $dif3 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif3pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_email!=$new_email){
                $dif4 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif4pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_status!=$new_status){
                $dif5 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif5pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_type!=$new_type){
                $dif6 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif6pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
                $typ_change = "Changed User Role.";
            }else{
                $typ_change = "Edited Users Details.";
            }
            
            $LEGGED_ON_PERSON = $_SESSION['name'];

            $BEFORE_EDIT = "
            <ul>
            <li ".$dif1.">ID: ".$old_id."</li>
            <li ".$dif2.">Name: ".$old_name."</li>
            <li ".$dif3.">Username: ".$old_username."</li>
            <li ".$dif4.">Email: ".$old_email."</li>
            <li ".$dif5.">Status: ".$old_status."</li>
            <li ".$dif6.">Type: ".$old_type."</li>
            </ul>";

            $AFTER_EDIT = "
            <ul>
            <li ".$dif1pt2.">ID: ".$new_id."</li>
            <li ".$dif2pt2.">Name: ".$new_name."</li>
            <li ".$dif3pt2.">Username: ".$new_username."</li>
            <li ".$dif4pt2.">Email: ".$new_email."</li>
            <li ".$dif5pt2.">Status: ".$new_status."</li>
            <li ".$dif6pt2.">Type: ".$new_type."</li>
            </ul>";


            // Inserting into activity log table
            $activity_query = "INSERT INTO `activity_log`(`ID`, `DESCRIPTION`, `AFTER_EDIT`, `ACTION_BY`, `REMARKS`) VALUES (null,'$BEFORE_EDIT','$AFTER_EDIT','$LEGGED_ON_PERSON $typ_change','$adminremarks')";
            
            $activity_exec = mysqli_query($conn,$activity_query);

            echo "
                    <script>
                    swal.fire({
                    title: 'UPDATED!',
                    text: 'User has been updated successfully...!',
                    icon: 'success',
                    confirmButtonColor: 'blue',
                    timer:2000,
                    backdrop: 'gray'
                    }).then(function() {
                    window.location.href='index.php?page=users';
                    });
                    </script>";
        }
        else
        {
            echo "
                    <script>
                    swal.fire({
                    title: 'Error Occured!',
                    text: 'User not updated.',
                    icon: 'error',
                    confirmButtonColor: 'blue',
                    timer:2000,
                    backdrop: 'gray'
                    }).then(function() {
                    window.location.href='index.php?page=users';
                    });
                    </script>";
        }
    } 
?>
<script>
function ConfirmUpdate() {
    return confirm("Are you sure you want to update this record?");
}
</script>