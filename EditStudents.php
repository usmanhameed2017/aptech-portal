<?php
session_start();
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
$query = "select * from student where id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

?>

<body>
    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <img src="assets/uploads/Fee Receipt Logo.png">
                    <div class="form-group">
                        <div class="col-lg-8 float-left">
                            <h1 class="uni-title">UNIVERSITY ROAD CENTER</h1>
                        </div>
                    </div>
                    <h6 class="ofc">Office copy</h6>
                    <div class="form-group">
                        <!-- For Hidden id -->
                        <input type="hidden" name="hiddenID" value="<?php echo $data['id']; ?>">
                        <input type="hidden" name="date_created" value="<?php echo $data['date_created']; ?>">
                        <!-- Student ID -->
                        <div class="col-lg-6">
                            <h6>Student ID</h6>
                            <input type="text" name="ex_id_no" placeholder="Student ID" value="<?php echo $data['ex_id_no']; ?>" class="form-control">
                        </div>

                    
                        <!-- Student Name -->
                        <div class="col-lg-6">
                            <h6>STUDENT NAME</h6>
                            <input type="text" name="name" value="<?php echo $data['name']; ?>"
                                placeholder="Enter Student Name" class="form-control" >
                        </div>
                        
                        <!-- Father Name -->
                        <div class="col-lg-6">
                            <h6>FATHER NAME</h6>
                            <input type="text" name="fname" value="<?php echo $data['father_name']; ?>"
                                placeholder="Enter Father Name" class="form-control" >
                        </div>

                        <!-- Contact -->
                        <div class="col-lg-6">
                            <h6>CONTACT</h6>
                            <input type="tel" name="contact" value="<?php echo $data['contact']; ?>"
                                placeholder="Enter Contact No" class="form-control" >
                        </div>

                        <!-- Guardian Number -->
                        <div class="col-lg-6">
                            <h6>GUARDIAN NUMBER</h6>
                            <input type="text" name="guardianNumber" value="<?php echo $data['Booking_Confirmation_Date']; ?>"
                                placeholder="Enter Guardian Number" class="form-control" >
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6">
                            <h6>EMAIL</h6>
                            <input type="text" name="email" value="<?php echo $data['email']; ?>" placeholder="Enter Email" class="form-control">
                        </div>

                        <!-- Timings -->
                        <div class="col-lg-6">
                            <h6>TIMINGS</h6>
                            <?php
        
                        ?>
                            <input list="timings" value="<?php echo $data['timings']; ?>" name="timings"
                                placeholder="Select" class="form-control" />
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
                    
                    ?>
                        </div>

                        <!-- Course -->
                        <div class="col-lg-6">
                            <h6>COURSE</h6>
                            <?php
                        ?>
                            <input list="course" value="<?php echo $data['course']; ?>" name="course"
                            placeholder="Select" class="form-control" />
                            <datalist id="course">
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
                            <option value="DIGITAL MARKETING">
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
                    ?>
                        </div>

                        <!-- Admission Fee -->
                        <div class="col-lg-6">
                            <h6>ADMISSION FEE</h6>
                            <input type="number" name="admission_fee" value="<?php echo $data['admission_fee']; ?>"
                            placeholder="Enter Admission Fee" class="form-control" >
                        </div>

                        <!-- Monthly Tuition Fee -->
                        <div class="col-lg-6">
                            <h6>MONTHLY TUTION FEE</h6>
                           <input type="number" id="demo" class="form-control" name="monthly_fee"
                onkeypress="return onlyNumbers(this.value);" onkeyup="NumToWord(this.value,'amount-rupees');"
                maxlength="9" placeholder="Enter Monthly Tution Fee" value="<?php echo $data['monthly_fee']; ?>">
                            
                        </div>

                        <!-- Monthly Fee In Words -->
                        <div class="col-lg-6">
                            <h6>MONTHLY FEE IN WORDS</h6>
                            <input type="text" name="amount_in_words" id="amount-rupees" value="<?php echo $data['amount_in_words']; ?>"
                            placeholder="Monthly Fee In Words" class="form-control">
                            
                        </div>

                        <!-- Certification Fee -->
                        <div class="col-lg-6">
                            <h6>CERTIFICATION FEE</h6>
                            <input type="text" name="bookingConfirmationNo" value="<?php echo $data['Original_Booking_Confirmation']; ?>"
                            placeholder="Enter Booking Confirmation No" class="form-control" >
                        </div>

                        <!-- Counselor -->
                        <div class="col-lg-6">
                            <h6>COUNSELOR</h6>
                            <input type="text" name="courseFamilyName" value="<?php echo $data['Course_Family_Name']; ?>"
                            placeholder="" class="form-control">
                        </div>

                        <!-- Date of admission -->
                        <div class="col-lg-6">
                            <h6>DATE OF ADMISSION</h6>
                            <input type="date" name="courseCode" value="<?php echo $data['Course_Code']; ?>"
                            placeholder="Enter Date Of Admission" class="form-control" >
                        </div>

                        <!-- Short Course Total Fee -->
                            <div class="col-lg-6">
                            <h6>TOTAL COURSE FEE</h6>
                            <input type="text" name="shortCourseTotalFee" value="<?php echo $data['Short_Course_Total_Fee']; ?>"
                            placeholder="Enter Total Course Fee" class="form-control" >
                        </div>

                        <!-- Address -->
                        <div class="col-lg-6">
                            <h6>ADDRESS</h6>
                            <textarea name="address" placeholder="Enter Address" id="" class="form-control" cols="30"
                                rows="1" ><?php echo $data['address']; ?></textarea>
                        </div>

                        <!-- Admin Remarks -->
                        <div class="col-lg-6">
                            <h6>ADMIN REMARKS</h6>
                            <input type="text" name="adminremarks" 
                                placeholder="Reason For Editing Student Record?" class="form-control" required>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-6">
                            <h6>ACTIVE STATUS</h6>
                            <select name="student_status" class="form-control">
                                <?php
                                if($data['student_status']== 1)
                                {
                                    echo '<option value="1" selected>Active</option>
                                          <option value="0">Inactive</option>';
                                }
                                else if($data['student_status']== 0)
                                {
                                    echo '<option value="1">Active</option>
                                          <option value="0" selected>Inactive</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Update Button -->
                        <div class="col-lg-6">
                            <br>
                            <input type="submit" onclick="return ConfirmUpdate()" value="Update" name="BtnUpdate" class="btn btn-info">
                           
                        <?php
                            echo "<a href='index.php?page=students' type='button' class='btn btn-danger' >Cancel</a>";
                             ?>
                        </div>
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
        $date_created = $_POST['date_created'];
        $ex_id_no = $_POST['ex_id_no'];
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $timings = $_POST['timings'];
        $course = $_POST['course'];
        $admission_fee = $_POST['admission_fee'];
        $monthly_fee = $_POST['monthly_fee'];
        $amount_in_words = $_POST['amount_in_words'];
        $student_status = $_POST['student_status'];
        $adminremarks = $_POST['adminremarks'];


        // Extra Fields as per new requirements
        $guardianNumber = $_POST['guardianNumber'];
        $bookingConfirmationNo = $_POST['bookingConfirmationNo'];
        $courseFamilyName = $_POST['courseFamilyName'];
        $courseCode = $_POST['courseCode'];
        $shortCourseTotalFee = $_POST['shortCourseTotalFee'];


        $qry = "update student set name='$name',ex_id_no='$ex_id_no',father_name='$fname',contact='$contact',address='$address',email='$email',timings='$timings',course='$course',admission_fee='$admission_fee',monthly_fee='$monthly_fee',amount_in_words='$amount_in_words',student_status='$student_status',ADMIN_REMARKS='$adminremarks',Booking_Confirmation_Date='$guardianNumber',
        Original_Booking_Confirmation='$bookingConfirmationNo',Course_Family_Name='$courseFamilyName',Course_Code='$courseCode',Short_Course_Total_Fee='$shortCourseTotalFee',date_created='$date_created' where id='$hiddenID'";
        $exec = mysqli_query($conn,$qry);
        if($exec==true)
        {
            // Edit student name on payments table as well if the student name is edited on student table
            $edit_query = "UPDATE payments SET FULL_NAME='$name' WHERE student_id_FK='$hiddenID'";
            $edit_exec = mysqli_query($conn,$edit_query);
            
            
            // Before Edit
            $old_ex_id_no = $data['ex_id_no'];
            $old_name = $data['name'];
            $old_fname = $data['father_name'];
            $old_contact = $data['contact'];
            $old_address = $data['address'];
            $old_email = $data['email'];
            $old_timings = $data['timings'];
            $old_course = $data['course'];
            $old_admission_fee = $data['admission_fee'];
            $old_monthly_fee = $data['monthly_fee'];
            $old_amount_in_words = $data['amount_in_words'];
            $old_student_status = $data['student_status'];

            $old_guardianNumber = $data['Booking_Confirmation_Date'];
            $old_bookingConfirmationNo = $data['Original_Booking_Confirmation'];
            $old_courseFamilyName = $data['Course_Family_Name'];
            $old_courseCode = $data['Course_Code'];
            $old_shortCourseTotalFee = $data['Short_Course_Total_Fee'];


            //After Edit
            $new_query = "select * from student where id='$id'";
            $new_result = mysqli_query($conn,$new_query);
            $new_data = mysqli_fetch_assoc($new_result);
            
            //Updated Record
            $new_ex_id_no = $new_data['ex_id_no'];
            $new_name = $new_data['name'];
            $new_fname = $new_data['father_name'];
            $new_contact = $new_data['contact'];
            $new_address = $new_data['address'];
            $new_email = $new_data['email'];
            $new_timings = $new_data['timings'];
            $new_course = $new_data['course'];
            $new_admission_fee = $new_data['admission_fee'];
            $new_monthly_fee = $new_data['monthly_fee'];
            $new_amount_in_words = $new_data['amount_in_words'];
            $new_student_status = $new_data['student_status'];

            $new_guardianNumber = $new_data['Booking_Confirmation_Date'];
            $new_bookingConfirmationNo = $new_data['Original_Booking_Confirmation'];
            $new_courseFamilyName = $new_data['Course_Family_Name'];
            $new_courseCode = $new_data['Course_Code'];
            $new_shortCourseTotalFee = $new_data['Short_Course_Total_Fee'];

            if($new_student_status == 1)
            {
                $new_student_status = "Active";
            }else if($new_student_status == 0){
                $new_student_status = "Inactive";
            }
            if($old_student_status== 0)
            {
                $old_student_status = "Inactive";
            }else if($old_student_status == 1){
                $old_student_status = "Active";
            }
            if($old_ex_id_no!=$new_ex_id_no){
                $dif1 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif1pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_name!=$new_name){
                $dif2 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif2pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_fname!=$new_fname){
                $dif3 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif3pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_contact!=$new_contact){
                $dif4 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif4pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_address!=$new_address){
                $dif5 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif5pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($new_email!=$old_email){
                $dif6 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif6pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($new_timings!=$old_timings){
                $dif7 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif7pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_course!=$new_course){
                $dif8 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif8pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_admission_fee!=$new_admission_fee){
                $dif9 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif9pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_monthly_fee!=$new_monthly_fee){
                $dif10 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif10pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }
            if($old_amount_in_words!=$new_amount_in_words){
                $dif11 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif11pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }

            if($old_guardianNumber!=$new_guardianNumber){
                $dif12 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif12pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }

            if($old_bookingConfirmationNo!=$new_bookingConfirmationNo){
                $dif13 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif13pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }

            if($old_courseFamilyName!=$new_courseFamilyName){
                $dif14 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif14pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }

            if($old_courseCode!=$new_courseCode){
                $dif15 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif15pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }

            if($old_shortCourseTotalFee!=$new_shortCourseTotalFee){
                $dif16 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif16pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
            }

            if($old_student_status!=$new_student_status){
                $dif17 = 'style="color: red; font-size: 13px; font-weight: bold;"';
                $dif17pt2 = 'style="color: green; font-size: 13px; font-weight: bold;"';
                $AC = "Changed the student status.";
            }else{
                $AC = "Updated the student details.";
            }
            $LEGGED_ON_PERSON = $_SESSION['name'];

            
            
            
$BEFORE_EDIT = "<ul>
<li ".$dif1.">Student ID: ".$old_ex_id_no."</li>
<li ".$dif2.">Student Name: ".$old_name."</li>
<li ".$dif3.">Father Name: ".$old_fname."</li>
<li ".$dif4.">Contact: ".$old_contact."</li>
<li ".$dif5.">Address: ".$old_address."</li>
<li ".$dif6.">Email: ".$old_email."</li>
<li ".$dif7.">Timings: ".$old_timings."</li>
<li ".$dif8.">Course: ".$old_course."</li>
<li ".$dif9.">Admission Fee: ".$old_admission_fee."</li>
<li ".$dif10.">Monthly Fee: ".$old_monthly_fee."</li>
<li ".$dif11.">Amount In Words: ".$old_amount_in_words."</li>
<li ".$dif12.">Guardian Number: ".$old_guardianNumber."</li>
<li ".$dif13.">Booking Confirmation No: ".$old_bookingConfirmationNo."</li>
<li ".$dif14.">Counselor: ".$old_courseFamilyName."</li>
<li ".$dif15.">Date Of Admission: ".$old_courseCode."</li>
<li ".$dif16.">Total Course Fee: ".$old_shortCourseTotalFee."</li>
<li ".$dif17.">Student Status: ".$old_student_status."</li>
</ul>";

$AFTER_EDIT = "<ul>
<li ".$dif1pt2.">Student ID: ".$new_ex_id_no."</li>
<li ".$dif2pt2.">Student Name: ".$new_name."</li>
<li ".$dif3pt2.">Father Name: ".$new_fname."</li>
<li ".$dif4pt2.">Contact: ".$new_contact."</li>
<li ".$dif5pt2.">Address: ".$new_address."</li>
<li ".$dif6pt2.">Email: ".$new_email."</li>
<li ".$dif7pt2.">Timings: ".$new_timings."</li>
<li ".$dif8pt2.">Course: ".$new_course."</li>
<li ".$dif9pt2.">Admission Fee: ".$new_admission_fee."</li>
<li ".$dif10pt2.">Monthly Fee: ".$new_monthly_fee."</li>
<li ".$dif11pt2.">Amount In Words: ".$new_amount_in_words."</li>
<li ".$dif12pt2.">Guardian Number: ".$new_guardianNumber."</li>
<li ".$dif13pt2.">Booking Confirmation No: ".$new_bookingConfirmationNo."</li>
<li ".$dif14pt2.">Counselor: ".$new_courseFamilyName."</li>
<li ".$dif15pt2.">Date Of Admission: ".$new_courseCode."</li>
<li ".$dif16pt2.">Total Course Fee: ".$new_shortCourseTotalFee."</li>
<li ".$dif17pt2.">Student Status: ".$new_student_status."</li>
</ul>";
            
            $activity_query = "INSERT INTO `activity_log`(`ID`, `DESCRIPTION`, `AFTER_EDIT`, `ACTION_BY`, `REMARKS`) VALUES (null,'$BEFORE_EDIT','$AFTER_EDIT','$LEGGED_ON_PERSON $AC','$adminremarks')";
            
            $activity_exec = mysqli_query($conn,$activity_query);
       

            echo "
                    <script>
                    swal.fire({
                    title: 'Student Details Successfully Updated!',
                    icon: 'success',
                    textColor: 'red',
                    confirmButtonColor: 'blue',
                    timer:2000,
                    backdrop: 'gray'
                    }).then(function() {
                    window.location.href='index.php?page=students';
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
                    window.location.href='index.php?page=students';
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