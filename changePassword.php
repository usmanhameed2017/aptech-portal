<?php
session_start();
include('db_connect.php');
if(!isset($_SESSION['id']))
{
    header("Location:login.php");
}
?>

<style>
.oldpassword-container {
    width: 100%;
    position: relative;
}

.oldpassword-container input[type="password"],
.oldpassword-container input[type="text"] {
    width: 100%;
    padding: 12px 36px 12px 12px;
    box-sizing: border-box;
}

.fa-eye {
    position: absolute;
    top: 28%;
    right: 4%;
    cursor: pointer;
    color: lightgray;
}


.newpassword-container {
    width: 100%;
    position: relative;
}

.newpassword-container input[type="password"],
.newpassword-container input[type="text"] {
    width: 100%;
    padding: 12px 36px 12px 12px;
    box-sizing: border-box;
}

.confirmpassword-container {
    width: 100%;
    position: relative;
}

.confirmpassword-container input[type="password"],
.confirmpassword-container input[type="text"] {
    width: 100%;
    padding: 12px 36px 12px 12px;
    box-sizing: border-box;
}
</style>

<body>
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/brands.min.css">

    

    <div class="container" style="margin-top:100px; position: relative; ">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center" style="font-weight:bold; letter-spacing:1px;">CHANGE PASSWORD</h1>
                    </div>
                    <div class="card-body">

                        <form action="" method="post">

                            <!-- Old Password -->
                            <div class="oldpassword-container">
                                <input type="password" name="old_password" placeholder="Enter Old Password"
                                    id="old_password" class="form-control" required>
                                <i class="fa-solid fa-eye" title="Show/Hide password" id="eye1"></i>
                            </div>
                            <br>

                            <!-- New Password -->
                            <div class="newpassword-container">
                                <input type="password" name="new_password" placeholder="Enter New Password"
                                    id="new_password" class="form-control" required>
                                <i class="fa-solid fa-eye" title="Show/Hide password" id="eye2"></i>
                            </div>
                            <br>


                            <!-- Confirm Password -->
                            <div class="confirmpassword-container">
                                <input type="password" name="confirm_password" placeholder="Re-Enter Password"
                                    id="confirm_password" class="form-control" required>
                                <i class="fa-solid fa-eye" title="Show/Hide password" id="eye3"></i>
                            </div>
                            <br>



                            <!-- Update Button -->
                            <input type="submit" value="Change Password" name="UpdateBtn" onclick="return Compare()"
                                class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
     
     if(isset($_POST['UpdateBtn']))
     {
        $old_password = MD5($_POST['old_password']);
        $new_password = MD5($_POST['new_password']);
        $confirm_password = MD5($_POST['confirm_password']);
         if(isset($_SESSION['id']))
         {
             $id = $_SESSION['id'];
             $query1 = "select * from users where id='$id'";
             $result = mysqli_query($conn,$query1);
             $data = mysqli_fetch_assoc($result);

             if(mysqli_num_rows($result)==1)
             {
                 if($old_password == $data['password'])
                 {
                     if($new_password == $confirm_password)
                     {
                         $query2 = "update users set password='$new_password' where id='$id'";
                         $exec = mysqli_query($conn,$query2);
                         if($exec==true)
                         {
                            echo "<script>
                            swal.fire({
                                title: 'UPDATED',
                                text: 'Your password has been updated successfully!',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: true,
                                confirmButtonColor: 'blue',
                                backdrop: 'gray'
                            }).then(function() {
                                window.location.href='index.php?page=payments'
                            })
                            </script>";
                         }
                         else
                         {
                            echo "<script> 
                            swal.fire({
                                title: 'ERROR',
                                text: 'Failed to update',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: true,
                                confirmButtonColor: 'blue',
                                backdrop: 'gray'
                            });
                            return false;
                            </script>";
                         }
                     }
                     else
                     {
                        echo "<script> 
                            swal.fire({
                                title: 'PASSWORD NOT MATCHED',
                                text: 'New password and Confirm password is not identical',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: true,
                                confirmButtonColor: 'blue',
                                backdrop: 'gray'
                            });
                            return false;
                            </script>";
                     }
                 }
                 else
                 {
                    echo "<script> 
                    swal.fire({
                        title: 'INVALID OLD PASSWORD',
                        text: 'Old password is incorrect',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: true,
                        confirmButtonColor: 'blue',
                        backdrop: 'gray'
                    });
                    </script>";
                 }
             }
         }
     }
     
     ?>


    <!-- Show Old Password -->
    <script>
    const passwordField1 = document.querySelector("#old_password");
    const eyeIcon1 = document.querySelector("#eye1");
    eyeIcon1.addEventListener("click", function() {
        this.classList.toggle("fa-eye-slash");
        const type1 = passwordField1.getAttribute("type") === "password" ? "text" : "password";
        passwordField1.setAttribute("type", type1);
    })
    </script>

    <!-- Show New Password -->
    <script>
    const passwordField2 = document.querySelector("#new_password");
    const eyeIcon2 = document.querySelector("#eye2");
    eyeIcon2.addEventListener("click", function() {
        this.classList.toggle("fa-eye-slash");
        const type2 = passwordField2.getAttribute("type") === "password" ? "text" : "password";
        passwordField2.setAttribute("type", type2);
    })
    </script>

    <!-- Show Confirm Password -->
    <script>
    const passwordField3 = document.querySelector("#confirm_password");
    const eyeIcon3 = document.querySelector("#eye3");
    eyeIcon3.addEventListener("click", function() {
        this.classList.toggle("fa-eye-slash");
        const type3 = passwordField3.getAttribute("type") === "password" ? "text" : "password";
        passwordField3.setAttribute("type", type3);
    })
    </script>

    <!-- Comparing password -->
    <script>
    function Compare() {
        var new_password = document.getElementById("new_password");
        var confirm_password = document.getElementById("confirm_password");
        if (new_password.value != confirm_password.value) {
            alert('New password and Confirm password is not identical....!!');
            return false;
        } else {
            return true;
        }
    }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>