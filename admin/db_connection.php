<?php
ob_start();
date_default_timezone_set('Asia/Kolkata');
$present=date('Y-m-d H:i');
function currentDateTime(){
  $present=date('Y-m-d H:i');
}

define("PEDDING",0);
define("WAITING",1);
define("CONFIRMED",2);
define("CANCELED",3);
//local server
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "db_donswebadmin";

//production server

/*$servername = "Localhost";
$username = "n754b65_root";
$password ="root@edendesigns.in";
$dbname = "n754b65_db_donswebadmin";*/


// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
  die("Connection failed: DB Server not responding" );// $conn->connect_error);
}

?>