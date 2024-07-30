<?php
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
?>
<style>
.modal-header {
        border: none !important;
    }
.modal-title{
        font-weight: 900;
    }

[data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.5s;
    visibility: visible;
}

[data-title]:after {
    content: attr(data-title);
    position: absolute;
    bottom: -2.2em;
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

[data-title] {
    position: relative;
} .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}
</style>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12 mt-3">
        <div class="card ">
            <div class="card-header">
                <b>USER DETAILS</b>
                <!-- Add New User Button -->
                <button class="btn btn-primary float-right col-md-2 col-sm-6" data-title="Create new user"
                id="openUserModal" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fa fa-plus"></i> New user </button>
            </div> 

            <div class="card-body">
                <div id="UserTableContent"> <!-- User table will be rendered here --> </div> 
            </div>
        </div>
    </div>
</div>
</div>
<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addUserModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalTitleId">ADD NEW USER</h1>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                <div class="modal-body">
                <!-- Add User Form -->
                <form method="POST" id="addUserForm">

                <!-- For hidden id -->
                <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" required>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter Username" class="form-control" 
                    required autocomplete="off">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" required autocomplete="off">
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter Password" id="password" class="form-control"
                    autocomplete="off" required>
                </div>

                <!-- Roles -->
                <div class="form-group">
                    <label for="">Assign Role</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="">Select Role</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                
                    <?php if(isset($meta['id'])): ?>
                    <small><i>Leave this blank if you dont want to change the password.</i></small>
                    <?php endif; ?>
                </div>

                <!-- Buttons -->
                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="addUserBtn"> Submit </button>
                    <button type="button" class="2 btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Dont remove these below scripts from here it is necessary to link these scripts only here -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<script src="js/num-to-words.js" type="text/javascript"></script>
<script src="./custom.js"></script>
<script>
    function readRecords()
    {
        let rd = "rd";
        $.ajax({
            type: "POST",
            url: "fetchUsersTable.php",
            data: {rd:rd},
            success: function (response) 
            {
                $("#UserTableContent").html(response);
            }
        });
    }

    $(document).ready(function () {
        readRecords();
    });

    $("#addUserBtn").click(function(){
        let name = $("#name").val();
        let username = $("#username").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let type = $("#type").val();
        if(name=="")
        {
            toaster("Name field is required",5);
        }
        else
        {
            if(username=="")
            {
                toaster("Username field is required",5);
            }
            else
            {
                if(password=="")
                {
                    toaster("Password field is required",5);
                }
                else
                {
                    if(type=="")
                    {
                        toaster("You must need to assign a role")
                    }
                    else
                    {
                        $.ajax({
                            type: "POST",
                            url: "Ajax/addUser.php",
                            data: {name:name, username:username, email:email, password:password, type:type},
                            success: function (response) 
                            {
                                readRecords();
                                toaster("A new user has been added successfully!");
                                $("#addUserForm input,select").val("");
                                $("#addUserModal").modal("hide");
                            }
                        });
                    }
                }
            }
        }
    });

    function deleteUser(id) {
    swal.fire({
        title: "ARE YOU SURE?",
        text: "Once deleted, you won't be able to revert this action!",
        icon: 'question',
        showCancelButton: true, 
        cancelButtonText: 'No',
        cancelButtonColor: 'red',
        confirmButtonText: 'Yes! Delete it',
        confirmButtonColor: 'blue',
        showCloseButton: true,
        allowOutsideClick: false
        }).then((result => {
            if(result.isConfirmed){
            $.ajax({
                type: "post",
                url: "DeleteUsers.php", 
                data: {id:id},
                success:function(data,status) 
                {
                    readRecords();
                    toaster("User record has been deleted permanently!",5);
                }
            });
        }
      }));
    }
</script>