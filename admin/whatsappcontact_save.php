<?php
include_once("adminsession.php");
//error_reporting(0);
include_once("db_connection.php");

$status="success";

//if (isset($_POST["submit"])) {
	if($status=="success"){		
		$type=$_POST["type"];
		$contact=$_POST["contact"];				       
		$id=0;
		$stmt="";				
		if(!isset($_POST["hdid"])){            
			$stmt = $con->prepare("INSERT INTO tbl_contact (
				contact, 
				type,												
				createdby,
				createdat) VALUES (?, ?, ?, ?)");		
            $stmt->bind_param("ssis", $contact, $type, $user_id, $present);	
                    
		}
		else{
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_contact SET
				contact=?, 
				type=?,				
				updatedby=?,
				updatedat=? WHERE contact_id=?");
            $stmt->bind_param("ssisi", $contact, $type, $user_id,$present,$id);
        
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