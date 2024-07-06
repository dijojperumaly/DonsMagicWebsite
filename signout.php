<?php
ob_start();
session_start();
if(isset($_SESSION['login_id'])){
    unset($_SESSION['login_id']);
    unset($_SESSION['login_name']);
    unset($_SESSION['role']);
    $_SESSION['login_id']="";
    session_destroy();
    header("location:index.php");
}
else{
    header("location:login.php");
}

?>