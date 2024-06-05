<?php
include_once("adminsession.php");
include_once("db_connection.php");

// Set the INSERT SQL data
$sql = "SELECT  image,id, name, housename, address, IFNULL(contact,'') contact, IFNULL(email,'') email, IFNULL(about,'') about, profile, message, IFNULL(document_file,'') document_file, IFNULL(STATUS,'Active') status,IFNULL(orderno,0) orderno FROM tbl_deligates WHERE IFNULL(isdeleted,0)=0 AND IFNULL(STATUS,'Active')='Active' ORDER BY IFNULL(orderno,0),name ASC";

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