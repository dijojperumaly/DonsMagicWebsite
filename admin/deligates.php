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
            <h4 class="card-title">Deligates List</h4>
            <!--<p class="card-description"> ADD <code></code>-->
            <a href="deligates_add.php"><input type="button" name="btnNews" id="btnNews" value="New" class="btn btn-primary"></a>
            </p>
            <div class="table-responsive" id="table_div">
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th></th>
                    <th>Name</th>
                    <th>About</th>
                    <th>Profile</th>                
                    <th>Document</th>
                    <th>Message</th>
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
                            url: 'deligates_all.php', // get the route value
                            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click									
                                //$(".se-pre-con").fadeIn("slow");									
                                $("#table_div").html("<center><img src='assets/images/loader.gif' width='50px'/></center>");
                            },
                            success: function(response) { //once the request successfully process to the server side it will return result here

                                // Parse the json result
                                response = JSON.parse(response);

                                var html = '<table class="table table-striped" id="tablepaging">';
               
                                html += "<thead><tr>" +
                                    "<th>#</th>" +
                                    "<th>Name</th>" +
                                    "<th>Address</th>" +
                                    "<th>About</th>" +
                                    "<th>Profile</th>" +
                                    "<th>Message</th>" +
                                    "<th>Doc</th>" +
                                    "<th>Order</th>" +
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
                                        if(value.document_file!=''){
                                            doc_icon="<i class='fa fa-file-text-o' style='font-size:36px;'></i>";
                                        }
                                        html += "<tr>" +
                                            "<td width='10%'><img src='./assets/deligates/profile_image/" + value.image + "' /></td>" +
                                            "<td width='10%'><b>" + value.name + "</b><br><span style='font-size:10px;'>"+ value.housename  +"</span></td>" +                                            
                                            "<td width='10%'>" + value.address + "<br><span style='font-size:10px;'>"+value.contact+"<br><span style='font-size:10px;'>"+ value.email +"</span></td>" +                                            
                                            "<td width='15%' style='max-width:150px;overflow:hidden;'>" + value.about + "</td>" +
                                            "<td width='10%' style='max-width:150px;overflow:hidden;'>" + value.profile + "</td>" +
                                            "<td width='10%' style='max-width:150px;overflow:hidden;'>" + value.message + "</td>" +
                                            "<td width='5%'>"+ doc_icon +"</td>" +
                                            "<td width='5%'>"+ value.orderno +"</td>" +
                                            "<td width='5%'>" + value.status + "</td>" +
                                            "<td width='10%'>" +                                            
                                            "<a href='deligates_edit.php?id="+value.id+"'><i class='fa fa-pencil-square-o pointer_link_blue' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;" +
                                            "<i class='fa fa-trash-o pointer_link_red' aria-hidden='true' onClick='deleteItem(" + value.id + ",this)'></i>" +
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
								url: "deligates_delete.php?delid=" + id, // get the route value								
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