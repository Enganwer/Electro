<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vendor</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../parsley.css">
    <script src="../parsley.min.js"></script>
    <!-- Ionicons -->

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
        .droid-arabic-naskh{font-family: 'Droid Arabic Naskh', serif;}
        body{font-family:  'Droid Arabic Naskh', serif;}
        ::-webkit-input-placeholder { /* WebKit browsers */
            direction: rtl;
        }
        select {
            direction: rtl;
        }
        input{
            direction: rtl;
        }

    </style>
</head>
<body>

<section class="content-header">
    <h1 style="text-align: left">
        Add New Vendor
    </h1>
</section>

<!-- Main content -->
<section class="content " style="height:710px">
    <!-- left column -->
    <div ">
    <!-- general form elements -->
    <div class="box box-primary ">

        <!-- /.box-header -->
        <!-- form start -->
        <form id="form" method="post"   action="process/addvendorproc.php" enctype="multipart/form-data">
            <div style="align: left" >
                <div class="form-group"  style="text-align: left">
                    <label for="un">Vendor Name</label>
                    <input  class="form-control" id="un" name="un" placeholder="Vendor Name" style="text-align: left" required>
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
                <div class="form-group"  style="text-align: left;float: left">
                    <label for="img" style="text-align: left">Image Vendor</label>
                    <input type="file" id="img" name="img" style="align:left">
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="centre">
			<br>
			<br>
			<br>
			<br>
                <button type="submit" name="submit" class="btn btn-primary" align="centre">Submit</button>
            </div>
        </form>
        <script>
            $('#form').parsley();
        </script>
    </div>
    </div>
</section>

</div>
</body>