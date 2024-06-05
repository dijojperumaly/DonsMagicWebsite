<?php
include_once("adminsession.php");
error_reporting(0);
include_once("db_connection.php");

$status="success";
$edit_filename=null;
$edit_document=null;
$filename="";
$documentfilename="";
$folder = "./assets/retreat/";
$folder_document = "./assets/retreat/";

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
		$retreattype=$_POST["retreattype"];
		$title=$_POST["title"];
		$subtitle=$_POST["subtitle"];
		$matter =$_POST["matter"];
		$retreatstartdate=isset($_POST["retreatstartdate"])&&$_POST["retreatstartdate"]!=null?$_POST["retreatstartdate"]:NULL;
		$retreatstarttime=isset($_POST["retreatstarttime"])&&$_POST["retreatstarttime"]!=null?$_POST["retreatstarttime"]:NULL;
		$retreatenddate=isset($_POST["retreatenddate"])&&$_POST["retreatenddate"]!=null?$_POST["retreatenddate"]:NULL;
		$retreatendtime=isset($_POST["retreatendtime"])&&$_POST["retreatendtime"]!=null?$_POST["retreatendtime"]:NULL;
		$startdate =isset($_POST["startdate"])&&$_POST["startdate"]!=null?$_POST["startdate"]:NULL;
		$enddate=isset($_POST["enddate"])&&$_POST["enddate"]!=null?$_POST["enddate"]:NULL;	
        $nodays=$_POST["nodays"];	
		$noseats=$_POST["noseats"];	
        $venu=$_POST["venu"];	
        $deligate=$_POST["deligate"];	
		$orderno=$_POST["orderno"];					

		$id=0;
		$stmt="";
		$retreatstarttime=date("h:i",strtotime($retreatstarttime));
		$retreatendtime=date("h:i",strtotime($retreatendtime));
		$retreatstartdate=$retreatstartdate. " ".$retreatstarttime;
		$retreatenddate=$retreatenddate." ".$retreatendtime;
		//$retreatstartdate=date("Y-m-d h:m:s",$retreatstartdate);
		$status=$retreatstartdate . "  ". $present;
		if(!isset($_POST["hdid"])){            
			$stmt = $con->prepare("INSERT INTO tbl_retreat (
				retreattype_id,
				title, 
				subtitle,
				matter,	
				retreatstartdate,	
                retreatenddate,
				startdate, 
				enddate,
				nodays,
				noseats,
				banner,
                venu,
				deligate_id,
				orderno,
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");		
            $stmt->bind_param("issssssssissiiis", $retreattype, $title, $subtitle, $matter, $retreatstartdate, $retreatenddate, $startdate, $enddate, $nodays, $noseats, $filename, $venu,$deligate, $orderno, $user_id, $present);		
                    
		}
		else{
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_retreat SET
				retreattype_id=?,
				title=?, 
				subtitle=?,
				matter=?,
				retreatstartdate=?,	
                retreatenddate=?,	
				startdate=?, 
				enddate=?,
				nodays=?,
				noseats=?,
				banner=?,
				venu=?,
				deligate_id=?,
				orderno=?,
				updatedby=?,
				updatedat=? WHERE id=?");
            $stmt->bind_param("isssssssssisiiisi", $retreattype, $title, $subtitle, $matter, $retreatstartdate, $retreatenddate, $startdate, $enddate, $nodays, $noseats, $filename, $venu, $deligate, $orderno, $user_id,$present,$id);
        
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