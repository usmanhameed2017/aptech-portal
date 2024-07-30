<style>
img.aplogo {
    position: relative;
    width: 207px;
    float: left;
    left: -27px;
}

button#submit {
    display: none;
}

button.hello.btn.btn-danger {
    display: none;
}
.modal-header {
        border: none !important;
    }
.modal-title{
        font-weight: 900;
    }

.modal-footer{
        border: none !important;
        margin-right: auto;
    }
    .td-button{
        display: flex;
    justify-content: space-between;
    min-width: 11em;
    max-width: max-content;
    }
</style>

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

a.btn.btn-danger.float-right {
    min-width: 110px;
    position: relative;
    left: -8px;
}

a.btn.btn-success.float-right {
    min-width: 110px;
    position: relative;
    left: -16px;
}

a#new_student {
    min-width: 110px;
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

[data-title] {
    position: relative;
}
.table-striped tbody tr:nth-of-type(odd) { 
    background-color: rgb(0 0 0 / 17%);
}
</style>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12 mt-3">
                <div class="card sx-scroll">
                <div class="card-header">
                <?php if($_SESSION['login_type'] == 2) 
                      {
                        echo "<b>ADD NEW STUDENT</b>"; 
                      }
                      else
                      {
                        echo "<b>STUDENT DETAILS</b>";
                      } 
                      ?>
                        <!-- Open Student Modal Button -->
                        <span class="float:right">
                            <a class="btn btn-primary col-md-1 col-sm-6 float-right text-white" data-title="Create New Student"
                             id="openStudentmodal" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            <i class="fa fa-plus"></i> New </a></span>

                        <?php if($_SESSION['login_type'] == 1) //Only admin have rights to see inactive students and export records.
                              { 
                        ?>

                        <!-- Inactive Student -->
                        <span class="float:right"><a class="btn btn-danger float-right" data-title="Inactive Students"
                        href="index.php?page=InactiveStudents"><i class="fa fa-minus"></i> Inactive </a></span>

                        <!-- Export Records -->
                        <span class="float:right"><a class="btn btn-success col-md-1 col-sm-6 float-right" 
                        data-title="Export as excel" href="exportStudent.php"> <i class="fas fa-file-excel"> </i> Export </a></span>

                        <?php 
                              } 
                        ?>

                    </div>
                        <div class='card-body'>
                    <div id="StudentTableContent"> <!-- Students table will be rendered here! --> </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="studentModal" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalTitleId">ADD NEW STUDENT</h1>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                <div class="modal-body">
                <!-- Add New Student Form -->
                <form method="post" id="addStudentForm" autocomplete="off">
                    
                
                <!-- Student Internal ID (Auto-Incremented) -->
                <!--<input type="hidden" class="form-control" name="id_no" id="id_no" -->
                <!--value="<?php // echo $data['id']+1; ?>" readonly>-->
 

                <!-- Student ID (External) (Invoice) -->
                <div class="form-group">
                    <label for="ex_id_no" class="control-label">Student ID</label>
                    <input type="text" class="form-control std" name="ex_id_no" id="ex_id_no" placeholder="Student ID">
                </div>

                <!-- Student Name -->
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
                </div>

                <!-- Father Name -->
                <div class="form-group">
                    <label for="fname" class="control-label">Father Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Father Name">
                </div> 

                <!-- Contact -->
                <div class="form-group">
                    <label for="contact" class="control-label">Student Contact No.</label>
                    <input type="number"  class="form-control" name="contact" id="contact" placeholder="Enter Contact">
                </div>

                <!-- Guardians Number (Invoice) -->
                <div class="form-group">
                    <label for="bcd" class="control-label">Guardian Contact No.</label>
                    <input type="text" class="form-control"  name="bcd" id="bcd" placeholder="Guardian Cell:No">
                </div>

                <!-- Email (Invoice) -->
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address" class="control-label">Address</label>
                    <textarea name="address" id="address" cols="30" rows="3" placeholder="Enter Address" class="form-control"></textarea>
                </div>

                <!-- Timings (Invoice) -->
                <div class="form-group">
                    <div class="col-xxl-12">
                        <label for="timings" class="control-label">Timings</label>
                        <input list="ShiftTimings" id="timings" placeholder="Select Timings" name="ShiftTimings" class="form-control">
                        <datalist id="ShiftTimings">
                         <!--MWF -->
                        <option value="9:00 TO 11:00 (MWF)">
                        <option value="11:00 TO 1:00 (MWF)">
                        <option value="1:00 TO 3:00 (MWF)">
                        <option value="3:00 TO 5:00 (MWF)">
                        <option value="5:00 TO 7:00 (MWF)">
                        <option value="7:00 TO 9:00 (MWF)">
                         <!--TTS -->
                        <option value="9:00 TO 11:00 (TTS)">
                        <option value="11:00 TO 1:00 (TTS)">
                        <option value="1:00 TO 3:00 (TTS)">
                        <option value="3:00 TO 5:00 (TTS)">
                        <option value="5:00 TO 7:00 (TTS)">
                        <option value="7:00 TO 9:00 (TTS)">
                        </datalist>
                    </div>
                </div>

                <!-- Course -->
                <div class="form-group">
                    <div class="col-xxl-12">
                        <label for="course" class="control-label">Course</label>
                        <input list="sfee_head" id="course" placeholder="Select Course" name="sfee_head" class="form-control">

                        <datalist id="sfee_head">
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
                    </div>
                </div>

                <!-- Admission Charges -->
                <div class="form-group">
                    <label for="admission_fee" class="control-label">Registration Fee</label>
                    <input type="number" class="form-control" name="admission_fee" id="admission_fee"
                    placeholder="Enter Registration Fee">
                </div>

                <!-- Monthly Tution Charges -->
                <div class="form-group">
                    <label for="monthly_fee" class="control-label">Monthly Tuition Fee</label>
                    <input type="number" id="monthly_fee" class="form-control" name="monthly_fee"
                        onkeypress="return onlyNumbers(this.value);" onkeyup="NumToWord(this.value,'amount_in_words');"
                        maxlength="9" placeholder="Enter Monthly Tution Fee" >
                </div>

                <!-- Amount In Words -->
                <div class="form-group">
                    <label for="amount_in_words" class="control-label">Monthly Fee In Words</label>
                    <input type="text" class="form-control" id="amount_in_words" name="amount_in_words" 
                    placeholder="Monthly Charges In Words">
                </div>

                <!-- Booking Confirmation Number / Certification Fee (Invoice) -->
                <div class="form-group">
                    <label for="obc" class="control-label">Certification Fee</label>
                    <input type="number" class="form-control" name="obc" id="obc" placeholder="Enter Certification Fee" >
                </div>

                <!-- Date Of Admission -->
                <div class="form-group">
                    <label for="cc" class="control-label">Date Of Admission</label>
                    <input type="date" class="form-control" name="cc" id="cc" placeholder="Date Of Admission" >
                </div>

                <!-- Total Course Fee -->
                <div class="form-group">
                    <label for="scc" class="control-label">Total Course Fee</label>
                    <input type="text" class="form-control" name="scc" id="scc" placeholder="Total Course Fee" >
                </div>
                
                <!-- Counselor Name -->
                <div class="form-group">
                    <label for="cfn" class="control-label">Counselor</label>
                    <input type="text" class="form-control" name="cfn" id="cfn" placeholder="Counselor" 
                    value="<?php echo $_SESSION['name']; ?>" readonly>
                </div>
                
                <div class="form-group">
                <button type="button" id="BtnInsertStudent" class="btn btn-primary" name="BtnInsertStudent"> Submit </button>
                <button type="button" class="2 btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<script src="js/num-to-words.js" type="text/javascript"></script>
