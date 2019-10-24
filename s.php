<!DOCTYPE HTML>
<html>
<head>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="parsley.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <!--webfont-->
    <link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Dorsa' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="parsley.min.js"></script>
    <!-- start menu -->
    <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="js/jquery.easydropdown.js"></script>
    <script src="js/simpleCart.min.js"> </script>
</head>
<body>

<div class="men_banner">
    <div class="container">
        <div class="header_top">
            <div class="header_top_right">

                <ul class="header_user_info">
                    <a class="login" href="login.php">
                        <i class="user"> </i>
                        <li class="user_desc"><?php

                            session_start();
                            if (isset($_SESSION["uun"]))
                            { $un=$_SESSION["uun"];
                                echo "$un" ;
                            }
                            else echo "My Account";
                            ?></li>
                    </a>
                    <div class="clearfix"> </div>
                </ul>
                <?php
                //session_start();
                if (isset($_SESSION["uun"]))

                    echo "
                <ul class=\"header_user_info\">
                    <a class=\"login\">
                        <i class=\"user\"> </i>
                        <li class=\"user_desc\"><a class=\"login\" href=\"process/logout.php\">Logout</a>

                            
                            </li>
                    </a>
                    <div class=\"clearfix\"> </div>
                </ul>"; ?>
                <!-- start search-->
                <div class="search-box">
                    <div id="sb-search" class="sb-search">
                        <form action="search.php" method="get">
                            <input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
                            <input class="sb-search-submit" type="submit" value="">
                            <span class="sb-icon-search"> </span>
                        </form>
                    </div>
                </div>
                <!----search-scripts---->
                <script src="js/classie1.js"></script>
                <script src="js/uisearch.js"></script>
                <script>
                    new UISearch( document.getElementById( 'sb-search' ) );
                </script>
                <!----//search-scripts---->
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="header_bottom">
            <div class="logo">
                <h1><a href="index.php"><span class="m_1">S</span>m<span class="m_1">S</span>ar</a> &nbsp;&nbsp;&nbsp; </h1>

            </div>
            <br>
            <div class="menu">
                <ul class="megamenu skyblue">
                    <?php
                    include "dbinfo.php";
                    $cn=mysqli_connect(Host,UN,PW,DBname);
                    $rslt=mysqli_query($cn,"select * from categories");
                    while ($arr=mysqli_fetch_array($rslt))
                    {
                        $cat_id=$arr[0];
                        ?>
                        <li><a class="color2" "><?php echo $arr[1]; ?></a>
                        <div class="megapanel">
                        <div class="row">
                        <?php
                        $rslt1=mysqli_query($cn,"select * from sub_categories where mcat_id='$cat_id'");
                        while ($arr1=mysqli_fetch_array($rslt1))
                        {
                            $scat_id= $arr1[0];
                            ?>
                            <div class="col1">
                            <div class="h_nav">
                            <h4><a href="category.php?cat=<?php echo $scat_id ?>"><?php echo $arr1[1] ?></a></h4>
                            <?php
                            while(1==2)
                            {
                                ?>

                                </div>
                                </div>
                                </div>
                                </div>
                                </li>
                            <?php }} }?>
                    <li><a class="color10" href="sellproduct.php">Sell Product</a></li>
                    <li><a class="color3" href="yourproducts.php">Your products</a></li>
                    <div class="clearfix"> </div>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
</div>


</body>
</html>