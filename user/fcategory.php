
<?php
if (isset($_GET["fcat"]))
{
    //include "../dbinfo.php";
    include "header.php";
    $cat_id=$_GET["fcat"];
    $cn=mysqli_connect(Host,UN,PW,DBname);

}
else header("location:404.php");?>
<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
							 <?php
                $cn1=mysqli_connect(Host,UN,PW,DBname);
                $cn2=mysqli_connect(Host,UN,PW,DBname);

                $rslt1=mysqli_query($cn1,"call view_brandscat('$cat_id')");

                while ($arr1=mysqli_fetch_array($rslt1))
                {
                    $scat_id=$arr1[0];
                    $crslt=mysqli_query($cn2,"select count(*) from products where cat_id='$cat_id' and brand_id='$scat_id' and product_status='accepted'");
                    $count=mysqli_fetch_array($crslt);

                    ?>
								<div class="input-checkbox">
										<a href=<?php echo"category.php?cat=$scat_id&fcat=$cat_id"?>>		
										<label for="brand-1">
										<span></span>
										<?php echo $arr1[1] ?>
										<small>(<?php echo $count[0] ?>)</small>
									</label>
									</a>
								</div>
				<?php } ?>
							</div>
						</div>
						<!-- /aside Widget -->

						</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						
						<!-- store products -->
						<div class="row">
							<!-- product -->
							  <?php
                    $cn3=mysqli_connect(Host,UN,PW,DBname);
                    $cn4=mysqli_connect(Host,UN,PW,DBname);

                    $rslt2=mysqli_query($cn3,"select product_id, product_name, product_desc, price from products where cat_id='$cat_id'  and product_status='accepted'");
                    while ($arr2=mysqli_fetch_array($rslt2))
                    {
                        $pid=$arr2[0];
                        $rslt3=mysqli_query($cn4,"select img from product_images where product_id=$pid limit 1");
                        $arr3=mysqli_fetch_array($rslt3);
                        ?>
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="<?php echo $arr3[0] ?>" alt="">
										
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="#"><?php echo $arr2[1] ?></a></h3>
										<h4 class="product-price">$<?php echo $arr2[3] ?></h4>
									
									</div>
									<div class="add-to-cart">
									 <a  href="product.php?id=<?php echo $arr2[0] ?>">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> View Product</button>
										</a>
									</div>
								</div>
							</div>
							<!-- /product -->

							<div class="clearfix visible-sm visible-xs"></div>

					<?php }?>
						</div>
						<!-- /store products -->

					
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
<?php include "footer.php"; ?>

