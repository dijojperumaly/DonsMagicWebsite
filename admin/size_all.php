<?php
include_once("adminsession.php");
include_once("db_connection.php");

$sql = "SELECT c.size_id,
        c.size,
        c.aboutsize,
        c.orderno,           
        IFNULL(c.STATUS,'Active') status
        FROM tbl_size c        
        WHERE IFNULL(c.isdeleted,0)=0         
        ORDER BY IFNULL(c.orderno,0) ASC";

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