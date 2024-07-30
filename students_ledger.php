<?php 
include ('db_connect.php');
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
?>

<style>
a.text {
    line-height: 30px;
}
.button-3 {
  appearance: none;
  background-color: #2ea44f;
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
  padding: 6px 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;
}

.button-3:focus:not(:focus-visible):not(.focus-visible) {
  box-shadow: none;
  outline: none;
}

.button-3:hover {
  background-color: #2c974b;
}

.button-3:focus {
  box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
  outline: none;
}

.button-3:disabled {
  background-color: #94d3a2;
  border-color: rgba(27, 31, 35, .1);
  color: rgba(255, 255, 255, .8);
  cursor: default;
}

.button-3:active {
  background-color: #298e46;
  box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
}
a.btn.btn-danger.col-md-1.col-sm-6.float-right {
    min-width: 110px;
    position: relative;
    left: -8px;



}.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}

a.btn.btn-success.col-md-1.col-sm-6.float-right {
    min-width: 110px;
    position: relative;
    left: -16px;
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

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <b>Students Ledger for Active Students</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-striped table-bordered table-hover text-center" style="width: 100%;" id="students_ledger_table">
                            <thead>

                                <tr>
                                    <th class="text-center">HIDDEN ID</th>
                                    <th class="text-center">S.NO.</th>
                                    <th class="text-center">NAME</th>
                                    <th class="text-center">FATHER NAME</th>
                                    <th class="text-center">STUDENT ID</th>
                                    <th class="text-center">COURSE</th>
                                    <th class="text-center">DATE</th>
                                    <th class="text-center">DETAIL/PRINT</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#students_ledger_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
            "url": "server_processingStudents_ledger.php", 
            "type": "POST",
        },
        "columns": [
            { data: 'id', className:'d-none'},
            { data: 'sr_no'},
            { data: 'name' },
            { data: 'father_name' },
            { data: 'ex_id_no'},
            { data: 'course'},
            { data: 'date' },

            { 
                "render": function (data, type, full, meta) 
                {
                    var buttons = '';
                    <?php if($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2): ?>
                        if (full.name === '' || full.name === null || full.name === undefined) 
                        {
                            buttons += "<p> <b> <a href='https://aptechurc.com/index.php?page=payments' class='text'> No Fee Yet!  </a> </b> </p>";
                        } 
                        else 
                        {
                            buttons += `<a href="StudentLedger.php?name=${full.name}" data-title="View & Print Ledger" 
                            <button class='button-3' role='button'>View</button></a>`;
                        }

                    <?php endif; ?>
                    
                    return buttons;
                }
            }
        ],
        "pageLength": 10,
        "searching": true, // Ensure searching is enabled
    });
});


function Print() 
{
    window.print()
    printButton.style.scale = '60';
}
</script>