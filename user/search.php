
<?php
if (isset($_GET["search"]))
{
    $search=$_GET["search"];
    include "header.php";
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
        <div class="col-md-8 mens_right">

            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="cbp-vm-options">
                    <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="grid">Grid View</a>
                    <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="list">List View</a>
                </div>

                <div class="clearfix"></div>
                <ul>
                    <?php
                    $rslt2=mysqli_query($cn,"select product_id, product_name, product_desc, price from products where product_status='accepted' and product_name like '%$search%'	");
                    while ($arr2=mysqli_fetch_array($rslt2))
                    {
                        $rslt3=mysqli_query($cn,"select img from product_images where product_id='$arr2[0]' limit 1");
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

