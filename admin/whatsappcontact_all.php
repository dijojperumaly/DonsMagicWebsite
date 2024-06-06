<?php
include_once("adminsession.php");
include_once("db_connection.php");

$sql = "SELECT c.contact_id,
        c.contact,
        c.type,                
        IFNULL(c.STATUS,'Active') status
        FROM tbl_contact c        
        WHERE IFNULL(c.isdeleted,0)=0         
        ORDER BY IFNULL(c.type,0) ASC";

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