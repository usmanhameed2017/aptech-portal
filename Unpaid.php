<?php
session_start();
include ('db_connect.php');
$from_month = isset($_GET['from_month']) ? $_GET['from_month'] : date('Y-m');
$to_month = isset($_GET['to_month']) ? $_GET['to_month'] : date('Y-m');
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
    <div class="card " style="overflow:auto">
        <div class="card_header">
        <div class="row justify-content-center pt-4">
            <!--<label for="" class="mt-2">Month</label>-->
            <!--<div class="col-sm-2">-->
                
            <!--    <input type="month" name="month" id="month" value="<?php echo $month ?>" class="form-control">-->
            <!--    </div>-->
            <form method="GET" action="" class="col-lg-12 d-flex justify-content-center">
            <label for="from_month" class="mt-2">From Month</label>
            <div class="col-lg-3">
                <input type="month" name="from_month" id="from_month" value="<?php echo $from_month ?>" class="form-control">
            </div>
            <label for="to_month" class="mt-2">To Month</label>
            <div class="col-lg-3">
                <input type="month" name="to_month" id="to_month" value="<?php echo $to_month ?>" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" name="submitBtn">Submit</button>

            </form>
                <div class="col-sm-2">
                <span class="float:right">
                        <a class="btn btn-success col-md-12 col-sm-12 float-right" title="Export as excel"
                            href="exportDuePayment.php?from_month=<?php echo $from_month; ?>$to_month=<?php echo $to_month; ?>">
                            <i class="fas fa-file-excel"></i> EXPORT
                        </a></span>
                        
            </div>
        </div>
        <div class="card-body">
                        <table class="table table-condensed table-striped table-bordered table-hover" id="entry">
                            <thead>
                            <tr>
                                <th class="text-center" colspan="8">STUDENTS REMAINING FEE FOR SELECTED MONTH</th>
                            </tr>

                            <tr>
                                <th class="text-center">S.NO.</th>
                                <th class="text-center">STUDENT ID</th>
                                <th class="text-center">STUDENT NAME</th>
                                <th class="text-center">FATHER NAME</th>
                                <th class="text-center">COURSE</th>
                                <th class="text-center">CONTACT NO.</th>
                                <th class="text-center">FEE</th>
                                <th class="text-center">ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            

                            $i = 1;
                            $total = 0;
                            $payments = $conn->query("SELECT s.*
    FROM student s
    WHERE s.student_status = 1 and s.ex_id_no NOT IN (SELECT p.ef_no FROM payments p WHERE p.FEE_TYPE=1 and date_format(Month_Of_Payment,'%Y-%m') BETWEEN '$from_month' AND '$to_month')");
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
                                <td class="text-center">
                                    <?php if($row['contact']!=null){
                                      
                                  ?>
                              
                                <a href="https://web.whatsapp.com/send?phone=<?php echo sprintf('%08d',$row['contact']); ?>&text=<?php echo $row['name']; ?>, Pay your monthly fee by the 10th of <?php echo date("F", strtotime($month)) ?> to avoid late fee charges of Rs.500/=%0A
NOTE: Fee is not acceptable after the 10th of every month without late fee charges.%0A
Regards,%0A
Aptech University Center" data-action="share/whatsapp/share" target="_blank"><img src="assets/uploads/WhatsApp.svg.webp" style="width: 50px ;" >Send Message</a>
                                
                                </td>
                                <?php	}else{
                                    echo "Add Contact No.";
                                }

                                        endwhile;
                                    else:										
                        
                                        ?>
                                </td>
                            </tr>

                            <tr>
                        <th class="text-center" colspan="8">All student fees are paid.</th>
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
<br>



 <script>
$('#month').change(function(){
location.replace('Unpaid.php?month='+$(this).val())
});
</script>



<script>




$('#entry').dataTable( {
"pageLength": 100
} );

</script>