<?php include "header.php";?>
<br>
    <br>

<div class="middle_content"  >
    <div class="container" >
        <h3 style="font-size: 26pt">اهلا وسهلا</h3>
        <p> شركه تكنواونلاين للتجاره الالكترونيه </p>
    </div>
</div>
    <div class="content_middle_bottom">
        <div class="header-left" id="home">
            <section>
                <ul class="lb-album"  style="width: 60%" >
                    <?php
                        $cn1=mysqli_connect(Host,UN,PW,DBname);
                        $cn2=mysqli_connect(Host,UN,PW,DBname);

                        $rslt1=mysqli_query($cn1,"select product_id,product_name from products where product_status='accepted' order by Rand() limit 4 ");

                        while ($arr1=mysqli_fetch_array($rslt1))
                        {
                            $pid=$arr1[0];
                            $rslt2=mysqli_query($cn2,"select img from product_images where product_id=$pid limit 1");
                            $arr2=mysqli_fetch_array($rslt2);
                            ?>


                    <li >
                        <a href="product.php?id=<?php echo $pid ?>">
                            <img src="<?php echo $arr2[0]?>"  class="img-responsive" alt="image01"/>
                            <span><?php echo $arr1[1] ?></span>
                        </a>
                        <div class="lb-overlay" id="image-<?php echo $pid ?>">
                            <a href="#page" class="lb-close">x Close</a>
                            <img src="<?php echo $arr2[0]?>"  class="img-responsive" alt="image01"/>
                            <div>
                                <h3><?php echo $arr1[1] ?></h3>

                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <div class="clearfix"></div>
                </ul>
            </section>
        </div>
    </div>
    </div>
<?php include "footer.php";?>