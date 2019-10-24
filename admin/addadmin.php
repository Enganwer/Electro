<?php  include 'header.php'; ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="text-align: right">
            Add New Manger
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
                    <form id="form" method="post"   action="process/addadminproc.php" enctype="multipart/form-data" data-parsley-validate="">
                        <div class="box-body">
                            <div class="form-group"  style="text-align: left">
                                <label for="un">User Name</label>
                                <input  class="form-control" id="un" name="un" placeholder="User name" style="text-align: left" required>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <label for="pw" >Password</label>
                                <input type="password" class="form-control" id="pw" name="pw" placeholder="Password" style="text-align: left" required>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <label for="fname" >Full Name</label>
                                <input  class="form-control" id="fname" name="fname" placeholder="Full Name" style="text-align: left" required>
                            </div>

                            <div class="form-group" style="text-align: left">
                                <label for="mob" >Phone</label>
                                <input  class="form-control" id="mob" name="mob" placeholder="Mobile" style="text-align: left" required data-parsley-pattern="01\d{9}">
                            </div>
                            <div class="form-group" style="text-align: left">
                                <label for="address">Address</label>
                                <input  class="form-control" id="address" name="address" placeholder="Address" style="text-align: left" required>
                            </div >
                            <div class="form-group"  style="text-align: left">
                                <label for="img" style="float:left ">Image Manger</label>
                                <br>
                                <input type="file" id="img" name="img" style="float: left" accept="image/*">

                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <script>
                            $(function(){
                                $('.parsley-validate').parsley();
                            })
                        </script>
                    </form>

                    </div>
            </div>
    </section>



</div>

<?php  include 'footer.php'; ?>

                <!-- /.box -->

