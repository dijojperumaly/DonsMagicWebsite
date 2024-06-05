<?php
include_once("adminsession.php");
include_once("db_connection.php");

$name="";
$housename="";
$email="";
$place="";
$contact="";
$subject="";
$reson="";
$reply="";
$replydate="";
$deligate="";
$id=0;

if(isset($_GET["id"])){
    $id=$_GET["id"];

    $sql_update="UPDATE tbl_prayerrequest SET isread=1 WHERE request_id=$id";
    $con->query($sql_update);

    $sql = "SELECT  request_id, 
        IFNULL(name,'')name, 
        IFNULL(hname,'') hname, 
        IFNULL(place,'') place, 
        IFNULL(email,'') email, 
        IFNULL(contact,'') contact, 
        IFNULL(subject,'') subject, 
        IFNULL(reson,'') reson, 
        CASE WHEN IFNULL(isreplyed,0)=0 THEN 'NO' ELSE 'YES' END isreplyed , 
        IFNULL(replydate,'') replydate,
        IFNULL(reply,'') reply,
        deligate_id,
        IFNULL(prayer_person,'') prayer_person
        FROM tbl_prayerrequest WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active'  AND request_id=$id";
        
    $results = $con->query($sql);    
  
    if($row=$results->fetch_array(MYSQLI_ASSOC)){        
        $name=$row["name"];
        $housename=$row["hname"];
        $place=$row["place"];
        $email=$row["email"];
        $contact=$row["contact"];
        $subject=$row["subject"];
        $reson=$row["reson"];        
        $isreplyed=$row["isreplyed"];
        $replydate=$row["replydate"];
        $reply=$row["reply"];        
        $deligate_id=$row["deligate_id"]; 
        $prayer_person=$row["prayer_person"]; 
        
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
        <div class="card" style="overflow:scroll;">
            <a href="prayerrequest.php">Back to list</a>
            <div class="card-body">
                <h4 class="card-title">Prayer Request</h4>
                <!--<p class="card-description"> ADD <code></code>-->
                <!-- <a href="retreat_add.php"><input type="button" name="btnRetreat" id="btnRetreat" value="New" class="btn btn-primary"></a> -->
                </p>
                <div class="main-form pt-45">
                    <div class="alert alert-dismissible" role="alert" style="display:none;">
                        <strong>Warning!</strong>
                        <p></p>
                    </div>
                    <form id="form_save" name="form_save" action="prayerrequest_save" method="post" data-toggle="validator">
                        
                        <input type="hidden" id="hdid" name="hdid" value="<?php echo $id; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Name&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <input name="name" id=-"name" type="text" class="form-control"  placeholder="Your name *" 
                                        data-error="Name is required." required="required" value="<?php echo $name; ?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-6">
                                <label for="email">House Name&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <input name="housename" id="housename" type="text" class="form-control" placeholder="House name"
                                        data-error="House name is required." value="<?php echo $housename; ?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-6">
                                <label for="email">Place&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <input name="place" id="place" type="text" class="form-control" placeholder="Your place *"
                                        data-error="Place is required." required="required" value="<?php echo $place; ?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <input name="email" id="email" type="text" class="form-control" placeholder="Email"
                                        data-error="Valid email is required." value="<?php echo $email; ?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-6">
                                <label for="email">Subject&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <input name="subject" id="subject" type="text" class="form-control" placeholder="Subject *"
                                        data-error="Subject is required." required="required" value="<?php echo $subject; ?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-6">
                                <label for="email">Phone&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <input name="phone" id="phone" type="text" class="form-control" placeholder="Phone"
                                        data-error="Phone is required." value="<?php echo $contact; ?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-12">
                                <label for="email">Request&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <textarea name="message" id="message" placeholder="Messege *" class="form-control" rows="10"
                                        data-error="Please,leave us a message." required="required" disabled><?php echo $reson; ?> </textarea>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <p class="form-message"></p>
                            <hr style="width:100%;text-align:left;margin-left:0">
                            <div class="col-md-12">
                                <label for="email">Reply&nbsp;
                                    <span class="at-required-highlight"></span>
                                </label>
                                <div class="singel-form form-group">
                                    <textarea name="replymessage" id="replymessage" placeholder="Reply *" class="form-control" rows="12"
                                        data-error="Please,leave us a reply." required="required"><?php echo $reply; ?></textarea>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- singel form -->
                            </div>
                            <div class="col-md-12">
                                <div class="singel-form">
                                    <button type="button" name="send" id="send" class="btn btn-primary">Send Reply</button>
                                </div> <!-- singel form -->
                            </div>
                        </div> <!-- row -->
                    </form><br><br>
                    <div class="alert alert-dismissible" role="alert" style="display:none;">
                        <strong>Warning!</strong>
                        <p></p>
                    </div>
                </div> <!-- main form -->

            </div>
        </div>
    </div>

    <?php require_once("admin_fooder.php")?> 

    <script>
        $(document).ready(function() {
            $('#send').click(function() {
					if ($("#form_save").valid()) { // test for validity
                        var $this = $("#send"); //send button selector using ID
						var $caption = $this.val(); // We store the html content of the send button
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
																				
								try {
									var json = $.parseJSON(response);
                                    var res_status = json["status"];
                                    //alert(res_status);
									if (res_status == "success") {
										//resetForm();
										//all();                                        
										ShowAlert("", "Successfully Replyed", "success");
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