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
		$retreat_id=$_POST["hdretreat_id"];
		$name=$_POST["name"];
		$housename=$_POST["housename"];
        $gender=$_POST["gender"];
        $dateofbirth=$_POST["dateofbirth"];
        $place=$_POST["place"];
        $diocese=$_POST["diocese"];	
        $parish=$_POST["parish"];		
        $phone=$_POST["phone"];	
		$email=$_POST["email"];       
		$id=0;
		$stmt="";
	//    $featured=1;
		if(!isset($_POST["hdid"])){
			$stmt = $con->prepare("INSERT INTO tbl_retreatbooking (
				hdretreat_id,
				name, 
				housename,
				gender,	
				dateofbirth,	
				place, 
				dioceses,
				parish,	
                contact,
                email,
                booking_date,		
				createdby,
				createdat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");		
			$stmt->bind_param("issssssssssis", $retreat_id, $name, $housename, $gender, $dateofbirth, $place, $diocese,$parish,$phone,$email,$present,$user_id, $present);		
		}
		else{
            $id=$_POST["hdid"];            
			$stmt = $con->prepare("UPDATE tbl_retreatbooking SET
				retreat_id=?,
				name=?,
                housename=?,
                gender=?,	
                dateofbirth=?,
                place=?,
                dioceses=?,
                parish=?,
                contact=?,
                email=?,
				updatedby=?,
				updatedat=? WHERE bookingid=?");
			$stmt->bind_param("isssssssssisi", $retreat_id, $name, $housename, $gender, $dateofbirth, $place, $diocese,$parish,$phone,$email, $user_id, $present,$id);
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