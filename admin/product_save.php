<?php
include_once("adminsession.php");
//error_reporting(0);
include_once("db_connection.php");

$status="success";
$edit_filename="";
$edit_document="";
$filename="";
$documentfilename="";
$folder = "../images/products/";
$folder_document = "./assets/news/news_document/";

if(isset($_POST["hdimagefile"])){
	$edit_filename=$_POST["hdimagefile"];
}
$filename=$edit_filename;

$con->begin_transaction();
//if (isset($_POST["submit"])) {

	if (isset($_FILES["imagefile"]['name'])) {		
		$fname = $_FILES['imagefile']['name'];
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed_imagetype)) {
			$status=[ 'status' => 'filetype_error' ];
		}else if($_FILES['imagefile']['size'] > 1048576){
			$status=[ 'status' => 'filesize_error' ];
		}else{
			$filename=date('ymdHisu').gettimeofday()["usec"].".".$ext;		
			//$filename = $_FILES["imagefile"]["name"];
			$tempname = $_FILES["imagefile"]["tmp_name"];			
			
			// Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder.$filename)) {
				if($edit_filename!=""){
					if(unlink($folder.$edit_filename)){}
				}
			}
			else {
				$status=[ 'status' => 'fail' ];
			}
		}
	}	
	if($status=="success"){		
		$title=$_POST["title"];
		$producttype=$_POST["producttype"];
		$mrp =$_POST["mrp"];
		$offerprice =$_POST["offerprice"];
		$aboutproduct =$_POST["aboutproduct"];
		$featured=$_POST["featured"];	
		$orderno=$_POST["orderno"];					

		$cid=0;
		$stmt="";
	//    $featured=1;
		if(!isset($_POST["hdid"])){
			$stmt = $con->prepare("INSERT INTO tbl_product (
				producttype_id,
				title, 
				aboutproduct,
				MRP,	
				offerprice,	
				isfeatured,
				image_1,
				orderno,
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");		
			$stmt->bind_param("issiiisiis", $producttype, $title, $aboutproduct, $mrp, $offerprice, $featured, $filename, $orderno, $user_id, $present);		
		}
		else{
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_news SET
				title=?, 
				sub_title=?,
				matter=?,
				news_date=?,		
				start_date=?, 
				end_date=?,
				isfeatured=?,
				document_file=?,
				image_1=?,
				orderno=?,
				updatedby=?,
				updatedat=? WHERE id=?");
			$stmt->bind_param("ssssssissiisi", $title, $subtitle, $matter, $date,  $startdate, $enddate, $featured, $documentfilename, $filename, $orderno, $user_id,$present,$id);
		}
		if($stmt->execute()){
				$status=[ 'status' => 'success'];	
				$con->commit();			
			}
			else{
				$status=[ 'status' => 'fail' ];
				$con->rollback();
			}
		
		$stmt->close();	
	}	
//}

$con->close();
echo json_encode($status);
?>