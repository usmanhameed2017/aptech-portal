<?php
session_start();
include "db_connect.php";
if (!isset($_SESSION["id"])) {
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
    h1.uni-title {
        position: relative;
        bottom: -83px;
        float: right;
        font-weight: bold;
    }

    .ofc {
        left: 0px;
        position: relative;
        float: right;
    }

    .form-group {
        position: relative;
        top: -42px;
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
    /* left: 206px; */
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

    .signn {
        position: relative;
        left: 721px;
        top: 7px;
        width: 210px;
    }


    .signn2 {
        position: relative;
        left: 721px;
        top: -20px;
        width: 210px;
    }

    .hrt {
        width: 1341px;
        margin-left: 0px;
        color: white;
        background-color: white;
        border: 0px;
        height: 0px;
        border-top: 1px dashed black;
        position: relative;
        top: 40px;
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
        position: relative;
        width: 310px;
        left: 618px;
        height: 1px;
        color: black;
        top: 24px;
        border-top: 2px dashed black;
    }

    .signline2 {
        position: relative;
        width: 310px;
        left: 625px;
        top: -4px;
        color: black;
        border-top: 2px dashed black;
        height: 2px;
    }

    .col-lg-12 {
        float: right;
    }

    h4 {
        position: relative;
        font-size: 1.5rem;
        top: 2px;
        left: 13px;
    }

    h6.std {
        position: relative;

        top: 10px;
        left: 0px;
    }


    .body{
        position: fixed;

    }
    p.float-right {
    max-height: 0px;
    position: absolute;
    font-size: 16px;
    text-align: right;
    display: flex;
    top: 100px;
    font-weight: 600;
    left: 824px;
}
    form.std_form {
        position: relative;
        top: 0px;
    }

    button#printButton {
        position: absolute;
        top: -883px;
        left: 584px;
        max-height: 38px;
        width: 110px;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
        border: 1px solid;
        font-weight: bold;
        color: black;
    }

    a.btn.btn-secondary {
        position: absolute;
        top: -883px;
        width: 110px;
        left: 445px;
    }

    #sizer {
        max-height: 1000px;
    }.container {
    position: relative;
    top: 25px;
    }
    </style>
</head>
<?php
$Receipt_no = $_GET['Receipt_no']??"";
$query = "select * from payments where Receipt_no='$Receipt_no'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);
?>

