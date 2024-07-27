<?php
include_once("admin/db_connection.php");
$status=['status' => 'success']; 
//$con->begin_transaction();
//if(isset($_POST["txtname"])){	
    $name=$_POST["txtname"];
    $phone=$_POST["txtphone"];
    $email=$_POST["txtemail"];  
    $password=$_POST["txtpassword"];  

    if(trim($name)==""){
        $status=[ 'status' => 'fill your name' ];   
    }else if(trim($phone)==""){
        $status=[ 'status' => 'fill your phone number' ];   
    }else if(trim($email)==""){
        $status=[ 'status' => 'fill your email' ];  
    }else if(trim($password)==""){
        $status=[ 'status' => 'fill your password!' ];   
    }else if(strlen(trim($password))<6){
        $status=[ 'status' => 'password minimum lenth is 6!' ];   
    }else{
        $stmt = $con->prepare("INSERT INTO tbl_useraccount(
                            name,
                            phone,
                            email,
                            password,                            
                            createdat
                            )
                            VALUES(?, ?, ?, ?, ?)");

        $stmt->bind_param("sssss", $name, $phone, $email, $password, $present);    
        if($stmt->execute()){
            $status=[ 'status' => 'success' ];
            $con->commit();
        }
        else{
            $status=[ 'status' => 'fail insert' ];
            $con->rollback();
        }
        $stmt->close();
    }    
//}
/*else{
    $status=[ 'status' => 'fail' ];    
    $con->rollback();
}*/
$con->close();
echo json_encode($status);
