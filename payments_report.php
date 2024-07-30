<?php
include("db_connect.php");
if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}if($_SESSION['login_type'] == 2){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['login_type']);
    echo "<script> window.location.href='Login.php'; </script>";
    exit("Intruders not allowed");
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
    color: white;
}  .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}.table-bordered td, .table-bordered th {
    max-width: 150px;
    border: 1px solid #dee2e6;
}
table#report-list{
			width:100%;
			border-collapse:collapse
		}
		table#report-list td,
		table#report-list th{
			border:1px solid;
			font-size:12px;
		}
        p{
            margin:unset;
        }
		.text-center{
			text-align:center
		}
        .text-right{
            text-align:right
        }
</style>
<noscript>
<style>
        table#entry {
    width: 100%;
    border-collapse: collapse;  
    font-family:sans-serif;
}

table#entry td,
table#entry th {
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
table#entry tfoot
{
    font-weight: 700;
}
</style>
</noscript>

<div class="container-fluid">
    <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card sx-scroll">
                    <div class="card-header">
                        <b>Fee Report</b>
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
        
                        <span class="float:right">
                            <a type="button" class="btn btn-primary col-md-3 col-sm-12 float-right" data-target="#modal1" id="b1">
                                <i class="fa fa-calendar"></i> Select Date Range </a></span>
                    </div>
                    
                <div class="card-body">
                    <table class='table table-bordered table-striped text-center' id='entry'>
                        <thead id='headerForButtons'>
                            <tr>
                                <th colspan="13">
                                <button class="btn btn-success col-sm-3 col-md-2" data-title="Print Now" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                             <a id="exportMonthlyReportBtn" class="btn btn-success text-white col-sm-3 col-md-2" title="Export as excel"> <i class="fas fa-file-excel"></i> Export</a>
                                </th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
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
                        <tbody id="tableBody"> </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='4' class='text-right'> Total </td>
                                <td colspan='6' id='totalAmount' class='text-center'> 
                                    <!-- Total Amount Will Be Rendered Here --> 
                                </td>
                                <td colspan='3'> </td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
   

<script src="./custom.js"> </script>
<script>

var start = 0; // The starting point for default loading
var chunkSize = 100; // Number of records to load at a time
var isLoading = false; // Flag to prevent multiple simultaneous requests

// For Date Range
var from;
var to;

// Function to load more data for default loading
function loadData() {
    if (isLoading) return; // Return if a request is in progress
    isLoading = true;
    $.ajax({
        url: 'server_processingPayments_report.php',
        type: 'POST',
        data: { start: start, chunkSize: chunkSize, from: from, to: to },
        success: function (data) {
            $('#tableBody').append(data);
            start += chunkSize; // Update the starting point
            isLoading = false;
        }
    });
}

// Function to load data with date range
function loadDataWithDateRange() {
    start = 0; // Reset the starting point for date range loading
    $.ajax({
        url: 'server_processingPayments_report.php',
        type: 'POST',
        data: { start: start, chunkSize: chunkSize, from: from, to: to },
        success: function (data) 
        {
            $('#tableBody').empty().append(data); // Clear and then append new data
            start += chunkSize; // Update the starting point
        }
    });
}

// Load initial data (First 100 records on page load) - from 0 to 100
loadData();

// Date Range search
$("#BtnSearch").click(function () {
    from = $("#from").val();
    to = $("#to").val();
    if (from === '' || to === '') 
    {
        toaster("Please select date range in a proper manner", 5);
    } 
    else 
    {
        $('#modal1').modal('hide');
        $("#exportMonthlyReportBtn").attr(
            "href",
            `exportMonthlyPayment.php?from=${from}&to=${to}`
        );
        // Ajax request for date range loading
        loadDataWithDateRange();

        // Ajax request for total amount with date range
        $.ajax({
            type: "POST",
            url: "totalAmount_DateRange.php",
            data: { start: start, chunkSize: chunkSize, from: from, to: to },
            success: function (response) 
            {
                $("#totalAmount").text(response);
            }
        });
    }
});

// Add a scroll event listener to trigger loading more data when near the bottom
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) 
    {
        loadData();
    }
});

$(document).ready(function() {
    $("#exportMonthlyReportBtn").attr("href",
    `exportMonthlyPayment.php?from=1970-01-01 12:00:00&to=3970-01-01 12:00:00`);
    // Ajax request for Total Amount
    $.ajax({
        type: "GET",
        url: "totalAmount.php",
        success: function (response) 
        {
            $("#totalAmount").text(response);
        }
    });
});

$("#resetBtn").click(function(){
    $("#exportMonthlyReportBtn").attr("href",
    `exportMonthlyPayment.php?from=1970-01-01 12:00:00&to=3970-01-01 12:00:00`);
    $("#tableBody").empty();
    $("#from").val("");
    $("#to").val("");
    loadData();
});

$('#month').change(function() {
    location.replace('index.php?page=payments_report&month=' + $(this).val())
});

$('#print').click(function() {
    // $(".d-none").hide();
    $("#headerForButtons").hide();
    var _c = $('#entry').clone();
    var ns = $('noscript').clone();
    ns.append(_c);
    
    var nw = window.open('', '_blank', 'width=1200,height=600')
    nw.document.write(
        '<p class="text-center"><b>Payment Report</b></p>'
        )
    nw.document.write(ns.html())
    nw.document.close()
    nw.print()
    setTimeout(() => {
        nw.close();
    }, 500);
    $("#headerForButtons").show();
});

$("#b1").click(function() {
    $('#modal1').modal({
        show: true,
        backdrop: false,
        keyboard: false
    });
});
</script>