<?php
include("db_connect.php");
session_start();
date_default_timezone_set('Asia/Karachi');

        $table = "<table class='table table-condensed table-striped table-bordered table-hover text-center' id='paymentsTable' style='width:100%'>
        <thead>
            <tr>
                <th class='text-center'>HIDDEN ID</th>
                <th class='text-center'>S.NO.</th>
                <th class='text-center'>RECEIPT NO</th>
                <th class='text-center'>RECEIVING DATE</th>
                <th class='text-center'>MONTH OF FEE</th>
                <th class='text-center'>FULL NAME</th>
                <th class='text-center'>FEE TYPE</th>
                <th class='text-center'>RECEIVED BY</th>
                <th class='text-center'>OPERATIONS</th>
            </tr>
        </thead>
    </table>";
echo $table;
?>
    
<script>
$(document).ready(function() {
    $('#paymentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "server_processingPayments.php",
            "type": "POST",
        },
        "columns": [
            { data: 'id', className:'d-none' },
            { data: 'sr_no' },
            { data: 'Receipt_no' },
            { data: 'date_created' },
            { data: 'Month_Of_Payment' },
            { data: 'FULL_NAME' },
            { 
                data: 'FEE_TYPE',
    render: function (data, type, full, meta) {
        switch (data) {
            case 1:
                return 'Monthly Fee';
            case 2:
                return 'Prospectus Fee';
            case 3:
                return 'Books Fee';
            case 4:
                return 'Fine';
            case 5:
                return 'Registration Fee';
            case 6:
                return 'Other Income Fee';
            default:
            return 'Unknown';

                    }
                },
            },
            {data: 'INPUTTER'},
            { 
                "render": function (data, type, full, meta) {
                    var buttons = '';
                    buttons += '<center><div class="td-button"><a href="ViewAndPrint.php?Receipt_no=' + full.Receipt_no + '" data-title="Print Receipt" class="btn btn-success p"><i class="fa fa-print"></i></a>&nbsp;';
                    
                    <?php if($_SESSION['login_type'] == 1): ?>
                    buttons += '<a type="button" href="EditPayment.php?id=' + full.id + '" data-title="Edit Fee" class="btn btn-primary r"><i class="fa fa-edit"></i></a>&nbsp;';
                    buttons += '<a class="btn btn-danger d text-white" data-title="Delete Fee" onclick="deletePayment('+full.id+')" ><i class="fa fa-trash"></i></a></div> </center>';
                    <?php endif; ?>
                    
                    return buttons;
                }
            }
        ],
        "pageLength": 10,
        "searching": true,
    });
});
</script>
