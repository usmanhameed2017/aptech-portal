<?php
include('db_connect.php');

if(!isset($_SESSION['id']) && !isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
 date_default_timezone_set("Asia/Karachi");

?>
<style>
.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}

img.aplogo {
    position: relative;
    width: 200px;

}

.float-right.r {
    position: relative;
    left: -35px;
}
</style>

<style type="text/css">
.username {
    width: 131px;
    text-align: center;
    position: relative;
    display: inline-block;
    color: black;
}

#box1 {
    display: none;
    text-align: center;
    position: absolute;
}
</style>



<script>
showMenu = function() {
    var div1 = document.getElementById('box1');
    var div2 = document.getElementById('box2');
    var div3 = document.getElementById('box3');
    var div4 = document.getElementById('box4');
    div1.style.display = 'block';
    div2.style.display = 'block';
    div3.style.display = 'block';
    div4.style.display = 'block';


}
hideMenu = function() {
    var div1 = document.getElementById('box1');
    var div2 = document.getElementById('box2');
    var div3 = document.getElementById('box3');
    var div4 = document.getElementById('box4');
    div1.style.display = 'none';
    div2.style.display = 'none';
    div3.style.display = 'none';
    div4.style.display = 'none';
}
</script>
<div id="page">
</div>


<div id="loading"></div>
<nav class="navbar navbar-light fixed-top border-bottom">
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-center justify-content-between h-0">
            <a href="./index.php?page=payments"><img src="assets/uploads/aptechlogo.png" class="aplogo"></a>
            <div class="float-right">
                    <div class="username" onmouseover="showMenu();" onmouseout="hideMenu();"><a class="fa fa-user"></a>
                        <?php echo $_SESSION['name']; ?>


                        <div id="box1">
                            <a class="dropdown-item text-left" href="index.php?page=ViewProfile"><i class="fa fa-user" aria-hidden="true"></i> View Profile </a>
                            <a class="dropdown-item text-left" href="index.php?page=changePassword"><i class="fa fa-key" aria-hidden="true"></i> Change Password </a>
                            <a class="dropdown-item text-left" href="#" onclick="ConfirmLogout()"><i class="fa fa-power-off"></i> Logout </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</nav>

<!-- Script For Confirmation Message Before Logout -->
<script type="text/javascript">
    function ConfirmLogout()
    {
        swal.fire({
            title: 'CONFIRMATION?',
            text: 'Are you sure you want to logout?',
            icon: 'question',
            allowOutsideClick: false,
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonColor: 'red',
            confirmButtonColor: 'blue',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result => {
            if(result.isConfirmed)
            {
                window.location.href="logout.php";
            }
        }));
    }
</script>