<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('db_connect.php');
ob_start();

ob_end_flush();
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/x-icon" href="assets/uploads/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <?php include('./header.php'); 
include('./footer.php'); ?>
    <?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
body {
    width: 100%;
    height: calc(100%);
    position: fixed;
    top: 0;
    left: 0
        /*background: #007bff;*/
}

.aplogo {
    max-width: 300px;
}

main#main {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    background-image: url(assets/uploads/urc.jpg);
    background-size: 100% 100%;
    /* background-color:white; */
}

@media only screen and (min-width: 768px) and (max-width: 959px) {
    .aplogo {
        max-width: 141px;
    }
}

.card.col-md-3 {
    width: 427px;
    -webkit-box-shadow: 0 4px 12px rgb(0 0 0 / 15%);
    box-shadow: 0 4px 12px rgb(0 0 0 / 15%);
    border-radius: 8px;
    margin: 0 auto;
    background: #fff;
}

.password-container {
    width: 100%;
    position: relative;
}

.password-container input[type="password"],
.password-container input[type="text"] {
    width: 100%;
    padding: 12px 36px 12px 12px;
    box-sizing: border-box;
}

.fa-eye {
    position: absolute;
    top: 64%;
    right: 4%;
    cursor: pointer;
    color: lightgray;
}
.card.col-md-3{
    box-shadow: rgb(50 50 93 / 25%) 0px 50px 100px -20px, rgb(0 0 0 / 30%) 0px 30px 60px -30px, rgb(10 37 64 / 56%) 0px 0px 8px -3px inset;
}.redirect {
    /* content: "."; */
    position: relative;
    left: 293px;
    width: 710px;
    top: 122px;
}
</style>




<body class="bg-dark">


    <main id="main">    

        <div class="align-self-center w-100">

            <div id="login-center" align="center">
                <div class="card col-md-3">
                    <div class="card-body">
                        <form method="post" id="login_form">
                            <br>
                            <div class="form-group">
                                <label for="username" class="fw-bold">Username</label> <i class="far fa-user"></i>
                                <input type="text" id="username" placeholder="Enter Username"
                                 class="form-control" autocomplete="username" required>
                            </div>

                            <div class="form-group">
                                <div class="password-container">
                                    <label for="password" class="fw-bold">Password</label> <i class="fa fa-lock"></i>
                                    <input type="password" id="password" placeholder="Enter Password" class="form-control" required>
                                    <i class="fa-solid fa-eye" title="Show/Hide password" id="eye"></i>
                                </div>

                                <br>
                                <input type="button" value="Login" id="LoginBtn"
                                    class="btn btn-outline-primary btn-block">
                                <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

<script src="./custom.js"></script>
<script>
// Login
$("#LoginBtn").on('click',function(){
    let username = $("#username").val();
    let password = $("#password").val();
    if(username=="" || password =="")
    {
        toaster("Username & Password fields are required",5);
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "loginAjax.php",
            data: { username:username, password:password },
            success: function (response) 
            {
                if(response==="Invalid username or password")
                {
                    toaster(response,5);
                }
                else if(response==="Login successful")
                {
                    window.location.href='index.php?page=payments';
                }
            }
        });
    }
});


// Show Password
const passwordField = document.querySelector("#password");
const eyeIcon = document.querySelector("#eye");
eyeIcon.addEventListener("click", function() {
    this.classList.toggle("fa-eye-slash");
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
});
</script>

</html>