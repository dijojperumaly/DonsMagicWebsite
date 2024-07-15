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
$image_2="";
$image_3="";
$image_4="";
$status="";
$size="";

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT  id, 
        IFNULL(p.title,'')title, 
        IFNULL(p.producttype_id,'') producttype_id, 
        p.product_code, 
        IFNULL(p.aboutproduct,'') aboutproduct, 
        IFNULL(p.MRP,'') MRP, 
        IFNULL(p.offerprice,'') offerprice, 
        CASE WHEN IFNULL(p.isfeatured,0)=0 THEN 'NO' ELSE 'YES' END isfeatured , 
        IFNULL(p.orderno,0) orderno, 
        p.image_1,
        p.image_2,
        p.image_3,
        p.image_4,
        IFNULL(p.STATUS,'Active') status,
        IFNULL(p.orderno,0) orderno,
        IFNULL(p.label,'') label,
        IFNULL(p.color,'') color,
        GROUP_CONCAT(s.size  ORDER BY s.orderno ASC) size,
        GROUP_CONCAT(s.size_id  ORDER BY s.orderno ASC) sizeid
        FROM tbl_product p
        LEFT JOIN tbl_availablesizes a On a.product_id=p.id
        LEFT JOIN tbl_size s ON a.size_id=s.size_id
        WHERE IFNULL(p.isdeleted,0)=0  AND p.id=$id
        GROUP BY p.id";
       
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
        $image_2=$row["image_2"];
        $image_3=$row["image_3"];
        $image_4=$row["image_4"];
        $sizeid=$row["sizeid"];
        $label=$row["label"];
        $color=$row["color"];
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
    <style>
		.holder {
			height: 250px;
			width: 250px;
			border: 0px solid black;
			display:none;
		}

		.holder img {
			max-width: 250px;
			max-height: 250px;
			min-width: 250px;
			min-height: 250px;
		}

		input[type="file"] {
			margin-top: 5px;
		}

		.heading {
			font-family: Montserrat;
			font-size: 45px;
			color: green;
		}
	</style> 
