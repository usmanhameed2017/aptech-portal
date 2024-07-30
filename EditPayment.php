<?php
session_start();
include('topbar.php');
include('db_connect.php');
include('header.php');
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}

?>
   
   <style>
    body{
        position: fixed;
    }
    h1.uni-title {
        position: relative;
        bottom: 35px;
        left: 556px;
        font-weight: bold;
    }

    .ofc {
        text-align: right;
        position: relative;
        bottom: 33px;
        left: -16px;
    }

    .form-group {
        position: relative;
        top: -42px;
    }

    .col-lg-6 {
        float: left;
    }

    h6.lst {
        position: relative;
        bottom: 128px;
        text-align: center;
        float: center;
        left: 241px;
        font-size: 20px;
    }

    .signn {
        position: relative;
        left: 864px;
        top: -48px;
        width: 210px;
    }

    hr {
        position: relative;
        height: -8px;
        background-color: black;
        bottom: 119px;
        width: 90%;
    }

    .signline {
        position: relative;
        width: 310px;
        left: 761px;
        top: -40px;
    }

    .col-lg-12 {
        float: right;
    }

    h4 {
        position: relative;
        font-size: 1.5rem;
        top: -33px;
        left: 13px;
    }   h6 {
        font-weight: bold;
        position: relative;
        top: 9px;
    }
    </style>
</head>
<?php
$id = $_GET['id']??"";
$query = "select * from payments where id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$otherTimings = $data['TIMINGS']; //For custom timings
?>

