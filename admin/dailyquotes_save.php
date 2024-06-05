<?php
error_reporting(0);
include_once("adminsession.php");
include_once("db_connection.php");
$status="success";
$quote="";
$lesson="";
$orderno="";

$con->begin_transaction();
//if (isset($_POST["submit"])) {
 
	if($status=="success"){	        
		$quote=$_POST["quote"];
		$lesson=$_POST["lesson"];       
		$orderno=$_POST["orderno"];					
		$cid=0;
		$stmt="";
	//    $featured=1;
		if(!isset($_POST["hdid"])){            
			$stmt = $con->prepare("INSERT INTO tbl_dailyvachanam (
				vachanam,
				lesson,			
				orderno,
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?)");		
            $stmt->bind_param("ssiis", $quote, $lesson, $orderno, $user_id, $present);		
            
		}
		else{
            $status=[ 'status' => 'update' ];  
			$id=$_POST["hdid"];
			$stmt = $con->prepare("UPDATE tbl_dailyvachanam SET
				vachanam=?,
				lesson=?,					
				orderno=?,
				updatedby=?,
				updatedat=? WHERE dailyid=?");
            $stmt->bind_param("ssiisi", $quote, $lesson, $orderno, $user_id, $present,$id); 
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