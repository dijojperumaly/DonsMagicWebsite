<?php
ob_start();
$status=[ 'status' => 'success' ];
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
//$obj = json_decode($_POST["myData"]);
//check if product is already in the cart
if(!in_array($_GET['id'], $_SESSION['cart'])){
//if(!in_array($obj->id, $_SESSION['cart'])){
    array_push($_SESSION['cart'], $_GET['id']);
    $status=[ 'status' => 'Product added to cart'];
}
else{
    $status=[ 'status' => 'Product already in cart' ];
}
echo json_encode($status);
?>