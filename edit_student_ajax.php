<?php
    if(isset($_POST['BtnUpdate']))
    {
        $hiddenID = $_POST['hiddenID']; //hidden
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
        Original_Booking_Confirmation='$bookingConfirmationNo',Course_Family_Name='$courseFamilyName',Course_Code='$courseCode',Short_Course_Total_Fee='$shortCourseTotalFee' where id_no='$hiddenID'";
        $exec = mysqli_query($conn,$qry);
        if($exec==true)
        {
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
            $new_query = "select * from student where ex_id_no='$id'";
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

            if($old_ex_id_no!=$new_ex_id_no){
                $dif1 = 'style="color: red;"';
            }
            if($old_name!=$new_name){
                $dif2 = 'style="color: red;"';
            }
            if($old_fname!=$new_fname){
                $dif3 = 'style="color: red;"';
            }
            if($old_contact!=$new_contact){
                $dif4 = 'style="color: red;"';
            }
            if($old_address!=$new_address){
                $dif5 = 'style="color: red;"';
            }
            if($new_email!=$old_email){
                $dif6 = 'style="color: red;"';
            }
            if($new_timings!=$old_timings){
                $dif7 = 'style="color: red;"';
            }
            if($old_course!=$new_course){
                $dif8 = 'style="color: red;"';
            }
            if($old_admission_fee!=$new_admission_fee){
                $dif9 = 'style="color: red;"';
            }
            if($old_monthly_fee!=$new_monthly_fee){
                $dif10 = 'style="color: red;"';
            }
            if($old_amount_in_words!=$new_amount_in_words){
                $dif11 = 'style="color: red;"';
            }

            if($old_guardianNumber!=$new_guardianNumber){
                $dif12 = 'style="color: red;"';
            }

            if($old_bookingConfirmationNo!=$new_bookingConfirmationNo){
                $dif13 = 'style="color: red;"';
            }

            if($old_courseFamilyName!=$new_courseFamilyName){
                $dif14 = 'style="color: red;"';
            }

            if($old_courseCode!=$new_courseCode){
                $dif15 = 'style="color: red;"';
            }

            if($old_shortCourseTotalFee!=$new_shortCourseTotalFee){
                $dif16 = 'style="color: red;"';
            }

            if($old_student_status!=$new_student_status){
                $dif17 = 'style="color: red;"';
            }
            // Inserting into Activity log table
            $activity_query = "insert into activity_log (DESCRIPTION) values ('".$_SESSION['name']." Updated student record.
            <h4> ".$adminremarks." </h4>
            <h6>STUDENT DETAILS BEFORE EDIT</h6>
            <ul>

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
            <li ".$dif14.">Course Family Name: ".$old_courseFamilyName."</li>
            <li ".$dif15.">Course Code: ".$old_courseCode."</li>
            <li ".$dif16.">Short Course Total Fee: ".$old_shortCourseTotalFee."</li>
            <li ".$dif17.">Student Status: ".$old_student_status."</li>
            </ul>

            <h6>STUDENT DETAILS AFTER EDIT</h6>
            <ul>

            <li ".$dif1.">Student ID: ".$new_ex_id_no."</li>
            <li ".$dif2.">Student Name: ".$new_name."</li>
            <li ".$dif3.">Father Name: ".$new_fname."</li>
            <li ".$dif4.">Contact: ".$new_contact."</li>
            <li ".$dif5.">Address: ".$new_address."</li>
            <li ".$dif6.">Email: ".$new_email."</li>
            <li ".$dif7.">Timings: ".$new_timings."</li>
            <li ".$dif8.">Course: ".$new_course."</li>
            <li ".$dif9.">Admission Fee: ".$new_admission_fee."</li>
            <li ".$dif10.">Monthly Fee: ".$new_monthly_fee."</li>
            <li ".$dif11.">Amount In Words: ".$new_amount_in_words."</li>
            <li ".$dif12.">Guardian Number: ".$new_guardianNumber."</li>
            <li ".$dif13.">Booking Confirmation No: ".$new_bookingConfirmationNo."</li>
            <li ".$dif14.">Course Family Name: ".$new_courseFamilyName."</li>
            <li ".$dif15.">Course Code: ".$new_courseCode."</li>
            <li ".$dif16.">Short Course Total Fee: ".$new_shortCourseTotalFee."</li>
            <li ".$dif17.">Student Status: ".$new_student_status."</li>
            </ul>')";
            $activity_exec = mysqli_query($conn,$activity_query);


            echo "
                    <script>
                    swal.fire({
                    title: 'UPDATED!',
                    text: 'Data has been updated successfully.',
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