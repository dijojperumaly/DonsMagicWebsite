<?php
include_once("adminsession.php");
include_once("db_connection.php");
error_reporting(0);
$status=array('status'=>'success');
$folder = "../images/products/";
//if (isset($_POST["submit"])) {

	if(isset($_GET["delid"])){		
		$id=$_GET["delid"];
		$sqlimage = "SELECT  IFNULL(image_1,'')image_1,
		IFNULL(image_2,'')image_2,
		IFNULL(image_3,'')image_3,
		IFNULL(image_4,'')image_4
        FROM tbl_product 
		WHERE IFNULL(id,0)=$id";		
        
		$results_image = $con->query($sqlimage);    
		//mysqli_free_result($results_image);
		$imagefiles=array();
		if($row_image=$results_image->fetch_assoc()){  
			array_push($imagefiles,$row_image["image_1"]);
			array_push($imagefiles,$row_image["image_2"]);
			array_push($imagefiles,$row_image["image_3"]);
			array_push($imagefiles,$row_image["image_4"]);
			for($i=0;$i<count($imagefiles);$i++){
				if($imagefiles[$i]!="" && $imagefiles[$i]!=NULL){
					if(unlink($folder.$imagefiles[$i])){
						$edit_filename="";
					}
				}
			}
			
		} 
		$stmt = $con->prepare("DELETE FROM tbl_product
			WHERE 	id=?");
		$stmt->bind_param("i", $id);
	
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
