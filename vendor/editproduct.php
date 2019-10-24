<?php  include 'header.php';
if (!isset($_GET["cnm"])) header("location:viewproducts.php");
else $cnm=$_GET["cnm"];
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Change Product
    </h1>
</section>

<!-- Main content -->
<section class="content " style="height:710px">
    <!-- left column -->
    <div class="col-md-10 col-lg-offset-1">
        <!-- general form elements -->
        <div class="box box-primary">
            <?php
            $cn1=mysqli_connect(Host,UN,PW,DBname);
            $venun=$_SESSION["venun"];
            $rslt1=mysqli_query($cn1,"select product_name, quantity, price from products where product_id='$cnm'");
            $arr1=mysqli_fetch_array($rslt1);
            ?>

            <form id="form" method="post"   action="process/editproductproc.php" >
                <div class="box-body">
                    <div class="form-group">
                        <label for="cid">Product Number</label>
                        <input readonly value="<?php echo $cnm; ?>" class="form-control" id="pid" name="pid"  >
                    </div>
                    <div class="form-group">
                        <label for="cnm">Product Name</label>
                        <input value="<?php echo $arr1[0]; ?>"  class="form-control" id="pnm" name="pnm" placeholder="Product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="cnm">Amount</label>
                        <input value="<?php echo $arr1[1]; ?>" class="form-control" id="qnt" name="qnt" placeholder="Amount" required>
                    </div>
                    <div class="form-group">
                        <label for="cnm">Price</label>
                        <input value="<?php echo $arr1[2]; ?>" class="form-control" id="pr" name="pr" placeholder="Price" required>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <script>
                $('#form').parsley();
            </script>
        </div>
    </div>
</section>

</div>

<?php  include 'footer.php'; ?>



<!-- /.box -->

