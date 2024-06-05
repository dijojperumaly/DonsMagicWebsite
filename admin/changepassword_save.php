<?php
include_once("adminsession.php");
include_once("db_connection.php");
$status="success";
//$con->begin_transaction();
if(isset($_POST["newpassword"])){	
    $oldpassword=$_POST["oldpassword"];
    $newpassword=$_POST["newpassword"];
    $confirmpassword=$_POST["confirmpassword"];   
    if($newpassword===$confirmpassword){
        $stmt = $con->prepare("UPDATE tbl_login SET
            password=? 
            WHERE user_Id=? AND password=?");
        $stmt->bind_param("sis", $newpassword,$user_id,$oldpassword);    
        if($stmt->execute()){
            if($stmt->affected_rows>0){
                $status=[ 'status' => 'success' ];
                $con->commit();
            }
           else{
                $status=[ 'status' => 'old' ];
                $con->rollback();
            }
        }
        else{
            $status=[ 'status' => 'old' ];
            $con->rollback();
        }
        $stmt->close();
    }
    else{
        $status=[ 'status' => 'confirm' ];
        $con->rollback();
    }
}
else{
    $status=[ 'status' => 'fail' ];    
    $con->rollback();
}
$con->close();
echo json_encode($status);
