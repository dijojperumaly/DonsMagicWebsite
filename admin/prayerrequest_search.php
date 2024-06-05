<?php
include_once("db_connection.php");
//include_once("adminsession.php");

$name="";
$place="";
$contact="";

if(isset($_GET["name"])){
    $name=$_GET["name"];
    $place=$_GET["place"];
    $contact=$_GET["contact"];

}


// Set the INSERT SQL data
$sql = "SELECT   p.request_id,
            d.id deligate_id,
            d.name deligatename,
            d.housename,
            IFNULL(p.name,'')name, 
            IFNULL(p.hname,'') hname, 
            subject,
            p.reson, 
            IFNULL(p.createdat,'') createdat, 
            IFNULL(p.replydate,'') replydate, 
            IFNULL(p.reply,'') reply, 
            IFNULL(p.prayer_person,'') prayer_person, 
            IFNULL(p.isreplyed,'') isreplyed, 
            p.contact,
            p.deligate_id, 
            IFNULL(p.STATUS,'Active') status
            FROM tbl_prayerrequest p
            LEFT JOIN tbl_deligates d ON p.deligate_id=d.id
            WHERE IFNULL(p.isdeleted,0)=0 
            AND IFNULL(p.STATUS,'Active')='Active' 
            AND p.name='$name'
            AND p.place='$place'
            AND p.contact='$contact'
            ORDER BY p.createdat DESC";

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