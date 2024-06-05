<?php
include_once("adminsession.php");
include_once("db_connection.php");
$id=0;
$type="";
$aboutype="";
$noseats="";
$banner="";
$deligate_id=0;
$orderno=0;
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT  retreattype_id, 
        IFNULL(retreattype,'')retreattype, 
        IFNULL(abouttype,'') abouttype,    
        IFNULL(noseats ,0)  noseats,
        IFNULL(deligate_id,0) deligate_id,
        image,   
        IFNULL(orderno,0) orderno
        FROM tbl_retreattype WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  AND retreattype_id=$id";
        
    $results = $con->query($sql);    
  
    if($row=$results->fetch_array(MYSQLI_ASSOC)){  
        $id=$row["retreattype_id"];
        $type=$row["retreattype"];
        $aboutype=$row["abouttype"];        
        $noseats=$row["noseats"];        
        $banner=$row["image"];        
        $deligate_id=$row["deligate_id"];        
        $orderno=$row["orderno"]; 
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
        <div class="card"><a href='retreattype.php'><< back to list</a>
            <div class="card-body">
            <h4 class="card-title">Edit Retreat Type</h4>            
            </p>
            <div class="table-responsive">
              
                <div class="alert alert-dismissible" role="alert" style="display:none;">
                    <strong>Warning!</strong>
                    <p></p>
                </div>
                <p>
                <form method="post" action="retreattype_save" id="form_save" name="form_save" enctype="multipart/form-data">    
                    <input type="hidden" name="hdid" id="hdid" value="<?php echo $id; ?>">                    
                    <label for="cname">Type &nbsp;
                        <span class="at-required-highlight">*</span>
                    </label>
                    <div class="form-group">
                        <input type="text" name="type" id="type" required="true" class="form-control" value="<?php echo $type; ?>">
                    </div>
                    <label for="contact1">About Type&nbsp;
                        <span class="at-required-highlight">*</span>
                    </label>
                    <div class="form-group">
                        <textarea name="aboutype" id="aboutype" class="form-control" required="true" rows="7"><?php echo $aboutype; ?></textarea>
                    </div>                    
                    
                    <label for="housename">Number of Seats &nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <input type="text" name="noseats" id="noseats" class="form-control" value="<?php echo $noseats; ?>">
                    </div>  
                    <label for="housename">Deligate &nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                    <?php 
                    $sql_select = "SELECT  id, 
                        name, 
                        housename 
                        FROM tbl_deligates WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  ORDER BY orderno ASC";                        
                    $select_results = $con->query($sql_select);    
                    ?>
                   
                        <select name="deligate" id="deligate" class="form-control">
                            <option value="">-----select-----</option>
                            <?php
                            while($row_select=$select_results->fetch_array(MYSQLI_ASSOC)){    
                                $id=$row_select["id"];
                                $name=$row_select["name"];
                                $housename=$row_select["housename"];
                            ?>
                            <option value="<?php echo $id; ?>" <?php if($id==$deligate_id){ ?> selected <?php }?>><?php echo $name." ".$housename; ?></option>
                            <?php
                            }
                            $select_results->close();	
                            ?>
                        </select>
                    </div>                     
                    <label for="email">Banner Image&nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <img src="assets/retreattype/type_banner/<?php echo $banner; ?>" alt=""><br><br>
                        <input type="file" class="form-control" name="banner" id="banner" accept="image/x-png,image/gif,image/jpeg">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <label for="email">Order No&nbsp;
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

            </div>
            </div>
        </div>
        </div>

    <?php require_once("admin_fooder.php")?> 

    <script>
			$(document).ready(function() {

                function resetForm() {
					$('#form_save')[0].reset();
					//$('#form_edit')[0].reset();
				}

				function resetMessage() {
					$('div[role="alert"]').attr("display:none");
				}

                $("#form_save").validate({
					rules: {
						type: {
							required: true,
						},
						abouttype: {
							required: true,
                        },
                        noseats:{
                            number:true,
                        }
                        						
					},

					messages: {
						type: {
							required: "Please enter type",
						},
						abouttype: {
							required: "Please enter about retreat type",
                        },
                        noseats: {
							number: "Enter valid number",
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
						var file_data = $('input[name="banner"]')[0].files;
						data.append("banner", file_data[0]); 

                        /*var file_document = $('input[name="document"]')[0].files;
						data.append("document", file_document[0]); */

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
								$this.attr('disabled', true).val("Processing...");
								$(".se-pre-con").fadeIn("slow");
							},
							success: function(response) { //once the request successfully process to the server side it will return result here
								$this.attr('disabled', false).val($caption);
								//alert(response);												
								try {
									//var json = $.parseJSON(response);
									var json = JSON.parse(response);
									if (json["status"] == "success") {
										resetForm();
										//all();
                                        
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
					}
				});
            });
    </script>
</body>
</html>

