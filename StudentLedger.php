<?php 
session_start();
include ('db_connect.php');
include('header.php');
include 'topbar.php';
include('navbar.php');
$rrr = $_GET['page']??"";

$id = $_GET['id']??"";
$_SESSION['ledger_id'] = $id;

$std_name = $_GET['name']??"";
$_SESSION['ledger_name'] = $std_name;

if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}
?>
<style>
button#submit {
    display: none;
}

button.hello.btn.btn-danger {
    display: none;
}.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}
</style>

<noscript>
    <style>
table#report-list {
    width: 100%;
    border-collapse: collapse;    
}

table#report-list td,
table#report-list th {
    border: 1px solid;
    font-size:12px;
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
    </style>
</noscript>

        <div class="data">
            <div class="col-md-12" style=" width: auto; margin-top:169px; margin-left: 265px;">
                <div class="card">
                    <div class="card-header">
                        <b>STUDENT LEDGER OF <?php echo strtoupper($std_name); ?>.</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-striped table-bordered table-hover" id='report-list'>
                            <thead>
                                <tr>
                                    <th class="text-center">S.NO.</th>
                                    <th class="text-center">DATE</th>
                                    <th class="text-center">RECEIPT NO</th>
                                    <th class="text-center">PAYMENT MODE</th>
                                    <th class="text-center">REGISTRATION/EXAM/CERTIFICATION</th>
                                    <th class="text-center">TUITION FEE</th>
                                    <th class="text-center">PROSPECTUS</th>
                                    <th class="text-center">BOOKS</th>
                                    <th class="text-center">FINE</th>
                                    <th class="text-center">OTHER INCOME</th>
                                    <th class="text-center">RECEIVED BY</th>
                                    <th class="text-center">REMARKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                      $i = 1;
                      $total = 0;
                      $payments = $conn->query("SELECT * FROM `payments` WHERE FULL_NAME = '$std_name'");
                      $t1 = 0;
                      $t2 = 0;
                      if($payments->num_rows > 0):
			          while($row = $payments->fetch_array()):

                    //"SELECT * FROM `payments` WHERE FEE_TYPE IN (5,1,2) AND FULL_NAME = '$std_name'
                    $total += $row['amount'];
                    $d = $row['date_created'];
                    $nnnn = $row['FULL_NAME'];
			        ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center">
                                        <p> <?php echo date("d-M-Y h:i a", strtotime($row['date_created'])) ?></p>
                                    </td>
                                    <td class="text-center">
                                        <p><?php echo $row['Receipt_no']; ?></p>
                                    </td>

                                    <td class="text-center">
                                        <p><?php echo $row['PAYMENT_MODE']; ?></p>
                                    </td>

                                    <td class="text-center">
                                    <p><?php if($row['FEE_TYPE']==5) { echo number_format($row['amount']); $t1 += $row['amount']; }else{ echo '-';} ?></p>
                                    </td>
                                    
                                    <td class="text-center">
                                        <p><?php if($row['FEE_TYPE']==1) { echo number_format($row['amount']);  $t2 += $row['amount']; }else{ echo '-';} ?></p>
                                    </td>

                                    <td class="text-center">
                                        <p><?php if($row['FEE_TYPE']==2) { echo number_format($row['amount']); }else{ echo '-';} ?></p>
                                    </td>

                                    <td class="text-center">
                                        <p><?php if($row['FEE_TYPE']==3) { echo number_format($row['amount']); }else{ echo '-';} ?></p>
                                    </td>

                                    <td class="text-center">
                                        <p><?php if($row['FEE_TYPE']==4) { echo number_format($row['amount']); }else{ echo '-';} ?></p>
                                    </td>

                                    <td class="text-center">
                                        <p><?php if($row['FEE_TYPE']==6) { echo number_format($row['amount']); }else{ echo '-';} ?></p>
                                    </td>

                                    <td class="text-center">
                                        <p><?php echo $row['INPUTTER']; ?></p>
                                    </td>

                                    <td class="text-center">
                                    <p><?php echo $row['remarks'] ?></p>
                                    </td>
                                </tr>
                                <?php 
                        endwhile;
                        else:
                    ?>
                                <tr>
                                    <th class="text-center" colspan="10">No Data.</th>
                                </tr>
                                <?php 
                        endif;
                    ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <!-- <th colspan="5" class="text-right">Total</th> -->
                                    <th colspan="12" style='letter-spacing:1px;' class="text-center">
                                        <?php echo "TOTAL  ".  number_format($t1 + $t2,2); ?></th>

                                </tr>
                            </tfoot>
                        </table>
                        <hr>
                        <div class="col-md-12 mb-4">
                            <center>
                                <button class="btn btn-success col-sm-3 col-md-2" title="Print now" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                                <a class="btn btn-success text-white col-sm-3 col-md-2" title="Export as excel" href="exportStudentLedger.php?ef_no=<?php echo $id; ?>&std_name=<?php echo $nnnn; ?>"> <i class="fas fa-file-excel"></i> Export </a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>
        <?php 
            $query2 = "select * from student where name='$std_name'";
            $result2 = mysqli_query($conn,$query2);
            $data = mysqli_fetch_assoc($result2);
            $k = $data['course'];
            $f = $data['father_name'];
            $ex_id_no = $data['ex_id_no']; 
            $y = $data['Short_Course_Total_Fee'];
        ?>

    <script>
    $('.nav_collapse').click(function() {
    console.log($(this).attr('href'));
    $($(this).attr('href')).collapse();
    });
    $('.nav-<?php if($rrr==''){ echo 'students_ledger';} ?>').addClass('active');

    $('#print').click(function() {
        var _c = $('#report-list').clone();
        var ns = $('noscript').clone();
        ns.append(_c);
        var nw = window.open('', '_blank', 'width=900,height=600');
        nw.document.write('<img class="aptimg" src="./assets/uploads/aptechlogo.png">');
        nw.document.write(
            '<h1 class="text-right" style="position:relative; top:-50px;"><b>UNIVERSITY ROAD CENTER</b></h1>'
        );
        nw.document.write('<p class="dat"><b>Date: <?php echo date("d/M/Y") ?> </b></p>');
        nw.document.write(
            '<div class="row"><p class="text-left"><b>Student Name: <?php echo $std_name; ?></b></p>');
        nw.document.write('<p class="text-left"><b>Father Name: <?php echo $f; ?></b></p>');
        nw.document.write('<p class="text-left"><b>Student ID: <?php echo $ex_id_no; ?></b></p>');
        nw.document.write('<p class="text-left"><b>Course: <?php echo $k; ?></b></p>');
        nw.document.write('<p class="text-left"><b>Total Course Fee: <?php echo $y; ?></b></p></div>');
        nw.document.write(ns.html());
        nw.document.close();
        nw.print();
            setTimeout(() => {
                nw.close();
            }, 500);
        });
        </script>