<body>
    <div class="container" style="margin-top:200px;">
        <div class="row">
            <div class="col-md-12">
                <form method="post">


            </div>

            <div class="form-group">
                <!-- For id -->
                <input type="hidden" name="hiddenID" value="<?php echo $data['id']; ?>">
                <input type="hidden" name="hiddenef" value="<?php echo $data['ef_no']; ?>">
                <input type="hidden" name="date_created" value="<?php echo $data['date_created']; ?>">

                <div class="col-lg-6">
                    <h6>NAME</h6>
                    <input type="text" name="name" value="<?php echo $data['FULL_NAME']; ?>" class="form-control"
                        required>
                </div>
                <div class="col-lg-6">
                    <h6>REMARKS</h6>
                    <input type="text" name="remarks" value="<?php echo $data['remarks']; ?>" class="form-control">
                </div>
                <div class="col-lg-6">
                    <h6>COURSE</h6>
                    <?php
                    if($data['FEE_HEAD']!='' && $data['FEE_HEAD']!=null || $data['FEE_HEAD']=='' && $data['FEE_HEAD']==null)
                    {
                        ?>
                    <input list="fee_head" value="<?php echo $data['FEE_HEAD']; ?>" name="fee_head" placeholder="Add course in student details"
                        class="form-control" readonly/>
                    <datalist id="fee_head">
                        <option value="ACCP REGISTRATION">
                        <option value="ACCP TUITION FEE">
                        <option value="DAE REGISTRATION">
                        <option value="SMART PRO TUITION FEE">
                        <option value="EXAM RESIT">
                        <option value="BATCH TRANSFER">
                        <option value="ONLINEVARSITY">
                        <option value="PROSPECTUS">
                        <option value="MS OFFICE">
                        <option value="WEB DESIGNING">
                        <option value="MICROSOFT.NET">
                        <option value="ANDROID">
                        <option value="C">
                        <option value="AUTOCAD">
                        <option value="PHP MYSQL">
                        <option value="JAVA">
                        <option value="C++">
                        <option value="C#">
                        <option value="ADV.EXCEL">
                        <option value="PYTHON">
                        <option value="AMAZON">
                        <option value="ACNS REGISTRATION">
                        <option value="ACNS TUITION FEE">
                        <option value="ROUTING TECHNOLOGY">
                        <option value="HARWARE PROFESSIONAL">
                        <option value="SERVER ADMINISTRATOR">
                        <option value="BEGINNERS ENGLISH">
                        <option value="SPOKEN ENGLISH PRE. INT">
                        <option value="SPOKEN ENGLISH INT">
                        <option value="SPOKEN ENGLISH POST. INT">
                        <option value="BUSINESS COMM.">
                        <option value="OTHERS">
                    </datalist>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-6">
                    <h6>CHEQUE NO</h6>
                    <input type="text" name="cheque_no" value="<?php echo $data['CHEQUE_NO']; ?>" class="form-control"
                        value="-">
                </div>
                <div class="col-lg-6">
                    <h6>PAYMENT MODE</h6>
                    <select name="payment_mode" class="form-control" required>
                        <option value="">Select Payment Mode</option>
                        <?php
                        if($data['PAYMENT_MODE']=='Cash')
                        {
                            echo '<option value="Cash" selected>Cash</option>
                                  <option value="Cheque" >Cheque</option>
                                  <option value="Online" >Online</option>';
                        }
                        else if($data['PAYMENT_MODE']=='Cheque')
                        {
                            echo '<option value="Cheque" selected>Cheque</option>
                                  <option value="Cash" >Cash</option>
                                  <option value="Online" >Online</option>';
                        } else if($data['PAYMENT_MODE']=='Online')
                        {
                           echo '<option value="Online" selected>Online</option>
                                  <option value="Cash" >Cash</option>
                                  <option value="Cheque" >Cheque</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-6">
                    <h6>TIMINGS</h6>
                    <?php
                    if($data['TIMINGS']!='' && $data['TIMINGS']!=null)
                    {
                        ?>
                    <input list="timings" value="<?php echo $data['TIMINGS']; ?>" name="timings" placeholder="Select"
                        class="form-control" />
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
                    <?php
                    }
                    else
                    {
                        ?>
                    <input list="timings" value="<?php echo $data['TIMINGS']; ?>" name="timings" placeholder="Select"
                        class="form-control" />
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
                    <?php
                    }
                    ?>
                </div>


                <div class="col-lg-6">
                    <h6>AMOUNT</h6>
                    <input type="number" name="amount" value="<?php echo $data['amount']; ?>" class="form-control" onkeypress="return onlyNumbers(this.value);" onkeyup="NumToWord(this.value,'amount_in_words');"
                maxlength="9"  required>
                </div>
                <div class="col-lg-6">
                    <h6>RECEIVED BY</h6>
                    <input type="text" name="inputter" value="<?php echo $data['INPUTTER']; ?>" class="form-control"
                        readOnly>
                </div>
                <div class="col-lg-6">
                    <h6>AMOUNT IN WORDS</h6>
                    <input type="text" id="amount_in_words" name="amount_in_words" value="<?php echo $data['AMOUNT_IN_WORDS']; ?>"
                        class="form-control">
                </div>

                <div class="col-lg-6">
                    <h6>MONTH OF FEE</h6>
                    <?php
                            if($data['Month_Of_Payment']!="" && $data['Month_Of_Payment']!=null)
                            {
                                ?>
                    <input type="date" name="Month_Of_Payment" value="<?php echo $data['Month_Of_Payment']; ?>"
                        class="form-control" required>
                    <?php
                            }
                            else
                            {
                                ?>
                    <input type="date" name="Month_Of_Payment" value="<?php echo $data['Month_Of_Payment']; ?>" required
                        class="form-control">
                    <?php
                            }
                            ?>
                </div>

                <div class="col-lg-6">
                    <h6>FEE TYPE</h6>
                    <?php
                            if($data['FEE_TYPE']!="" && $data['FEE_TYPE']!=null)
                            {
                                ?>
                    <select name="fee_type" class="form-control" required>
                        <option value="">Select Fee Type</option>
                        <option value="1" <?php if($data['FEE_TYPE']==1) { ?> selected <?php } ?>>Tuition Fee</option>
                        <option value="2" <?php if($data['FEE_TYPE']==2) { ?> selected <?php } ?>>Prospectus Fee
                        </option>
                        <option value="3" <?php if($data['FEE_TYPE']==3) { ?> selected <?php } ?>>Books Fee
                        </option>
                        <option value="4" <?php if($data['FEE_TYPE']==4) { ?> selected <?php } ?>>Fine</option>
                        <option value="5" <?php if($data['FEE_TYPE']==5) { ?> selected <?php } ?>>Registration</option>
                        <option value="6" <?php if($data['FEE_TYPE']==6) { ?> selected <?php } ?>>Other Income</option>
                    </select>
                    <?php
                            }
                            else
                            {
                                ?>
                    <input type="date" name="Month_Of_Payment"
                        value="<?php echo date('y-m-d',strtotime($data['Month_Of_Payment'])); ?>" required
                        class="form-control">
                    <?php
                            }
                            ?>
                </div>
                <div class="col-lg-6">
                    <h6>ADMIN REMARKS</h6>
                    <input type="text"  name="adminremarks" placeholder="Reason For Editing Payment?" class="form-control" required>
                </div>

                <div class="col-lg-6">
                    <br>
                    <input type="submit" onclick="ConfirmUpdate()" value="Update" name="BtnUpdate"
                        class="btn btn-info">
                        <?php
                            echo "<a href='index.php?page=payments' type='button' class='btn btn-danger' >Cancel</a>";
                             ?>
                </div>
            </div>
        </div>

        </form>
    </div>
    </div>
    </div>
    </div>

    <?php
    if(isset($_POST['BtnUpdate']))
    {
        $hiddenID = $_POST['hiddenID']; //hidden
        $hiddenef = $_POST['hiddenef']; //hidden
        $date_created = $_POST['date_created']; //hidden
        $receipt_no = $_POST['receipt_no'];
        $name = $_POST['name'];
        $remarks = $_POST['remarks'];
        $date = $_POST['date'];
        $fee_head = $_POST['fee_head'];
        $cheque_no = $_POST['cheque_no'];
        $payment_mode = $_POST['payment_mode'];
        $timings = $_POST['timings'];
        $amount = $_POST['amount'];
        $inputter = $_POST['inputter'];
        $amount_in_words = $_POST['amount_in_words'];
        $month_of_payment = $_POST['Month_Of_Payment'];
        $m = date('y-m-d',strtotime($month_of_payment));
        $fee_type = $_POST['fee_type'];

        $adminremarks = $_POST['adminremarks'];

        $qry = "update payments set amount='$amount',remarks='$remarks',FULL_NAME='$name',FEE_HEAD='$fee_head',PAYMENT_MODE='$payment_mode',AMOUNT_IN_WORDS='$amount_in_words',Month_Of_Payment='$m',CHEQUE_NO='$cheque_no',TIMINGS='$timings',INPUTTER='$inputter',FEE_TYPE='$fee_type',ADMIN_REMARKS='$adminremarks',date_created='$date_created' where id='$hiddenID'";

        $exec = mysqli_query($conn,$qry);
        if($exec==true)
        {
            $edited_query = "select * from payments where id='$id'";
            $edited_result = mysqli_query($conn,$edited_query);
            $edited_data = mysqli_fetch_assoc($edited_result);
            $student_name = $edited_data['FULL_NAME'];
            $payment_id = $edited_data['id'];

            // Before Edit
            $hiddenef = $data['ef_no'];
            $old_receipt_no = $data['Receipt_no'];
            $old_name =  $data['FULL_NAME'];
            $old_remarks = $data['remarks'];
            $old_fee_head = $data['FEE_HEAD'];
            $old_payment_mode = $data['PAYMENT_MODE'];
            $old_cheque_no = $data['CHEQUE_NO'];
            $old_timings = $data['TIMINGS'];
            $old_amount = $data['amount'];
            $inputter =  $data['INPUTTER'];
            $old_amount_in_words = $data['AMOUNT_IN_WORDS'];
            $old_month_of_payment = date('d-M-Y',strtotime($data['Month_Of_Payment']));
            $old_fee_type = $data['FEE_TYPE'];
            // After Edit
            $new_query = "select * from payments where id='$id'";
            $new_result = mysqli_query($conn,$new_query);
            $new_data = mysqli_fetch_assoc($new_result);
            //New Record
            $new_ef_id = $new_data['ef_no'];
            $new_receipt_no = $new_data['Receipt_no'];
            $new_name = $new_data['FULL_NAME'];
            $new_remarks = $new_data['remarks'];
            $new_fee_head = $new_data['FEE_HEAD'];
            $new_payment_mode = $new_data['PAYMENT_MODE'];
            $new_cheque_no = $new_data['CHEQUE_NO'];
            $new_timings = $new_data['TIMINGS'];
            $new_amount = $new_data['amount'];
            $new_amount_in_words = $new_data['AMOUNT_IN_WORDS'];
            $new_month_of_payment = date('d-M-Y',strtotime($new_data['Month_Of_Payment']));
            $new_fee_type = $new_data['FEE_TYPE'];
            $adminremarks = $_POST['adminremarks'];

            if($hiddenef!=$new_ef_id){
                $dif1 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif1pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_receipt_no!=$new_receipt_no){
                $dif2 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif2pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_name!=$new_name){
                $dif3 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif3pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_remarks!=$new_remarks){
                $dif4 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif4pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_fee_head!=$new_fee_head){
                $dif5 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif5pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_payment_mode!=$new_payment_mode){
                $dif6 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif6pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_cheque_no!=$new_cheque_no){
                $dif7 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif7pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_timings!=$new_timings){
                $dif8 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif8pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_amount!=$new_amount){
                $dif9 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif9pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
      
            if($inputter!=$inputter){
                $dif10 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif10pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_amount_in_words!=$new_amount_in_words){
                $dif11 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif11pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_fee_type!=$new_fee_type){
                $dif12 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif12pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
               
            }if($old_month_of_payment!=$new_month_of_payment){
                $dif13 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif12pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
               
            }
            
            
            if($old_fee_type == 1)
            {
                $old_fee_type = "Tution Fee";
            }else if($old_fee_type == 2){
                $old_fee_type = "Prospectus Fee";
            }else if($old_fee_type == 3){
                $old_fee_type = "Books Fee";
            }else if($old_fee_type == 4){
                $old_fee_type = "Fine";
            }else if($old_fee_type == 5){
                $old_fee_type = "Registration";
            }else if($old_fee_type == 6){
                $old_fee_type = "Other Income";
            }
            
            
            if($new_fee_type == 1)
            {
                 $new_fee_type = "Tution Fee";
            }else if($new_fee_type == 2){
                $new_fee_type = "Prospectus Fee";
            }else if($new_fee_type == 3){
                $new_fee_type = "Books Fee";
            }else if($new_fee_type == 4){
                $new_fee_type = "Fine";
            }else if($new_fee_type == 5){
                $new_fee_type = "Registration";
            }else if($new_fee_type == 6){
                $new_fee_type = "Other Income";
            }
            
            
            $LEGGED_ON_PERSON = $_SESSION['name'];
            $BEFORE_EDIT = "
<ul>
<li ".$dif2.">Receipt No: ".$old_receipt_no."</li>
<li ".$dif1.">Student ID: ".$hiddenef."</li>
<li ".$dif3.">Student Name: ".$old_name."</li>
<li ".$dif9.">Amount: ".$old_amount."</li>
<li ".$dif11.">Amount In Words: ".$old_amount_in_words."</li>
<li ".$dif4.">Remarks: ".$old_remarks."</li>
<li ".$dif5.">Fee Head: ".$old_fee_head."</li>
<li ".$dif8.">Timing: ".$old_timings."</li>
<li ".$dif7.">Cheque No: ".$old_cheque_no."</li>
<li ".$dif6.">Payment Mode: ".$old_payment_mode."</li>
<li ".$dif10.">Recieved By: ".$inputter."</li>
<li ".$dif13.">Month Of Payment: ".$old_month_of_payment."</li>
<li ".$dif12.">Fee Type: ".$old_fee_type."</li>
</ul>";
            
     
        $AFTER_EDIT = "
            <ul>
            <li ".$dif2pt2.">Receipt No: ".$new_receipt_no."</li>
            <li ".$dif1pt2.">Student ID: ".$new_ef_id."</li>
            <li ".$dif3pt2.">Student Name: ".$new_name."</li>
            <li ".$dif9pt2.">Amount: ".$new_amount."</li>
            <li ".$dif11pt2.">Amount In Words: ".$new_amount_in_words."</li>
            <li ".$dif4pt2.">Remarks: ".$new_remarks."</li>
            <li ".$dif5pt2.">Fee Head: ".$new_fee_head."</li>
            <li ".$dif8pt2.">Timing: ".$new_timings."</li>
            <li ".$dif7pt2.">Cheque No: ".$new_cheque_no."</li>
            <li ".$dif6pt2.">Payment Mode: ".$new_payment_mode."</li>
            <li ".$dif10pt2.">Recieved By: ".$inputter."</li>
            <li ".$dif13pt2.">Month Of Payment: ".$new_month_of_payment."</li>
            <li ".$dif12pt2.">Fee Type: ".$new_fee_type."</li>
            </ul>";
            // Inserting into Activity Log table
            $activity_query = "INSERT INTO `activity_log`(`ID`, `DESCRIPTION`, `AFTER_EDIT`, `ACTION_BY`, `REMARKS`) VALUES (null,'$BEFORE_EDIT','$AFTER_EDIT','$LEGGED_ON_PERSON Edited Payment Details.','$adminremarks')";
            
            $activity_exec = mysqli_query($conn,$activity_query);
            echo "
                    <script>
                    swal.fire({
                    title: 'UPDATED!',
                    text: 'Data has been updated successfully.',
                    icon: 'success',
                    confirmButtonColor: 'blue',
                    timer:2000,
                    backdrop: 'gray'
                    }).then(function() {
                    window.location.href='index.php?page=payments';
                    });
                    </script>";
        }
        else
        {
            echo "
                    <script>
                    swal.fire({
                    title: 'Error Occured',
                    text: 'Data updation failed..',
                    icon: 'error',
                    confirmButtonColor: 'blue',
                    timer:2000,
                    backdrop: 'gray'
                    }).then(function() {
                    window.location.href='index.php?page=payments';
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

    <script type="text/javascript">
function onlyNumbers(evt) {
    var e = event || evt; // For trans-browser compatibility
    var charCode = e.which || e.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function NumToWord(inputNumber, outputControl) {
    var str = new String(inputNumber)
    var splt = str.split("");
    var rev = splt.reverse();
    var once = ['Zero', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine '];
    var twos = ['Ten', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ',
        'Eighteen ', 'Nineteen '
    ];
    var tens = ['', 'Ten', 'Twenty ', 'Thirty ', 'Forty ', 'Fifty ', 'Sixty ', 'Seventy ', 'Eighty ', 'Ninety '];

    numLength = rev.length;
    var word = new Array();
    var j = 0;

    for (i = 0; i < numLength; i++) {
        switch (i) {

            case 0:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                } else {
                    word[j] = '' + once[rev[i]];
                }
                word[j] = word[j];
                break;

            case 1:
                aboveTens();
                break;

            case 2:
                if (rev[i] == 0) {
                    word[j] = '';
                } else if ((rev[i - 1] == 0) || (rev[i - 2] == 0)) {
                    word[j] = once[rev[i]] + "Hundred ";
                } else {
                    word[j] = once[rev[i]] + "Hundred and ";
                }
                break;

            case 3:
                if (rev[i] == 0 || rev[i + 1] == 1) {
                    word[j] = '';
                } else {
                    word[j] = once[rev[i]];
                }
                if ((rev[i + 1] != 0) || (rev[i] > 0)) {
                    word[j] = word[j] + "Thousand ";
                }
                break;


            case 4:
                aboveTens();
                break;

            case 5:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                } else {
                    word[j] = once[rev[i]];
                }
                if (rev[i + 1] !== '0' || rev[i] > '0') {
                    word[j] = word[j] + "Lakh ";
                }

                break;

            case 6:
                aboveTens();
                break;

            case 7:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                } else {
                    word[j] = once[rev[i]];
                }
                if (rev[i + 1] !== '0' || rev[i] > '0') {
                    word[j] = word[j] + "Crore ";
                }
                break;

            case 8:
                aboveTens();
                break;

                //            This is optional. 

                //            case 9:
                //                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                //                    word[j] = '';
                //                }
                //                else {
                //                    word[j] = once[rev[i]];
                //                }
                //                if (rev[i + 1] !== '0' || rev[i] > '0') {
                //                    word[j] = word[j] + " Arab";
                //                }
                //                break;

                //            case 10:
                //                aboveTens();
                //                break;

            default:
                break;
        }
        j++;
    }

    function aboveTens() {
        if (rev[i] == 0) {
            word[j] = '';
        } else if (rev[i] == 1) {
            word[j] = twos[rev[i - 1]];
        } else {
            word[j] = tens[rev[i]];
        }
    }

    word.reverse();
    var finalOutput = '';
    for (i = 0; i < numLength; i++) {
        finalOutput = finalOutput + word[i];
    }
    document.getElementById(outputControl).value = finalOutput;
}
</script>