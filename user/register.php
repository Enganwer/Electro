<?php
session_start();
if(!empty( $_SESSION["uun"]))
    header("location:index.php");
session_abort();
include "header.php";
?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
					 <form action="process/registration_proc.php" method="post" data-parsley-validate="">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Registration</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="fname" required="" placeholder="Full Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="un" required="" placeholder="UserName">
							</div>
							<div class="form-group">
								<input class="input" type="password" id="pw" name="pw" required="" placeholder="Password">
							</div>
							<div class="form-group">
								<input class="input" type="password" data-parsley-equalto="#pw" required="" placeholder="Re-Password">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" required="" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="mob" required data-parsley-pattern="01\d{9}" placeholder="Telephone">
							</div>
							<input type="submit" class="primary-btn order-submit" align="left" value="Submit !">
    <script>
        $(function(){
            $('.parsley-validate').parsley();
        })
    </script>
	</form>
					
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
