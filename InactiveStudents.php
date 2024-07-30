<?php 
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
if($_SESSION['login_type'] == 2)
{
   header("Location:login.php"); 
} 
?>

<style>
input[type=checkbox] {
    /* Double-sized Checkboxes */
    -ms-transform: scale(1.3);
    /* IE */
    -moz-transform: scale(1.3);
    /* FF */
    -webkit-transform: scale(1.3);
    /* Safari and Chrome */
    -o-transform: scale(1.3);
    /* Opera */
    transform: scale(1.3);
    padding: 10px;
    cursor: pointer;
}

.uni-title {
    font-weight: bold;
    font-size: 20px;
    margin-left: 150px;
    margin-top: 50px;
}

.col-md-10 {
    margin-top: 64px;
}

a.btn.btn-success.col-md-1.col-sm-6.float-right {
    min-width: 110px;
    position: relative;
    left: -8px;
}

[data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.5s;
    visibility: visible;
}

[data-title]:after {
    content: attr(data-title);
    position: absolute;
    bottom: -1.8em;
    left: 30%;
    padding: 4px 4px 4px 4px;
    color: #222;
    white-space: nowrap;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0px 0px 4px #222;
    -webkit-box-shadow: 0px 0px 4px #222;
    box-shadow: 0px 0px 4px #222;
    background-image: -moz-linear-gradient(top, #f8f8f8, #cccccc);
    background-image: -webkit-linear-gradient(top, #f8f8f8, #cccccc);
    background-image: -moz-linear-gradient(top, #f8f8f8, #cccccc);
    background-image: -ms-linear-gradient(top, #f8f8f8, #cccccc);
    background-image: -o-linear-gradient(top, #f8f8f8, #cccccc);
    opacity: 0;
    z-index: 99999;
    visibility: hidden;
}
.col-md-10 {
    margin-top: 131px;
    margin-left: 278px;
}
[data-title] {
    position: relative;
}.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}
</style>


<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12 mt-3">
        <div class="card"> 
            <div class="card-header">
                        <a href="exportInactiveStudent.php" data-title="Export as excel"
                            class="btn btn-success col-md-1 col-sm-6 float-right">
                            <i class="fa fa-export"></i>Export</a>

                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover table-striped">
                            <thead>

                                <tr>
                                    <th class="text-center">S.NO.</th>
                                    <th class="text-center">Student ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Father Name</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Timings</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Admission Fee</th>
                                    <th class="text-center">Monthly Fee</th>
                                    <th class="text-center">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i = 1;
								$student = $conn->query("SELECT * FROM student where student_status=0 order by id desc");
								while($row=$student->fetch_assoc()):
								?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center">
                                        <?php echo $row['id_no'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo ucwords($row['name']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['father_name'] ?>
                                    </td>

                                    <!-- <td class="text-center">
									     <?php echo $row['email'] ?>
									</td> -->

                                    <td class="text-center">
                                        <?php echo $row['contact'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $row['address'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $row['timings'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $row['course'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $row['admission_fee'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $row['monthly_fee'] ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo "<a href='EditStudents.php?id=$row[id]' data-title='Edit Student' class='btn btn-primary'><i class='fa fa-edit'></i></a>"; ?>
                                        &nbsp;
                                   <?php 
                                   //echo "<a href='DeleteStudents.php?id_no=$row[id_no]' onclick='return ConfirmDelete()' class='btn btn-danger'><i class='fa fa-trash'></i></a>"; 
                                   ?> 
                                    </td>
                                    <?php endwhile; ?>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <!-- Table Panel -->
            </div>
        </div>

    </div>
    <style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        /* max-width:100px; */
        max-height: 150px;
    }
    </style>

    <script>
    $(document).ready(function() {
        $('table').dataTable()
    })
    $('#new_student').click(function() {
        uni_modal("New Student ", "manage_student.php", "mid-large")

    })
    $('.edit_student').click(function() {
        uni_modal("Manage Student  Details", "manage_student.php?id=" + $(this).attr('data-id'), "mid-large")

    })
    $('.delete_student').click(function() {
        _conf("Are you sure to delete this Student ?", "delete_student", [$(this).attr('data-id')])
    })

    function delete_student($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_student',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
    </script>

    <!-- Confirming For Deleting a Student -->
    <script>
    function ConfirmDelete() {
        return confirm("Are you sure you want to te delete this record permanently?");
    }
    </script>