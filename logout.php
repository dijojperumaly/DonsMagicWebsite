<?php
ob_start();
session_start();
if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['phone']);
    unset($_SESSION['email']);
    $_SESSION['userid']="";
    session_destroy();
    if(isset($_SESSION["lasturl"])){
        header("location:".$_SESSION["lasturl"]);
        echo "dddd";
    }else{
        header("location:./index.php");                        
    }

}
else{
    header("location:login.php");
}

?>