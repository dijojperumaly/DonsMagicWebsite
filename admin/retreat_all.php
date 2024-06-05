<?php
include_once("adminsession.php");
include_once("db_connection.php");

$sql = "SELECT   r.id,
        d.id deligate_id,
        IFNULL(d.name,'') name,
        IFNULL(d.housename,'') housename,
        IFNULL(r.title,'')title, 
        IFNULL(r.subtitle,'') subtitle, 
        IFNULL(r.matter, '') matter,
        IFNULL(r.retreatstartdate,'') retreatstartdate, 
        IFNULL(r.retreatenddate,'') retreatenddate, 
        IFNULL(r.startdate,'') startdate, 
        IFNULL(r.enddate,'') enddate, 
        IFNULL(r.banner,'') banner, 
        IFNULL(r.nodays,'') nodays,
        r.noseats,
        r.venu, 
        r.deligate_id, 
        r.retreattype_id,
        IFNULL(r.STATUS,'Active') status,
        IFNULL(r.orderno,0) orderno 
    FROM tbl_retreat r
    LEFT JOIN tbl_deligates d ON r.deligate_id=d.id
    WHERE IFNULL(r.isdeleted,0)=0 
    AND IFNULL(r.STATUS,'Active')='Active' 
    ORDER BY IFNULL(r.orderno,0), r.retreatstartdate ASC";

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