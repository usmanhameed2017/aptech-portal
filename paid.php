<?php
session_start();
include ('db_connect.php');
$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

include('header.php');

?>
<?php include 'topbar.php' ?>
<style>


.card {
margin-top: 114px;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}
</style>

<div class="container-fluid">
    <div class="row">
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card_header">
        <div class="row justify-content-center pt-4">
            <label for="" class="mt-2">Month</label>
            <div class="col-sm-2">
                
                <input type="month" name="month" id="month" value="<?php echo $month ?>" class="form-control">
                </div>
                <div class="col-sm-2">
                <span class="float:right">
                        <a class="btn btn-success col-md-12 col-sm-12 float-right" title="Export as excel"
                            href="PaidExportReport.php?month=<?php echo $month; ?>">
                            <i class="fas fa-file-excel"></i> EXPORT
                            </a></span>
                        
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                                    <table class="table table-condensed table-striped table-bordered table-hover" id="entry">
                                        <thead>
                            <tr>
                                <th class="text-center" colspan="8">PAID STUDENTS FOR SELECTED MONTH</th>
                            </tr>

                            <tr>
                                <th class="text-center">S.NO.</th>
                                <th class="text-center">STUDENT ID</th>
                                <th class="text-center">STUDENT NAME</th>
                                <th class="text-center">FATHER NAME</th>
                                <th class="text-center">COURSE</th>
                                <th class="text-center">CONTACT NO.</th>
                                <th class="text-center">FEE</th>
                

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            

                            $i = 1;
                            $total = 0;
                            $payments = $conn->query("SELECT s.*
                            FROM student s
                            WHERE s.student_status = 1 and s.ex_id_no IN (SELECT p.ef_no FROM payments p WHERE p.FEE_TYPE=1 and date_format(Month_Of_Payment,'%Y-%m') = '$month' )");
                            if($payments->num_rows > 0):
                            while($row = $payments->fetch_array()):
                                $total += $row['monthly_fee'];

                                ?>
                            <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-center">
                                    <p><?php echo $row['ex_id_no']; ?></p>
                                </td>
                                </td>
                                <td class="text-center">
                                    <p><?php echo $row['name']; ?></p>
                                </td>
                                <td class="text-center">
                                    <p><?php echo $row['father_name']; ?></p>
                                </td>
                                <td class="text-center">
                                    <p><?php echo $row['course']; ?></p>
                                </td>

                                <td class="text-center">
                                    <p><?php echo $row['contact']; ?></p>
                                </td>


                                <td class="text-center">
                                    <p><?php echo number_format($row['monthly_fee']); ?></p>
                                </td>
                              
                                <?php	
                                        endwhile;
                                    else:										
                        
                                        ?>
                                </td>
                            </tr>

                            <tr>
                        <th class="text-center" colspan="8">No Fee Yet.</th>
                            </tr>
                                <?php 
                                    endif;
                                ?>
                  <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">Total</th>
                                <th colspan="3" class="text-center"><?php echo number_format($total,2) ?></th>
                                

                            </tr>
                        </tfoot>

                    </table>
                
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<script>
$('#month').change(function(){
location.replace('paid.php?month='+$(this).val())
})
</script>

<script>


$('#entry').dataTable( {
"pageLength": 100
} );

</script>