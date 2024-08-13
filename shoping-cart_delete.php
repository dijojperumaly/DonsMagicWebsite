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
if(isset($_GET['id'])){    
    //if(!in_array($_GET['id'], $_SESSION['cart']["id"])){
    if(array_search($_GET['id'], array_column($_SESSION['cart'], 'id')) == true) {
        $id=$_GET['id'];
        $i=0;
        foreach ($_SESSION['cart']  as $subArray) {
            if ($subArray["id"] == $id) {
                 unset($_SESSION['cart'][$i]);
            }
            $i=$i+1;
        }
        $status=[ 'status' => 'success',"message" => "Item removed from cart "];
    }
    else{
        $status=[ 'status' => 'exist',"message" => "This item does't exists in cart " . $_GET['id'] ];
    }
}
print_r($_SESSION['cart'] );
echo json_encode($status);
?>