<script src="./custom.js"></script>
<script>

// Fetch Student Table
function readRecords() {
        var rd = 'rd';
        $.ajax({
            type: "post",
            url: "fetchStudentsTable.php",
            data: {rd:rd},
            success: function (response) {
                $("#StudentTableContent").html(response);
            }
        });
    } 

$(document).ready(function () {
    readRecords(); // Load table on page initialization
});

// Add Student 
$("#BtnInsertStudent").click(function(){
        let ex_id_no = $("#ex_id_no").val(); // (Not in Invoice)
        let name = $("#name").val();
        let fname = $("#fname").val();
        let contact = $("#contact").val();
        let email = $("#email").val(); //(Not in Invoice)
        let address = $("#address").val();
        let timings = $("#timings").val(); // (Not in Invoice)
        let course = $("#course").val();
        let admission_fee = $("#admission_fee").val();
        let monthly_fee = $("#monthly_fee").val();
        let amount_in_words = $("#amount_in_words").val();
        let obc = $("#obc").val(); // This is Certification fee
        let bcd = $("#bcd").val(); // This is Guardian number (Not in Invoice)
        let cfn = $("#cfn").val(); // This is Counselor Name
        let cc = $("#cc").val();   // This is Date Of Admission
        let scc = $("#scc").val(); // This is Total Course Fee
        if(name==="")
        {
            toaster("Student name is required!",5);
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "Ajax/addStudent.php",
                data: {ex_id_no:ex_id_no, name:name, fname:fname, contact:contact, email:email, address:address,
                timings:timings, course:course, admission_fee:admission_fee, monthly_fee:monthly_fee, amount_in_words:amount_in_words,
                obc:obc, bcd:bcd, cfn:cfn, cc:cc, scc:scc},
                success: function (response) 
                {
                    readRecords();
                    toaster("New student has been added",5);
                    $(`#ex_id_no,#name,#fname,#contact,#email,#address,#timings,#course,#admission_fee,#monthly_fee,
                    #amount_in_words,#obc,#bcd,#cc,#scc`).val("");
                    $("#addStudentModal").modal("hide");
                    window.location.href=`studentInvoice.php?id=${response}`;
                }
            });
        }
    });

// Delete Student
function deleteStudent(id) {
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
                url: "DeleteStudents.php", 
                data: {id:id},
                success:function(data,status) 
                {
                    readRecords();
                    toaster("Student record has been deleted permanently!",5);
                }
            });
        }
    }));
}

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
    document.getElementById(outputControl).value = finalOutput+"Only";
}
</script>