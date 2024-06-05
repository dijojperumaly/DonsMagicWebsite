<?php
include_once("adminsession.php");
include_once("db_connection.php");

$status=array('status'=>'success');
//if (isset($_POST["submit"])) {

	if(isset($_GET["id"])){		
		$id=$_GET["id"];
		$booking_status=$_GET["status"];
		$stmt = $con->prepare("UPDATE tbl_retreatbooking
            SET booking_status=?,
            updatedat=?,
            updatedby=?
			WHERE bookingid=?");
		$stmt->bind_param("isii",$booking_status, $present, $user_id, $id);
	
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
