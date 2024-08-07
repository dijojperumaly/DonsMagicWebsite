                                                              
                </div>
                <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © edendesigns.in 2024</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Designed by <a href="https://edendesigns.in/" target="_blank">Edendesigns</a></span>
            </div>
          </footer>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/flot/jquery.flot.js"></script>
    <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/vendors/flot/jquery.flot.stack.js"></script>
    <script src="assets/vendors/flot/jquery.flot.pie.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page, only for dashboard page -->
          <!--<script src="assets/js/dashboard.js"></script> -->
    <!-- End custom js for this page -->
 <!-- MY SCRIPT START -->

    <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <!--<script src="assets/js/bootstrap-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap-3.4.1.min.js"></script>-->
    

    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.rowReorder.min.js"></script>
    
    <script src="assets/js/ckeditor.js"></script>
    <script src="assets/js/myjs.js"></script>

    
    <script>
    $(document).ready(function() {
      $(".se-pre-con").fadeOut("slow");
    });
	function ShowAlert(msg_title, msg_body, msg_type) {
		var AlertMsg = $('div[role="alert"]');
		$(AlertMsg).find('strong').html(msg_title);
		$(AlertMsg).find('p').html(msg_body + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
		$(AlertMsg).removeAttr('class');
		$(AlertMsg).addClass('alert alert-' + msg_type);
		$(AlertMsg).show();
	}

	function ShowPopUpAlert(msg_title, msg_body, msg_type) {
		var AlertMsg = $('div[role="popupalert"]');
		$(AlertMsg).find('strong').html(msg_title);
		$(AlertMsg).find('p').html(msg_body + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
		$(AlertMsg).removeAttr('class');
		$(AlertMsg).addClass('alert alert-' + msg_type);
		$(AlertMsg).show();
	}
</script>
<!-- multi select chosen links start-->
<script src="assets/js/chosen.jquery.min.js"></script>
<link href="assets/css/chosen.min.css" rel="stylesheet" />
<!-- multi select chosen links end-->