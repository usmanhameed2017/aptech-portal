<?php
session_start();
include("header.php");
include "db_connect.php";
if (!isset($_SESSION["id"])) 
{
    header("Location:login.php");
}
?>
<!doctype html>
<html id="html" lang="en">

<head>
    <title>Print Receipt</title>
    <meta content="" name="descriptison">
<meta content="" name="keywords">
<!-- Google Fonts -->

<link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
<link rel="icon" type="image/x-icon" href="assets/uploads/favicon.png">
<!-- Vendor CSS Files -->
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="assets/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
<link href="assets/css/select2.min.css" rel="stylesheet">
<!-- Sweet Alert2 css file -->
<link rel="stylesheet" href="dist/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js">
</script>
<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="assets/css/jquery-te-1.4.0.css">
    <link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print">
    <style>
    .uni-title {
        font-weight: bold;
    }

    .ofc {
        left: 0px;
        position: relative;
        float: right;
    }
    
    .col-sm-6 {
        float: left;
    }

    h6 {
        font-weight: bold;
        position: relative;
        top: 9px;
    }

    h6.lst {
    position: relative;
    text-align: center;
    float: left;
     left: 206px; 
    top: -79px;
    margin-left: 138px;
    }

    h6.lst2 {
    position: relative;
    text-align: center;
    left: -102px;
    top: 51px;
    margin-top: 10px;
    margin-left: -90px;
    }



    .hrt {
        margin-left: 0px;
        color: white;
        background-color: white;
        border: 0px;
        height: 0px;
        border-top: 1px dashed black;
    }

    .hrt:after {
        content: '\002702';
        display: inline-block;
        position: relative;
        top: -13px;
        left: -1px;
        padding: 0 2px;
        background: white;
        color: gray;
        font-size: 15px;

        transform: rotate(0deg);
    }

    .signline {
        height: 1px;
        color: black;
        border-top: 2px dashed black;
    }


    h4 {
        font-size: 1.5rem;
    }


/*    button#printButton {*/
/*        position: absolute;*/
/*        top: -883px;*/
/*        left: 584px;*/
/*        max-height: 38px;*/
/*        width: 110px;*/
/*    }*/

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
        border: 1px solid;
        font-weight: bold;
        color: black;
    }.heightADJUST{
        min-height: 4vh;
        max-height: 5vh;
    }


    </style>
</head>

<?php
$id = $_GET['id']??"";
if($id==="")
{
   header("Location:index.php?page=students"); 
}
$query = "SELECT * FROM student WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);
?>

