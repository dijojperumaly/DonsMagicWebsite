<?php
include_once("adminsession.php");
include_once("db_connection.php");

// Set the INSERT SQL data
$sql = "SELECT   p.request_id,
            d.id deligate_id,
            d.name,
            d.housename,
            IFNULL(p.name,'')name, 
            IFNULL(p.hname,'') hname, 
            IFNULL(subject,'') subject,
            IFNULL(p.reson,'') reson,
            IFNULL(p.createdat,'') createdat, 
            IFNULL(p.replydate,'') replydate, 
            IFNULL(p.reply,'') reply, 
            IFNULL(p.prayer_person,'') prayer_person, 
            IFNULL(p.isreplyed,'') isreplyed, 
            IFNULL(p.contact,'') contact,
            p.deligate_id, 
            IFNULL(p.STATUS,'Active') status,
            IFNULL(p.isread,0) isread
            FROM tbl_prayerrequest p
            LEFT JOIN tbl_deligates d ON p.deligate_id=d.id
            WHERE IFNULL(p.isdeleted,0)=0 
            AND IFNULL(p.STATUS,'Active')='Active' 
            ORDER BY p.createdat ASC";

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