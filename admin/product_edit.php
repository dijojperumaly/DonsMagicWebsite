<?php
include_once("db_connection.php");
include_once("adminsession.php");
$title="";
$sub_title="";
$matter="";
$news_date="";
$start_date="";
$end_date="";
$isfeatured="";
$document_file="";
$image_1="";

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT  id, 
        IFNULL(title,'')title, 
        IFNULL(sub_title,'') sub_title, 
        matter, 
        IFNULL(news_date,'') news_date, 
        IFNULL(start_date,'') start_date, 
        IFNULL(end_date,'') end_date, 
        CASE WHEN IFNULL(isfeatured,0)=0 THEN 'NO' ELSE 'YES' END isfeatured , 
        IFNULL(document_file,'') document_file, image_1, 
        IFNULL(STATUS,'Active') status,
        IFNULL(orderno,0) orderno
        FROM tbl_news WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  AND id=$id";
        
    $results = $con->query($sql);    
  
    if($row=$results->fetch_array(MYSQLI_ASSOC)){        
        $title=$row["title"];
        $sub_title=$row["sub_title"];
        $matter=$row["matter"];
        $news_date=$row["news_date"];
        $start_date=$row["start_date"];
        $end_date=$row["end_date"];
        $isfeatured=$row["isfeatured"];
        $document_file=$row["document_file"];
        $image_1=$row["image_1"];        
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
        <div class="card"><a href='news.php'><< back to list</a>
            <div class="card-body">
            <h4 class="card-title">ADD NEWS</h4>            
            </p>
            <div class="table-responsive">
              
                <div class="alert alert-dismissible" role="alert" style="display:none;">
                    <strong>Warning!</strong>
                    <p></p>
                </div>
                <p>
                    <form method="post" action="news_save" id="form_save" name="form_save" enctype="multipart/form-data">       
                        <input type="hidden" name="hdid" id="hdid" value="<?php echo $id; ?>">                 
                        <label for="cname">Title &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="title" id="title" required="true" class="form-control" value="<?php echo $title; ?>">
                        </div>

                        <label for="housename">Sub Title &nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="subtitle" id="subtitle" class="form-control" value="<?php echo $sub_title; ?>">
                        </div>

                        <label for="contact1">Matter&nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <textarea name="matter" id="matter" class="form-control" required="true"><?php echo $matter; ?></textarea>
                        </div>
                        <label for="field-1-3">Date&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="date" name="date" id="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($news_date)); ?>">
                        </div>
                        <label for="place">Start Date</label>
                        <div class="form-group">
                            <input type="date" name="startdate" id="startdate" class="form-control" value="<?php echo date('Y-m-d',strtotime($start_date)); ?>">
                        </div>
                        <label for="email">End date&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="enddate" id="enddate" value="<?php echo date('Y-m-d',strtotime($end_date)); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>                        
                        <label for="email">Banner&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <input type="hidden" id="hdbanner" name="hdbanner" value="<?php echo $image_1; ?>">
                            <img src="./assets/news/news_banner/<?php echo $image_1; ?>" width="250px" /></br></br>
                            <input type="file" class="form-control" name="banner" id="banner" accept="image/x-png,image/gif,image/jpeg">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <label for="email">Document File&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="form-group">
                            <?php
                            $doc_icon="";
                                if($document_file!=''){
                                    $doc_icon="<a href='./assets/news/news_document/".$document_file."'><i class='fa fa-file-text-o' style='font-size:36px;'></i></a></br></br>";
                                }
                                echo $doc_icon;
                            ?>
                            <input type="hidden" id="hddocument" name="hddocument" value="<?php echo $document_file; ?>">
                            <input type="file" class="form-control" name="document" id="document">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group" style="text-align:left;float:left; margin:4px;">
                            <input type="checkbox" class="form-control" name="featured" id="featured" value="1" <?php if($isfeatured=="YES"){ echo "checked";} ?> >                            
                        </div>
                        <label for="featured"  style="text-align:left;float:left;margin:2px;">Is-Featured</label></br></br>
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
						var file_data = $('input[name="banner"]')[0].files;
						data.append("banner", file_data[0]); 

                        var file_document = $('input[name="document"]')[0].files;
						data.append("document", file_document[0]); 

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
								//alert(response);												
								try {
									//var json = $.parseJSON(response);
									var json = JSON.parse(response);
									if (json["status"] == "success") {
										//resetForm();
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
                        $(".se-pre-con").fadeOut("slow");
					}
				});
            });
    </script>
</body>
</html>

