<?php include "header.php";?>
<section class="content-header">
    <h1 style="text-align: center">
        Requset Vendor
    </h1>
</section>

<section class="content" >
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">Cart Number</th>
                            <th style="text-align: center">User Name </th>
                            <th style="text-align: center">Cart Date </th>
                            <th style="text-align: center">User Adress </th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cn1=mysqli_connect(Host,UN,PW,DBname);

                        $rslt1=mysqli_query($cn1,"call view_orders('$un')");
                        while($arr1=mysqli_fetch_array($rslt1))
                        {
                            $cnm=$arr1[0];

                            ?>
                            <tr>
                                <td style="text-align: center"><?php echo "$arr1[0]"; ?></td>
                                <td style="text-align: center"><?php echo "$arr1[1]"; ?></td>
                                <td style="text-align: center"><?php echo "$arr1[2]"; ?></td>
                                <td style="text-align: center"><?php echo "$arr1[3]"; ?></td>
                                <td style="text-align: center"><?php echo "<i class=\"fa fa-edit\"></i> <a href='viewcart.php?cartid=$cnm'>Show the order</a>"; ?></td>
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
