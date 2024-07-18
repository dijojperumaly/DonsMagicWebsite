<?php
ob_start();
include_once("admin/db_connection.php");
include('headerWhite.php');
?>
<style>
img {
  display: block;
  height: auto;
  max-width: 100%;
}

.product-page {
  display: flex;
}

.img-display {
  flex-grow: 1;
  max-width: 372px;
}

.thumb {
  opacity: .7;
  margin: 0 .25rem .25rem 0;
  width: 120px;
  transition: opacity .25s ease-out;
}

.thumb:hover,
.thumb.active {
  opacity: 1;
}

.zoom {
  display: inline-block;
}
</style>
    <div class="pagination">
        <!--<p>Home > Shop > Women > Jacket </p>-->
    </div>
    <!-- product section -->
    <section class="product-container">
    <?php
        if(isset($_REQUEST["id"])){
            $getId=$_REQUEST["id"];
            $sql_products = "SELECT   p.id, 
					IFNULL(p.title,'')title, 
					IFNULL(p.product_code,'')product_code, 
					IFNULL(p.aboutproduct,'') aboutproduct, 
					p.MRP, 
					IFNULL(p.offerprice,'') offerprice, 
					CASE WHEN IFNULL(p.isfeatured,0)=0 THEN 'NO' ELSE 'YES' END isfeatured , 
					IFNULL(p.image_1,'') image_1,
                    IFNULL(p.image_2,'') image_2,
                    IFNULL(p.image_3,'') image_3,
                    IFNULL(p.image_4,'') image_4,
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
                        AND IFNULL(p.id,0)=$getId                        
					GROUP BY p.id 
					ORDER BY IFNULL(p.orderno,0) ASC,p.id DESC";     
					//echo $sql_products;                   
					$product_results = $con->query($sql_products);                                
					if($row_product=$product_results->fetch_array(MYSQLI_ASSOC)){    
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
                        $view_image="";
                        if($image_1!=""){
							$view_image=$image_1;                                            
						}else if($image_2!=""){
							$view_image=$image_2; 
						}else if($image_3!=""){
							$view_image=$image_3; 
						}else if($image_4!=""){
							$view_image=$image_4; 
						}
    ?>
        <!-- left side -->
        <div class="img-card">
            <!--<span class="zoom">-->
                <img src="images/products/<?php echo $view_image; ?>" alt="" id="featured-image" class="zoom" >
            <!--</span>-->
            <!-- small img -->
            <div class="small-Card">                              
                <?php if($image_1!=""){ ?><img src="images/products/<?php echo $image_1; ?>" onclick="currentSlide(this)"  alt="" class="small-Img"><?php } ?>                
                <?php if($image_2!=""){ ?><img src="images/products/<?php echo $image_2; ?>" onclick="currentSlide(this)"  alt="" class="small-Img"><?php } ?>
                <?php if($image_3!=""){ ?><img src="images/products/<?php echo $image_3; ?>" onclick="currentSlide(this)"  alt="" class="small-Img"><?php } ?>
                <?php if($image_4!=""){ ?><img src="images/products/<?php echo $image_4; ?>" onclick="currentSlide(this)"  alt="" class="small-Img"><?php } ?>
            </div> 
        </div>
        <section class="product-page">
            <div class="thumbnails">
                <div class="thumb active">
                <a href="https://i8.amplience.net/i/jpl/jd_334285_a?qlt=92&w=750&h=531&v=1">
                    <img src="https://i8.amplience.net/i/jpl/jd_334285_a?qlt=92&w=750&h=531&v=1" alt="thumb-air-force-right-side">
                </a>
                </div>
                <div class="thumb">
                <a href="https://i8.amplience.net/i/jpl/jd_334285_b?qlt=92&w=950&h=673&v=1">
                    <img src="https://i8.amplience.net/i/jpl/jd_334285_b?qlt=92&w=950&h=673&v=1" alt="thumb-air-force-left-side">
                </a>
                </div>
                <div class="thumb">
                <a href="https://i8.amplience.net/i/jpl/jd_334285_e?qlt=92&w=950&h=673&v=1">
                    <img src="https://i8.amplience.net/i/jpl/jd_334285_e?qlt=92&w=950&h=673&v=1" alt="thumb-air-force-bottom-side">
                </a>
                </div>
            </div>
            <div class="img-display">
                <span class="zoom">
                <img src="https://i8.amplience.net/i/jpl/jd_334285_a?qlt=92&w=750&h=531&v=1" alt="">
                </span>
            </div>
            </section>
        <!-- Right side -->
        <div class="product-info">
            <h3><?php echo $producttype; echo trim($color)!=""?" (".$color.")":""; ?></h3>             										
				<?php echo trim($title); ?>           
                <br>Product ID : <?php echo trim($product_code); ?> 
            <h5>
            <?php 
                    if($status!=$statusarray["SOLDOUT"]){
                    if($offerprice!="" && $offerprice>0){
                        echo "<del>₹ $MRP</del> &nbsp; ₹ $offerprice/-";
                    }else{
                        echo "₹ $MRP/-";
                    }
                }else{
                    if($offerprice!="" && $offerprice>0){
                        echo "<del>₹ $offerprice</del>/-";
                    }else{
                        echo "<del>₹ $MRP</del>/-";
                    }
                    echo '<span class="soldout">'.$statusarray["SOLDOUT"].'</span>';
                }
                ?>
            </h5>
            <p><?php echo $aboutproduct;?></p>           

            <div class="sizes">
                <?php 
                $sizeArray = explode(',', $size);
                if(count($sizeArray)>0){
                ?>
                    <p>Size:</p>
                    <select name="size" id="size" class="size-option">
                        <?php 
                        foreach($sizeArray as $sizevalue){
                        ?>
                        <option value="<?php echo $sizevalue; ?>"><?php echo $sizevalue; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                <?php 
                }
                ?>
            </div>

            <div class="quantity">
                <!--<input type="number" value="1" min="1">-->              
                <button id="btnorder" onClick="callWhatsapp('<?php echo $product_code;?>',size.value)">Order Now</button>
                <button id="btncart" onClick="" class="multiple">Add To Cart</button>
            </div>

            <div>
                <!--<p>Delivery:</p>
                <p>Free shipping on orders above ₹ 599 | All over Kerala.</p>-->
                <!--<div class="delivery">
                    <p>TYPE</p> <p>HOW LONG</p> <p>HOW MUCH</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Standard delivery</p> 
                    <p>1-4 business days</p> 
                    <p>$4.50</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Express delivery</p> 
                    <p>1 business day</p> 
                    <p>$10.00</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Pick up in store</p> 
                    <p>1-3 business days</p> 
                    <p>Free</p>
                </div>-->
            </div>
        </div>
        
        <?php
                }
            }
        ?>
    </section>
    <p>&nbsp;</p><p>&nbsp;</p>
    <!-- script tags -->
    
    <?php
	include("footer.php");
	?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script>
        function currentSlide(obj){
            /*alert(obj.src);
            $("#featured-image").attr("src",obj.src);   
            $('.zoom').zoom();               
          
            /*$('.zoom')
                .zoom({
                url: this.src
                })
                .find('img').attr('src', obj.src);*/

               /* $('#featured-image').imageZoom({
                    zoom : 300
                });  */

                
        }
        $(document).ready(function() {
            $(function() {
                $('.zoom').zoom();
                $('.thumb').on('click', 'a', function(e) {
                    e.preventDefault();
                    var thumb = $(e.delegateTarget);
                    if (!thumb.hasClass('active')) {
                    thumb.addClass('active').siblings().removeClass('active');
                    $('.zoom')
                        .zoom({
                        url: this.href
                        })
                        .find('img').attr('src', this.href);
                    }
                });
            });
            window.callWhatsapp = function(code,size) {                 
                window.open("https://wa.me/918921911289?text=Hi%20There!%20I%20am%20interested%20in%20your%20product%20ID%20"+code+", size:"+size);
            }
        });
    </script>
