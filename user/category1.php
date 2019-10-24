
<?php
if (isset($_GET["cat"])and isset($_GET["fcat"]))
{
    include "header.php";
    $scat_id=$_GET["cat"];
    $cat_id=$_GET["fcat"];

}
else header("location:404.php");?>
<head>
    <title>Watches an E-Commerce online Shopping Category Flat Bootstrap Responsive Website Template| Men :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/component.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <!--webfont-->
    <link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Dorsa' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <!-- start menu -->
    <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="js/jquery.easydropdown.js"></script>
    <script src="js/simpleCart.min.js"> </script>
</head>
<body>

<div class="men">
    <div class="container">
        <div class="col-md-4 sidebar_men">
            <h3>Categories</h3>
            <ul class="product-categories color">
                <?php

                $cn1=mysqli_connect(Host,UN,PW,DBname);
                $cn2=mysqli_connect(Host,UN,PW,DBname);

                $rslt1=mysqli_query($cn1,"call view_brandscat('$cat_id')");

                while ($arr1=mysqli_fetch_array($rslt1))
                {
                    $scat_id1=$arr1[0];
                    $crslt=mysqli_query($cn2,"select count(*) from products where cat_id='$cat_id' and brand_id='$scat_id1' and product_status='accepted'");
                    $count=mysqli_fetch_array($crslt);

                    ?>
                    <li class="cat-item cat-item-42"><a href=<?php echo"category.php?cat=$scat_id&fcat=$cat_id"?>><?php echo $arr1[1] ?></a> <span class="count">(<?php echo $count[0] ?>)</span></li>
                <?php }
                ?>
            </ul>
        </div>
        <div class="col-md-8 mens_right">

            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="cbp-vm-options">
                    <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="grid">Grid View</a>
                    <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="list">List View</a>
                </div>

                <div class="clearfix"></div>
                <ul>
                    <?php

                    $cn2=mysqli_connect(Host,UN,PW,DBname);
                    $cn3=mysqli_connect(Host,UN,PW,DBname);
                    $rslt2=mysqli_query($cn2,"select product_id, product_name, product_desc, price from products where cat_id='$cat_id' and brand_id='$scat_id' and product_status='accepted'");
                    while ($arr2=mysqli_fetch_array($rslt2))
                    {
                        $pid=$arr2[0];
                    $rslt3=mysqli_query($cn3,"select img from product_images where product_id=$pid limit 1");
                    $arr3=mysqli_fetch_array($rslt3);
                    ?>
                    <li class="last simpleCart_shelfItem">
                        <a class="cbp-vm-image" href="product.php?id=<?php echo $arr2[0] ?>">
                            <div class="view view-first">
                                <div class="inner_content clearfix">
                                    <div class="product_image">
                                        <div class="mask1"><img src="<?php echo $arr3[0] ?>" alt="image" class="img-responsive zoom-img"></div>

                                        <div class="product_container">
                                            <h4><?php echo $arr2[1] ?></h4>
                                            <p><?php echo $arr2[2] ?></p>
                                            <div class="price mount item_price">ر.س &nbsp;<?php echo $arr2[3] ?></div>
                                            <a class="button item_add cbp-vm-icon cbp-vm-add" href="product.php?id=<?php echo $arr2[0] ?>">تصفح</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
            <script src="js/classie.js" type="text/javascript"></script>
        </div>
    </div>
</div>
</body>
<?php include "footer.php"; ?>

