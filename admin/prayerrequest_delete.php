<?php
include_once("adminsession.php");
include_once("db_connection.php");
$status=array('status'=>'success');
//if (isset($_POST["submit"])) {

	if(isset($_GET["delid"])){		
		$id=$_GET["delid"];
		$stmt = $con->prepare("UPDATE tbl_prayerrequest
            SET isdeleted=1,
            updatedat=?,
            updatedby=?
			WHERE request_id=?");
		$stmt->bind_param("sii",$present, $user_id, $id);
	
		if($stmt->execute()){
			$status=['status'=>'success'];
		}
		else{
			$status=['status'=>'fail'];
		}
		$stmt->close();
	}
	
	
//}
$con->close();
echo json_encode($status);
?>
