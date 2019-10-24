<?php  include "../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
session_start();
if (!isset($_SESSION["venun"]))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
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
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>ال</b>Vendor</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b> Vendor</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <a href="../user/index.php" class="logo">User</a>
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- Tasks: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <?php


                                $un = $_SESSION["venun"];

                                $rslt = mysqli_query($cn, "call user_info('$un')");
                                if ($arr = mysqli_fetch_array($rslt)) {
                                    $name = $arr[0];
                                    $role = $arr[1];
                                    $img = $arr[2];

                            }
                    ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $img ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $name ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo $img ?>" class="img-circle" alt="User Image">

                                <p>
                                    <?php echo $name.'-Vendor' ?>

                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="pull-right">
                                    <a href="process/logout.php" class="btn btn-primary btn-flat">Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>

            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo $img ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $name;  ?></p>
                </div>
            </div>
            <!-- search form -->
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"><?php echo 'Vendor';  ?></li>

                <br>
                <a href="index.php">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i> <span>Reqeusts   </span>
                    </a>

                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-shopping-cart"></i> <span>Products</span>
                        <span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="addproduct.php"><i class="fa fa-plus"></i>Add Product</a></li>
                        <li><a href="viewproducts.php"><i class="fa fa-edit"></i>Change Product</a></li>
                    </ul>
                </li>
                <a href="ordersinday.php">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa  fa-file-text"></i> <span>Reports per Day   </span>
                </a>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->


        <!-- Main content -->

        <!-- /.content -->

    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
        <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
</body>
</html>
