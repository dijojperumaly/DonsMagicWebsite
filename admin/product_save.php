<?php
include_once("adminsession.php");
//error_reporting(0);
include_once("db_connection.php");
$id=0;
$status['status']="success";
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
$files_name_arr=array();
$con->begin_transaction();
//if (isset($_POST["submit"])) {

	if (isset($_FILES["imagefile"]['name'])) {	
		/*$fname = $_FILES['imagefile']['name'];
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
		}*/
		$countfiles = count($_FILES['imagefile']['name']);
		for($index = 0,$image_index=0;$index < $countfiles;$index++,$image_index++)
		{			
			$fname = $_FILES['imagefile']['name'][$index];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed_imagetype)) {
				$status=[ 'status' => 'filetype_error' ];
			}else if($_FILES['imagefile']['size'][$index] > 1048576){
				$status=[ 'status' => 'filesize_error' ];
			}else{
				$filename=date('ymdHisu').gettimeofday()["usec"].$image_index.".".$ext;
				$files_name_arr[$index]=$filename;
				//$filename = $_FILES["imagefile"]["name"];
				$tempname = $_FILES["imagefile"]["tmp_name"][$index];	
				//$folder = "./images/partsmodel/";
				
				// Now let's move the uploaded image into the folder: image
				if (move_uploaded_file($tempname, $folder.$filename)) {
					if($edit_filename!=""){
						//if(unlink($folder.$edit_filename)){}
					}
				}
				else {
					$status=[ 'status' => 'fail' ];
				}
			}
		}
	}		
	$size=array();
	if($status['status']=="success"){		
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
		$imagetitle=isset($_POST["imagetitle"])?$_POST["imagetitle"]:array();
		$itemstyle=isset($_POST["itemstyle"])? $_POST["itemstyle"]:2;	
		$cid=0;
		$stmt="";
		$smt_code="";
		if(!isset($_POST["hdid"])){
			if($itemstyle==2){
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
					$i=0;
				foreach($files_name_arr as $fnamegallery){
					$img_title="";
					if($imagetitle[$i]!="" && $imagetitle[$i]!=NULL){
						$img_title=$imagetitle[$i];
					}else{
						$img_title=$title;
					}
					$i=$i+1;
					$stmt->bind_param("issiiisisssis", $producttype, $img_title, $aboutproduct, $mrp, $offerprice, $featured, $fnamegallery, $orderno, $productstatus, $label, $color, $user_id, $present);		
					$smt_code=$con->prepare("UPDATE tbl_product SET product_code=CONCAT((SELECT typecode FROM tbl_producttype WHERE producttype_id=$producttype),?) WHERE id=?");
					if($stmt->execute()){	
						$lastid=0;		
						if($smt_code!=""){				
							$lastid=$stmt->insert_id;
							$procode=floor(((double) microtime() * 100000)).$lastid;
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
					}
				}
				$stmt->close();	
			}
			else{				
				$image_1="";
				$image_2="";
				$image_3="";
				$image_4="";
				$pos=1;
				$stmt="";
				$stmt = $con->prepare("INSERT INTO tbl_product (
					producttype_id,
					title, 
					aboutproduct,
					MRP,	
					offerprice,	
					isfeatured,
					image_1,
					image_2,
					image_3,
					image_4,
					orderno,
					status,
					label,
					color,
					createdby,
					createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				foreach($files_name_arr as $fnamegallery){
					switch($pos){
						case 1:
							$image_1=$fnamegallery;	
							break;
						case 2:
							$image_2=$fnamegallery;	
							break;
						case 3:
							$image_3=$fnamegallery;	
							break;
						case 4:
							$image_4=$fnamegallery;	
							break;
					}
					$pos=$pos+1;
					if($pos==5){
						break;
					}
				}
				//$i=$i+1;
				$stmt->bind_param("issiiissssisssis", $producttype, $img_title, $aboutproduct, $mrp, $offerprice, $featured, $image_1, $image_2, $image_3, $image_4, $orderno, $productstatus, $label, $color, $user_id, $present);		
				$smt_code=$con->prepare("UPDATE tbl_product SET product_code=CONCAT((SELECT typecode FROM tbl_producttype WHERE producttype_id=$producttype),?) WHERE id=?");
				if($stmt->execute()){	
					$lastid=0;		
					if($smt_code!=""){				
						$lastid=$stmt->insert_id;
						$procode=floor(((double) microtime() * 100000)).$lastid;
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
				}				
				$stmt->close();	
			}
					
		}
		else{  // update product start			
			$id=$_POST["hdid"];

			$sql = "SELECT  IFNULL(p.image_1,'') image_1,
						IFNULL(p.image_2,'') image_2,
						IFNULL(p.image_3,'') image_3,
						IFNULL(p.image_4,'') image_4			
					FROM tbl_product p WHERE p.id=$id";
				
			$results = $con->query($sql);    
			$image_1="";
			$image_2="";
			$image_3="";
			$image_4="";
			if($row=$results->fetch_array(MYSQLI_ASSOC)){  
				$image_1=$row["image_1"];
				$image_2=$row["image_2"];
				$image_3=$row["image_3"];              
				$image_4=$row["image_4"]; 
			}
			for($i=0;$i<count($files_name_arr);$i++){
				if($image_1==""){
					$image_1=$files_name_arr[$i];					
				}else if($image_2==""){
					$image_2=$files_name_arr[$i];					
				}else if($image_3==""){
					$image_3=$files_name_arr[$i];					
				}else if($image_4==""){
					$image_4=$files_name_arr[$i];					
				}
			}
			$stmt = $con->prepare("UPDATE tbl_product SET
				producttype_id=?,
				title=?, 
				aboutproduct=?,
				MRP=?,	
				offerprice=?,	
				isfeatured=?,
				image_1=?,
				image_2=?,
				image_3=?,
				image_4=?,
				orderno=?,
				status=?,
				label=?,
				color=?,
				updatedby=?,
				updatedat=? WHERE id=?");
			$stmt->bind_param("issiiissssisssisi", $producttype, $title, $aboutproduct, $mrp, $offerprice, $featured, $image_1, $image_2, $image_3, $image_4, $orderno, $productstatus, $label, $color, $user_id, $present,$id);									
							
			if($stmt->execute()){	
				$stmt_delete = $con->prepare("DELETE FROM tbl_availablesizes WHERE product_id=?");	
				$stmt_delete->bind_param("i",$id);
				if($stmt_delete->execute()){
					$status=[ 'status' => 'success'];
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
			else{
				$status=[ 'status' => 'fail' ];
				$con->rollback();
			}
			$stmt->close();	
			
		}
		
	}	
//}
if($status[ 'status']=='success'){
	$con->commit();
}else{				
	$con->rollback();
}
$con->close();
echo json_encode($status);
?>