<?php
date_default_timezone_set("Asia/Karachi");
include('db_connect.php');
include('header.php');
?>
<style>
h5 {
    font-size: 15px;
    font-weight: bold;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
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
.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    min-width: 700px;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1pxsolidrgba(0, 0, 0, .2);
    border-radius: 0.3rem;
    outline: 0;
    left: -192px;
}
div#b1 {
    position: relative;
    left: 807px;
    top: 38px;
}
a#b1 {
    max-width: 195px;
    position: relative;
    left: -2px;
    color: white;
}
.center-align {
    text-align: center;
}
</style>

<div class="container-fluid">
    <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <b>ACTIVITY LOG <i class="fa fa-history"></i></b>
                        <div id="target">
                            <div class="modal fade" id="modal1" tabindex="-1" role="dialog"
                                aria-labelledby="modal1Label" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-left">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="text-center" style="font-weight:900; margin-left:auto;">SELECT DATE RANGE</h3>
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"></div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-5 mx-auto">
                                                    <form id="activityLogDateRange" method="post">
                                                        <label for="from">From</label> &nbsp;
                                                        <input type="date" id="from" class="form-control">
                                                        <label for="to">To</label> &nbsp;
                                                        <input type="date" id="to" class="form-control">
                                                        <br>
                                                        <span>
                                                            <input type="button" id="SearchBtn" value="Search" class="btn btn-outline-success">
                                                            <button type="button" id="resetBtn" class="btn btn-outline-danger">Reset</button></span>
                                                            <br><br>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="float:right">
                            <a type="button" class="btn btn-primary col-md-3 col-sm-12 float-right"
                                data-target="#modal1" id="b1">
                                <i class="fa fa-calendar"></i> Select Date Range
                            </a></span>

                    </div>
                    <div class="card-body"> 
                        <table class='table table-condensed table-striped table-bordered table-hover' id='activityLogTable' style='width:100%'>
                            <thead>
                                <tr>
                                    <th class='text-center'><b>S.NO.</b></th>
                                    <th class='text-center'><b>ACTION</b></th>
                                    <th class='text-center'><b>BEFORE ACTION</b></th>
                                    <th class='text-center'><b>AFTER ACTION</b></th>
                                    <th class='text-center'><b>REMARKS</b></th>
                                    <th class='text-center'><b>TIME-STAMP</b></th>
                                </tr>
                            </thead>
                        </table>
</table> </div>
                </div>
            </div>
        </div>
        </div>

<script src="./custom.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    readRecords();
});
function readRecords()
{
    $("#activityLogTable").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
        "url": "server_processingActivityLog.php", 
        "type": "POST",
        },
        "columns": [
            { data: 'sr_no', className: 'center-align'},
            { data: 'ACTION_BY', className: 'center-align'},
            { data: 'DESCRIPTION'},
            { data: 'AFTER_EDIT' },
            { data: 'REMARKS'},
            { data: 'DATE_CREATED' },
        ],
        "pageLength": 10,
        "searching": true, 
    });
}
var from;
var to;
$("#SearchBtn").click(function(){
    from = $("#from").val();
    to = $("#to").val();
    if(from === "" || to === "")
    {
        toaster("Please select date range in a proper manner!",5);
    }
    else
    {
        $("#modal1").modal("hide");
        $('#activityLogTable').DataTable().destroy();
        $("#activityLogTable").DataTable({
        "processing": true, 
        "serverSide": true,
        "ajax": {
        "url": "server_processingActivityLog2.php", 
        "type": "POST",
        "data": {from:from, to:to},
        },
        "columns": [
            { data: 'id', className: 'center-align'},
            { data: 'ACTION_BY', className: 'center-align'},
            { data: 'DESCRIPTION'},
            { data: 'AFTER_EDIT' },
            { data: 'REMARKS'},
            { data: 'DATE_CREATED' },
        ],
        "pageLength": 10,
        "searching": true,
    });
    }
});
$("#resetBtn").click(function(){
$('#activityLogTable').DataTable().destroy();
    readRecords();
    $("#from").val("");
    $("#to").val("");
});

$("#b1").click(function() {
    $('#modal1').modal({
        show: true,
        backdrop: false,
        keyboard: false
    });
});
</script> 