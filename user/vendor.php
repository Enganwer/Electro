
<?php
if (isset($_GET["vid"]))
{
    //include "../dbinfo.php";
    include "header.php";
    $vid=$_GET["vid"];
    $cn=mysqli_connect(Host,UN,PW,DBname);

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
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
        .droid-arabic-naskh{font-family: 'Droid Arabic Naskh', serif;}
        body{font-family:  'Droid Arabic Naskh', serif;}
    </style>
</head>
<body>

<div class="men">
    <div class="container">
        <div class="col-md-4 sidebar_men">
            <h3 style="text-align: right">بيانات التاجر</h3>
            <ul class="product-categories color" dir="rtl" style="width: 250px">
                <?php
                $cn1=mysqli_connect(Host,UN,PW,DBname);
                $cn2=mysqli_connect(Host,UN,PW,DBname);

                $rslt1=mysqli_query($cn1,"select * from users where id=$vid");
                $arr1=mysqli_fetch_array($rslt1);
//id, user_name, password, full_name, mobile, role, adress, img
                echo "<li class='cat-item cat-item-42'> <img class='img-responsive' src='$arr1[7]'> </li>";
                echo "<h4><li class='cat-item cat-item-42'>اسم التاجر: $arr1[3]</li>";
                    echo "<li class='cat-item cat-item-42'>رقم الجوال: $arr1[4]</li>";
                    echo "<li class='cat-item cat-item-42'>العنوان: $arr1[6]</li></h4>";
               ?>
            </ul>
            <h3 dir="rtl">التعليقات</h3>



            <ul class="tab_list" dir="rtl">
                <?php
                $cn3=mysqli_connect(Host,UN,PW  ,DBname);
                $rslt3=mysqli_query($cn3,"call view_vendorrating('$vid')");
                while ($arr3=mysqli_fetch_array($rslt3))
                {

                    ?>
                    <li><?php echo "$arr3[2]: تفييم $arr3[0]/5" ;?><br> التعليق: <?php echo "$arr3[1]"?></li>

                <?php } ?>
            </ul>



            <div dir="rtl" class="col-md-12 account-top" style="float: right">
                <form method="post" action="<?php  if(isset($_SESSION['uun'])) echo 'process/ratevendor.php'; else  echo 'login.php'; ?>"  class="demo-form" data-parsley-validate="">
                    <div>
                        <span>التعليق</span>
                        <input type="text"  name="msg"  required="">
                    </div>
                    <div>
                        <span class="pass" name="rate">التقييم</span>
                        <select  name="rate">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <input type="hidden" name="vid" value="<?php echo $vid ?>">
                    <input type="submit" value="قيم التاجر">
                    <script>
                        $(function(){
                            $('.parsley-validate').parsley();
                        })
                    </script>
                </form>
            </div>
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
                    $cn3=mysqli_connect(Host,UN,PW,DBname);
                    $cn4=mysqli_connect(Host,UN,PW,DBname);

                    $rslt2=mysqli_query($cn3,"select product_id, product_name, product_desc, price from products where vendor_id='$vid'  and product_status='accepted'");
                    while ($arr2=mysqli_fetch_array($rslt2))
                    {
                        $pid=$arr2[0];
                        $rslt3=mysqli_query($cn4,"select img from product_images where product_id=$pid limit 1");
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

