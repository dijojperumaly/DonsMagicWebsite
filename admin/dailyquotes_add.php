<?php require_once("adminsession.php")?>
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
        <div class="card"><a href='dailyquotes.php'><< back to list</a>
            <div class="card-body">
            <h4 class="card-title">ADD DELIGATES</h4>            
            </p>
            <div class="table-responsive">
              
                <div class="alert alert-dismissible" role="alert" style="display:none;">
                    <strong>Warning!</strong>
                    <p></p>
                </div>
                <p>
                    <form method="post" action="dailyquotes_save" id="form_save" name="form_save">   
                                    
                        <label for="cname">Daily Quote &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <textarea name="quote" id="quote" required="true" class="form-control"></textarea>
                        </div>

                        <label for="housename">Lesson &nbsp;
                            <span class="at-required-highlight">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" name="lesson" id="lesson" class="form-control">
                        </div>                        
                        <label for="email">Order No&nbsp;
                            <span class="at-required-highlight"></span>
                        </label>
                        <div class="col-lg-4 col-md-4 form-group">
                            <input type="number" class="form-control" name="orderno" id="orderno">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group" style="clear:both;text-align:center;margin:4px;">
                            <p>
                                <input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary">
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
						quote: {
							required: true,
						},
						lesson: {
							required: true,
						},						
					},

					messages: {
						quote: {
							required: "Please specify quote",
						},
						lesson: {
							required: "Please enter lesson",
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

