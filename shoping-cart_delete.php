<?php
ob_start();
$status=[ 'status' => 'error',"message" => "Success" ];
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
$flag=0;
if(isset($_GET['id'])){    
    $id=$_GET['id'];
    foreach ($_SESSION['cart']  as $index=>$subArray) {
        if ($subArray["id"] == $id) {
                unset($_SESSION['cart'][$index]);
                $flag=1;               
        }
    }
    if($flag==1){
        $status=['status' => 'success',"message" => "Item removed from cart "];
    }else{
        $status=[ 'status' => 'exist',"message" => "This item does't exists in cart "];
    }
}
echo json_encode($status);
?>