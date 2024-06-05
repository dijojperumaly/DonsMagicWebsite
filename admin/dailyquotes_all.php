<?php
include_once("adminsession.php");
include_once("db_connection.php");
// Set the INSERT SQL data
$sql = "SELECT  dailyid,vachanam, lesson, orderno, IFNULL(STATUS,'Active') status,IFNULL(orderno,0) orderno FROM tbl_dailyvachanam WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active' ORDER BY IFNULL(orderno,0) ASC";

// Process the query so that we will save the date of birth
$results = $con->query($sql);

// Fetch Associative array
$row = $results->fetch_all(MYSQLI_ASSOC);

// Free result set
$results->free_result();

// Close the connection after using it
$con->close();

echo json_encode($row);

?>