<?php
include_once("db_connection.php");
include_once("adminsession.php");
$id=0;
$name="";
$housename="";
$address="";
$contact="";
$email="";
$about="";
$profile="";
$message="";
$document_file="";
$image="";			
$orderno="";

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT  id, 
        IFNULL(name,'') name, 
        IFNULL(housename,'') housename, 
        address, 
        IFNULL(contact,'') contact, 
        IFNULL(email,'') email, 
        IFNULL(about,'') about, 
        IFNULL(profile,'') profile, 
        IFNULL(message,'') message, 
        IFNULL(image,'') image, 
        IFNULL(document_file,'') document_file, 
        IFNULL(STATUS,'Active') status,
        IFNULL(orderno,0) orderno
        FROM tbl_deligates WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  AND id=$id";
        
    //echo $sql;
    $results = $con->query($sql);    
  
    if($row=$results->fetch_array(MYSQLI_ASSOC)){        
        $name=$row["name"];
        $housename=$row["housename"];
        $address=$row["address"];
        $contact=$row["contact"];
        $email=$row["email"];
        $about=$row["about"];
        $profile=$row["profile"];
        $message=$row["message"];
        $document_file=$row["document_file"];
        $image=$row["image"];			
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
    <title>db_donswebadmin Admin Panel</title>
    <?php require_once("admin_links.php")?>
   
</head>
<body>

    <?php require_once("admin_header.php")?>
    
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card"><a href='deligates.php'><< back to list</a>
            <div class="card-body">
            <h4 class="card-title">EDIT DELIGATES</h4>            
            </p>
            
            <div class="table-responsive">
              
                <div class="alert alert-dismissible" role="alert" style="display:none;">
                    <strong>Warning!</strong>
                    <p></p>
                </div>
                
                <p>
                    <form method="post" action="deligates_save" id="form_save" name="form_save" enctype="multipart/form-data">   
                        <input type="hidden" name="hdid" id="hdid" value="<?php echo $id; ?>">
                        <img src="assets/deligates/profile_image/<?php echo $image; ?>" width="150px" alt="">
                        <input type="hidden" id="hdimage" name="hdimage" value="<?php echo $image; ?>">
                        </br></br>
                        <label for="imagefile">Profile Image &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="file" class="form-control" name="imagefile" id="imagefile" >
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>                    
                        <label for="cname">Name &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
                        </div>

                        <label for="housename">House Name &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="housename" id="housename" class="form-control" value="<?php echo $housename; ?>">
                        </div>

                        <label for="contact1">Address&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <textarea name="address" id="address" class="form-control" rows="5"><?php echo $address; ?></textarea>
                        </div>
                        <label for="field-1-3">Contact&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="number" name="contact" id="contact" class="form-control" value="<?php echo $contact; ?>">
                        </div>                       
                        <label for="email">Email&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>       
                        <label for="contact1">About&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <textarea name="about" id="about" class="form-control" rows="5"><?php echo $about; ?></textarea>
                        </div>
                        <label for="contact1">Profile&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <textarea name="profile" id="profile" class="form-control" rows="5"><?php echo $profile; ?></textarea>
                        </div> 
                        <label for="contact1">Message&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="5"><?php echo $message; ?></textarea>
                        </div>                                    
                        <label for="email">Document File&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <?php
                            $doc_icon="";
                                if($document_file!=''){
                                    $doc_icon="<a href='./assets/deligates/document/".$document_file."'><i class='fa fa-file-text-o' style='font-size:36px;'></i></a></br></br>";
                                }
                                echo $doc_icon;
                            ?>
                            <input type="hidden" id="hddocument" name="hddocument" value="<?php echo $document_file; ?>">
                            <input type="file" class="form-control" name="document" id="document">
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
                    //$('#form_save')[0].reset();                    
					//$('#form_edit')[0].reset();
				}

				function resetMessage() {
					$('div[role="alert"]').attr("display:none");
				}

                $("#form_save").validate({
					rules: {
						name: {
							required: true,
						},
						housename: {
							required: true,
						},						
					},

					messages: {
						name: {
							required: "Please specify name",
						},
						matter: {
							required: "Please enter house name",
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
                        var file_document = $('input[name="document"]')[0].files;
                        data.append("document", file_document[0]); 
                        
                        //File data						
                        var file_image = $('input[name="imagefile"]')[0].files;
						data.append("imagefile", file_image[0]); 

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
                                        
										ShowAlert("", "Successfully Saved", "success");
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

