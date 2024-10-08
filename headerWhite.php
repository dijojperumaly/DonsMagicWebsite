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

<!--	<link rel="stylesheet" href="popupStyle/popupstyle.css"> -->
<!-- ===============================================================================================-->
<!-- <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'> -->
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
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						<!--Free shipping on orders above ₹ 599 | All over Kerala.-->
					</div>

					<div class="right-top-bar flex-w h-full">
						<!-- <a href="#" class="flex-c-m trans-04 p-lr-25">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							My Account
						</a> -->

						<a href="https://www.facebook.com/profile.php?id=61555030816084&mibextid=ZbWKwL" class="flex-c-m trans-04 p-lr-25">
						<i class="fa fa-facebook"></i>
						</a>

						<a href="https://www.instagram.com/donsmagic?igsh=Mzc0OGR1cWdkamcx" target="_blank" class="flex-c-m trans-04 p-lr-25">
						<i class="fa fa-instagram"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					
					<a href="." class="logo" style="font-family: 'Gugi'; color: Black; font-size: 24px;">
						<img src="images/donslogo_black.jpg" alt="IMG-LOGO">
						<!--DONS MAGIC-->
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
							 	<a href="#"><img src="images/icons/cart.png" alt="user" width="25"></a>
							</li>-->
							<!--<li>
							 	<a><img src="images/icons/userb.png" alt="user" width="25"></a>
								<ul class="sub-menu">
								<li><a href="profile.php">Profile</a></li>
								<li><a href="signout.php">SignOut</a></li>									
								</ul>	
							</li>-->
							
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<!--<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>-->
						<div class="flex-c-m h-full p-r-1 bor6 mycartcountdiv" id="mycartcountdiv">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo count($_SESSION['cart']); ?>">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						</div> 
						<!--<a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a> -->
						<div class="flex-c-m h-full p-r-1 bor6">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-account" data-notify="1">
								<i class="zmdi zmdi-account-circle"></i>
							</div>
						</div> 
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile" style="height:80px;padding:5px 15px;"> 
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="." class="logo" style="font-family: 'Gugi'; color: Black; font-size: 24px;">
					<img src="images/donslogo_black.jpg" alt="IMG-LOGO">
						<!--DONS MAGIC-->
					</a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15" id="mycartcountmobilediv">
				<!--<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>-->

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo count($_SESSION['cart']); ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<!--<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>-->				
			</div>
			<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
				<div class="flex-c-m h-full p-r-2">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-account" data-notify="1">
						<i class="zmdi zmdi-account-circle"></i>						
					</div>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">

					<!--Free shipping on orders above ₹ 599 | All over Kerala.-->

					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<!-- <a href="#" class="flex-c-m p-lr-10 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a> -->

						<a href="https://www.facebook.com/profile.php?id=61555030816084&mibextid=ZbWKwL" class="flex-c-m p-lr-10 trans-04">
						<i class="fa fa-facebook"></i>
						</a>

						<a href="https://www.instagram.com/donsmagic?igsh=Mzc0OGR1cWdkamcx" class="flex-c-m p-lr-10 trans-04">
						<i class="fa fa-instagram"></i>
						</a>
					</div>
				</li>
			</ul>

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
						<a><img src="images/icons/cart.png" alt="user" width="25"></a>
					</li>-->
					<!--<li>
						<a><img src="images/icons/userb.png" alt="user" width="25"></a>
						<ul class="sub-menu">
						<li><a href="collections.php">Profile</a></li>
						<li><a href="collections.php">SignOut</a></li>									
						</ul>	
					</li>-->
									

				</ul>
			</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

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
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
				<?php 
					$carttotal=0;
					foreach($_SESSION['cart'] as $cartitem){
						$carttotal+=$cartitem["price"];
					?>
					<li class="header-cart-item flex-w flex-t m-b-12" >
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
							<img src="images/item-cart-03.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
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
						Total:342$
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
