<?php
ob_start();
session_start();
if(isset($_SESSION['userid'])){
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    $_SESSION['userid']="";
    session_destroy();
    header("location:index.php");
}
else{
    header("location:login.php");
}

?>