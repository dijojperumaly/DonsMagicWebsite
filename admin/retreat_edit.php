<?php
include_once("db_connection.php");
include_once("adminsession.php");
$title="";
$sub_title="";
$matter="";
$news_date="";
$start_date="";
$end_date="";
$nodays="";
$noseats="";
$venu="";
$banner="";
$deligate_id=0;
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT  id, 
        IFNULL(retreattype_id,0) retreattype_id,
        IFNULL(title,'')title, 
        IFNULL(subtitle,'') subtitle, 
        matter, 
        IFNULL(retreatstartdate,'') retreatstartdate, 
        IFNULL(retreatenddate,'') retreatenddate, 
        IFNULL(nodays,0) nodays, 
        IFNULL(noseats,0) noseats, 
        startdate, 
        enddate,
        banner,
        venu,
        deligate_id,        
        IFNULL(orderno,0) orderno
        FROM tbl_retreat WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  AND id=$id";
        
    $results = $con->query($sql);    
  
    if($row=$results->fetch_array(MYSQLI_ASSOC)){ 
        $retreattype_id=$row["retreattype_id"];  
        $title=$row["title"];
        $sub_title=$row["subtitle"];
        $matter=$row["matter"];
        $retreatstartdate=$row["retreatstartdate"];
        $retreatenddate=$row["retreatenddate"];
        $startdate=$row["startdate"];
        $nodays=$row["nodays"];
        $noseats=$row["noseats"];
        $enddate=$row["enddate"];
        $banner=$row["banner"];
        $venu=$row["venu"];
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
</head>
<body>
    <?php require_once("admin_header.php")?>
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card"><a href='retreat.php'><< back to list</a>
            <div class="card-body">
            <h4 class="card-title">EDIT RETREAT</h4>            
            </p>
            <div class="table-responsive">
              
                <div class="alert alert-dismissible" role="alert" style="display:none;">
                    <strong>Warning!</strong>
                    <p></p>
                </div>
                <p>
                <form method="post" action="retreat_save" id="form_save" name="form_save" enctype="multipart/form-data">    
                    <input type="hidden" name="hdid" id="hdid" value="<?php echo $id; ?>">                    
                    <label for="retreattype">Retreat Type &nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                    <?php 
                        $sql_select = "SELECT  retreattype_id, 
                            retreattype
                            FROM tbl_retreattype WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  ORDER BY orderno ASC";                        
                        $select_results = $con->query($sql_select);    
                        ?>
                    
                        <select name="retreattype" id="retreattype" class="form-control">
                            <option value="">-----select-----</option>
                            <?php
                            while($row_select=$select_results->fetch_array(MYSQLI_ASSOC)){    
                                $id=$row_select["retreattype_id"];
                                $retreattype=$row_select["retreattype"];
                            
                            ?>
                            <option value="<?php echo $id; ?>" <?php if($id==$retreattype_id){ ?> selected <?php }?>><?php echo $retreattype; ?></option>
                            <?php
                            }
                            $select_results->close();	
                            ?>
                        </select>
                    </div>  
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
                        <textarea name="matter" id="matter" class="form-control" required="true" rows="7"><?php echo $matter; ?></textarea>
                    </div>                    
                    <label for="field-1-3" style="clear:both;">Retreat Start Date/Time&nbsp;
                        <span class="at-required-highlight"></span>
                    </label><br>
                    <div class="form-group col-lg-6 col-md-6"  style="float:left;">
                        <input type="date" name="retreatstartdate" id="retreatstartdate" class="form-control" value="<?php echo date('Y-m-d',strtotime($retreatstartdate)); ?>">
                    </div>
                    <div class="form-group col-lg-6 col-md-6" style="float:left;">
                        <input type="time" name="retreatstarttime" id="retreatstarttime" class="form-control" value="<?php echo date('h:i',strtotime($retreatstartdate)); ?>">
                    </div><br>
                    <label for="field-1-3" style="clear:both;">Retreat End Date/Time&nbsp;
                        <span class="at-required-highlight"></span>
                    </label><br>
                    <div class="form-group col-lg-6 col-md-6"  style="float:left;">
                        <input type="date" name="retreatenddate" id="retreatenddate" class="form-control" value="<?php echo date('Y-m-d',strtotime($retreatenddate)); ?>">
                    </div>
                    <div class="form-group col-lg-6 col-md-6" style="float:left;">
                        <input type="time" name="retreatendtime" id="retreatendtime" class="form-control" placeholder="Time" value="<?php echo date('h:i',strtotime($retreatenddate)); ?>">
                    </div><br>
                    <label for="field-1-3">No of Days&nbsp;
                            <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <input type="number" name="nodays" id="nodays" class="form-control" value="<?php echo $nodays; ?>">
                    </div> 
                    <label for="field-1-3">Publish Start Date&nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <input type="date" name="startdate" id="startdate" class="form-control" value="<?php echo date('Y-m-d',strtotime($start_date)); ?>">
                    </div>                        
                    <label for="email">Publish End date&nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <input type="date" class="form-control" name="enddate" id="enddate" value="<?php echo date('Y-m-d',strtotime($end_date)); ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>   
                    <label for="housename">Venu &nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <input type="text" name="venu" id="venu" class="form-control" value="<?php echo $venu; ?>">
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
                    <label for="email">Banner&nbsp;
                        <span class="at-required-highlight"></span>
                    </label>
                    <div class="form-group">
                        <img src="assets/retreat/<?php echo $banner; ?>" alt="" style="max-width:300px;"><br><br>
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
					}
				});
            });
    </script>
</body>
</html>

