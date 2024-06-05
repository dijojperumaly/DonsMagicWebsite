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
        <div class="card" style="overflow:scroll;">
            <div class="card-body">
            <h4 class="card-title">Prayer Request List</h4>
            <!--<p class="card-description"> ADD <code></code>-->
            <!-- <a href="retreat_add.php"><input type="button" name="btnRetreat" id="btnRetreat" value="New" class="btn btn-primary"></a> -->
            </p>
            <div class="alert alert-dismissible" role="alert" style="display:none;">
                <strong>Warning!</strong>
                <p></p>
            </div>
            <div class="table-responsive" id="table_div">
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Matter</th>
                    <th>Date</th>                    
                    <th>Order</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>

    <?php require_once("admin_fooder.php")?> 

    <script>
        $(document).ready(function() {

            window.all = function() {
                        // Ajax config
                        //alert("called all");
                        $.ajax({
                            type: "GET", //we are using GET method to get all record from the server
                            url: 'prayerrequest_all.php', // get the route value
                            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click									
                                //$(".se-pre-con").fadeIn("slow");									
                                $("#table_div").html("<center><img src='assets/images/loader.gif' width='50px'/></center>");
                            },
                            success: function(response) { //once the request successfully process to the server side it will return result here

                                // Parse the json result
                                response = JSON.parse(response);

                                //alert(response);

                                var html = '<table class="table table-striped" id="tablepaging">';
               
                                html += "<thead><tr>" +
                                    "<th>#</th>" +
                                    "<th>Person</th>" +
                                    "<th>Request</th>" +
                                    "<th>Date</th>" +
                                    "<th>Reply</th>" +                                    
                                    "<th>Deligate/Devoted</th>" +
                                    "<th>Status</th>" +
                                    "<th>Action</th>" +
                                    "</tr>" +
                                    "</thead>" +
                                    "<tbody>";
                                // Check if there is available records
                                if (response.length) {
                                    //html += '<div class="list-group">';
                                    // Loop the parsed JSON
                                    $.each(response, function(key, value) {
                                        let doc_icon="";
                                        let read_color="";
                                        if(value.isread==0){
                                            read_color=" style='background-color: #d1f0ff;' ";
                                        }
                                        if(value.document_file!=''){
                                            doc_icon="<i class='fa fa-file-text-o' style='font-size:36px;'></i>";
                                        }
                                        html += "<tr "+read_color+" >" +
                                            "<td width='10%'>"+ (key+1) + "</td>" +
                                            "<td width='20%'><b>" + value.name + "</b><br><span style='font-size:12px;'>"+ value.hname  +"<br>"+value.contact +"</span></td>" +                                            
                                            "<td width='25%'><b>" + value.subject + "</b><br><span style='font-size:12px;'>" + value.reson.substring(0,20) + "<a href='prayerrequest_view.php?id="+value.request_id+"'> read...</a></td>" +
                                            "<td width='15%'>" + value.createdat + "</td>" +
                                            "<td width='5%'>" + value.reply.substring(0,20) + "<a href='prayerrequest_view.php?id="+value.request_id+"'> read...</a><br><span style='font-size:11px;'>"+ value.replydate +"</td>" +                                            
                                            "<td width='5%'>"+ value.prayer_person +"</td>" +
                                            "<td width='5%'>" + value.status + "</td>" +
                                            "<td width='10%'>" +                                            
                                            "<a href='prayerrequest_view.php?id="+value.request_id+"'><i class='fa fa-eye pointer_link_blue' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;" +
                                            "<i class='fa fa-trash-o pointer_link_red' aria-hidden='true' onClick='deleteItem(" + value.request_id + ",this)'></i>" +
                                            "</td>" +
                                            "</tr>";
                                    });
                                    html += "</tbody></table>";
                                    //html += '</div>';
                                } else {
                                    html += '<div class="alert alert-warning">';
                                    html += 'No records found!';
                                    html += '</div>';
                                }

                                $("#table_div").html(html);
                                //$("#tablepaging").html(html);
                                $(".se-pre-con").fadeOut("slow");
                                tablePagination();
                            },
                            complete: function(data) {
                                // Hide image container
                                $(".se-pre-con").fadeOut("slow");
                            }
                        });
                    }

                    window.tablePagination = function() {
                        //$('#tablepaging').DataTable();
                        //$('.dataTables_length').addClass('bs-select');
                        var table = $('#tablepaging').DataTable({
                            rowReorder: true,
                            pageLength: 10,
                            sPaginationType: "first_last_numbers", //"full", //"simple_numbers" //"simple",	
                            stateSave: true,
                            "bDestroy": true,
                        });
                    }

            window.deleteItem=function (id, obj) {
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
								url: "prayerrequest_delete.php?delid=" + id, // get the route value								
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
											ShowAlert("", "Successfully Deleted ", "success");
											$(obj).closest('tr').remove();
											all();
											//tablePagination();

										} else {
											ShowPopUpAlert("", "Not saved! please enter correct data", "danger");
										}
									} catch (e) {
										ShowPopUpAlert("", "Not saved! please enter correct data/try after sometime", "danger");
									}

									// Reset form

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
			}

            all();
            tablePagination();
        });
    </script>
</body>
</html>