<body class="blocking" oncontextmenu="return false">
    
    <!-- Office Use -->
    <div class="container">
        <div class="row">
            <img src="assets/uploads/Fee Receipt Logo.png">
            <div class="form-group">
                <div class="">
                    <h1 class="uni-title">UNIVERSITY ROAD CENTER</h1>
                </div>
                <h6 class="ofc">Office Copy</h6>
             
            </div>
            <p class="float-right" >RECEIPT NO: <?php echo $data["Receipt_no"]; ?></p>
            <div class="col-lg-12">
                <form method="post">
                    <div class="row">
                       
                        <div class="col-sm-6">
                            <h6>RECEIVING DATE</h6>
                            <input type="text" name="date"
                                value="<?php echo strtoupper(date("d-M-Y h:i",strtotime($data["date_created"]))); ?>"
                                class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>FEE TYPE </h6>
                            <input type="text" name="receipt_no" value="<?php if (
                                $data["FEE_TYPE"] == 1
                            ) {
                                echo "Monthly Fee";
                            } elseif ($data["FEE_TYPE"] == 2) {
                                echo "Prospectus Fee";
                            } elseif ($data["FEE_TYPE"] == 3) {
                                echo "Books Fee";
                            } elseif ($data["FEE_TYPE"] == 6) {
                                echo "Other Income Fee";
                            } elseif ($data["FEE_TYPE"] == 5) {
                                echo "Registration Fee";
                            } elseif ($data["FEE_TYPE"] == 4) {
                                echo "Fine";
                            } ?>"
                                class="form-control" disabled required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>NAME</h6>
                            <input type="text" name="name" value="<?php echo $data[
                                "FULL_NAME"
                            ]; ?>"
                                class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>MONTH OF FEE</h6>
                            <input type="text" class="form-control"
                                value="<?php echo strtoupper(
                                    date(
                                        "M-Y",
                                        strtotime($data["Month_Of_Payment"])
                                    )
                                ); ?>" disabled>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>COURSE</h6>
                            <input type="text" name="fee_head" value="<?php echo $data[
                                "FEE_HEAD"
                            ]; ?>"
                                class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>CHEQUE NO</h6>
                             <input type="text" name="cheque_no" value="<?php if ($data["CHEQUE_NO"]){echo $data["CHEQUE_NO"];}else{echo "-";} ?>"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>PAYMENT MODE</h6>
                            <?php if ($data["PAYMENT_MODE"] == "Cash") {
                                echo "<input type='text' disabled class='form-control text-uppercase' value='Cash'";
                            } elseif ($data["PAYMENT_MODE"] == "Cheque") {
                                echo "<input type='text' disabled class='form-control text-uppercase' value='Cheque'";
                            } elseif ($data["PAYMENT_MODE"] == "Online") {
                                echo "<input type='text' disabled class='form-control text-uppercase' value='Online'";
                            } ?>
                            <input type="text" name="payment_mode" class="form-control" readonly>
                        </div>


                        <div class="col-sm-6">
                            <h6>TIMINGS</h6>
                            <?php if (
                                $data["TIMINGS"] != "" &&
                                $data["TIMINGS"] != null
                            ) { ?>
                            <input list="timings" value="<?php echo $data[
                                "TIMINGS"
                            ]; ?>" name="timings"
                                placeholder="Select" disabled class="form-control" />
                            <datalist id="timings">
                                <!-- MWF -->
                                <option value="9:00 TO 11:00 (MWF)">
                                <option value="11:00 TO 1:00 (MWF)">
                                <option value="1:00 TO 3:00 (MWF)">
                                <option value="3:00 TO 5:00 (MWF)">
                                <option value="5:00 TO 7:00 (MWF)">
                                <option value="7:00 TO 9:00 (MWF)">
                                    <!-- TTS -->
                                <option value="9:00 TO 11:00 (TTS)">
                                <option value="11:00 TO 1:00 (TTS)">
                                <option value="1:00 TO 3:00 (TTS)">
                                <option value="3:00 TO 5:00 (TTS)">
                                <option value="5:00 TO 7:00 (TTS)">
                                <option value="7:00 TO 9:00 (TTS)">
                            </datalist>
                            <?php } else { ?>
                            <input type="text" class="form-control" readonly>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <h6>AMOUNT</h6>
                            <input type="text" disabled name="amount" value="<?php echo number_format(
                                $data["amount"]
                            ); ?>"
                                class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <h6>RECEIVED BY</h6>
                            <input type="text" disabled name="inputter" value="<?php echo strtoupper(
                                $data["INPUTTER"]
                            ); ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <h6>AMOUNT IN WORDS</h6>
                            <input type="text" disabled name="amount_in_words"
                                value="<?php echo strtoupper(
                                    $data["AMOUNT_IN_WORDS"]
                                ); ?>" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <h6>REMARKS</h6>
                            <input type="text" name="remarks" value="<?php echo $data[
                                "remarks"
                            ]; ?>"
                                class="form-control" disabled required>
                        </div>

                        <div class="col-lg-12">
                            <h6>* Cheques subject to realization</h6>
                            <h6>* This receipt must be produced when demanded</h6>
                            <h6>* Fee once paid is not refundable</h6>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <hr class="signline" />
                                <h6 class="signn">Issuing Signature</h6>
                            </div>
                        </div>
                        <hr class="hrt" />
                        <h6 class="lst">1st Floor-Bell Arcade, Gullistan-e-Johar, Block-1, Main University Road, Opp. University of Karachi.
                            <br>
                            URL: www.aptech-education.com.pk Tel: 021-34664922-3, 0336-2197164
                        </h6>
                    </div>


                </form>
            </div>

        </div>
    </div>



    <!-- Student Copy -->
    <div class="container">
        <div class="row">
            <img src="assets/uploads/Fee Receipt Logo.png">
            <div class="form-group">
                <div class="">
                    <h1 class="uni-title">UNIVERSITY ROAD CENTER</h1>

                </div>
                <h6 class="ofc">Student Copy</h6>
               
            </div>
            <p class="float-right" >RECEIPT NO: <?php echo $data[
                "Receipt_no"
            ]; ?></p>
            <div class="col-lg-12">
                
                <form method="post" class="std_form">
         
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <h6>RECEIVING DATE</h6>
                            <input type="text" name="date"
                                value="<?php echo strtoupper(
                                    date(
                                        "d-M-Y h:i",
                                        strtotime($data["date_created"])
                                    )
                                ); ?>"
                                class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>FEE TYPE</h6>
                            <input type="text" name="receipt_no" value="<?php if (
                                $data["FEE_TYPE"] == 1
                            ) {
                                echo "Monthly Fee";
                            } elseif ($data["FEE_TYPE"] == 2) {
                                echo "Prospectus Fee";
                            } elseif ($data["FEE_TYPE"] == 3) {
                                echo "Book Fee";
                            } elseif ($data["FEE_TYPE"] == 6) {
                                echo "Other Income Fee";
                            } elseif ($data["FEE_TYPE"] == 5) {
                                echo "Registration Fee";
                            } elseif ($data["FEE_TYPE"] == 4) {
                                echo "Fine";
                            } ?>"
                                class="form-control" disabled required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>NAME</h6>
                            <input type="text" name="name" value="<?php echo $data[
                                "FULL_NAME"
                            ]; ?>"
                                class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>MONTH OF FEE</h6>
                            <input type="text" class="form-control"
                                value="<?php echo strtoupper(
                                    date(
                                        "M-Y",
                                        strtotime($data["Month_Of_Payment"])
                                    )
                                ); ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>COURSE</h6>
                            <input type="text" name="fee_head" value="<?php echo $data[
                                "FEE_HEAD"
                            ]; ?>"
                                class="form-control" disabled required>
                        </div>
                        <div class="col-sm-6">
                            <h6>CHEQUE NO</h6>
                            <input type="text" name="cheque_no" value="<?php if ($data["CHEQUE_NO"]){echo $data["CHEQUE_NO"];}else{echo "-";} ?>"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>PAYMENT MODE</h6>
                            <?php if ($data["PAYMENT_MODE"] == "Cash") {
                                echo "<input type='text' disabled class='form-control text-uppercase'  value='Cash'";
                            } elseif ($data["PAYMENT_MODE"] == "Cheque") {
                                echo "<input type='text' disabled class='form-control text-uppercase' value='Cheque'";
                            } elseif ($data["PAYMENT_MODE"] == "Online") {
                                echo "<input type='text' disabled class='form-control text-uppercase' value='Online'";
                            } ?>
                            <input type="text" name="payment_mode" class="form-control" readonly>
                        </div>


                        <div class="col-sm-6">
                            <h6>TIMINGS</h6>
                            <?php if (
                                $data["TIMINGS"] != "" &&
                                $data["TIMINGS"] != null
                            ) { ?>
                            <input list="timings" value="<?php echo $data[
                                "TIMINGS"
                            ]; ?>" name="timings"
                                placeholder="Select" disabled class="form-control" />
                            <datalist id="timings">
                                <!-- MWF -->
                                <option value="9:00 TO 11:00 (MWF)">
                                <option value="11:00 TO 1:00 (MWF)">
                                <option value="1:00 TO 3:00 (MWF)">
                                <option value="3:00 TO 5:00 (MWF)">
                                <option value="5:00 TO 7:00 (MWF)">
                                <option value="7:00 TO 9:00 (MWF)">
                                    <!-- TTS -->
                                <option value="9:00 TO 11:00 (TTS)">
                                <option value="11:00 TO 1:00 (TTS)">
                                <option value="1:00 TO 3:00 (TTS)">
                                <option value="3:00 TO 5:00 (TTS)">
                                <option value="5:00 TO 7:00 (TTS)">
                                <option value="7:00 TO 9:00 (TTS)">
                            </datalist>
                            <?php } else { ?>
                            <input type="text" class="form-control" readonly>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <h6>AMOUNT</h6>
                            <input type="text" disabled name="amount" value="<?php echo number_format(
                                $data["amount"]
                            ); ?>"
                                class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <h6>RECEIVED BY</h6>
                            <input type="text" disabled name="inputter" value="<?php echo strtoupper(
                                $data["INPUTTER"]
                            ); ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <h6>AMOUNT IN WORDS</h6>
                            <input type="text" disabled name="amount_in_words"
                                value="<?php echo strtoupper(
                                    $data["AMOUNT_IN_WORDS"]
                                ); ?>" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <h6>REMARKS</h6>
                            <input type="text" name="remarks" value="<?php echo $data[
                                "remarks"
                            ]; ?>"
                                class="form-control" disabled required>

                        </div>

                    </div>


            </div>
            <div class="col-lg-12">
                <h6 class="std">* Cheques subject to realization</h6>
                <h6 class="std">* This receipt must be produced when demanded</h6>
                <h6 class="std">* Fee once paid is not refundable</h6>
            </div>
            <div>

                <hr class="signline2" />
                <h6 class="signn2">Issuing Signature</h6>

            </div>
            <div>
                <h6 class="lst2">1st Floor-Bell Arcade, Gullistan-e-Johar, Block-1, Main University Road, Opp. University of Karachi.
                            <br>
                            URL: www.aptech-education.com.pk Tel: 021-34664922-3, 0336-2197164
                </h6>
            </div>

            <div class="col-sm-6">
                <?php 
                if(isset($_SESSION['tk'])){?>
                <button class="btn btn-success" id="printButton" type="button" onclick="PrintNow()"> Print <i
                        class='fa fa-print'></i></button>
                        
               <?php }
                ?>
                <?php 
                if($_SESSION["login_type"]==1){ ?>
                    
                
                <button class="btn btn-success admin" id="printButton" type="button" onclick="PrintNow()"> Print <i
                        class='fa fa-print'></i></button>
                        <style>
                            a#backButton {
                        min-width: 110px !important;
                        }
                        </style>
               <?php }
                ?>
                <a href="index.php?page=payments" class="btn btn-secondary" id="backButton" type="button"> Home <i class="fa fa-home"></i></a>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
   

    
      <?php 
       // $_SESSION["tk"] = 'true'; //remove comment for checking
    if(!isset($_SESSION['tk']) && $_SESSION["login_type"]==2){?> 
    <div class="container block" style="display:none">
        <h1 class="blocked">Better Luck Next Time!</h1>
        <p class="block">Do not take any unauthorized advantage of this. Your every single action is being monitored.</p>

    </div>
    
    <style>
   
        a#backButton {
    min-width: 258px;
    }@media print{
    .container {
        display:none;
    }
    .container.block {
        display:block !important;
    }.block{
        color:black;
        font-size:28px;
    }.blocked{
        color:black;
        font-size:38px;
    }
    }
    </style>
    <script>
    
    var currentInnerHtml;
    var element = new Image();
    var elementWithHiddenContent = document.querySelector("#html");
    var innerHtml = elementWithHiddenContent.innerHTML;
    
    element.__defineGetter__("id", function() {
        currentInnerHtml = "";
    });
    
    setInterval(function() {
        currentInnerHtml = innerHtml;
        console.log(element);
        console.clear();
        elementWithHiddenContent.innerHTML = currentInnerHtml;
    }, 1);
   </script>
    
    <?php
    }
      ?>
      
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
        document.getElementById('backButton').style.width='258px';
        document.getElementById('printButton').style.visibility='hidden';
         window.location.replace("https://aptechurc.com/index.php?page=payments");
        <?php unset($_SESSION["tk"]); ?>
       
    }
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