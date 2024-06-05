<?php
include_once("adminsession.php");
error_reporting(0);
include_once("db_connection.php");

$status="success";
$edit_filename=null;
$edit_document=null;
$filename="";
$documentfilename="";
$folder = "./assets/retreattype/type_banner/";
$folder_document = "./assets/retreattype/type_document/";

if(isset($_POST["hdbanner"])){
	$edit_filename=$_POST["hdbanner"];
}
if(isset($_POST["hddocument"])){
	$edit_document=$_POST["hddocument"];
}
$filename=$edit_filename;
$documentfilename=$edit_document;

$con->begin_transaction();
//if (isset($_POST["submit"])) {

	if (isset($_FILES["banner"]['name'])) {		
		$fname = $_FILES['banner']['name'];
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed_imagetype)) {
			$status=[ 'status' => 'filetype_error' ];
		}else if($_FILES['banner']['size'] > 1048576){
			$status=[ 'status' => 'filesize_error' ];
		}else{
			$filename=date('ymdHisu').gettimeofday()["usec"].".".$ext;		
			//$filename = $_FILES["banner"]["name"];
			$tempname = $_FILES["banner"]["tmp_name"];			
			
			// Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder.$filename)) {
				if($edit_filename!=""){
					if(unlink($folder.$edit_filename)){}
                }
                $status="success";
			}
			else {
				$status=[ 'status' => 'fail' ];
			}
		}
	}
	
	if($status=="success"){		
		$type=$_POST["type"];
		$aboutype=$_POST["aboutype"];				
        $noseats=$_POST["noseats"];	        
        $deligate=$_POST["deligate"];	
		$orderno=$_POST["orderno"];					

		$id=0;
		$stmt="";				
		if(!isset($_POST["hdid"])){            
			$stmt = $con->prepare("INSERT INTO tbl_retreattype (
				retreattype, 
				abouttype,								
				noseats,
				image,                
				deligate_id,
				orderno,
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");		
            $stmt->bind_param("ssisiiis", $type, $aboutype, $noseats, $filename, $deligate, $orderno, $user_id, $present);	
                    
		}
		else{
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_retreattype SET
				retreattype=?, 
				abouttype=?,
				noseats=?,
				image=?,              				
				deligate_id=?,
				orderno=?,
				updatedby=?,
				updatedat=? WHERE retreattype_id=?");
            $stmt->bind_param("ssisiiisi", $type, $aboutype, $noseats, $filename, $deligate, $orderno, $user_id,$present,$id);
        
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