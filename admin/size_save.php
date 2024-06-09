<?php
include_once("adminsession.php");
//error_reporting(0);
include_once("db_connection.php");

$status="success";

//if (isset($_POST["submit"])) {
	if($status=="success"){		
		$size=$_POST["size"];
		$aboutsize=$_POST["aboutsize"];				       
		$orderno=$_POST["orderno"];	
		$id=0;
		$stmt="";				
		if(!isset($_POST["hdid"])){            
			$stmt = $con->prepare("INSERT INTO tbl_size (
				size, 
				aboutsize,	
				orderno,											
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?)");		
            $stmt->bind_param("ssiis", $size, $aboutsize, $orderno, $user_id, $present);	
                    
		}
		else{
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_size SET
				size=?, 
				aboutsize=?,
				orderno=?,				
				updatedby=?,
				updatedat=? WHERE size_id=?");
            $stmt->bind_param("ssiisi", $size, $aboutsize, $orderno, $user_id, $present, $id);
        
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