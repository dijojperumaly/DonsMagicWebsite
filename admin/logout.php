<?php
ob_start();
session_start();
if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['role']);
    $_SESSION['user_id']="";
    session_destroy();
    header("location:login.php");
}
else{
    header("location:login.php");
}

?>