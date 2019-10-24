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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">


					</div>

					<!-- Order Details -->
					<div class="col-md-5.left-account">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
							
							    <?php
                $totalprice=0;
                $cn1=mysqli_connect(Host,UN,PW,DBname);
                $cn2=mysqli_connect(Host,UN,PW,DBname);
                $rslt1=mysqli_query($cn1,"call view_intialcart('$uun')");

                if($rslt1->num_rows==0)echo '<h2>Cart is Empty ! </h2>' ;
                
				else{
                    while ($arr1=mysqli_fetch_array($rslt1))
                    {
                        // p.product_id,p.product_name,p.quantity,p.price,c.quantity,p.price*p.quantity totalprice

                        
                        ?>
					
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>Price</strong></div>
							</div>
							<div class="order-products">
								<div class="order-col">
									<div><?php echo $arr1[4]; ?> x <?php echo $arr1[1]; ?></div>
									<div><?php echo $arr1[3]; ?></div>
								</div>
								
							</div>
								<?php
                        $totalprice+=$arr1[5];
                    }} ?>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								
								<div><strong class="order-total"><?php echo $totalprice; ?></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>We will sent SMS to you.</p>
								</div>
							</div>
							<div class="input-radio">
							<form  method="post" class="demo-form" action="process/submit_order.php" >
								<input type="radio" name="payment" id="payment-2">
								
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>visit :  <a href="www.paypal.com"></p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<input type="submit" value="submit"  class="primary-btn order-submit"></a>
</form>				
				</div>
				
				
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

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