<body class="" oncontextmenu="return false">
    
                    
                <!--Student Copy-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-2 text-center">
                            <button class="btn btn-success admin" id="printButton" type="button" onclick="PrintNow()"> Print <i class='fa fa-print'></i></button>
                            <a href="index.php?page=students" class="btn btn-secondary" id="backButton" type="button"> Home <i class="fa fa-home"></i></a>
                        </div>
                        <div class="col-sm-6 mt-2">
                             <img src="assets/uploads/Fee Receipt Logo.png">
                        </div>
                        <div class="col-sm-6 mt-2 d-flex align-items-center">
                           <h2 class="uni-title">UNIVERSITY ROAD CENTER</h2>
                        </div>
                         <div class="col-md-12 text-center">
                           <h6>STUDENT COPY</h6>
                        </div>
                        
                        <div class="col-sm-6">
                            <h6>STUDENT NAME</h6>
                            <input type="text" name="std_name" value="<?php echo $data['name']; ?>" class="form-control" disabled>
                        </div>
                        
                        <div class="col-sm-6">
                            <h6>FATHER NAME</h6>
                            <input type="text" name="fname" value="<?php echo $data['father_name']; ?>" class="form-control" disabled>
                        </div>
                    
                        <div class="col-sm-6">
                            <h6>CONTACT</h6>
                            <input type="text" name="contact" value="<?php echo $data['contact']; ?>" class="form-control" disabled>
                        </div>
                       
                         <div class="col-sm-6">
                            <h6>COUNSELOR</h6>
                            <input type="text" name="counselor" value="<?php echo $data['Course_Family_Name']; ?>" class="form-control" disabled>
                        </div>
                        <div class="col-sm-6">
                            <h6>COURSE</h6>
                            <input type="text" name="course" value="<?php echo $data['course']; ?>" class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>ADMISSION FEE</h6>
                             <input type="text" name="admission_fee" value="<?php echo $data['admission_fee']; ?>" class="form-control" disabled>
                        </div>
                    
                        <div class="col-sm-6">
                            <h6>MONTHLY FEE</h6>
                            <input type="text" name="monthly_fee" value="<?php echo $data['monthly_fee']; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <h6>AMOUNT IN WORDS</h6>
                            <input type="text" name="amount_in_words" value="<?php echo $data['amount_in_words']; ?>" class="form-control" readonly>
                        </div>
                    
                        <div class="col-sm-6">
                            <h6>DATE OF ADMISSION</h6>
                            <input type="text" disabled name="date_of_admission" value="<?php echo date('F-d-Y',strtotime($data['date_created'])); ?>" class="form-control" required>
                        </div>

                        <div class="col-sm-6">
                            <h6>CERTIFICATION FEE</h6>
                            <input type="text" name="certification_fee" value="<?php echo $data['Original_Booking_Confirmation']; ?>" class="form-control" disabled>
                        </div>
                   
                        
                         <div class="col-sm-6">
                            <h6>ADDRESS</h6>
                            <textarea autosize name="auto_adjustment" class="form-control" disabled><?php echo $data['address']; ?></textarea>
                        </div>
                        <div class="col-sm-6">
                            <h6>TOTAL COURSE FEE</h6>
                            <textarea autosize name="auto_adjustment" class="form-control" disabled><?php echo $data['Short_Course_Total_Fee']; ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="heightADJUST"></div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="std">* Cheques subject to realization</h6>
                            <h6 class="std">* This receipt must be produced when demanded</h6>
                            <h6 class="std">* Fee once paid is not refundable</h6>
                        </div>
                        <div class="col-md-8 d-flex justify-content-between align-items-end">
                            <div class="col-md-5 text-center mb-2">
                                <hr class="signline" />
                                <h6 class="signn">Issuing Signature</h6>
                            </div>
                            <div class="col-md-5 text-center mb-2">
                                <hr class="signline" />
                                <h6 class="signn">Receiving signature</h6>
                            </div>
                        </div>
                             
                        <div class="col-md-12 mt-2 text-center">
                            <h6 class="">1st Floor-Bell Arcade, Gulistan-e-Johar, Block-1, Main University Road, Opp. University of Karachi.
                                <br> URL: www.aptech-education.com.pk Tel:021-34664922-3, 0336-2197164
                            </h6>
                        </div>
                    </div>
                </div>
                    
                        <hr class="hrt" />


                <!--Office Copy-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                           <h6>OFFICE COPY</h6>
                        </div>
                        
                        <div class="col-sm-6">
                            <h6>STUDENT NAME</h6>
                            <input type="text" name="std_name" value="<?php echo $data['name']; ?>" class="form-control" disabled>
                        </div>
                        
                        <div class="col-sm-6">
                            <h6>FATHER NAME</h6>
                            <input type="text" name="fname" value="<?php echo $data['father_name']; ?>" class="form-control" disabled>
                        </div>
                    
                        <div class="col-sm-6">
                            <h6>CONTACT</h6>
                            <input type="text" name="contact" value="<?php echo $data['contact']; ?>" class="form-control" disabled>
                        </div>
                       
                         <div class="col-sm-6">
                            <h6>COUNSELOR</h6>
                            <input type="text" name="counselor" value="<?php echo $data['Course_Family_Name']; ?>" class="form-control" disabled>
                        </div>
                        <div class="col-sm-6">
                            <h6>COURSE</h6>
                            <input type="text" name="course" value="<?php echo $data['course']; ?>" class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>ADMISSION FEE</h6>
                             <input type="text" name="admission_fee" value="<?php echo $data['admission_fee']; ?>" class="form-control" disabled>
                        </div>
                    
                        <div class="col-sm-6">
                            <h6>MONTHLY FEE</h6>
                            <input type="text" name="monthly_fee" value="<?php echo $data['monthly_fee']; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <h6>AMOUNT IN WORDS</h6>
                            <input type="text" name="amount_in_words" value="<?php echo $data['amount_in_words']; ?>" class="form-control" readonly>
                        </div>
                    
                        <div class="col-sm-6">
                            <h6>DATE OF ADMISSION</h6>
                            <input type="text" disabled name="date_of_admission" value="<?php echo date('F-d-Y',strtotime($data['date_created'])); ?>" class="form-control" required>
                        </div>

                        <div class="col-sm-6">
                            <h6>CERTIFICATION FEE</h6>
                            <input type="text" name="certification_fee" value="<?php echo $data['Original_Booking_Confirmation']; ?>" class="form-control" disabled>
                        </div>
                   
                        
                         <div class="col-sm-6">
                            <h6>ADDRESS</h6>
                            <textarea autosize name="auto_adjustment" class="form-control" disabled><?php echo $data['address']; ?></textarea>

                        </div>
                        <div class="col-sm-6">
                            <h6>TOTAL COURSE FEE</h6>
                            <textarea autosize name="auto_adjustment" class="form-control" disabled><?php echo $data['Short_Course_Total_Fee']; ?></textarea>
                        </div>
                        <div class="col-md-12">
                                <div class="heightADJUST"></div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between align-items-end">
                               <div class="col-md-4 text-center mb-2">
                                <hr class="signline" />
                                <h6 class="signn">Issuing Signature</h6>
                            </div>
                            <div class="col-md-4 text-center mb-2">
                                <hr class="signline" />
                                <h6 class="signn">Receiving signature</h6>
                            </div>
                        </div>
                    </div>
                </div>
            
    <script>
    document.addEventListener('keydown', (e) => {
    e = e || window.event;
    if(e.keyCode == 116 || e.keyCode == 17 || e.keyCode == 80 || e.keyCode == 85 || e.keyCode == 67 || e.keyCode == 82 || e.keyCode == 16 || e.keyCode == 73 || e.keyCode == 123 || e.keyCode == 74 || e.keyCode == 121){
        e.preventDefault();
    } 
    });

    </script>
    
    <script>
    function PrintNow() {
        window.print()
        // document.getElementById('backButton').style.width='258px';
        // document.getElementById('printButton').style.visibility='hidden';
        //  window.location.replace("https://aptechurc.com/index.php?page=students");
        <?php unset($_SESSION["tk"]); ?>
    }
    
    $(document).ready(function(){
        window.print();
    });
    </script>
               
                        <script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>

<script>
  // Initialize autosize on the textarea
  autosize(document.getElementsByName('auto_adjustment'));
</script>
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