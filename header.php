<?php
ob_start();
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
include_once("globelvariables.php");
//echo  $_SERVER['SCRIPT_NAME'];
if(basename(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH))!="login.php"){
	$_SESSION["lasturl"]=$_SERVER['REQUEST_URI'];
}

$account_username="";
$account_phone="";
$account_email="";

if(isset($_SESSION['user_id'])){
	$account_username=isset($_SESSION['user_name'])?$_SESSION['user_name']:"";
	$account_phone=isset($_SESSION['phone'] )?$_SESSION['phone'] :"";
	$account_email=isset($_SESSION['email'])?$_SESSION['email']:"";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dons Magic</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link rel="stylesheet" href="popupStyle/popupstyle.css">-->
<!--===============================================================================================-->
	<!--<link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'> -->
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css"> 
<!--===============================================================================================-->

</head>
<body class="animsition">
	 <!-- WHATS APP SHARE BUTTON STARTING -->
	 <a
      href="https://maps.app.goo.gl/HbEKxLZuqc51WUV18" target="_blank"
      class="floatWatsapp">
      <img src="images/whatsapp.png"  alt="" height="50px" width="50px" />
    </a>
    <!-- WHATS APP SHARE BUTTON ENDING -->
    <!--Floating Call BUTTON STARTING -->
    <a
      href="tel:+918921911289"
      class="floatCallbutton">
      <img src="images/call.png" alt="" height="50px" width="50px" />
    </a>
    <!-- Floating Call BUTTON ENDING -->
	
	<!-- Header -->
	<header class="header-v3">
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">
					
					<!-- Logo desktop -->		
					<a href="." class="logo" style="font-family: 'Gugi'; color: White; font-size: 24px;">
						<img src="images/donslogo.png" alt="IMG-LOGO">
						<!--DONS MAGIC						-->
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href=".">HOME</a>
							</li>

							<li>
								<a href="about.php">ABOUT</a>
							</li>

							<li>
								<a href="newarrival.php">NEW ARRIVALS</a>
							</li>

							<li>
								<a>COLLECTIONS</a>
								<ul class="sub-menu">
								<li><a href="collections.php?type=OW">OUTDOOR CASUAL</a></li>
									<li><a href="collections.php?type=CW,MW">COMFORT WEARS & HOME WEARS</a></li>
									<!-- <li><a href="BodyPositive.php">BODY POSITIVE COLLECTION</a></li> -->
								</ul>
							</li>

							<li>
								<a href="offers.php">OFFERS</a>
							</li>

							<li>
								<a href="ComfortWear.php">OUR AREAS</a>
							</li>
							<!-- <li>
								<a href="index.php">OUR AREAS</a>
								<ul class="sub-menu">
								<li><a href="ComfortWear.php">COMFORT WEAR</a></li>
									<li><a href="CustomDesign.php">CUSTOM DESIGN</a></li>
									<li><a href="StichingUnit.php">STICHING UNIT</a></li>
								</ul>
							</li> -->

							<li>
								<a href="contact.php">CONTACT</a>
							</li>
							<!--<li>
							 	<a href="#"><img src="images/icons/cartw.png" alt="user" width="25"></a>
							</li>-->
							<!--<li>
							 	<a><img src="images/icons/userw.png" alt="user" width="25"></a>
								<ul class="sub-menu">
									<li><a href="profile.php">Profile</a></li>
									<li><a href="signout.php">SignOut</a></li>									
								</ul>	
							</li>-->
							
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m h-full">							
						<div class="flex-c-m h-full p-r-1 bor6 mycartcountdiv" id="mycartcountdiv">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" onclick="show_cartsidebar()" id="mycartdiv"  data-notify="<?php echo count($_SESSION['cart']); ?>">
								<i class="zmdi zmdi-shopping-cart"></i>							
							</div>
							
						</div> 
						<div class="flex-c-m h-full p-r-1 bor6">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-account" data-notify="1">
								<i class="zmdi zmdi-account-circle"></i>
							</div>
						</div> 
							
						<!--<div class="flex-c-m h-full p-lr-19">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
								<i class="zmdi zmdi-menu"></i>
							</div>
						</div>-->
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile" style="height:80px;padding:5px 15px;">
					
			<div class="logo-mobile">
				<!--<a href="index.php"><img src="images/donslogo.png" alt="IMG-LOGO"></a>-->
				<a href="." class="logo" style="font-family: 'Gugi'; color: Black; font-size: 22px;">
					<img src="images/donslogo_black.jpg" alt="IMG-LOGO">
					<!--DONS MAGIC-->
				</a>
				
			</div>

			
			<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
				<div class="flex-c-m h-full p-r-5" id="mycartcountmobilediv">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" onclick="show_cartsidebar()" data-notify="<?php echo count($_SESSION['cart']); ?>">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
				</div>
			</div>
			<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
				<div class="flex-c-m h-full p-r-2">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-account" data-notify="1">
						<i class="zmdi zmdi-account-circle"></i>						
					</div>
				</div>
			</div>  			
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href=".">HOME</a>
				</li>

				<li>
					<a href="about.php">ABOUT</a>
				</li>

				<li>
					<a href="newarrival.php">NEW ARRIVALS</a>
				</li>

				<li>
					<a>COLLECTIONS</a>
					<ul class="sub-menu-m">
						<li><a href="collections.php?type=OW">OUTDOOR CASUAL</a></li>
						<li><a href="collections.php?type=CW,MW">COMFORT WEARS & HOME WEARS</a></li>
						<!-- <li><a href="Comingsoon.php">MATERNITY & NURSING WEAR</a></li> -->
						<!-- <li><a href="BodyPositive.php">BODY POSITIVE COLLECTION</a></li> -->
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="offers.php">OFFERS</a>
				</li>

				<li>
					<a href="ComfortWear.php">OUR AREAS</a>
				</li>

				<!-- <li>
					<a href="index.php">OUR AREAS</a>
					<ul class="sub-menu-m">
					<li><a href="ComfortWear.php">COMFORT WEAR</a></li>
						<li><a href="CustomDesign.php">CUSTOM DESIGN</a></li>
						<li><a href="StichingUnit.php">STICHING UNIT</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li> -->

				<li>
					<a href="contact.php">CONTACT</a>
				</li>
				<!--<li>
					<a><img src="images/icons/userb.png" alt="user" width="25"></a>
					<ul class="sub-menu">
						<li><a href="profile.php">Profile</a></li>
						<li><a href="signout.php">SignOut</a></li>									
					</ul>	
				</li>-->
				<!--<li>
					<a href="#"><img src="images/icons/cartw.png" alt="user" width="25"></a>
				</li>-->

			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<button class="flex-c-m btn-hide-modal-search trans-04">
				<i class="zmdi zmdi-close"></i>
			</button>

			<form class="container-search-header">
				<div class="wrap-search-header">
					<input class="plh0" type="text" name="search" placeholder="Search...">

					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
				</div>
			</form>
		</div>
	</header>


	<!-- Sidebar -->
	<aside class="wrap-sidebar js-sidebar">
		<div class="s-full js-hide-sidebar"></div>

		<div class="sidebar flex-col-l p-t-22 p-b-25">
			<div class="flex-r w-full p-b-30 p-r-27">
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
				<ul class="sidebar-link w-full">
					<li class="p-b-13">
						<a href="." class="stext-102 cl2 hov-cl1 trans-04">
							Home
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							My Wishlist
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							My Account
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							Track Oder
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							Refunds
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							Help & FAQs
						</a>
					</li>
				</ul>

				<div class="sidebar-gallery w-full p-tb-30">
					<span class="mtext-101 cl5">
						@ CozaStore
					</span>

					<div class="flex-w flex-sb p-t-36 gallery-lb">
						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-01.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-01.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-02.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-02.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-03.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-03.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-04.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-04.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-05.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-05.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-06.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-06.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-07.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-07.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-08.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-08.jpg');"></a>
						</div>

						<!-- item gallery sidebar -->
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="images/gallery-09.jpg" data-lightbox="gallery" 
							style="background-image: url('images/gallery-09.jpg');"></a>
						</div>
					</div>
				</div>

				<div class="sidebar-gallery w-full">
					<span class="mtext-101 cl5">
						About Us
					</span>

					<p class="stext-108 cl6 p-t-27">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus vulputate hendrerit. Praesent faucibus erat vitae rutrum gravida. Vestibulum tempus mi enim, in molestie sem fermentum quis. 
					</p>
				</div>
			</div>
		</div>
	</aside>


	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll mycartitemdiv" id="mycartitemdiv">
				<ul class="header-cart-wrapitem w-full">
					<?php 
					$carttotal=0;
					foreach($_SESSION['cart'] as $cartitem){
						$carttotal+=$cartitem["price"];
					?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img" onclick="deleteCartItem(this,<?php echo $cartitem["id"]; ?>)">
							<img src="images/products/<?php echo $cartitem["image"]; ?>" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?php echo $cartitem["type"]; ?>
							</a>

							<span class="header-cart-item-info">
								<?php echo "Rs:". $cartitem["price"]; ?>
							</span>
						</div>
					</li>
					<?php	
						}					
					?>

					<!--<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>-->
					
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: <?php echo $carttotal; ?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="wrap-header-cart js-panel-account">
		<div class="s-full js-hide-account"></div>

		<div class="header-account flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					My Account
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-account">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<?php 
								if((isset($_SESSION["user_id"]))){
								?>
									<img src="images/item-cart-01.jpg" alt="IMG" style="border-radius: 50%;">
								<?php
								}
							?>
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?php echo $account_username; ?>
							</a>
							<span class="header-cart-item-info">
								<?php echo $account_phone; ?>
							</span>
							<span class="header-cart-item-info">
								<?php echo $account_email; ?>
							</span>
						</div>
					</li>

					
				</ul>
				
				<div class="w-full">
					<!--<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>-->
					<div class="header-cart-buttons flex-w w-full">
					<?php 
						if(!isset($_SESSION["user_id"])){						
						?>
							<a href="login.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
								Sign Up
							</a>
							<a href="login.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
								Sign In
							</a>
						<?php
						}else{
						?>
						<a href="logout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Sign Out
						</a>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1 rs2-slick1">
			<div class="slick1">
				<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-12.jpg);" data-thumb="images/thumb-01.jpg" data-caption="Comfort Wear">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Women Collection
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									Comfort Wear
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="newarrival.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-06.jpg);" data-thumb="images/thumb-02.jpg" data-caption="Maternity Wears">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Women Collections
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									Maternity Wears
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="newarrival.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-08.jpg);" data-thumb="images/thumb-03.jpg" data-caption="Women Collections">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
								Women Collections
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									NEW SEASON
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="newarrival.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="wrap-slick1-dots p-lr-10"></div>
		</div>
	</section>
