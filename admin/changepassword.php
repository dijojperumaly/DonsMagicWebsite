<?php
include_once("adminsession.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<?php include("admin_links.php"); ?>
	<style>
		.bs-example{
			margin: 20px;
		}
	</style>
	
</head>

<body>
	<?php include("admin_header.php");	
	?>
 		
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Change Password</h3>              
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin">
	

				<div class="alert alert-dismissible" role="alert" style="display:none;">
					<strong>Warning!</strong>
					<p></p>
				</div>
			
						<!--<form method="post" action="dresscategorysave.php" id="form" class="valida" autocomplete="off" novalidate="novalidate">-->
						<form method="post" action="changepassword_save" id="form_changepassword" name="form_changepassword">

							<label for="cname">Old Password &nbsp;
								<span class="at-required-highlight">*</span>
							</label>
							<div class="form-group">
								<input type="password" name="oldpassword" id="oldpassword" required="true" class="form-control">
							</div>
                            <label for="cname">New Password &nbsp;
								<span class="at-required-highlight">*</span>
							</label>
							<div class="form-group">
								<input type="password" name="newpassword" id="newpassword" required="true" class="form-control">
							</div>
                            <label for="cname">Confirm Password &nbsp;
								<span class="at-required-highlight">*</span>
							</label>
							<div class="form-group">
								<input type="password" name="confirmpassword" id="confirmpassword" required="true" class="form-control">
							</div>							
							<p>
								<input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary">
							</p>
						</form>
				</div>	
		
        </div>
    </div>
		<?php include("admin_fooder.php"); ?>

		<!-- //loading-gif Js -->
		<script src="js/modernizr.js"></script>
		<!--// loading-gif Js -->

		<script>
			$(document).ready(function() {

				function resetForm() {
					$('#form_changepassword')[0].reset();					
				}

				function resetMessage() {
					$('div[role="alert"]').attr("display:none");
				}
				
				$("#form_changepassword").validate({
					rules: {
						oldpassword: {
							required: true,
						},
						newpassword: {
							required: true,
						},
                        nconfirmpasswordame: {
							required: true,
						},
					},

					messages: {
						oldpassword: {
							required: "enter password",
						},
						newpassword: {
							required: "enter new password",
						},
                        nconfirmpasswordame: {
							required: "confirm password",
						},
					},
					errorPlacement: function(error, element) {
						error.insertAfter(element);
					}
				});
				$('#submit').click(function() {
					if ($("#form_changepassword").valid()) { // test for validity
						var $this = $("#submit"); //submit button selector using ID
						var $caption = $this.val(); // We store the html content of the submit button
						var form = "#form_changepassword"; //defined the #form ID
						var formData = $(form).serializeArray(); //serialize the form into array
						var route = $(form).attr('action'); //get the route using attribute action

						var data = new FormData();

						//Form data						
						$.each(formData, function(key, input) {
							data.append(input.name, input.value);
						});
						formData = data;
					
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
										ShowAlert("", "Successfully Changed", "success");
									} 
                                    else if (json["status"] == "old") {																				
										ShowAlert("", "Incorrect password", "danger");
									}
                                    else if (json["status"] == "confirm") {																			
										ShowAlert("", "Please confirm password", "danger");
									}
                                    else {
										ShowAlert("", "Not changed! please enter currect password/confirm your password", "danger");
									}
								} catch (e) {
									ShowAlert("", "Not changed! please enter currect password/confirm your password", "danger");
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

		<!--<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>-->
		<!--<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>		-->

		</body>

</html>