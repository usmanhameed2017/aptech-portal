<?php 
include("db_connect.php");
session_start();
if(isset($_POST['rd']) && isset($_POST['rd'])!=='')
{
    if($_SESSION['login_type'] == 1)
    {            
        $table = 
            "<table class='table table-condensed table-bordered table-hover table-striped' id='studentsTable'>
                <thead>
                    <tr>
                        <th scope='col' class='text-center'>S.NO.</th>
                        <th scope='col' class='text-center'>Student ID</th>
                        <th scope='col' class='text-center'>Name</th>
                        <th scope='col' class='text-center'>Father Name</th>
                        <th scope='col' class='text-center'>Email</th>
                        <th scope='col' class='text-center'>Contact</th>
                        <th scope='col' class='text-center'>Guardian Number</th>
                        <th scope='col' class='text-center'>Address</th>
                        <th scope='col' class='text-center'>Timings</th>
                        <th scope='col' class='text-center'>Course</th>
                        <th scope='col' class='text-center'>Admission Fee</th>
                        <th scope='col' class='text-center'>Monthly Fee</th>
                        <th scope='col' class='text-center'>Certification Fee</th>
                        <th scope='col' class='text-center'>Counselor</th>
                        <th scope='col' class='text-center'>Date Of Admission</th>
                        <th scope='col' class='text-center'>Total Course Fee</th>
                        <th class='text-center'>Actions</th>
                    </tr>
                </thead>
            </table>";     
        echo $table;        
    } 
}
?>
<script>
    $(document).ready(function () {
        $("#studentsTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
            "url": "server_processingStudents.php", 
            "type": "POST",
        },
        "columns": [
            { data: 'id'},
            { data: 'ex_id_no' },
            { data: 'name' },
            { data: 'father_name' },
            { data: 'email' },
            { data: 'contact' },
            { data: 'Booking_Confirmation_Date' }, // this is guardian number
            { data: 'address' },
            { data: 'timings' },
            { data: 'course' },
            { data: 'admission_fee' },
            { data: 'monthly_fee' },
            { data: 'amount_in_words' },
            { data: 'Original_Booking_Confirmation' }, // this is certification fee
            { data: 'Course_Family_Name' }, // this is counselor name
            { data: 'Course_Code' }, // this is date of admission
            { data: 'Short_Course_Total_Fee' },
            { 
                "render": function (data, type, full, meta) {
                    var buttons = '';
                    <?php if($_SESSION['login_type'] == 1): ?>
                    // buttons += '<div class="td-button"><a class="btn btn-secondary text-white" data-title="Print Invoice" href="studentInvoice.php?id_no='+full.id+'&name='+full.name+'&fname='+full.father_name+'&contact='+full.contact+'&address='+full.address+'&course='+full.course+'&admission_fee='+full.admission_fee+'&monthly_fee='+full.monthly_fee+'&amount_in_words='+full.amount_in_words+'&certification_fee='+full.Original_Booking_Confirmation+'&counselor='+full.Course_Family_Name+'&date_of_admission='+full.Course_Code+'&total_course_fee='+full.Short_Course_Total_Fee+'"><i class="fa fa-print"></i></a>';
                    buttons += '<a type="button" href="EditStudents.php?id=' + full.id + '" data-title="Edit Student" class="btn btn-primary r"><i class="fa fa-edit"></i></a>';
                    buttons += '<a class="btn btn-danger text-white" data-title="Delete Student" onclick="deleteStudent('+full.id+')"><i class="fa fa-trash"></i></a></div>';
                    <?php endif; ?>
                    return buttons;
                }
            },
        ],
        "pageLength": 10,
        "searching": true,
    });
});
</script>