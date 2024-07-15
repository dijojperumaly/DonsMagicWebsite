<?php
include_once("adminsession.php");
include_once("db_connection.php");
$status=array('status'=>'success');
error_reporting(0);
$folder = "../images/products/";
	if(isset($_GET["delid"])){		
		$id=$_GET["delid"];
        $fileName=$_GET["fileName"];
        $field=$_GET["field"];
        $column="image_1";
        switch(trim($field)){
            case 1:
                $column="image_1";
                break;
            case 2:
                $column="image_2";
                break;
            case 3:
                $column="image_3";
                break;
            case 4:
                $column="image_4";
                break;
            default:
                $column="image_1";
        }
		$stmt = $con->prepare("UPDATE tbl_product SET ".$column."=NULL
			WHERE 	id=?");
		$stmt->bind_param("i", $id);
	
		if($stmt->execute()){
			$status=['status'=>'success'];
            if(unlink($folder.$fileName)){
                $status=['status'=>'success'];
            }
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
