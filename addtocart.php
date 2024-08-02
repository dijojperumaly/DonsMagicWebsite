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
    if(array_search($_GET['id'], array_column($_SESSION['cart'], 'id')) === false) {
        $id=$_GET['id'];
        $type=$_GET['type'];
        $product_code=$_GET['product_code'];
        $price=$_GET['price'];        
        $newdata =  array (
            'id' => $id,
            'type' => $type,
            'product_code' => $product_code,
            'price' => $price
        );
        array_push($_SESSION['cart'], $newdata);    
        $status=[ 'status' => 'success',"message" => "Item added to cart "];
    }
    else{
        $status=[ 'status' => 'exist',"message" => "This item already in cart" ];
    }
}
echo json_encode($status);
?>