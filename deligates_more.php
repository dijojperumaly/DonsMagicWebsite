<?php
include_once("admin/db_connection.php");
include "header.php";

?>
<section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-3.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-banner-cont">
                    <h2>Deligate</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Deligates</li>
                        </ol>
                    </nav>
                </div> <!-- page banner cont -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<section id="teachers-singel" class="pt-70 pb-120 gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
                <div class="teachers-left mt-50">
                    <?php
                    $id=0;
                    $name="";
                    $message="";
                    $about="";
                    $profile="";
                    $image="";
                    $retreattype="";
                    $noseats="";
                    $nodays="";
                    $title="";
                    $subtitle="";
                    $retreatstartdate="";
                    $retreatenddate="";
                    $housename="";
                    /*if(isset($_REQUEST["id"])){                        
                        $id=$_REQUEST["id"];                        
                        $sql = "SELECT DISTINCT d.id, 
                        IFNULL(d.name,'')name, 
                        IFNULL(d.housename,'') housename,
                        IFNULL(d.message,'') message,
                        IFNULL(d.about,'') about,
                        IFNULL(d.profile,'') profile,
                        IFNULL(d.image,'') image,
                        IFNULL(t.retreattype,'') retreattype,
                        IFNULL(r.id,'0') retreat_id,
                        IFNULL(r.noseats,'0') noseats,
                        IFNULL(r.nodays,'0') nodays,
                        IFNULL(r.title,'') title,
                        IFNULL(r.subtitle,'') subtitle,
                        IFNULL(r.retreatstartdate,'') retreatstartdate,
                        IFNULL(r.retreatenddate,'') retreatenddate,
                        IFNULL(r.banner,'') image_retreat
                        FROM tbl_deligates d
                        LEFT JOIN tbl_retreat r ON d.id=r.deligate_id AND r.retreatstartdate>='$present'
                        LEFT JOIN tbl_retreattype t ON t.retreattype_id=r.retreattype_id                        
                        WHERE IFNULL(d.isdeleted,0)=0 AND IFNULL(r.isdeleted,0)=0 AND IFNULL(t.isdeleted,0)=0  AND d.id=$id";

                        $results = $con->query($sql);                   
                        If($row=$results->fetch_array(MYSQLI_ASSOC)){        
                            $id=$row["id"];
                            $retreat_id=$row["retreat_id"];
                            $name=$row["name"];
                            $housename=$row["housename"];
                            $message=$row["message"];
                            $about=$row["about"];
                            $profile=$row["profile"];
                            $image=$row["image"];
                                          
                            $retreattype=$row["retreattype"];
                            $noseats=$row["noseats"];
                            $nodays=$row["nodays"];
                            $title=$row["title"];
                            $subtitle=$row["subtitle"];
                            $retreatstartdate=$row["retreatstartdate"];
                            $retreatenddate=$row["retreatenddate"];
                            $image_retreat=$row["image_retreat"];
                    
                        }
                    }*/
                    ?>

                    <div class="hero">
                        <img src="images/products/<?php if($image!=""){echo $image;}else{echo "priest.jpg";} ?>" alt="<?php echo $name; ?>">
                    </div>
                    <div class="name">
                        <h6><?php echo $name; ?></h6>
                        <span><?php echo $housename; ?></span>
                    </div>
                    <div class="social">
                        <ul>
                            <!--<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>-->
                        </ul>
                    </div>
                    <div class="description">
                        <p align="justify"></p>
                    </div>
                    
                </div> <!-- teachers left -->
            </div>
            <div class="col-lg-8">
                <div class="teachers-right mt-50">
                    <ul class="nav nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Retreat</a>
                        </li>
                        <!--<li class="nav-item">
                            <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>-->
                    </ul> <!-- nav -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <div class="dashboard-cont">
                                <div class="singel-dashboard pt-40">
                                    <h5><u>About</u></h5>
                                    <p align="justify"><?php echo $about; ?></p>
                                </div> <!-- singel dashboard -->
                                <?php if(trim($profile)!=""){?>
                                <div class="singel-dashboard pt-40">
                                    <h5><u>Profile</u></h5>
                                    <p align="justify"><?php echo $profile; ?></p>
                                </div> <!-- singel dashboard -->
                               <?php } ?>
                            </div> <!-- dashboard cont -->
                        </div>
                        <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                            <div class="courses-cont pt-20" style="max-height:800px;min-height:100px;overflow:auto;scroll-behavior:smooth; scrollbar-width:thin;">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="singel-course mt-30">
                                            <!--<div class="thum">
                                                <div class="image">
                                                   <img width="50px" src="admin/assets/retreat/<?php /*if($image_retreat!=""){ echo $image_retreat;}else{ echo "default.gif";}*/ ?>" alt="<?php echo $title; ?>">                                               </div>
                                                <div class="price">
                                                    <span><?php echo $noseats; ?></span>
                                                </div>
                                            </div>-->
                                            <div class="cont border">
                                                <!--<ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>-->
                                                <span>(<?php echo $nodays; ?> Day)</span><br>
                                                <a href="#">
                                                    <h4><?php echo $title; ?></h4>
                                                    <h6><?php echo $subtitle; ?></h6>
                                                </a>
                                                <div class="course-teacher">
                                                    <div class="thum">
                                                        <!--<a href="#"><img src="images/course/teacher/t-2.jpg" alt="teacher"></a>-->
                                                        Date:
                                                    </div>
                                                    <div class="name">
                                                        <a href="#"><h6><?php echo $retreatstartdate; ?></h6></a>
                                                        <a href="#"><h6><?php echo $retreatenddate; ?></h6></a>
                                                    </div>
                                                    <div class="admin">
                                                        <a href="retreatbooknow?id=<?php echo $retreat_id; ?>" class="main-btn">Book Now</a>
                                                         <!--<ul>
                                                            <li><a href="#"><i class="fa fa-user"></i><span>31</span></a></li>
                                                            <li><a href="#"><i class="fa fa-heart"></i><span>10</span></a></li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- singel course -->
                                    </div>                                    
                                </div> <!-- row -->
                            </div> <!-- courses cont -->
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-cont">
                                <div class="title">
                                    <h6>Student Reviews</h6>
                                </div>
                                <ul>
                                    <li>
                                        <div class="singel-reviews">
                                            <div class="reviews-author">
                                                <div class="author-thum">
                                                    <img src="images/review/r-1.jpg" alt="Reviews">
                                                </div>
                                                <div class="author-name">
                                                    <h6>Bobby Aktar</h6>
                                                    <span>April 03, 2019</span>
                                                </div>
                                            </div>
                                            <div class="reviews-description pt-20">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                <div class="rating">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span>/ 5 Star</span>
                                                </div>
                                            </div>
                                        </div> <!-- singel reviews -->
                                    </li>
                                    <li>
                                        <div class="singel-reviews">
                                            <div class="reviews-author">
                                                <div class="author-thum">
                                                    <img src="images/review/r-2.jpg" alt="Reviews">
                                                </div>
                                                <div class="author-name">
                                                    <h6>Humayun Ahmed</h6>
                                                    <span>April 13, 2019</span>
                                                </div>
                                            </div>
                                            <div class="reviews-description pt-20">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                <div class="rating">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span>/ 5 Star</span>
                                                </div>
                                            </div>
                                        </div> <!-- singel reviews -->
                                    </li>
                                    <li>
                                        <div class="singel-reviews">
                                            <div class="reviews-author">
                                                <div class="author-thum">
                                                    <img src="images/review/r-3.jpg" alt="Reviews">
                                                </div>
                                                <div class="author-name">
                                                    <h6>Tania Aktar</h6>
                                                    <span>April 20, 2019</span>
                                                </div>
                                            </div>
                                            <div class="reviews-description pt-20">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                <div class="rating">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span>/ 5 Star</span>
                                                </div>
                                            </div>
                                        </div> <!-- singel reviews -->
                                    </li>
                                </ul>
                                <div class="title pt-15">
                                    <h6>Leave A Comment</h6>
                                </div>
                                <div class="reviews-form">
                                    <form action="#">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-singel">
                                                        <input type="text" placeholder="Fast name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-singel">
                                                        <input type="text" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-singel">
                                                        <div class="rate-wrapper">
                                                            <div class="rate-label">Your Rating:</div>
                                                            <div class="rate">
                                                                <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-singel">
                                                        <textarea placeholder="Comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-singel">
                                                        <button type="button" class="main-btn">Post Comment</button>
                                                    </div>
                                                </div>
                                            </div> <!-- row -->
                                        </form>
                                </div>
                            </div> <!-- reviews cont -->
                        </div>
                    </div> <!-- tab content -->
                </div> <!-- teachers right -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<?php
include "footer.php";
?>