<?php
include('db_connect.php');
session_start();
if(isset($_POST['rd']) && isset($_POST['rd'])!=='')
{
    $table = "<table class='table table-bordered table-striped text-center' id='entry'>
    <thead>
        <tr>
            <th class='text-center'>S.NO.</th>
            <th class='text-center'>DATE</th>
            <th class='text-center'>RECEIPT NO</th>
            <th class='text-center'>NAME</th>
            <th class='text-center'>COURSE</th>
            <th class='text-center'>REGISTRATION-EXAM-CERTIFICATION</th> 
            <th class='text-center'>TUITION FEE</th>
            <th class='text-center'>PROSPECTUS</th>
            <th class='text-center'>BOOKS</th>
            <th class='text-center'>FINE</th>
            <th class='text-center'>OTHER INCOME</th>
            <th class='text-center'>PAYMENT MODE</th>
            <th class='text-center'>COUNSELOR</th>
            <th class='text-center'>REMARKS</th>
        </tr>
    </thead>
        <tbody> </tbody>
    <tfoot>
    
        <tr>
            <th colspan='5' class='text-right'>Total</th>
            <th colspan='6' class='text-center' id='totalFee'> </th>
            <th colspan='3' class='text-center'> </th>
        </tr>
       
    </tfoot>
    
</table>";
echo $table;
}
?>
<script>
    $("#entry").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "server_processingPayments_report.php",
            type: "POST"
        },
        columns:[
            {data: "id"},
            {data: "date_created"},
            {data: "Receipt_no"},
            {data: "FULL_NAME"},
            {data: "FEE_HEAD"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
            // {data: "id"},
        ],
        pageLength: 10
    });
</script>