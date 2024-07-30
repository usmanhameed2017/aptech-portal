<?php
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
else
{
    $id = $_SESSION['id'];
}
?>
<style>
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
tfoot{
    font-weight: 700;
}

/*Modal*/
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
button#b1 {
    max-width: 195px;
    color: white;
}




</style>
<noscript>
<style>
        table#counselorsTable {
    width: 100%;
    border-collapse: collapse;  
    font-family:sans-serif;  
}

table#counselorsTable td,
table#counselorsTable th {
    border: 1px solid;
    font-size:12px;
    font-family:sans-serif;
}

p {
    margin: unset;
}

.text-center {
    text-align: center
}

.text-right {
    text-align: right
}

.row {
    position: relative;
    top: -30px;
}

.aptimg {
    position: relative;
    max-width: 180px;
    top: 10px;
}

.dat {
    position: relative;
    top: -10px;
    text-align: right;
}
table#counselorsTable tfoot
{
    font-weight: 700;
}
</style>
</noscript>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12 mt-3">
        <div class="card sx-scroll">
            <div class="card-header">
                <b id="paymentHeading">Daily Payments Taken By Counselors
                <?php 
                // date_default_timezone_set("Asia/Karachi");
                //echo date("l jS \of F Y"); 
                ?>
                </b>

                <?php
                    if($_SESSION['login_type']==1)
                    { ?>
                        <span class="float:right"><button type="button" class="btn btn-primary col-md-3 col-sm-12 float-right" data-target="#modal1" id="b1">
                        <i class="fa fa-calendar"></i> Select Date Range </button></span>
             <?php  }
                ?>
                    <!-- Date Range Modal -->
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
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-5 mx-auto">

                                                    <!-- Form For date Range -->
                                                    <form method="post" id="dateRangeForm">
                                                        <label for="from">From</label> &nbsp;
                                                        <input type="date" id="from" class="form-control">
                                                        <label for="to">To</label> &nbsp;
                                                        <input type="date" id="to" class="form-control">
                                                        <br>
                                                        <span>
                                                            <input type="button" id="BtnSearch" value="Search" class="btn btn-outline-success mb-2">
                                                            <button type="button" id="resetBtn" class="btn btn-outline-danger mb-2">Reset</button></span>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
            <div class="card-body">
                <div id="tableContent">
                    <!-- Counselors Table Will Be Rendered Here -->
                </div>
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success col-sm-3 col-md-2" title="Print now" id="print"> 
                            <i class="fa fa-print"> </i> Print </button>
                            
                            &nbsp;
                            
                            <a class="btn btn-success text-white col-sm-3 col-md-2" id="exportBtn" title="Export as excel" href="exportCounselors.php">
                            <i class="fas fa-file-excel"> </i> Export </a>
                        </div>
                    </div>
                <div>
            </div>
        </div>
    </div>
</div>

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="./custom.js"></script>
<script>

var from = '';
var to = '';

// Search through filters
$("#BtnSearch").click(function(){
    from = $("#from").val();
    to = $("#to").val();
    if(from=="" || to=="")
    {
        toaster("Select date range filter in a proper manner",5);
    }
    else
    {
        $("#exportBtn").attr(`href`,`exportCounselors.php?from=${from}&to=${to}`);
        $.ajax({
        url:"fetchCounselors.php",
        type: "POST",
        data: {from:from, to:to},
        success:function(response)
        {
            $("#tableContent").html(response);
            $("#modal1").modal("hide");
        }
    });
    }
});

// Reset Records
$("#resetBtn").click(function(){
    $("#from").val("");
    $("#to").val("");
    readRecords();
    $("#exportBtn").attr(`href`,`exportCounselors.php`);
});

// Page initialiation
$(document).ready(function () {
    readRecords();
});

function readRecords()
{
    let rd = "rd";
    $.ajax({
        url:"fetchCounselors.php",
        type: "POST",
        data: {rd:rd},
        success:function(response)
        {
            $("#tableContent").html(response);
        }
    });
}


$(document).ready(function () {
    $('#print').click(function() {
        $("th.text-center.adminView").hide();
        $(".adminView-button").hide();
        var _c = $('#counselorsTable').clone();
        var ns = $('noscript').clone();
        ns.append(_c);
        var nw = window.open('', '_blank', 'width=900,height=600');
        nw.document.write('<img class="aptimg" src="./assets/uploads/aptechlogo.png">');
        nw.document.write(
            '<h1 class="text-right" style="position:relative; font-family:sans-serif; top:-50px;"><b>UNIVERSITY ROAD CENTER</b></h1>'
        );
        nw.document.write("<h4 style='font-family:sans-serif;'> Daily Payments Taken By Counselors </h4>");
        nw.document.write(ns.html());
        nw.document.close();
        nw.print();
            setTimeout(() => {
                nw.close();
            }, 500);
            $("th.text-center.adminView").show();
        $(".adminView-button").show();
        });
});
$("#b1").click(function() {
    $('#modal1').modal({
        show: true,
        backdrop: false,
        keyboard: false
    });
});
</script>