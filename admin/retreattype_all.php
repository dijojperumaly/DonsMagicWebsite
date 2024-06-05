<?php
include_once("adminsession.php");
include_once("db_connection.php");

$sql = "SELECT   r.retreattype_id,
        d.id deligate_id,
        d.name,
        r.retreattype,
        r.noseats,
        IFNULL(r.abouttype,'') abouttype, 
        IFNULL(r.document_file,'') document_file, 
        r.image,                     
        IFNULL(r.STATUS,'Active') status,
        IFNULL(r.orderno,0) orderno 
        FROM tbl_retreattype r
        LEFT JOIN tbl_deligates d ON r.deligate_id=d.id
        WHERE IFNULL(r.isdeleted,0)=0 
        AND IFNULL(r.STATUS,'Active')='Active' 
        ORDER BY IFNULL(r.orderno,0), r.retreattype ASC";

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