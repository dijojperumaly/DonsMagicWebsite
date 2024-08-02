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
    if(!in_array($_GET['id'], $_SESSION['cart'])){
        array_push($_SESSION['cart'], $_GET['id']);
        $status=[ 'status' => 'success',"message" => "Item added to cart "];
    }
    else{
        $status=[ 'status' => 'exist',"message" => "This item already in cart" ];
    }
}

echo json_encode($status);
?>