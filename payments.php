<?php
date_default_timezone_set("Asia/Karachi");
?>
<style>
    .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 17%);
}
a.btn.btn-danger.col-md-1.col-sm-6.float-right {
    min-width: 110px;
    position: relative;
    left: -8px;



}a.btn.btn-secondary.col-md-1.col-sm-6.float-right {
    position: relative;
        min-width: 110px;
    left: -15px;
}

a.btn.btn-success.col-md-1.col-sm-6.float-right {
    min-width: 110px;
    position: relative;
    left: -23px;
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
a#new_payment {
    min-width: 110px;
}.td-button{
        display: flex;
        justify-content: space-between;
        max-width: fit-content;
        }
@media all and (max-width: 1280px) {
td.text-center.r {
    transform: scale(0.8);
    display: flex;
}
}
</style>

<div class="container-fluid">
    <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card sx-scroll">
                    <div class="card-header">
                        <b>FEE DETAILS</b>
                        <!-- New -->
                        <span class="float:right"><a class="btn btn-primary col-md-1 col-sm-6 float-right"
                                data-title="Add New Fee" href="javascript:void(0)" id="new_payment">
                                <i class="fa fa-plus"></i> New
                            </a></span>

                        <!-- Unpaid -->
                        <?php if($_SESSION['login_type'] == 1)
                        { 
                            ?>
                        <span class="float:right"><a href="Unpaid.php" data-title="Due Fee"
                                class="btn btn-danger col-md-1 col-sm-6 float-right">
                                <i class="fa fa-minus"></i> Unpaid
                            </a></span>
                            
                         <!-- Paid -->
                        <span class="float:right"><a href="paid.php" data-title="Paid Fee"
                                class="btn btn-secondary col-md-1 col-sm-6 float-right">
                                <i class="fa fa-plus"></i> Paid
                            </a></span>

                        <!-- Export -->
                        <span class="float:right"><a class="btn btn-success col-md-1 col-sm-6 float-right"
                                data-title="Export as excel" href="exportPayment.php">
                                <i class="fas fa-file-excel"></i> Export
                            </a></span>

                <?php   } 
                ?>
                    </div>
                <div class="card-body">
                    <div id="PaymentTableContent"> <!-- Payments table will be rendered here! --> </div>
                </div>
            </div>
          </div>
        </div>
    </div>
<script src="./custom.js"> </script>
<script>

function readRecords() {
        var rd = 'rd';
        $.ajax({
            type: "post",
            url: "fetchPaymentsTable.php",
            data: {rd:rd},
            success: function (response) {
                $("#PaymentTableContent").html(response); 
            }
        });
    }
$(document).ready(function () {
    readRecords();
});

        function deletePayment(id)
        {
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
                    url: "DeletePayment.php", 
                    data: {id:id},
                    success:function(data,status) 
                    {
                        readRecords();
                        toaster("Payment has been deleted permanently!",5);
                    }
                });
                }
            }));
        }

function Print() {
    window.print();
    printButton.style.scale = '60';
}

$('#new_payment').click(function() {
    uni_modal(
        "Receipt No: <?php $qryyy="select MAX(Receipt_no) from payments";$reult=mysqli_query($conn,$qryyy);while($dataa = mysqli_fetch_assoc($reult)){echo $o = $dataa['MAX(Receipt_no)']+1;} ?>
        <?php
                            date_default_timezone_set("Asia/Karachi");
                            echo "<div class='floating'><p class='float-right'>Receiving date: ". date("Y-m-d h:i:s") ."</p></div>"; ?>",
        "manage_payment.php", "mid-large")
})

$('.view_payment').click(function() {
    uni_modal("Payment Details", "view_payment.php?ef_id=" + $(this).attr('data-ef_id') + "&pid=" + $(this)
        .attr('data-id'), "mid-large")

})
$('.edit_payment').click(function() {
    uni_modal("Manage Payment", "manage_payment.php?id=" + $(this).attr('data-id'), "mid-large")

})
$('.delete_payment').click(function() {
    _conf("Are you sure to delete this payment?", "delete_payment", [$(this).attr('data-id')])
})
 </script>