<?php
if (isset($_GET["cartid"])) $cartid=$_GET["cartid"];

else header("location:../index.php?error=inv");

?>
<?php include "header.php";?>

<section class="content-header">
    <h1>
        طلبات التجار
    </h1>
</section>
<?php
$cn2=mysqli_connect(Host,UN,PW,DBname);
$rslt2=mysqli_query($cn2,"select full_name, mobile, adress from users where id=(select client_id from carts where cart_id=$cartid);");
$arr2=mysqli_fetch_array($rslt2);
?>
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group" style="text-align: right">
            <label for="un">اسم العميل</label>
            <input  class="form-control" value=" <?php echo $arr2[0];?>" readonly   >
        </div>
    </div>
    <div class="box-body">
        <div class="form-group" style="text-align: right">
            <label for="un">رقم الجوال </label>
            <input  class="form-control" value=" <?php echo $arr2[1];?>" readonly >
        </div>
    </div>
    <div class="box-body">
        <div class="form-group" style="text-align: right">
            <label for="un">عنوان العميل</label>
            <input  class="form-control" value=" <?php echo $arr2[2];?>" readonly >
        </div>
    </div>

</div>
<section class="content" >
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">اسم المنتج</th>
                            <th style="text-align: center">الكميه</th>
                            <th style="text-align: center">سعر الوحده </th>
                            <th style="text-align: center">اجمالي السعر </th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if(isset($_SESSION['venun']))  $vun = $_SESSION["venun"];
                        else header("target:login.php");
                        $cn1=mysqli_connect(Host,UN,PW,DBname);

                        $rslt1=mysqli_query($cn1,"call dispatch_order2('$cartid','$vun')");
                        while($arr1=mysqli_fetch_array($rslt1))
                        {

                            ?>
                            <tr>
                                <td style="text-align: center"><?php echo "$arr1[0]"; ?></td>
                                <td style="text-align: center"><?php echo "$arr1[1]"; ?></td>
                                <td style="text-align: center"><?php echo "$arr1[2]"; ?></td>
                                <td style="text-align: center"><?php echo "$arr1[3]"; ?></td>

                            </tr>
                        <?php }?>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- Bootstrap 3.3.7 -->
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
</div>

<?php  include 'footer.php'; ?>
