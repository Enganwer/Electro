<?php              include "../dbinfo.php"; ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

 		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
 		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 		<!--[if lt IE 9]>
 		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 		<![endif]-->
		
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +201550327520</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> elctro@hotmail.com</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="login.php"><i class="fa fa-user-o"></i> 
						<?php

                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
							
                            //    $_SESSION["uun"]="ahmed";
                            if (isset($_SESSION["uun"]))
                            {
                                $un=$_SESSION["uun"];
                                echo "$un" ;
                            }

                            else echo "My Account";

                            ?>
						</a></li>
						

						<?php

                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            if (isset($_SESSION["uun"]))
                            {
                                $un=$_SESSION["uun"];
                                echo '                       <li>  <a class="login" href="process/logout.php"><i class="fa fa-user-o"></i>  Logout';
                            }


                            ?></li>
                    </a>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form method="get" action="search.php" >
									<input class="input" placeholder="Search here" name="search" id="search">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
						
					<?php

						if (session_status() == PHP_SESSION_NONE) {
							session_start();
						}

						if (!isset($_SESSION["uun"]))
						   $uun=session_id();
						else
							$uun=$_SESSION["uun"];
												
						$totalprice=0;
						$cn1=mysqli_connect(Host,UN,PW,DBname);
						$cn2=mysqli_connect(Host,UN,PW,DBname);
						$rslt1=mysqli_query($cn1,"call view_intialcart('$uun')");
						
						
						?>
								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?php echo $rslt1->num_rows?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
										<?php 
										 if($rslt1->num_rows==0)echo 'Cart is empty' ;
										 else{
												while ($arr1=mysqli_fetch_array($rslt1))
												{
													$pid=$arr1[0];
													$rslt2=mysqli_query($cn2,"select img from product_images where product_id=$pid limit 1");
													$arr2=mysqli_fetch_array($rslt2);													?>
											<div class="product-widget">
												<div class="product-img">
													<img src="<?php echo $arr2[0]; ?>" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="product.php?id=<?php echo $arr1[0]; ?>"><?php echo $arr1[1]; ?></a></h3>
													<h4 class="product-price"><span class="qty"><?php echo $arr1[4]; ?>x</span>$<?php echo $arr1[5]; ?></h4>
												</div>
												
												<a href="process/cartproc.php?pid=<?php echo $arr1[0];?>&proc=rem" class="delete"><i class="fa fa-close"></i></a>
											</div>
										 <?php 
										                         $totalprice+=$arr1[5];

										 }} ?>
										</div>
										<div class="cart-summary">
											<small><?php echo $rslt1->num_rows?> Item(s) selected</small>
											<h5>TOTAL: $<?php echo $totalprice; ?></h5>
										</div>
										<div class="cart-btns">
											<a href="cart.php">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						 <?php
                    $cn=mysqli_connect(Host,UN,PW,DBname);
                    $rslt=mysqli_query($cn,"select * from categories");
                    while ($arr2=mysqli_fetch_array($rslt))
                    {
                        $cat_id=$arr2[0];
						?>
						<li><a href=<?php echo"fcategory.php?fcat=$cat_id"?> > <?php echo $arr2[1] ?></a></li>
					<?php } ?>
						<li><a href="../vendor/login.php">Vendor Login</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>