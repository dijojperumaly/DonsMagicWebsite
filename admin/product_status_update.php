<?php
include_once("adminsession.php");
error_reporting(0);
include_once("db_connection.php");
$id=0;
$status="success";

$con->begin_transaction();
//if (isset($_POST["submit"])) {	
	if($status=="success"){	
        $id=$_GET["id"];
		$productstatus=$_GET["productstatus"];			
        $stmt = $con->prepare("UPDATE tbl_product SET           
            status=?,          
            updatedby=?,
            updatedat=? WHERE id IN($id)");
        $stmt->bind_param("sis", $productstatus, $user_id, $present);				
		if($stmt->execute()){	
            $status=[ 'status' => 'success' ];
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