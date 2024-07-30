<?php 
session_start();
include('db_connect.php');
include('header.php');
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
 ?>
<?php
if(isset($_GET['id'])){
	$qry2 = $conn->query("SELECT * FROM payments where id = {$_GET['id']} ");
	foreach($qry2->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
    <!-- For Receipt No -->
    <?php
$query = "select MAX(Receipt_no) from payments";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$receipt_no = $row['MAX(Receipt_no)']+1;
//    <!-- For Payment ID --> 
$query2 = "select MAX(id) from payments";
$result2 = mysqli_query($conn,$query2);
$row2 = mysqli_fetch_assoc($result2);
$hidden_id = $row2['MAX(id)'];
?>
<!doctype html>
<html lang="en">
<head>
    <style>
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
    }

    button#submit {
        display: none;
    }

    button.hello.btn.btn-danger {
        display: none;
    }

    h6 {
        position: relative;
        top: 10px;
        font-weight: 600;
    }

    .form-control {
        font-weight: 500;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: white;
        opacity: 1;
    }.modal-footer{
        display:none;
    }
    </style>

<?php
$query3 = "select * from student";
$result3 = mysqli_query($conn,$query3);
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Payment Form -->
                <form method='post'>
                    <img src="assets/uploads/Fee Receipt Logo.png">
                    <div class="form-group">
                        <div class="col-lg-8 float-left">

                        </div>
                    </div>
                    <h6 class="ofc">Office copy</h6>
                    <div class="form-group">
                        <!-- Student ID (Primary Key Of Student Table) -->
                        <input type="hidden" id="id">
                        
                        
                        
                        
                        <div class="col-lg-6">
                            <h6>STUDENT ID</h6>
                            <input list="idss" id="ef_no" name="ef_no" value="" placeholder="Enter Student ID" class="form-control std">
                            <datalist id="idss">
                            <?php
                                while($data3=mysqli_fetch_assoc($result3))
                                {
                                    echo "<option value='$data3[ex_id_no]'></option>";
                                }
                            ?>
                            </datalist>
                        </div>
                        <!-- RECEIVING DATE -->
                        <input type="hidden" name="date" id="date" value="<?php
                        date_default_timezone_set("Asia/Karachi");
                        echo date("Y-m-d h:i:s"); ?>" class="form-control" readonly>

                        <div class="col-lg-6">
                            <h6>FEE TYPE</h6>
                            <select name="FEE_TYPE" id="FEE_TYPE" class="form-control" required>
                                <option value="">Select Fee Type</option>
                                <option value="1">Tuition Fee</option>
                                <option value="2">Prospectus</option>
                                <option value="3">Books</option>
                                <option value="4">Fine</option>
                                <option value="5">Registration</option>
                                <option value="6">Other Income</option>
                            </select>
                        </div>
                        
                         <div class="col-lg-6">
                            <h6>NAME</h6>
                            <input list="names" id="name" onkeyup="GetDetails(this.value)"
                                placeholder="Enter Student Name" name="name" class="form-control" required>
                            <datalist id="names">
                            <?php
                    $query8 = "select * from student";
                    $result8 = mysqli_query($conn,$query8);
                while($data8=mysqli_fetch_assoc($result8))
                {
                    echo "<option value='$data8[name]'></option>";
                }
                ?>
                            </datalist>
                        </div>


                        <div class="col-lg-6">
                            <h6>MONTH OF FEE</h6>
                            <input type="month" name="month_of_payment" id="month_of_payment" class="form-control" required>
                        </div>
                       
                         <div class="col-lg-6">
                            <h6>COURSE</h6>
                            <input type="text" id="fee_head" placeholder="Select Course" name="fee_head"
                                class="form-control" readonly>
                            <!-- <datalist id="fee_head" >
                                    
                            </datalist> -->
                        </div>

                        <script>
                    $(".form-control.readonly").on('keydown paste focus mousedown', function(e){
                        if(e.keyCode != 9)
                            e.preventDefault();
                    });
                        </script>
                        

                        <div class="col-lg-6">
                            <h6>CHEQUE NO</h6>
                            <input type="text" name="cheque_no" id="cheque_no" class="form-control" placeholder="Enter Check No">
                        </div>
                        
                        <div class="col-lg-6">
                            <h6>PAYMENT MODE</h6>
                            <select name="payment_mode" id="payment_mode" class="form-control" required>
                                <option value="">Select Payment Mode</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
    
                        <div class="col-lg-6">
                            <h6>TIMINGS</h6>
                            <input list="timingList" id="timings" placeholder="Select Timings" name="timings" class="form-control" required>
                            <datalist id="timingList">
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
                        </div>
                        <div class="col-lg-6">
                            <h6>AMOUNT</h6>
                            <!-- onkeypress="return onlyNumbers(this.value);" onkeyup="NumToWord(this.value,'amount_in_words');"maxlength="9" -->
                            <input type="number" placeholder="Enter Amount" name="amount" id="amount" class="form-control" 
                            onkeypress="return onlyNumbers(this.value);" onkeyup="NumToWord(this.value,'amount_in_words');"
                            maxlength="9"  required>
                        </div>
                        
                        <!-- Hidden field for Receipt No -->
                        <input type="hidden" class="form-control" name="receipt_no" id="receipt_no" 
                        value="<?php echo $receipt_no ?>" readonly>

                         <div class="col-lg-6">
                            <h6>RECEIVED BY</h6>
                            <input type="text" name="inputter" id="inputter" value="<?php echo $_SESSION['name']; ?>" class="form-control" readonly>
                        </div>
                        
                        <div class="col-lg-6">
                            <h6>AMOUNT IN WORDS</h6>
                            <input type="text" id="amount_in_words" placeholder="Enter Amount In Words" name="amount_in_words" class="form-control">
                        </div>
                        
                        <div class="col-lg-6">
                            <h6>REMARKS</h6>
                            <input type="text" name="remarks" id="remarks" placeholder="Enter Remarks" class="form-control" required>
                        </div>

                        <div class="col-lg-6">
                            <br>
                            <input type="button" value="Submit" class="btn btn-primary" id="insertPaymentBtn">
                            <?php
                            echo "<a href='index.php?page=payments' type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</a>";
                             ?>
                        </div>
                </form>
            </div>
        </div>
    </div> 
    </div>

    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript">
            // Insert payment
            $("#insertPaymentBtn").click(function(){
                let id = $("#id").val();
                let ef_no = $("#ef_no").val();
                let receipt_no = $("#receipt_no").val();
                let name = $("#name").val();
                let remarks = $("#remarks").val();
                let date = $("#date").val();
                let fee_head = $("#fee_head").val();
                let cheque_no = $("#cheque_no").val();
                let payment_mode = $("#payment_mode").val();
                let timings = $("#timings").val();
                let amount = $("#amount").val();
                let FEE_TYPE = $("#FEE_TYPE").val();
                let inputter = $("#inputter").val();
                let amount_in_words = $("#amount_in_words").val();
                let month_of_payment = $("#month_of_payment").val();

                if(name==='')
                {
                    toaster('Name is required',5);
                }
                else
                {
                    if(remarks==='')
                    {
                        toaster('Remarks are required!',5);
                    }
                    else
                    {
                        if(payment_mode==='')
                        {
                            toaster('Payment mode is required!',5);
                        }
                        else
                        {
                            if(timings==='')
                            {
                                toaster('Timings are required!',5);
                            }
                            else
                            {
                                if(amount==='')
                                {
                                    toaster('Amount is required!',5);
                                }
                                else
                                {
                                    if(FEE_TYPE==='')
                                    {
                                        toaster("Fee type is required!",5);
                                    }
                                    else
                                    {
                                        if(month_of_payment==='')
                                        {
                                            toaster("Month of payment is required!",5);
                                        }
                                        else
                                        {
                                            $.ajax({
                                                type: "POST",
                                                url: "Ajax/insertPayment.php",
                                                data: {id:id, ef_no:ef_no, receipt_no:receipt_no, name:name, remarks:remarks, date:date, fee_head:fee_head, cheque_no:cheque_no,
                                                payment_mode:payment_mode, timings:timings, amount:amount, FEE_TYPE:FEE_TYPE, inputter:inputter, amount_in_words:amount_in_words,
                                                month_of_payment:month_of_payment},
                                                success: function (data) 
                                                {
                                                    swal.fire({
                                                    title: 'Fee Successfully Submitted!',
                                                    text: 'Tuition fee has been submitted',
                                                    icon: 'success',
                                                    confirmButtonColor: 'blue',
                                                    backdrop: 'gray',
                                                    timer: 2000
                                                    }).then(function() {
                                                    window.location.href = `ViewAndPrint.php?Receipt_no=${data}`;
                                                    });
                                                }
                                            });
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            });
    
    // Search By ID
    $("#ef_no").keyup(function(){
        let ef_no = $("#ef_no").val();
        if(ef_no==="")
        {
            $("#id").val(""); // Primary Key Of Student Table
            $("#name").val("");
            $("#stimings").val("");
            $("#amount").val("");
            $("#amount_in_words").val("");
            $("#sfee_head").val("");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "SearchById.php",
                data: {ef_no:ef_no},
                success: function (data,status) 
                {
                    var user1 = JSON.parse(data);
                    $("#id").val(user1.id); // Primary Key Of Student Table
                    $('#name').val(user1.name);
                    $('#timings').val(user1.timings);
                    $('#amount').val(user1.monthly_fee);
                    $('#amount_in_words').val(user1.amount_in_words);
                    $('#fee_head').val(user1.course);
                }
            });
        }
        
    });
    
        // Search by name
        $('#name').keyup(function(){
            var name = $('#name').val();
            if(name==='')
            {
                $("#id").val(""); // Primary Key Of Student Table
                $('#ef_no').val("");
                $('#stimings').val("");
                $('#amount').val("");
                $('#amount_in_words').val("");
                $('#sfee_head').val("");
            }
            else
            {
                $.ajax({
                    type: "post",
                    url: "SearchByName.php",
                    data: {name:name},
                    success: function (data,status) 
                    {
                        var user = JSON.parse(data);
                        $("#id").val(user.id); // Primary Key Of Student Table
                        $('#ef_no').val(user.ex_id_no);
                        $('#timings').val(user.timings);
                        $('#amount').val(user.monthly_fee);
                        $('#amount_in_words').val(user.amount_in_words);
                        $('#fee_head').val(user.course);
                    }
                });
            }
        });
        
        // Amount In Words
                $(document).ready(function(){

            // Trigger conversion on page load
            convertAmountToWords();

            // Add event listener to update on input change
            $("#amount").on("input", function(){
                convertAmountToWords();
            });

            // Convert Amount To Words
            function convertAmountToWords() 
            {
                var amountValue = $("#amount").val();
                var amountInWords = convertToWords(amountValue);
                if(amountValue=="")
                {  
                    $("#amount_in_words").val(amountInWords);
                }
                else
                {
                    $("#amount_in_words").val(amountInWords+" Only");
                }
            }
            
            // Convert To Words Process
            function convertToWords(amount) 
            {
                if (amount === 0) 
                {
                    return "Zero";
                }

                var words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
                var teens = ["", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
                var tens = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

                var result = "";
                if (amount >= 1000) 
                {
                    result += convertToWords(Math.floor(amount / 1000)) + " Thousand ";
                    amount %= 1000;
                }
                if (amount >= 100) 
                {
                    result += words[Math.floor(amount / 100)] + " Hundred ";
                    amount %= 100;
                }
                if (amount >= 20) 
                {
                    result += tens[Math.floor(amount / 10)] + " ";
                    amount %= 10;
                }
                if (amount > 10 && amount < 20) 
                {
                    result += teens[amount - 10] + " ";
                    amount = 0;
                }
                if (amount > 0) 
                {
                    result += words[amount] + " ";
                }

                return result.trim();
            }
        });
    </script>