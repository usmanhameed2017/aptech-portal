

<?php
if(!isset($_SESSION['id']) && !isset($_SESSION['name']))
{
    header("Location:login.php");
}
if($_SESSION['login_type'] == 1): ?>
<nav id="sidebar" class='mx-lt-5 bg-white border-right'>
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
        <a href="index.php?page=activity_log" class="nav-item nav-activity_log"><span class='icon-field'><i class="fa fa-history"></i></span> Activity Log</a>
        <a href="index.php?page=payments" class="nav-item nav-payments"><span class='icon-field'><i class="fa fa-money-check "></i></span> Fee</a>
        <a href="index.php?page=students" class="nav-item nav-students"><span class='icon-field'><i class="fas fa-graduation-cap"></i></span> Students</a>
        <a href="index.php?page=students_ledger" class="nav-item nav-students_ledger"><span class='icon-field'><i class="fa fa-balance-scale "></i></span> Students Ledger</a>
        <a href="index.php?page=payments_report" class="nav-item nav-payments_report"><span class='icon-field'><i class="fa fa-scroll"></i></span> Fee Report</a>
        <a href="index.php?page=counselors" class="nav-item nav-counselors"><span class='icon-field'><i class="fas fa-user-circle"></i></span> Counselors</a>
        <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
        <a href="#" onclick="ConfirmLogout()" class="nav-item nav-site_settings"><span class='icon-field'><i class="fas fa-lock"></i></span> Logout</a>
             <a href="index.php?page=InactiveStudents" class="nav-item nav-InactiveStudents" style="display:none;"><span class='icon-field'><i class="fa fa-users "></i></span> Student Ledger</a>
             <a href="StudentLedger" class="nav-item nav-StudentLedger" style="display:none;"><span class='icon-field'><i class="fa fa-balance-scale "></i></span> Student Ledger</a>
             <a href="ViewProfile" class="nav-item nav-ViewProfile" style="display:none;"><span class='icon-field'><i class="fa fa-balance-scale "></i></span> Student Ledger</a>
             <a href="index.php?page=changePassword" class="nav-item nav-changePassword" style="display:none;"><span class='icon-field'><i class="fa fa-balance-scale "></i></span> Student Ledger</a>
             
             
        
    </div>
</nav>
<?php endif; ?>
<?php if($_SESSION['login_type'] == 2): ?>
<nav id="sidebar" class='mx-lt-5 bg-white border-right'>
    <div class="sidebar-list">
        <a href="index.php?page=payments" class="nav-item nav-payments"><span class='icon-field'><i class="fa fa-receipt "></i></span> Fee</a>
        <a href="index.php?page=students" class="nav-item nav-students"><span class='icon-field'><i class="fas fa-graduation-cap "></i></span> Students</a>
        <a href="index.php?page=students_ledger" class="nav-item nav-students_ledger"><span class='icon-field'><i class="fa fa-balance-scale "></i></span> Students Ledger</a>
        <a href="index.php?page=counselors" class="nav-item nav-counselors"><span class='icon-field'><i class="fas fa-user-circle"></i></span> Counselors</a>
        <a href="#" onclick="ConfirmLogout()" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-lock"></i></span> Logout</a>
        <?php endif; ?>
    </div>
</nav>

<?php $rrr = $_GET['page']??"";
?>
<script>
$('.nav_collapse').click(function() {
    console.log($(this).attr('href'))
    $($(this).attr('href')).collapse()
})
$('.nav-<?php if($rrr=='StudentLedger'){ echo 'students';}elseif($rrr=='users'){ echo 'users';}
          elseif($rrr=='users'){ echo 'users';}elseif($rrr=='activity_log'){ echo 'activity_log';}
          elseif($rrr=='payments'){ echo 'payments';}elseif($rrr=='students'){ echo 'students';}
          elseif($rrr=='counselors'){ echo 'counselors';}
          elseif($rrr=='InactiveStudents'){ echo 'students';}elseif($rrr=='payments_report'){ echo 'payments_report';}
          elseif($rrr=='home'){ echo 'home';}elseif($rrr=='ViewProfile'){ echo 'users';}
          elseif($rrr=='students_ledger'){ echo 'students_ledger';}elseif($rrr=='changePassword'){ echo 'users';} ?>').addClass('active')

    function ConfirmLogout(){
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