<?php 
include('headerWhite.php');
?> 

	<!-- Title page -->
	<!--<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-02.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Account
		</h2>
	</section>	-->

	<!-- Content page -->
	<section class="bg0 p-t-62 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-lg-8 p-b-80">
					<div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->                        
						<div class="p-b-63">							
							<div class="p-t-32">
								<h4 class="p-b-15">
                                    Sign Up Now
								</h4>
								<p class="stext-117 cl6">
									Create a DonsMagic Account
								</p>

								<!--<div class="flex-w flex-sb-m p-t-18">-->
                                <div class="p-t-55">
                                    <form method="post" name="form_signup" id="form_signup" action="useraccount_save">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="txtname" id="txtname" placeholder="your name*">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="txtphone" id="txtphone" placeholder="phone number*">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="txtemail" id="txtemail" placeholder="email*">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="txtpassword" id="txtpassword" placeholder="password*">
                                        </div>

                                        <div class="form-group">
                                            <input class="btn btn-success" type="button" name="btnsignup" id="btnsignup" value="Sign Up" style="cursor:pointer;">
                                        </div>
                                    </form>	
                                    <div class="alert alert-dismissible" role="alert" style="display:none;">
                                        <strong>Warning!</strong>
                                        <p></p>
                                    </div>								
								</div>
							</div>
						</div>

						<!-- item blog -->						

						<!-- item blog -->
						
						<!-- Pagination -->
						<!--<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
							<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
								1
							</a>

							<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
								2
							</a>
						</div>-->
					</div>
				</div>

				<div class="col-md-5 col-lg-4 p-b-80">
					<div class="side-menu">
                        <div class="p-r-45 p-r-0-lg">
                            <div class="p-b-63">
                                <div class="p-t-32">
                                    <!--<div class="bor17 of-hidden pos-relative">
                                        <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

                                        <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </div>-->                      
                                    <!--<h4 class="mtext-112 cl2 p-b-33">
                                        Sign In
                                    </h2>-->
                                    <h4 class="p-b-15">
                                        Sign In
                                    </h4>
                                    <p class="stext-117 cl6">
                                        You have an Account Please Sign In
                                    </p>
                                    <div class="p-t-55">
                                        <form method="post" name="form_login" id="form_login" action="useraccount_save.php">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="txtloginuname" id="txtloginuname" placeholder="email*">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="txtloginpassword" id="txtloginpassword" placeholder="password*">
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="Submit" name="btnlogin" id="btnlogin" value="Sign In" style="cursor:pointer;">
                                            </div>
                                        </form>
                                    </div>
                                </div>                                                    
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
		
<?php
include('footer.php');
?>	
<script>
$(document).ready(function() {
    function resetForm() {
        $('#form_signup')[0].reset();        
    }
                
    $("#form_signup").validate({
        rules: {
            txtname: {
                required: true,
            },
            txtphone: {
                required: true,
                number:true,
                minlength:10,
                maxlength: 10
            },	
            txtemail: {	
                required: true,						
                email:true,
            },
            txtpassword: {	
                required: true,
                minlength:6,
                maxlength: 18,          
            },					
        },

        messages: {
            txtname: {
                required: "fill your name",
            },
            txtphone: {
                required: "fill your phone number",
                number: "number only",
                minlength:"phone number must 10 digit indian mobile number",
                maxlength: "phone number must 10 digit indian mobile number",
            },	
            txtemail: {
                number: "fill your email id",
                email: "invalid email id",
            },	
            txtpassword: {	
                required: "fill your password",
                minlength:"password mut be minimum 6 and maximum 18 charactor length",
                maxlength: "password mut be minimum 6 and maximum 18 charactor length",          
            },				
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
    $('#btnsignup').click(function() {
        if ($("#form_signup").valid()) { // test for validity
            var $this = $("#btnsignup"); //btnsignup button selector using ID
            var $caption = $this.val(); // We store the html content of the btnsignup button
            var form = "#form_signup"; //defined the #form ID
            var formData = $(form).serializeArray(); //serialize the form into array
            var route = $(form).attr('action'); //get the route using attribute action

            $("#btnsignup").prop('disabled', true).val("Processing...");

            // Ajax config
            var data = new FormData();

            //Form data						
            $.each(formData, function(key, input) {
                data.append(input.name, input.value);      
            });

            //File data
            //var file_data = $('input[name="imagefile"]')[0].files;
            //data.append("imagefile", file_data[0]); 

            //multifile upload
            /*for (var i = 0; i < file_data.length; i++) {
                data.append("imagefile[]", file_data[i]);
            }*/
            formData = data;
            // Ajax config

            $.ajax({
                type: "POST", //we are using POST method to btnsignup the data to the server side
                url: route, // get the route value
                data: formData, // our serialized array data for server side
                timeout: 100,
                async: false,
                processData: false,
                contentType: false,

                beforeSend: function() { //We add this before send to disable the button once we btnsignup it so that we prevent the multiple click
                    $("#btnsignup").prop('disabled', true).val("Processing...");
                    //$this.attr('disabled', true).val("Processing...");
                    $(".se-pre-con").fadeIn("slow");
                },
                success: function(response) { //once the request successfully process to the server side it will return result here
                    $("#btnsignup").attr('disabled', false).val($caption);
                    //alert(response);												
                    try {
                        //var json = $.parseJSON(response);
                        var json = JSON.parse(response);
                        if (json["status"] == "success") {
                            resetForm();
                            //all();                            
                            ShowAlert("", "Thank You for Creating an Account in Donsmagic! Sign In to Continue...", "success");
                        }
                        else {
                            ShowAlert("", json["status"], "danger");
                        }
                    } catch (e) {                                    
                        ShowAlert("", "Not saved! please enter correct data", "danger");
                    }

                    // Reset form

                },
                complete: function(data) {
                    // Hide image container
                    $("#btnsignup").prop('disabled', false).val($caption);
                    $(".se-pre-con").fadeOut("slow");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#btnsignup").prop('disabled', false).val($caption);
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
