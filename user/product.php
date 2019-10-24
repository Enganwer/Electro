<?php
if (isset($_GET["id"])) {

    $pid1=$_GET["id"];
    include "header.php";

}
else header("location:404.php");
    ?>
	<body>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
						 <?php
                              $cn1=mysqli_connect(Host,UN,PW,DBname);
                              $rslt=mysqli_query($cn1,"select img from product_images where product_id='$pid1'");
                              while ($arr=mysqli_fetch_array($rslt))
                              {
                              ?>
							<div class="product-preview">
								<img src="<?php echo $arr[0] ?>" alt="">
							</div>
							  <?php }?>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
					
						<div id="product-imgs">
						 <?php
                              $cn1=mysqli_connect(Host,UN,PW,DBname);
                              $rslt=mysqli_query($cn1,"select img from product_images where product_id='$pid1'");
                              while ($arr=mysqli_fetch_array($rslt))
                              {
                              ?>
						
							<div class="product-preview">
								<img src="<?php echo $arr[0] ?>" alt="">
							</div>
							  <?php } ?>
						
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<?php $rslt1=mysqli_query($cn,"call view_product('$pid1')");
                $arr1=mysqli_fetch_array($rslt1);
                ?>
				                <form   method="post" action="process/addproducttocart.php">

								                            <input type="hidden" name="ppid" value="<?php echo $pid1 ?>">

					<div class="col-md-5">
					
						<div class="product-details">
							<h2 class="product-name"><?php echo $arr1[1];?></h2>
							
							<div>
								<h3 class="product-price"><?php echo $arr1[2];?> $<del class="product-old-price"> </del></h3>
								<span class="product-available">	<?php  if($arr1[3]==0) echo 'Out of stock';else echo 'In stock'; ?></span>
							</div>
							<p>
							<?php echo $arr1[4];?>
							
							<div class="product-options">
								
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<input type="number" name="qnt" value="1" min="0" max="<?php echo $arr1[3];?>" class="form-control" >
								</div>
					 <?php if($arr1[3]>0) echo '
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
								';?>
							</div>
						</form>

							<ul class="product-links">
								<li>Vendor :</li>
								<li><p><?php echo "<p 'vendor.php?vid=$arr1[6]' class='quick'> $arr1[7] </p>"; ?></p></li>
								
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/"target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://aboutme.google.com/u/0/?referer=gplus"target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"target="_blank"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							
								<li><a data-toggle="tab" href="#tab3">Reviews</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											    <p class="quick_desc"><?php echo $arr1[4];?></p>
					
											</div>
									</div>
								</div>
								<!-- /tab1  -->

								
								<!-- tab3  -->
								<!----------------------------------here the code-------------------------->
								<!-- tab3  -->
 
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>Total Rate <?php echo $arr1[5];?> / 5</span>
													
												</div>
												
											</div>
										</div>
										<!-- /Rating -->

						
										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
												<?php
                        $cn2=mysqli_connect(Host,UN,PW  ,DBname);
                        $rslt2=mysqli_query($cn2,"call view_productrating('$pid1')");
                        while ($arr2=mysqli_fetch_array($rslt2))
                        {

                        ?>
													<li>
														<div class="review-heading">
															<h5 class="name"><?php echo "$arr2[2]" ?></h5>
															
															<div class="quick">
<?php echo "$arr2[0]" ;?> from 5 Star																
																</div>
														</div>
														<div class="review-body">
															<p><?php echo "$arr2[1]"?> </p>
															</div>
													</li>
						<?php
						}
						?>
	
												</ul>

											</div>

											</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												
													
												<form method="post"  class="review-form" action="<?php  if(isset($_SESSION['uun'])) echo 'process/rateproc.php'; else 
				echo 'login.php'; ?>" >
													
													<textarea class="input" placeholder="Your Review"  type="text"  name="msg"  required=""></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														      
														<div class="stars">
															<input id="star5" name="rate" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rate" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rate" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rate" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rate" value="1" type="radio"><label for="star1"></label>
														</div>
										
													</div>
					 <input type="hidden" name="ppid" value="<?php echo $pid1 ?>">
													<button class="primary-btn" type="submit" value="submit">Submit</button>
												 <script>
                        $(function(){
                            $('.parsley-validate').parsley();
                        })
                    </script>
												</form>
													
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
	
								
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
