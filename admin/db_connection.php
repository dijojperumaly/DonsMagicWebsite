<?php
ob_start();
date_default_timezone_set('Asia/Kolkata');
$present=date('Y-m-d H:i');
function currentDateTime(){
  $present=date('Y-m-d H:i');
}

define("PRIMARY_CONTACT",1);
define("SECONDARY_CONTACT",2);
define("USER_ACTIVE",'Active');
define("USER_INACTIVE",'Inactive');

$statusarray=array("ACTIVE"=>"Active","DRAFT"=>"Draft","SOLDOUT"=>"SoldOut");
$productlabelarray=array("NEW"=>"New");
$contactarray=array("PRIMARY"=>"PRIMARY","SECONDARY"=>"SECONDARY");

//local server
$servername = "localhost";
$username = "root";
$password ="root";
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