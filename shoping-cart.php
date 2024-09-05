<?php
ob_start();
include_once("admin/db_connection.php");
include('headerWhite.php');
?>
<style>
.dropdown{
    height: 45px;
	width: 100%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: left;
    border: none;
    outline: none;
    background-color: transparent;
    border-radius: 0px;
    position: relative;
	color: #555;
	padding:10px;	
}
</style>

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
								<?php								
								$pids=0;
								$selPrice=0;
								$totalSelPrice=0;
									foreach($_SESSION['cart'] as $cartarray){
										$pids.=','. $cartarray["id"];
									}									
									$view_image="";
									$sql_products = "SELECT   p.id, 
										IFNULL(p.title,'')title, 
										IFNULL(p.product_code,'')product_code, 
										IFNULL(p.aboutproduct,'') aboutproduct, 
										p.MRP, 
										IFNULL(p.offerprice,'') offerprice, 								
										IFNULL(p.image_1,'') image_1,
										IFNULL(p.image_2,'') image_2,
										IFNULL(p.image_3,'') image_3,
										IFNULL(p.image_4,'') image_4,
										IFNULL(p.STATUS,'Active') status,
										IFNULL(p.label,'') label,
										IFNULL(p.color,'') color,
										t.producttype_id,
										t.producttype,
										t.typecode,
										GROUP_CONCAT(s.size  ORDER BY s.orderno ASC) size
										FROM tbl_product p LEFT JOIN tbl_producttype t ON t.producttype_id=p.producttype_id
										LEFT JOIN tbl_availablesizes a On a.product_id=p.id
										LEFT JOIN tbl_size s ON a.size_id=s.size_id
										WHERE IFNULL(p.isdeleted,0)=0  AND IFNULL(p.STATUS,'Active')!='".$statusarray["DRAFT"]."' 
										AND p.id IN(".$pids.")
										GROUP BY p.id 
										ORDER BY IFNULL(p.orderno,0) ASC,p.id DESC";     
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
										$image_2=$row_product["image_2"];
										$image_3=$row_product["image_3"];
										$image_4=$row_product["image_4"];
										$status=$row_product["status"];
										$size=$row_product["size"];
										$label=$row_product["label"];
										$color=$row_product["color"];

										if($image_1!=""){
											$view_image=$image_1;                                            
										}else if($image_2!=""){
											$view_image=$image_2; 
										}else if($image_3!=""){
											$view_image=$image_3; 
										}else if($image_4!=""){
											$view_image=$image_4; 
										}

										if($offerprice!="" && $offerprice!=0){
											$selPrice=$offerprice;
										}else{
											$selPrice=$MRP;
										}
										$totalSelPrice=$totalSelPrice+$selPrice;
									?>

								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1" onclick="deleteCartItem_CartView(this,<?php echo $id; ?>)">
											<img src="images/products/<?php echo $view_image; ?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?php echo $producttype; ?></td>
									<td class="column-3"><span>&#8377;</span> <?php echo $selPrice; ?></td>
									<td class="column-4">1
										<!--<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>-->
									</td>
									<td class="column-5"><span>&#8377;</span> <?php echo $selPrice; ?></td>
								</tr>
								<?php
									}
								?>
								<!--<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="images/item-cart-05.jpg" alt="IMG">
										</div>
									</td>
									<td class="column-2">Lightweight Jacket</td>
									<td class="column-3">$ 16.00</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product2" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">$ 16.00</td>
								</tr>-->
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
								<span>&#8377;</span> <?php echo $totalSelPrice; ?>
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<!--<select class="js-select2" name="time">-->
										<select class="dropdown" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<span>&#8377;</span><?php echo $totalSelPrice; ?>
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	

	<?php
	include('footer.php');
	?>

	<script>
		function deleteCartItem_CartView(obj,id=0){
			//alert(id);
			$.ajax({
				type: "GET", //we are using POST method to submit the data to the server side
				url: "shoping-cart_delete.php?id="+id, // get the route value	
				//dataType:"json",				
				//data:dataPost,// our serialized json data for server side    				
				timeout: 1000,
				async: false,
				processData: false,
				contentType: false,
			
				beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click
					//$(obj).attr("disabled", true).html("Processing...");
					//$(".se-pre-con").fadeIn("slow");
				},
				success: function(response) { //once the request successfully process to the server side it will return result here
					//objcart.attr("disabled", false).html(caption);					
					//var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
					//alert(response);
					try {
						var json = $.parseJSON(response);
						//var json = JSON.parse(response);		
									
						if (json["status"] == "success") {								
							//swal(type, json["message"], "success");
							$(obj).parent().parent().remove();	

							$.get(location.href, function(data){ 								
								$('#mycartcountdiv').empty().append( $(data).find('#mycartcountdiv').children() );
								return false;
							});
							$.get(location.href, function(data){ 
								$('#mycartcountmobilediv').empty().append( $(data).find('#mycartcountmobilediv').children() );
								return false;
							});
							$.get(location.href, function(data){ 
								$('#mycartitemdiv').empty().append( $(data).find('#mycartitemdiv').children() );
								return false;
							});								
						}else{
							//swal(type, json["message"], "error");
						}
					} catch (e) {                                    
						//ShowAlert("", "Not saved! please enter correct data", "danger");
						//swal(type, "error", e);
					}
					// Reset form
				},
				complete: function(data) {
					// Hide image container
					//$(objcart).attr("disabled", false).html(caption);	
					//$(".se-pre-con").fadeOut("slow");
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//$(objcart).attr("disabled", false).html(caption);	
					//ShowAlert(textStatus, errorThrown, "danger");
					//$(".se-pre-con").fadeOut("slow");
				}
			});						
			
		}
	</script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
		
	</script>

Agra
Aligarh
Allahabad
Ambedkar Nagar
Amethi
Amroha
Auraiya
Azamgarh
Baghpat
Bahraich
Ballia
Balrampur
Banda
Bara Banki
Bareilly
Basti
Bhadohi
Bijnor
Budaun
Bulandshahr
Chandauli
Chitrakoot
Deoria
Etah
Etawah
Faizabad
Farrukhabad
Fatehpur
Firozabad
Gautam Buddha Nagar
Ghaziabad
Ghazipur
Gonda
Gorakhpur
Hamirpur
Hapur
Hardoi
Hathras
Jalaun
Jaunpur
Jhansi
Kannauj
Kanpur Dehat
Kanpur Nagar
Kasganj
Kaushambi
Kheri
Kushinagar
Lalitpur
Lucknow
Mahoba
Mahrajganj
Mainpuri
Mathura
Mau
Meerut
Mirzapur
Moradabad
Muzaffarnagar
Pilibhit
Pratapgarh
Rae Bareli
Rampur
Saharanpur
Sambhal
Sant Kabir Nagar
Shahjahanpur
Shamli
Shrawasti
Siddharthnagar
Sitapur
Sonbhadra
Sultanpur
Unnao
Varanasi
Almora
Bageshwar
Chamoli
Champawat
Dehradun
Garhwal
Hardwar
Nainital
Pithoragarh
Rudraprayag
Tehri Garhwal
Udham Singh Nagar
Uttarkashi
