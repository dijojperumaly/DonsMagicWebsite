<?php
ob_start();
include_once("admin/db_connection.php");
include('headerWhite.php');
?>
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
						$status=$row_product["status"];
						$size=$row_product["size"];
						$label=$row_product["label"];
						$color=$row_product["color"];
    ?>
        <!-- left side -->
        <div class="img-card">
            <img src="images/products/<?php echo $image_1; ?>" alt="" id="featured-image" style="margin-left:4px;">
            <!-- small img -->
            <!--<div class="small-Card">
                <img src="images/products/240614231441000000304861.jpg" alt="" class="small-Img">
                <img src="img/small-img-2.png" alt="" class="small-Img">
                <img src="img/small-img-3.png" alt="" class="small-Img">
                <img src="img/image-1.png" alt="" class="small-Img"> 
            </div> -->
        </div>
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
    <script>
        $(document).ready(function() {
            window.callWhatsapp = function(code,size) {                 
                window.open("https://wa.me/918921911289?text=Hi%20There!%20I%20am%20interested%20in%20your%20product%20ID%20"+code+", size:"+size);
            }
        });
    </script>
