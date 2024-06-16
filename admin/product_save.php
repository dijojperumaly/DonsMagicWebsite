<?php
include_once("adminsession.php");
//error_reporting(0);
include_once("db_connection.php");
$id=0;
$status="success";
$edit_filename="";
$edit_document="";
$filename="";
$documentfilename="";
$folder = "../images/products/";
if(isset($_POST["hdimagefile"])){
	$edit_filename=$_POST["hdimagefile"];
}
$filename=$edit_filename;
$producttype=0;
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
	$size=array();
	if($status=="success"){		
		$title=$_POST["title"];
		$producttype=$_POST["producttype"];
		$mrp =$_POST["mrp"];
		$offerprice =$_POST["offerprice"];
		$aboutproduct =$_POST["aboutproduct"];
		$featured=isset($_POST["featured"])? $_POST["featured"]:0;	
		$orderno=$_POST["orderno"];	
		$productstatus=$_POST["productstatus"];	
		$size=isset($_POST["size"])?$_POST["size"]:array(null);		
		$label=$_POST["label"];	
		$color=$_POST["color"];	
		$cid=0;
		$stmt="";
		$smt_code="";
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
				status,
				label,
				color,
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");		
			$stmt->bind_param("issiiisisssis", $producttype, $title, $aboutproduct, $mrp, $offerprice, $featured, $filename, $orderno, $productstatus, $label, $color, $user_id, $present);		

			$smt_code=$con->prepare("UPDATE tbl_product SET product_code=CONCAT((SELECT typecode FROM tbl_producttype WHERE producttype_id=$producttype),?) WHERE id=?");
		}
		else{
			
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_product SET
				producttype_id=?,
				title=?, 
				aboutproduct=?,
				MRP=?,	
				offerprice=?,	
				isfeatured=?,
				image_1=?,
				orderno=?,
				status=?,
				label=?,
				color=?,
				updatedby=?,
				updatedat=? WHERE id=?");
			$stmt->bind_param("issiiisisssisi", $producttype, $title, $aboutproduct, $mrp, $offerprice, $featured, $filename, $orderno, $productstatus, $label, $color, $user_id, $present,$id);
			
		}
		if($stmt->execute()){	
			$lastid=0;		
			if($smt_code!=""){				
				$lastid=$stmt->insert_id;
				$procode=floor(((double) microtime() * 10000)).$lastid;
				$smt_code->bind_param("si",$procode,$lastid);

				if($smt_code->execute()){
					$status=[ 'status' => 'success'];
					$con->commit();	
				}else{
					$status=[ 'status' => 'fail, Product code error' ];
					$con->rollback();
				}
			}
			if($id==0){
				$stmt_size = $con->prepare("INSERT INTO tbl_availablesizes(
					size_id,
					product_id,
					createdby,
					createdat
				)VALUES(?, ?, ?, ?)");
				
				foreach($size as $sizevalue){
					$stmt_size->bind_param("iiis",$sizevalue,$lastid,$user_id,$present);
					if($stmt_size->execute()){
						$status=[ 'status' => 'success'];
						$con->commit();	
					}else{
						$status=[ 'status' => 'fail, Product size error' ];
						$con->rollback();
					}
				}
				
			}
			else{
				$stmt_delete = $con->prepare("DELETE FROM tbl_availablesizes WHERE product_id=?");	
				$stmt_delete->bind_param("i",$id);
				if($stmt_delete->execute()){
					$stmt_size = $con->prepare("INSERT INTO tbl_availablesizes(
						size_id,
						product_id,
						createdby,
						createdat
					)VALUES(?, ?, ?, ?)");
					
					foreach($size as $sizevalue){
						$stmt_size->bind_param("iiis",$sizevalue,$id,$user_id,$present);
						if($stmt_size->execute()){
							$status=[ 'status' => 'success'];
							$con->commit();	
						}else{
							$status=[ 'status' => 'fail, Product size error' ];
							$con->rollback();
						}
					}
				}
				else{
					$status=[ 'status' => 'fail, Product size update error' ];
					$con->rollback();
				}
			}				
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