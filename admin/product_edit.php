<?php
include_once("db_connection.php");
include_once("adminsession.php");
$id="";
$title="";
$producttype_id="";
$product_code="";
$aboutproduct="";
$MRP="";
$offerprice="";
$isfeatured="";
$orderno="";
$image_1="";
$status="";

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT  id, 
        IFNULL(title,'')title, 
        IFNULL(producttype_id,'') producttype_id, 
        product_code, 
        IFNULL(aboutproduct,'') aboutproduct, 
        IFNULL(MRP,'') MRP, 
        IFNULL(offerprice,'') offerprice, 
        CASE WHEN IFNULL(isfeatured,0)=0 THEN 'NO' ELSE 'YES' END isfeatured , 
        IFNULL(orderno,0) orderno, 
        image_1, 
        IFNULL(STATUS,'Active') status,
        IFNULL(orderno,0) orderno
        FROM tbl_product WHERE IFNULL(isdeleted,0)=0  AND id=$id";
        
    $results = $con->query($sql);    
  
    if($row=$results->fetch_array(MYSQLI_ASSOC)){        
        $title=$row["title"];
        $producttype_id=$row["producttype_id"];
        $product_code=$row["product_code"];
        $aboutproduct=$row["aboutproduct"];
        $MRP=$row["MRP"];
        $offerprice=$row["offerprice"];
        $isfeatured=$row["isfeatured"];
        $orderno=$row["orderno"];
        $status=$row["status"];     
        $image_1=$row["image_1"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donsmagic Admin Panel</title>
    <?php require_once("admin_links.php")?>
    <?php require_once("adminsession.php")?>
</head>
<body>
    <?php require_once("admin_header.php")?>
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card"><a href='product.php'><< back to list</a>
            <div class="card-body">
            <h4 class="card-title">EDIT PRODUCT</h4>            
            </p>
            <div class="table-responsive">
              
                <div class="alert alert-dismissible" role="alert" style="display:none;">
                    <strong>Warning!</strong>
                    <p></p>
                </div>
                <p>
                    <form method="post" action="product_save" id="form_save" name="form_save" enctype="multipart/form-data">       
                        <input type="hidden" name="hdid" id="hdid" value="<?php echo $id; ?>">                 
                        <label for="producttype">Product Type &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                        <?php 
                            $sql_select = "SELECT  producttype_id, 
                                producttype,typecode
                                FROM tbl_producttype WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  ORDER BY orderno ASC";                        
                            $select_results = $con->query($sql_select);    
                            ?>
                        
                            <select name="producttype" id="producttype" class="form-control" required="true">
                                <option value="">-----select-----</option>
                                <?php
                                while($row_select=$select_results->fetch_array(MYSQLI_ASSOC)){    
                                    $typeid=$row_select["producttype_id"];
                                    $producttype=$row_select["producttype"];
                                    $typecode=$row_select["typecode"];
                                ?>
                                <option value="<?php echo $typeid; ?>" <?php if($typeid==$producttype_id){ ?> selected <?php }?>> <?php echo $producttype. " (".$typecode.")"; ?></option>
                                <?php
                                }
                                $select_results->close();	
                                ?>
                            </select>
                        </div>                  
                        <label for="cname">Title &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control">
                        </div>

                        <label for="housename">MRP &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="mrp" id="mrp" value="<?php echo $MRP; ?>" class="form-control" required="true">
                        </div>
                        <label for="housename">Offer Price &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="offerprice" id="offerprice" value="<?php echo $offerprice; ?>" class="form-control">
                        </div>
                        <label for="size">Available Sizes &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <img src="images/loader.gif" id="select_preloader" style="display:none;width:20px;"/>
                            <select name="size[]" id="size" data-placeholder="Begin typing a size to filter..." multiple class="form-control chosen-select" style="padding:2px 12px;">
                                <option value="">---select---</option>
                                
                            </select>
                        </div>

                        <label for="contact1">About Product&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <textarea name="aboutproduct" id="aboutproduct" class="form-control" rows="7"><?php echo $aboutproduct; ?></textarea>
                        </div>                        
                        <label for="email">Image&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="hidden" id="hdimagefile" name="hdimagefile" value="<?php echo $image_1; ?>">
                            <img src="../images/products/<?php echo $image_1; ?>" width="250px" /></br></br>
                            <input type="file" class="form-control" name="imagefile" id="imagefile" accept="image/x-png,image/gif,image/jpeg">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>                        
                        <div class="form-group" style="text-align:left;float:left; margin:4px;">
                            <input type="checkbox" class="form-control" name="featured" id="featured" value="1" <?php if($isfeatured=="YES"){ echo "checked";} ?> >                            
                        </div>
                        <label for="featured"  style="text-align:left;float:left;margin:2px;">Is-Featured</label></br></br>
                        <label for="producttype">Status &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="col-lg-4 col-md-4 form-group">
                            <select name="productstatus" id="productstatus" class="form-control" required="true">                                
                                <?php
                                foreach($statusarray as $prostatus){                                       
                                ?>
                                    <option value="<?php echo $prostatus; ?>" <?php if($prostatus==$status){ ?> selected <?php }?>><?php echo$prostatus; ?></option>
                                <?php
                                }
                             
                                ?>
                            </select>
                        </div> 
                        <label for="orderno">Order No&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="col-lg-4 col-md-4 form-group">
                            <input type="number" class="form-control" name="orderno" id="orderno" value="<?php echo $orderno; ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group" style="clear:both;text-align:center;margin:4px;">
                            <p>
                                <input type="button" name="submit" id="submit" value="Update" class="btn btn-primary">
                            </p>
                        </div>
                        <div class="alert alert-dismissible" role="alert" style="display:none;">
                            <strong>Warning!</strong>
                            <p></p>
                        </div>
                    </form>
                </p>
                <a href='product.php'><< back to list</a>
            </div>
            </div>
        </div>
        </div>

    <?php require_once("admin_fooder.php")?> 

    <script>
			$(document).ready(function() {

                function showChosen(){
					$(".chosen-select").chosen({
						width: "100%",
						no_results_text: "Oops, nothing found!",
					});	
				}

                function resetForm() {
					$('#form_save')[0].reset();
					//$('#form_edit')[0].reset();
				}

				function resetMessage() {
					$('div[role="alert"]').attr("display:none");
				}

                function areaFill() {
					var cat_id = this.value!=""?this.value:-1;
					
					$.ajax({
						url: "ajax_jsonlistview.php?valueField=size_id&textField=size&table=tbl_size t1",
						type: "GET",
						cache: false,
						beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click								
							//$(".se-pre-con").fadeIn("slow");
							//$("#size").css('display', 'none');
							$("#select_preloader").css('display', 'block');
						},
						success: function(dataResult) {		
                            //alert(dataResult);
							var data = JSON.parse(dataResult);
							var s = '<option value=""></option>';							
							var isDisable="";
							//alert(data["list1"].length);
							$(data["list1"]).each(function(key, value){	
								s += '<option value="' + value.size_id + '" '+' >' + value.size + '</option>';
							});							
							$("#size").html(s);
							
							//$("#form_save").find('select[name="size[]"]').html(s);
							//$("#form_edit").find('select[name="size[]"]').html(s);
							$("#select_preloader").css('display', 'none');
						    //$("#size").css('display', 'block');
						},
						complete: function(data) {
							showChosen();
							$("#select_preloader").css('display', 'none');
							//$("#size").css('display', 'block');
							
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							showChosen();
							$("#select_preloader").css('display', 'none');
						    //$("#size").css('display', 'block');
						}
					});
				}	
                areaFill();

                $("#form_save").validate({
					rules: {
						title: {
							required: true,
						},
						matter: {
							required: true,
						},						
					},

					messages: {
						title: {
							required: "Please specify news title",
						},
						matter: {
							required: "Please enter matter of news",
						},					
					},
					errorPlacement: function(error, element) {
						error.insertAfter(element);
					}
				});
				$('#submit').click(function() {
					if ($("#form_save").valid()) { // test for validity
                        var $this = $("#submit"); //submit button selector using ID
						var $caption = $this.val(); // We store the html content of the submit button
						var form = "#form_save"; //defined the #form ID
						var formData = $(form).serializeArray(); //serialize the form into array
						var route = $(form).attr('action'); //get the route using attribute action
						
						// Ajax config
						var data = new FormData();

                        //Form data						
                        $.each(formData, function(key, input) {
							data.append(input.name, input.value);
						});

						//File data
						var file_data = $('input[name="imagefile"]')[0].files;
						data.append("imagefile", file_data[0]); 

						//multifile upload
						/*for (var i = 0; i < file_data.length; i++) {
						    data.append("banner[]", file_data[i]);
						}*/
						formData = data;
						// Ajax config

						$.ajax({
							type: "POST", //we are using POST method to submit the data to the server side
							url: route, // get the route value
							data: formData, // our serialized array data for server side
							timeout: 100,
							async: false,
                            processData: false,
                            contentType: false,

							beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click
								$this.attr("disabled", true).val("Processing...");
								$(".se-pre-con").fadeIn("slow");
							},
							success: function(response) { //once the request successfully process to the server side it will return result here
								$this.attr('disabled', false).val($caption);
								alert(response);												
								try {
									//var json = $.parseJSON(response);
									var json = JSON.parse(response);
									if (json["status"] == "success") {
										//resetForm();
										//all();
                                        //window.location.reload();
                                        
										ShowAlert("", "Successfully Updated", "success");
									}else if(json["status"] == "filetype_error") {
										ShowAlert("", "Not saved! invalid file type", "danger");
									}else if(json["status"] == "filesize_error") {
										ShowAlert("", "Not saved! file size exceed", "danger");
									}
                                    else {
										ShowAlert("", "Not saved! please enter correct data", "danger");
									}
								} catch (e) {                                    
									ShowAlert("", "Not saved! please enter correct data", "danger");
								}

								// Reset form

							},
							complete: function(data) {
								// Hide image container
                                $this.attr('disabled', false).val($caption);
								$(".se-pre-con").fadeOut("slow");
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
                                $this.attr('disabled', false).val($caption);
								ShowAlert(textStatus, errorThrown, "danger");
								$(".se-pre-con").fadeOut("slow");
							}
						});
					} else {
						ShowAlert("", "please enter valid data for all required field", "danger");
                        $(".se-pre-con").fadeOut("slow");
					}
				});
            });
    </script>
</body>
</html>

