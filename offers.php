<?php
ob_start();
include('headerWhite.php');
include_once("admin/db_connection.php");
?>
	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
	<div class="container">
			

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>
						<?php 
                            $sql_select = "SELECT  producttype_id, 
							producttype,typecode
							FROM tbl_producttype 
							WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  
							ORDER BY orderno ASC";                        
							$select_results = $con->query($sql_select);                                
							while($row_select=$select_results->fetch_array(MYSQLI_ASSOC)){    
								$id=$row_select["producttype_id"];
								$producttype=$row_select["producttype"];
								$typecode=$row_select["typecode"];
							?>
							<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".<?php echo $typecode; ?>">
								<?php echo $producttype; ?>
							</button>
							<?php
							}
							$select_results->close();	
						?>	
					
				</div>

				<!-- <div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div> -->
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Sort By
							</div>

							<ul>
								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Default
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Popularity
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Average rating
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										Newness
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Price: Low to High
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Price: High to Low
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Price
							</div>

							<ul>
								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										All
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$0.00 - $50.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$50.00 - $100.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$100.00 - $150.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$150.00 - $200.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$200.00+
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col3 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Color
							</div>

							<ul>
								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #222;">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="#" class="filter-link stext-106 trans-04">
										Black
									</a>
								</li>

								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										Blue
									</a>
								</li>

								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="#" class="filter-link stext-106 trans-04">
										Grey
									</a>
								</li>

								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="#" class="filter-link stext-106 trans-04">
										Green
									</a>
								</li>

								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="#" class="filter-link stext-106 trans-04">
										Red
									</a>
								</li>

								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
										<i class="zmdi zmdi-circle-o"></i>
									</span>

									<a href="#" class="filter-link stext-106 trans-04">
										White
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Tags
							</div>

							<div class="flex-w p-t-4 m-r--5">
								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Fashion
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Lifestyle
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Denim
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Streetstyle
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Crafts
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row isotope-grid">
				<?php 
						$sql_products = "SELECT   p.id, 
						IFNULL(p.title,'')title, 
						IFNULL(p.product_code,'')product_code, 
						IFNULL(p.aboutproduct,'') aboutproduct, 
						p.MRP, 
						IFNULL(p.offerprice,'') offerprice, 
						CASE WHEN IFNULL(p.isfeatured,0)=0 THEN 'NO' ELSE 'YES' END isfeatured , 
						p.image_1, 
						IFNULL(p.STATUS,'Active') status,
						IFNULL(p.orderno,0) orderno,
						IFNULL(p.label,'') label,
						IFNULL(p.color,'') color,
						t.producttype_id,
						t.producttype,
						t.typecode,
						GROUP_CONCAT(s.size  ORDER BY s.orderno ASC) size
						FROM tbl_product p LEFT JOIN tbl_producttype t ON t.producttype_id=p.producttype_id
						LEFT JOIN tbl_availablesizes a On a.product_id=p.id
						LEFT JOIN tbl_size s ON a.size_id=s.size_id
						WHERE IFNULL(p.isdeleted,0)=0  
						AND IFNULL(p.STATUS,'Active')!='".$statusarray["DRAFT"]."'
						AND IFNULL(p.offerprice,0)>0
						GROUP BY a.product_id ORDER BY IFNULL(p.orderno,0) ASC,p.id DESC";     
						//echo $sql_products;                   
						$product_results = $con->query($sql_products);                                
						while($row_product=$product_results->fetch_array(MYSQLI_ASSOC)){    
							$typeid=$row_product["producttype_id"];
							$producttype=$row_product["producttype"];
							$typecode=$row_product["typecode"];

							$id=$row_product["id"];
							$title=$row_product["title"];
							$product_code=$row_product["product_code"];
							$aboutproduct=$row_product["aboutproduct"];
							$MRP=$row_product["MRP"];
							$offerprice=$row_product["offerprice"];
							$image_1=$row_product["image_1"];
							$status=$row_product["status"];
							$size=$row_product["size"];
							$label=$row_product["label"];
							$color=$row_product["color"];

						?>
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $typecode; ?>">
							<!-- Block2 -->
							<div class="block2">
							<div class="block2-pic hov-img0 <?php if(trim($label)!=""){ ?>label-new <?php }?>" data-label="<?php echo $label; ?>">
									<img src="images/products/<?php echo $image_1; ?>" alt="IMG-PRODUCT">
									<a href="https://wa.me/919744187391?text=Hi%20There!%20I%20am%20interested%20in%20your%20product%20ID%20<?php echo $product_code; ?> "
									style="background-color: #075e54; color: white;" 
									class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" target="_blank">
										Contact Us
									</a>
								</div>
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="viewmore.php?id=<?php echo $id; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											<?php echo $producttype; echo trim($color)!=""?" (".$color.")":""; ?>										
											<br><?php echo trim($title); ?>
										</a>
										
										<span class="stext-105 cl3">										
											Product ID : <?php echo $product_code; ?>
										</span>

										<span class="stext-105 cl3">									
										<?php 
										if($status!=$statusarray["SOLDOUT"]){
											if($offerprice!="" && $offerprice>0){
												echo "<s>₹ $MRP</s> &nbsp; ₹ $offerprice/-";
											}else{
												echo "₹ $MRP/-";
											}
										}else{
											if($offerprice!="" && $offerprice>0){
												echo "<s>₹ $offerprice</s>/-";
											}else{
												echo "<s>₹ $MRP</s>/-";
											}
											echo '<span class="soldout">'.$statusarray["SOLDOUT"].'</span>';
										}
										if($status!=$statusarray["SOLDOUT"]){
											echo "<br>Size: $size";
										}
										else{
											echo "<br><s>Size: $size</s>";
										}
										
										?>
										</span>
									</div>

									<div class="block2-txt-child2 flex-r p-t-3">
										<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
											<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
											<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php
						}
						$product_results->close();	
					?>				

				
			</div>

			<!-- Pagination -->
			<!-- <div class="flex-c-m flex-w w-full p-t-38">
				<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
					1
				</a>

				<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
					2
				</a>
			</div> -->
		</div>
		
</div>
	<!-- Footer -->
	<?php
	include("footer.php");
	?>