<?php
include_once("db_connection.php");
include_once("adminsession.php");
?>
<div class="se-pre-con"></div>
<div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <a class="sidebar-brand brand-logo" href="./"><img src="assets/images/logo.png" alt="logo" /><b>DONSMAGIC</b></a>          
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="./"><img src="assets/images/logo.png" alt="logo" /></a>
        </div>
        <hr>
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="assets/images/faces/face.png" alt="profile" />
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column pr-3">
                <span class="font-weight-medium mb-2"><?php echo $user_name; ?></span>
                <span class="font-weight-normal">online</span>
              </div>
              <!--<span class="badge badge-danger text-white ml-3 rounded">3</span>-->
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">
              <i class="mdi mdi-newspaper menu-icon"></i>
              <span class="menu-title">Products</span>
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="size.php">
              <i class="mdi mdi-contacts menu-icon"></i>
              <span class="menu-title">Size</span>
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Order List</span>
            </a>
          </li>          
          <li class="nav-item sidebar-actions">
            <div class="nav-link">
              <div class="mt-4">
                <div class="border-none">
                  <p class="text-black">Settings</p>
                </div>
                <ul class="mt-4 pl-0">
                  <li><a class="dropdown-item" href="whatsappcontact.php">Contact</a></li>
                  <li><a class="dropdown-item" href="changepassword.php">Change Password</a></li>
                  <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles light"></div>
            <div class="tiles dark"></div>
          </div>
        </div>
        <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
            <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="./"><img src="assets/images/logo.png" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
              <i class="mdi mdi-menu"></i>
            </button>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                  <span class="count count-varient1">0</span>
                </a>
                <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <!--<a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face4.jpg" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on your photo</span>
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face3.jpg" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> James <span class="text-small text-muted">posted a photo on your wall</span>
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face2.jpg" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> Alex <span class="text-small text-muted">just mentioned you in his post</span>
                      </p>
                    </div>
                  </a>-->
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0">View all activities</p>
                </div>
              </li>
              <!--<li class="nav-item dropdown d-none d-sm-flex">
              <?php              
                /*$sql = "SELECT  request_id, 
                    IFNULL(name,'') name,  
                    IFNULL(place,'') place,             
                    IFNULL(subject,'') subject, 
                    IFNULL(reson,'') reson,                    
                    IFNULL(createdat,'') createdat,
                    (select count(*) from tbl_prayerrequest WHERE isread=0) total                 
                    FROM tbl_prayerrequest WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active' AND isread=0 ORDER BY request_id DESC LIMIT 3";
                    
                $results = $con->query($sql);    
              
                if($row=$results->fetch_array(MYSQLI_ASSOC)){                                           
                  $total=$row["total"];*/
            ?>

                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-shield-cross"></i>
                  <span class="count count-varient2"><?php //echo $total; ?></span>
                </a>
                <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Prayer Request</h6>
                  <?php 
                    /*do{
                      $request_id=$row["request_id"];
                      $notificationname=$row["name"];
                      $place=$row["place"];
                      $subject=$row["subject"];
                      $reson=$row["reson"];        
                      $createdat=$row["createdat"]; 
                     */
                  ?>
                  <a class="dropdown-item preview-item" href="prayerrequest_view?id=<?php //echo $request_id; ?>">
                    <div class="preview-item-content flex-grow">
                      <span class="badge badge-pill badge-success"><?php //echo $notificationname; ?></span>
                      <p class="text-small text-muted ellipsis mb-0"><?php //echo $subject; ?><br><?php //echo $place; ?></p>
                    </div>
                    <p class="text-small text-muted align-self-start"> <?php //echo date("d-m-Y H:i A", strtotime($createdat));?> </p>
                  </a>
                  <?php 
                    //}while($row=$results->fetch_array(MYSQLI_ASSOC));                
                  ?>                  
                  <a href="prayerrequest.php"><h6 class="p-3 mb-0">See all activity</h6></a>
                  </div>
                  <?php
                //}else{

                  ?>
                  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-shield-cross-outline"></i>
                  <span class="count count-varient2">0</span>
                </a>
                <?php
               // }
                
                ?>
                
              </li> -->
              <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
                <form class="nav-link form-inline mt-2 mt-md-0">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                  </div>
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right ml-lg-auto">
              <li class="nav-item dropdown d-none d-xl-flex border-0">
                <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-earth"></i> English </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                  <a class="dropdown-item" href="#"> French </a>
                  <a class="dropdown-item" href="#"> Spain </a>
                  <a class="dropdown-item" href="#"> Latin </a>
                  <a class="dropdown-item" href="#"> Japanese </a>
                </div>
              </li>
              <li class="nav-item nav-profile dropdown border-0">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                  <img class="nav-profile-img mr-2" alt="" src="assets/images/faces/face.png" />
                  <span class="profile-name"><?php echo $user_name; ?></span>
                </a>
                <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="changepassword.php">
                    <i class="mdi mdi-cached mr-2 text-success" style="width:fit-content;"></i> Change Password </a>
                  <a class="dropdown-item" href="logout.php">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
        <div class="main-panel">
          <div class="content-wrapper pb-0" style="padding: 1.75rem 1.25rem">
            