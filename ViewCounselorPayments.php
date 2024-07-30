<?php
session_start();
?>
<!-- Bootstrap CSS v5.2.1 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<?php
include('db_connect.php');
include('header.php');
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

<?php
$id = $_GET['id']??"";
$from = $_GET['from']??"";
$to = $_GET['to']??"";
?>

<div class="container-fluid" style="margin-top:75px;">
    <br>
    <div class="row">
    <div class="col-lg-12" style="position: relative; top: 4px;">
        <div class="card ">
            <div class="card-header">
                <b>Payment of <?php date_default_timezone_set("Asia/Karachi");
                echo date("l jS \of F Y"); ?></b>
            </div> 
            <div class="card-body">
                <div>
                <table class='table table-condensed table-bordered table-hover table-striped text-center' id='counselorsTable'>
                    <thead class="text-center text-uppercase">
                        <tr> 
                            <th class="text-center">S.NO.</th>
                            <th class="text-center">Counselors</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Receipt No</th>
                            <th class="text-center">Payment Mode</th>
                            <th class="text-center">Fee Type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Month Of Payment</th>
                            <th class="text-center">Receiving Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($from==="" || $to==="") // If date range is not selected
                        {
                            $query = "SELECT * FROM payments
                            WHERE counselor_id='$id' AND date_created >= DATE(NOW()) AND date_created < DATE(NOW() + INTERVAL 1 DAY)
                            ORDER BY Receipt_no DESC";   
                        }
                        else
                        {
                            $query = "SELECT * FROM payments
                            WHERE counselor_id='$id' AND date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)
                            ORDER BY Receipt_no ASC";  
                        }
                        $result = mysqli_query($conn,$query); 
                        $i = 1; 
                        $FEE_TYPE = '';
                        $totalAmount = 0;
                        while($data = mysqli_fetch_assoc($result))
                        {
                            if($data['FEE_TYPE']==1)
                            {
                                $FEE_TYPE = "Monthly Fee";
                            }
                            else if($data["FEE_TYPE"]== 2)
                            {
                                $FEE_TYPE = "Prospectus Fee";
                            }
                            else if($data["FEE_TYPE"]== 3)
                            {
                                $FEE_TYPE = "Books Fee";
                            }
                            else if($data["FEE_TYPE"]== 4)
                            {
                                $FEE_TYPE = "Fine";
                            }
                            else if($data["FEE_TYPE"]== 5)
                            {
                                $FEE_TYPE = "Registration Fee";
                            }
                            else if($data["FEE_TYPE"]== 6)
                            {
                                $FEE_TYPE = "Other Income Fee";
                            }
                            else
                            {
                                $FEE_TYPE = "Unknown";
                            }
                            echo "<tr>
                            <td>".$i++."</td>
                            <td>".$data['INPUTTER']."</td>
                            <td>".$data['FULL_NAME']."</td>
                            <td>".$data['Receipt_no']."</td>
                            <td>".$data['PAYMENT_MODE']."</td>
                            <td>".$FEE_TYPE."</td>
                            <td>".number_format($data['amount'],2)."</td>
                            <td>".date('M-Y',strtotime($data['Month_Of_Payment']))."</td>
                            <td>".date('M-d-Y h:i a',strtotime($data['date_created']))."</td>";
                        }          
                        ?>
                    </tbody>
                    <tfoot>
                        <?php
                        if($from==="" || $to==="") // If date range is not selected
                        {
                            $query = "SELECT SUM(amount) AS totalAmount FROM payments
                            WHERE counselor_id='$id' AND date_created >= DATE(NOW()) 
                            AND date_created < DATE(NOW() + INTERVAL 1 DAY)";
                        }
                        else
                        {
                            $query = "SELECT SUM(amount) AS totalAmount FROM payments
                            WHERE counselor_id='$id' AND date_created BETWEEN '$from' AND DATE_ADD('$to', INTERVAL 1 DAY)";
                        }

                        $result = mysqli_query($conn,$query);
                        $data = mysqli_fetch_assoc($result);
                        $totalAmount = $data['totalAmount'];
                        ?>
                        <tr>
                            <td class="text-right" colspan="6"> TOTAL </td>
                            <td class="text-left" colspan="3"> <?php echo number_format($totalAmount,2); ?> </td>
                        </tr>
                    </tfoot>
                </table> 

                        <div class="col-md-12">
                            <center>
                                <!-- <button class="btn btn-success col-sm-3 col-md-2" title="Print now"
                                type="button" id="print"><i class="fa fa-print"></i> Print</button> -->
                                <a class="btn btn-secondary text-white col-sm-3 col-md-2" title="Back to previous page"
                                href="index.php?page=counselors">
                                <i class="fas fa-arrow-left"></i> Back </a>
                                <a class="btn btn-success text-white col-sm-3 col-md-2" title="Export as excel"
                                href="exportViewCounselorPayment.php?id=<?php echo $id; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?> ">
                                <i class="fas fa-file-excel"></i> Export </a>
                            </center>
                        </div>
            </div>
        </div>
    </div>
 </div>
    </div>
</div>

<script src="./custom.js"></script>
<script>
    function readRecords()
    {
        $("#counselorsTable").dataTable();
    }

    $(document).ready(function () {
        readRecords();
    });

$(document).ready(function () {
    $('#print').click(function() {
        var _c = $('#counselorsTable').clone();
        var ns = $('noscript').clone();
        ns.append(_c);
        var nw = window.open('', '_blank', 'width=900,height=600');
        nw.document.write('<img class="aptimg" src="./assets/uploads/aptechlogo.png">');
        nw.document.write(
            '<h1 class="text-right" style="position:relative; font-family:sans-serif; top:-50px;"><b>UNIVERSITY ROAD CENTER</b></h1>'
        );
        nw.document.write("<h4 style='font-family:sans-serif;'> Payment of <?php echo date('M-d-Y'); ?> </h4>");
        nw.document.write(ns.html());
        nw.document.close();
        nw.print();
            setTimeout(() => {
                nw.close();
            }, 500);
        });
});
</script>