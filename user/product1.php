
<?php
if (isset($_GET["id"])) {

    $pid1=$_GET["id"];
    include "header.php";

}
else header("location:404.php");
    ?>

<body>
<div class="men">
    <div class="container">
        <div class="col-md-9 single_top">
            <div class="single_left">
                <div class="labout span_1_of_a1">
                    <div class="flexslider">
                        <ul class="slides">
                              <?php
                              $cn1=mysqli_connect(Host,UN,PW,DBname);
                              $rslt=mysqli_query($cn1,"select img from product_images where product_id='$pid1'");
                              while ($arr=mysqli_fetch_array($rslt))
                              {
                              ?>
                                <li data-thumb="<?php echo $arr[0] ?>">
                                    <img src="<?php echo $arr[0] ?>" />
                                </li>
                                <?php }?>
                                                    </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php $rslt1=mysqli_query($cn,"call view_product('$pid1')");
                $arr1=mysqli_fetch_array($rslt1);
                ?>
                <form dir="rtl"  method="post" action="process/addproducttocart.php">
                    <h1><?php echo $arr1[1];?></h1>
                    <p class="availability">الكميه: <span class="color"><?php  if($arr1[3]==0) echo 'نفذت الكميه';else echo $arr1[3]; ?></span></p>
                    <div class="price_single">
                        <span class="amount item_price actual"><?php echo $arr1[2];?>ر.س.</span>
                    </div>
                    <h2 class="quick"> التقييم: <?php echo $arr1[5];?>/5</h2>
                    <h2 class="quick">المواصفات:</h2>
                    <p class="quick_desc"><?php echo $arr1[4];?></p>

                 <h2 class="quick">التاجر:  <?php echo "<a href='vendor.php?vid=$arr1[6]' class='quick'> $arr1[7] </a>"; ?></h2>

                    <div class="quantity_box">

                        الكميه:

                        <select name="qnt">
                            <?php
                            for($i=1;$i<=$arr1[3];$i++)
                           echo "<option value='$i'>$i</option>";
                            ?>
                        </select>
                            <input type="hidden" name="ppid" value="<?php echo $pid1 ?>">



                            <div class="clearfix"></div>
                        <?php if($arr1[3]>0) echo '
                        <div class=" account-top">
                        <input type="submit"  value="اضافه الي السله " >
                        </div>
                    </div>
'; ?>
                </div>
                <div class="clearfix"> </div>
            </form>
                <br>
                <br>
                <div  dir="rtl">


                    <h3>التعليقات</h3>



                    <ul class="tab_list">
                        <?php
                        $cn2=mysqli_connect(Host,UN,PW  ,DBname);
                        $rslt2=mysqli_query($cn2,"call view_productrating('$pid1')");
                        while ($arr2=mysqli_fetch_array($rslt2))
                        {

                        ?>
                        <li><?php echo "$arr2[2]: تفييم $arr2[0]/5" ;?><br> التعليق: <?php echo "$arr2[1]"?></li>

                        <?php } ?>
                    </ul>
                </div>


                <div dir="rtl" class="col-md-7 account-top" style="float: right">
                <form method="post" action="<?php  if(isset($_SESSION['uun'])) echo 'process/rateproc.php'; else  echo 'login.php'; ?>"  class="demo-form" data-parsley-validate="">
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
                    <input type="hidden" name="ppid" value="<?php echo $pid1 ?>">
                    <input type="submit" value="قيم المنتج">
                    <script>
                        $(function(){
                            $('.parsley-validate').parsley();
                        })
                    </script>
                </form>
                </div>

            </div>
        </div>

        <div class="clearfix"> </div>

    </div>

</div>
<!-- FlexSlider -->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>
</body>
<?php include "footer.php"; ?>