</head>
<body>
    <?php require_once("admin_header.php")?>
    <input type="hidden" name="hdsize" id="hdsize" value="<?php echo $sizeid; ?>">
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
                        <label for="imgholder">Image&nbsp;(800x1000 px) (file size max:1MB) Max no of Images:4
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="" id="imgholder" <?php if(trim($image_1)!=""){ echo "style='display:block; width:100%;'";} ?>> <!-- class="holder" -->
                                <?php                                 
                                    if($image_1!=""){
                                        echo '<div class="img-div" id="img-editdiv1" >'.
                                        '<img id="imgPreview" class="img-responsive image img-thumbnail" src="../images/products/'.$image_1.'" alt="pic" style="margin:2px;"/>'.
                                        '<div class="middle"><button id="action-icon-edit" value="img-editdiv1" class="btn btn-danger" role="'. $image_1 .'" tag="1">'.
							            '<i class="fa fa-trash" aria-hidden="true"></i></i></button></div></div><div class="clear-fix"></div>';
                                    } 
                                    if($image_2!=""){
										echo '<div class="img-div" id="img-editdiv2">'.
                                        '<img id="imgPreview" class="img-responsive image img-thumbnail" src="../images/products/'.$image_2.'" alt="pic" style="margin:2px;"/>'.
										'<div class="middle"><button id="action-icon-edit" value="img-editdiv2" class="btn btn-danger" role="'. $image_2 .'" tag="2">'.
							            '<i class="fa fa-trash" aria-hidden="true"></i></i></button></div></div><div class="clear-fix"></div>';
                                    } 
                                    if($image_3!=""){
										echo '<div class="img-div" id="img-editdiv3">'.
                                        '<img id="imgPreview" class="img-responsive image img-thumbnail" src="../images/products/'.$image_3.'" alt="pic" style="margin:2px;"/>'.
										'<div class="middle"><button id="action-icon-edit" value="img-editdiv3" class="btn btn-danger" role="'. $image_3 .'" tag="3">'.
							            '<i class="fa fa-trash" aria-hidden="true"></i></i></button></div></div><div class="clear-fix"></div>';
                                    } 
                                    if($image_4!=""){
										echo '<div class="img-div" id="img-editdiv4">'.
                                        '<img id="imgPreview" class="img-responsive image img-thumbnail" src="../images/products/'.$image_4.'" alt="pic" style="margin:2px;"/>'.
										'<div class="middle"><button id="action-icon-edit" value="img-editdiv4" class="btn btn-danger" role="'. $image_4 .'" tag="4">'.
							            '<i class="fa fa-trash" aria-hidden="true"></i></i></button></div></div><div class="clear-fix"></div>';
                                    } 
                                                                   
                                ?>                                
						</div>	
						<p>
                        <div class="form-group" style="clear:both;">
							<div id="image_preview" style="width:100%;">

							</div>
						</div>
						</p>
                        <div class="form-group">
                            <input type="hidden" id="hdimagefile" name="hdimagefile" value="<?php echo $image_1; ?>">                            
                            <input type="file" class="form-control" name="imagefile" id="imagefile" accept="image/x-png,image/gif,image/jpeg,image/jpg" multiple="multiple">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>                   
                        <label for="cname">Title &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control">
                        </div>
                        <label for="cname">Label &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <select name="label" id="label" class="form-control">                                
                                <option value="">---No Label----</option>
                                <?php
                                foreach($productlabelarray as $prolabel){                                       
                                ?>
                                    <option <?php if($prolabel==$label){echo "selected";} ?> value="<?php echo $prolabel; ?>"><?php echo $prolabel; ?></option>
                                <?php
                                }
                                
                                ?>
                            </select>
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
                        <label for="housename">Colour &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="color" id="color" value="<?php echo $color; ?>" class="form-control">
                        </div>
                        <label for="contact1">About Product&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <textarea name="aboutproduct" id="aboutproduct" class="form-control" rows="7"><?php echo $aboutproduct; ?></textarea>
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

                /*const photoInp = $("#imagefile");
				let file;

				photoInp.change(function (e) {
				file = this.files[0];
					if (file) {
						let reader = new FileReader();
						reader.onload = function (event) {
							$("#imgPreview")
								.attr("src", event.target.result);
						};
						reader.readAsDataURL(file);
						$("#imgholder").css("display","block");
					}
					else{
						$("#imgPreview")
								.attr("src", "");
						$("#imgholder").css("display","none");
					}
				});
*/

                function showChosen(){
					$(".chosen-select").chosen({
						width: "100%",
						no_results_text: "Oops, nothing found!",
					});	
				}

                function resetForm() {
					$('#form_save')[0].reset();
					//$('#form_edit')[0].reset();
                    $("#imgPreview")
								.attr("src", "");
						$("#imgholder").css("display","none");
				}

				function resetMessage() {
					$('div[role="alert"]').attr("display:none");
				}

                function sizeFill() {
					var cat_id = this.value!=""?this.value:-1;
                    var sizeArray=$("#hdsize").val().split(",");
                    					
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
                                let select="";
                                if ($.inArray(value.size_id, sizeArray) != -1)
                                {
                                    select='selected'
                                }
								s += '<option '+ select +' value="' + value.size_id + '" '+' >' + value.size + '</option>';
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
                sizeFill();

                $("#form_save").validate({
					rules: {
						producttype: {
							required: true,
						},
						mrp: {
							required: true,
                            number:true,
						},	
                        orderno: {							
                            number:true,
						},						
					},

					messages: {
						producttype: {
							required: "Please specify product type",
						},
						mrp: {
							required: "Please enter MRP",
                            number: "Number only",
						},	
                        orderno: {
                            number: "Number only",
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
						//data.append("imagefile", file_data[0]); 

						//multifile upload
						for (var i = 0; i < file_data.length; i++) {
						    data.append("imagefile[]", file_data[i]);
						}
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
								//alert(response);												
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
									ShowAlert("", "error:Not saved! please enter correct data", "danger");
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

// Multiple images preview in browser start
				$.validator.addMethod('maxSize', function (value, element, param) {
					return this.optional(element) || (element.files[0].size <= param)
				}, 'File size must be less than {0} KB');

				$('#form-upload').validate({
					/* maxSize value should be provided in kb e.g (1048576 * 1) for 1MB */
					rules: {
						"images[]": { required: true,  accept:"image/jpeg,image/png,image/jpg", maxSize: 1048576}
					},
					messages: {
						"images[]": {
							required: 'No file has been chosen yet.',
							accept: 'Please upload .png or .jpg or .jpeg format',
							maxSize: `Image size cannot be greater than {0} KB.`
						}
					},
					onblur: "true",
					onfocus: "true",
					errorClass: "help-block",
					errorElement: "strong",
					highlight: function (element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					unhighlight: function (element) {
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
					},
					errorPlacement: function (error, element) {
						if (element.parent('input-group').length) {
							error.insertAfter(element.parent())
							return false
						} else {
							error.insertAfter(element)
							return false
						}
					}
				});

				var fileArr = [];
				$("#imagefile").change(function () {
					// check if fileArr length is greater than 0
					$("#filesizemessage").html("");
					if (fileArr.length > 0) fileArr = [];

					$('#image_preview').html("");
					var total_file = document.getElementById("imagefile").files;

					var i;
					let filemoresize="";
					if (!total_file.length) return;
					for (i = 0; i < total_file.length; i++) {
						if (total_file[i].size > 1048576) {
							//document.querySelector('#submit-btn').setAttribute('disabled', true);							
							//return false;
							filemoresize+= total_file[i].name + ", ";
						} else {
							fileArr.push(total_file[i]);
							$('#image_preview').append("<div class='img-div' id='img-div" + i + "'>"+
							"<img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-responsive image img-thumbnail'>"+							
							"<div class='middle'><button id='action-icon' value='img-div" + i + "' class='btn btn-danger' role='" + total_file[i].name + "'>"+
							"<i class='fa fa-trash' aria-hidden='true'></i></i></button></div></div><div class='clear-fix'></div>");
							//$('#submit-btn').prop('disabled', false);
						}
					}					
					document.getElementById('imagefile').files = FileListItem(fileArr);
					if(filemoresize!=""){
						$("#filesizemessage").html(filemoresize+ " these files size is more than 1MB ");
					}					
				});
				
				$('body').on('click', '#action-icon-edit', function (evt) {
					var divName = this.value;
					var fileName = $(this).attr('role');
					var field = $(this).attr('tag');
					var id = $('#hdid').val();
					
					bootbox.confirm({
						//title: "Delete",
						onEscape: true,
						size: 'small',
						message: 'Are you sure? do you want to delete!',
						buttons: {
							confirm: {
								label: 'Yes',
								className: 'btn-danger'
							},
							cancel: {
								label: 'No',
								className: 'btn-success'
							}
						},
						callback: function(result) {
							if (result) {								
								$.ajax({
									type: "GET", //we are using POST method to submit the data to the server side
									url: "product_img_remove.php?delid=" + id+"&fileName="+fileName+"&field="+field, // get the route value								
									//data: JSON.stringify({delcid:id}), // our serialized array data for server side
									timeout: 100,
									async: false,
									beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click
										//$this.attr('disabled', true).html("Processing...");
										$(".se-pre-con").fadeIn("slow");
									},
									success: function(response) { //once the request successfully process to the server side it will return result here
										//$this.attr('disabled', false).html($caption);
										//alert(response);
										try {
											var json = $.parseJSON(response);
											//var json = JSON.parse(response);
											var res_status = json["status"];
											if (res_status == "success") {
												//ShowAlert("", "Successfully Deleted ", "success");
												$(`#${divName}`).remove();												
											} else {
												ShowPopUpAlert("", "Not saved! please enter correct data", "danger");												
											}
										} catch (e) {
											ShowPopUpAlert("", "Not saved! please enter correct data/try after sometime", "danger");											
										}
									},
									complete: function(data) {
										// Hide image container
										$(".se-pre-con").fadeOut("slow");										
									},
									error: function(XMLHttpRequest, textStatus, errorThrown) {
										ShowPopUpAlert(textStatus, errorThrown, "danger");
										$(".se-pre-con").fadeOut("slow");										
									}
								});
							}
						}
					});
									
					evt.preventDefault();
				})

				$('body').on('click', '#action-icon', function (evt) {
					var divName = this.value;
					var fileName = $(this).attr('role');
					var total_file = fileArr;

					for (var i = 0; i < fileArr.length; i++) {
						if (fileArr[i].name === fileName) {
							fileArr.splice(i, 1);
						}
					}

					document.getElementById('imagefile').files = FileListItem(fileArr);
					$(`#${divName}`).remove();
					evt.preventDefault();
				})
				function FileListItem(file) {
					file = [].slice.call(Array.isArray(file) ? file : arguments)
					for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
					if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
					for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
					return b.files
				} 

// Multiple images preview in browser end
            });
    </script>
</body>
</html>

