<?php
error_reporting(0);
include_once("db_connection.php");
//include_once("adminsession.php");
if(!isset($user_id)){
    $user_id=-1;
}
$status="success";
$con->begin_transaction();
//if (isset($_POST["submit"])) {

	if($status=="success"){		
		$name=$_POST["name"];
		$housename=$_POST["housename"];
		$place=$_POST["place"];
		$email=$_POST["email"];		
		$subject=$_POST["subject"];	
        $phone=$_POST["phone"];					
        $message=$_POST["message"];
       
		$id=0;
		$stmt="";
	//    $featured=1;
		if(!isset($_POST["hdid"])){
			$stmt = $con->prepare("INSERT INTO tbl_prayerrequest (
				name, 
				hname,
				place,	
				email,	
				subject, 
				contact,
				reson,				
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");		
			$stmt->bind_param("sssssssis", $name, $housename, $place, $email, $subject, $phone,$message, $user_id, $present);		
		}
		else{
            $id=$_POST["hdid"];
            $replymessage=$_POST["replymessage"];
			$stmt = $con->prepare("UPDATE tbl_prayerrequest SET
				isreplyed=1,
                replydate=?,
                reply=?,		
				updatedby=?,
				updatedat=? WHERE request_id=?");
			$stmt->bind_param("ssisi", $present, $replymessage, $user_id,$present,$id);
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