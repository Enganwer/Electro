<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["uun"]))
   $uun=session_id();
else
    $uun=$_SESSION["uun"];

include "header.php";
?>
<div class="account-in" align="right" ">
    <div class="container">
        <div class="check_box">
            <div class="cart-items">
                <h1 style="text-align: right;font:bold 40px 'Arial Black'">سله المشتريات</h1>

                <?php
                $totalprice=0;
                $cn1=mysqli_connect(Host,UN,PW,DBname);
                $cn2=mysqli_connect(Host,UN,PW,DBname);
                $rslt1=mysqli_query($cn1,"call view_intialcart('$uun')");

                if($rslt1->num_rows==0)echo '<h2>السله فارغه </h2>' ;
                else{
                    while ($arr1=mysqli_fetch_array($rslt1))
                    {
                        // p.product_id,p.product_name,p.quantity,p.price,c.quantity,p.price*p.quantity totalprice

                        $pid=$arr1[0];
                        $rslt2=mysqli_query($cn2,"select img from product_images where product_id=$pid limit 1");
                        $arr2=mysqli_fetch_array($rslt2);

                        ?>


                        <div class="cart-header2">
                            <div class="cart-sec simpleCart_shelfItem" >
                                <a href="process/cartproc.php?pid=<?php echo $arr1[0];?>&proc=rem">
                                    <img align="left" src="images/cross.PNG"> </a>

                                <div class="cart-item cyc" style="float: right;">
                                    <img src="<?php echo $arr2[0]; ?>" class="img-responsive" alt="" />
                                </div>
                                <div class="cart-item-info" style="text-align: right;font-size:25px">

                                    <h3><a href="product.php?id=<?php echo $arr1[0]; ?>"><?php echo $arr1[1]; ?></a></h3>
                                    <ul class="qty" style="  text-align: right;">
                                        <a href="process/cartproc.php?pid=<?php echo $arr1[0];?>&proc=plus"  ><img src="images/plus.jpg" width="26" height="26"> </a> &nbsp;
                                        <a href="process/cartproc.php?pid=<?php echo $arr1[0];?>&proc=min"  ><img src="images/minus.png" width="26" height="26"> </a>
                                        &nbsp;<li style="font:bold 20px 'Arial Black'"><p><span style="font:bold 20px 'Arial Black'">الكميه:</span><?php echo $arr1[4]; ?></p></li>

                                    </ul>
                                    <div class="delivery" style="text-align: right;font:bold 20px 'Arial Black'">
                                        <p style="text-align: right;"> السعر:<?php echo $arr1[3]; ?></p>
                                        <p style="text-align: right">السعر الاجمالي:<?php echo $arr1[5]; ?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>

                        <?php
                        $totalprice+=$arr1[5];
                    }} ?>

                <div class="col-md-10 cart-total">

                    <ul class="total_price" style="float: right">

                        <li class="last_price"><span style="font-weight: bold;"><?php echo $totalprice; ?></span></li>
                        <li class="last_price"> <h4>:الاجمالي</h4></li>
                        <div class="clearfix"> </div>
                    </ul>
                    <div class="clearfix"></div>
                    <div dir="rtl" class="col-md-12 account-top" style="float: right">
                    <form  method="post" class="demo-form" action="process/submit_order.php" >
                        <p style="text-align: right;"> طريقه الدفع:

                        <input type="radio" name="pay" value="cash" checked="checked"> كاش
                        <input type="radio" name="pay" value="paypal"> باي بال
                      <br><br>  <input type="submit" value="تاكيد الطلب" >
                     <!--   <a class="order" href="process/submit_order.php"></a> -->
                    </form>

                    </div>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>



    <?php  include "footer.php"?>



