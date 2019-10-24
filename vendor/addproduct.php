<?php  include 'header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        New Product
    </h1>
</section>

<!-- Main content -->
<section class="content " style="height:710px">
    <!-- left column -->
    <div ">
    <!-- general form elements -->
    <div class="box box-primary">

        <!-- /.box-header -->
        <!-- form start -->
        <form id="form" method="post"  action="process/addproductproc.php" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group" style="text-align: left">
                    <label for="un">Product Name</label>
                    <input  class="form-control" id="un" name="un" placeholder="product name"  style="text-align: left" required>
                </div>
                <div class="form-group" style="text-align:left">
                    Categrey Type
                    <select name="cat" class="form-control">
                        <option></option>
                        <?php
                        $cn1=mysqli_connect(Host,UN,PW,DBname);
                        $rslt1=mysqli_query($cn1,"select *  from categories");

                        while ($arr2=mysqli_fetch_array($rslt1))
                        {
                            ?>
                            <option value="<?php echo "$arr2[0]";?>"><?php echo "$arr2[1]";?></option>

                        <?php } ?>
                    </select>
                </div>

                <div class="form-group" style="text-align: left">
                    Brand
                    <select name="brand" class="form-control" >
                        <option></option>
                        <?php
                        $cn1=mysqli_connect(Host,UN,PW,DBname);
                        $rslt1=mysqli_query($cn1,"select *  from brands");

                        while ($arr2=mysqli_fetch_array($rslt1))
                        {
                            ?>
                            <option value="<?php echo "$arr2[0]";?>"><?php echo "$arr2[1]";?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="form-group" style="text-align: left">
                    <label for="quant">Amount</label>
                    <input  class="form-control" id="quant" name="quant" placeholder="Amount"  style="text-align: left" required>
                </div>

                <div class="form-group" style="text-align: left">
                    <label for="Price">Price</label>
                    <input  class="form-control" id="price" name="price" placeholder="Price"  style="text-align: left" required>
                </div>

                <div class="form-group" style="text-align: left">
                    <label for="quant">Describtion</label>
                    <input   class="form-control" id="desc" name="desc" placeholder="Describtion"  style="text-align: left" required>

                </div>

                <div class="form-group" style="text-align: left">
                    <label for="img">Image Product</label>
                    <input type="file" name="files[]" multiple class="form-control"/>

                </div>


                <input type="submit" name="Submit" class="btn btn-primary"/>
            </div>
        </form>

    </div>
    </div>
</section>



</div>

<?php  include 'footer.php'; ?>

<!-- /.box -->

