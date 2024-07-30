<?php
include("db_connect.php");
session_start();
if(isset($_POST['rd']) && isset($_POST['rd'])!=="")
{
$table = "<table class='table table-condensed table-bordered table-hover table-striped text-center' id='usersTable' style='width:100%'>
<thead>
    <tr> 
        <th class='text-center'>HIDDEN ID</th>
        <th class='text-center'>S.NO.</th>
        <th class='text-center'>Name</th>
        <th class='text-center'>Username</th>
        <th class='text-center'>Email</th>
        <th class='text-center'>Roles</th>
        <th class='text-center'>Status</th>
        <th class='text-center'>Operations</th>
    </tr>
</thead>
</table>";
echo $table;
}
?>
<script>
    $(document).ready(function () {
        $("#usersTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
            "url": "server_processingUsers.php", 
            "type": "POST",
        },
        "columns": [
            { data: 'id', className:'d-none'},
            { data: 'sr_no'},
            { data: 'name' },
            { data: 'username'},
            { data: 'email' },
            { data: 'type'},
            { data: 'status' },
            { 
                "render": function (data, type, full, meta) {
                    var buttons = '';
                    <?php if($_SESSION['login_type'] == 1): ?>
                    buttons += '<a type="button" href="EditUsers.php?id=' + full.id + '" data-title="Edit User" class="btn btn-info r"><i class="fa fa-edit"></i></a>&nbsp;';
                    buttons += '<a class="btn btn-danger text-white" data-title="Delete User" onclick="deleteUser('+full.id+')"><i class="fa fa-trash"></i></a>&nbsp;';
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