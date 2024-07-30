<?php 
if($_SESSION['login_type'] == 2){
  
    echo "<script> window.location.href='index.php?page=payments'; </script>";
    
    exit("Intruders not allowed");
}

if($_SESSION['id']==null && $_SESSION['login_type'] == 2){
    
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['login_type']);
    echo "<script> window.location.href='login.php'; </script>";
    
    exit("Intruders not allowed");
    
           }
?>
<style>
span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}

.imgs {
    margin: .5em;
    max-width: calc(100%);
    max-height: calc(100%);
}

.imgs img {
    /* max-width: calc(100%); */
    max-height: calc(100%);
    cursor: pointer;
}

#imagesCarousel,
#imagesCarousel .carousel-inner,
#imagesCarousel .carousel-item {
    height: 60vh !important;
    background: black;
}

#imagesCarousel .carousel-item.active {
    display: flex !important;
}

#imagesCarousel .carousel-item-next {
    display: flex !important;
}

#imagesCarousel .carousel-item img {
    margin: auto;
}

#imagesCarousel img {
    width: auto !important;
    height: auto !important;
    max-height: calc(100%) !important;
    max-width: calc(100%) !important;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['name']."!"  ?>
                    <hr>


                    <div class="container">
                        <div class="row">
                
                            <div class="col-lg-4 mb-2">
                            <a href="index.php?page=students">
                                <div class="card-box bg-blue">
                                    <div class="icon">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    </div>
                                    <div class="inner">
                                 
                                        <?php
                                        $totalStudents = mysqli_query($conn,'SELECT * FROM student');
                                        $countStudents = mysqli_num_rows($totalStudents);
                                        ?>
                                        <h3> <?php echo $countStudents; ?> </h3>
                                        <p> Total Students </p>
                               
                                    </div>
                                </div>
                                </a>
                            </div>         

                            <div class="col-lg-4">
                            <a href="index.php?page=students">
                                <div class="card-box bg-green">
                                    <div class="icon text-white">
                                        <i class="fa fa-certificate " aria-hidden="true"></i>
                                    </div>
                                    <div class="inner">
                                        
                                        <h3> <?php echo "32"; ?> </h3>
                                        <p> Total Courses</p>
                                    </div>
                                </div>
                                </a>
                            </div>

                            <div class="col-lg-4 ">
                            <a href="index.php?page=users">
                                <div class="card-box bg-red">
                                    <div class="icon">
                                        <i class="fa fa-users"></i>
                                    </div>

                                    <div class="inner">
                                        <?php
                                        $totalUsers = mysqli_query($conn,'SELECT * FROM users');
                                        $countUsers = mysqli_num_rows($totalUsers);
                                        ?>
                                        <h3> <?php echo $countUsers; ?> </h3>
                                        <p> Total Users </p>
                                    </div>

                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="mt-2">
                                <b class="display-6">Recent Fee</b>
                            </div>
                            <table class="table table-condensed table-bordered table-hover table-striped text-center" style="width: 100%;" id="dashBoardTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.NO.</th>
                                        <th class="text-center">DATE</th>
                                        <th class="text-center">RECEIPT NO</th>
                                        <th class="text-center">MONTH OF FEE</th>
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">PAID AMOUNT</th>
                                    </tr>
                                </thead>
                                    <tbody></tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
        $("#dashBoardTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
            "url": "fetchDashboardTable.php", 
            "type": "POST",
        },
        "columns": [
            { data: 'sr_no'},
            { data: 'date_created' },
            { data: 'Receipt_no'},
            { data: 'Month_Of_Payment' },
            { data: 'FULL_NAME'},
            { data: 'amount' },
        ],
        "pageLength": 25,
        "searching": true,
    });
});
</script>