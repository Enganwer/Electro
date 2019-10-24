<?php  include "../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
session_start();
if (!isset($_SESSION["admun"]))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
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
            <span class="logo-mini"><b></b>Elctro</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Manager</span>
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
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart"></i>
                            <?php
                            $cn1=mysqli_connect(Host,UN,PW,DBname);
                            $rslt2=mysqli_query($cn1,"select count(*) from products  where product_status='pendding'");
                            $arr2= mysqli_fetch_array($rslt2);
                            $count=$arr2[0];

                            ?>
                            <span class="label label-danger"> <?php echo $count; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php

                                $rslt1=mysqli_query($cn1,"select * from pendding_items");
                            while($arr1=mysqli_fetch_array($rslt1)) {
                                $cnm = $arr1[0];

                            ?>
                            <li class="header">You've :  <?php echo $count ?> product to add </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">

                                    <li><!-- Task item -->
                                        <?php echo $arr1[1]   ?>



                                    </li>
                                    <!-- end task item -->
                                </ul>
                                <?php } ?>
                            </li>
                            <li class="footer">
                                <a href="index.php">Show all</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <?php


                                $un = $_SESSION["admun"];

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
                                    <?php echo $name.'- Admin' ?>

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
                <li class="header"><?php echo 'Admin';  ?></li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Users</span>
                        <span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="addadmin.php"><i class="fa  fa-user-plus"></i> Add User </a></li>
                        <li><a href="removeadmin.php"><i class="fa fa-user-times"></i> Delete User</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-shopping-cart"></i> <span>Category</span>
                        <span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="addmcat.php"><i class="fa fa-plus"></i>Add Category</a></li>
                        <li><a href="viewmcat.php"><i class="fa fa-edit"></i>Change Category</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-shopping-cart"></i> <span>Brand</span>
                        <span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="addbrand.php"><i class="fa fa-plus"></i>Add Brand</a></li>
                        <li><a href="viewbrands.php"><i class="fa fa-edit"></i>Change Brand </a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-file-text"></i> <span>Reports</span>
                        <span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="vendorreport.php"><i class="fa fa-file-text-o"></i>Vendor Report</a></li>
                        <li><a href="productsreport.php"><i class="fa fa-file-text-o"></i>Products Report </a></li>
                    </ul>
                </li>


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
