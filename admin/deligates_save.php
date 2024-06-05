<?php
include_once("adminsession.php");
error_reporting(0);
include_once("db_connection.php");

$status="success";
$edit_filename="";
$edit_document="";
$filename="";
$documentfilename="";
$folder = "./assets/deligates/profile_image/";
$folder_document="./assets/deligates/document/";

if(isset($_POST["hdimage"])){
	$edit_filename=$_POST["hdimage"];
}
if(isset($_POST["hddocument"])){
	$edit_document=$_POST["hddocument"];
}
$filename=$edit_filename;
$documentfilename=$edit_document;

$con->begin_transaction();
//if (isset($_POST["submit"])) {

    if (isset($_FILES["imagefile"])) {		
		$fname = $_FILES['imagefile']['name'];
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed_imagetype)) {
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
                $status="success";
			}
			else {
				$status=[ 'status' => 'fail' ];
			}
		}
	}
	
	if (isset($_FILES["document"]['name'])) {		
		$fname = $_FILES['document']['name'];
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed_documenttype)) {
			$status=[ 'status' => 'filetype_error' ];
			if($fname!=""){
				if(unlink($folder.$edit_document)){}
			}
		}else if($_FILES['document']['size'] > 1048576){
			$status=[ 'status' => 'filesize_error' ];
			if($fname!=""){
				if(unlink($folder.$edit_document)){}
			}
		}else{
			$documentfilename=date('ymdHisu').gettimeofday()["usec"].".".$ext;		
			//$documentfilename = $_FILES["document"]["name"];
			$tempname = $_FILES["document"]["tmp_name"];	
			
			
			// Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder_document.$documentfilename)) {
				if($edit_document!=""){
					if(unlink($folder_document.$edit_document)){}
                }
                $status="success";
			}
			else {
				$status=[ 'status' => 'fail' ];
				if($fname!=""){
					if(unlink($folder.$edit_document)){}
				}
			}
		}
    }   
	if($status=="success"){	
        $status=[ 'status' => 'test' ];  
		$name=$_POST["name"];
		$housename=$_POST["housename"];
		$address=$_POST["address"];
		$contact=$_POST["contact"];
		$email=$_POST["email"];
		$about=$_POST["about"];
        $profile=$_POST["profile"];	
        $message=$_POST["message"];       
		$orderno=$_POST["orderno"];					

		$cid=0;
		$stmt="";
	//    $featured=1;
		if(!isset($_POST["hdid"])){            
			$stmt = $con->prepare("INSERT INTO tbl_deligates (
				name,
				housename,
				address,
				contact,
				email, 
				about,
				profile,
                message,
				document_file,
                image,				
				orderno,
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");		
            $stmt->bind_param("ssssssssssiis", $name, $housename, $address, $contact, $email, $about, $profile, $message, $documentfilename, $filename, $orderno, $user_id, $present);		
            
		}
		else{
            $status=[ 'status' => 'update' ];  
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_deligates SET
				name=?,
				housename=?,
				address=?,
				contact=?,
				email=?, 
				about=?,
				profile=?,
                message=?,
				document_file=?,
                image=?,				
				orderno=?,
				updatedby=?,
				updatedat=? WHERE id=?");
            $stmt->bind_param("ssssssssssiisi", $name, $housename, $address, $contact, $email, $about, $profile, $message, $documentfilename, $filename, $orderno, $user_id, $present,$id); 
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