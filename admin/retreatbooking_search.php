<?php
include_once("db_connection.php");
//include_once("adminsession.php");

$name="";
$housename="";
$contact="";

if(isset($_GET["name"])){
    $name=$_GET["name"];
    $housename=$_GET["housename"];
    $contact=$_GET["contact"];

}

// Set the INSERT SQL data
$sql = "SELECT
            r.id retreat_id,
            r.title,
            r.retreatstartdate,
            r.retreatenddate,
            t.retreattype,
            t.retreattype_id,
            d.id deligate_id,
            d.name deligate_name,
            d.housename deligate_housename,
            b.bookingid,
            b.name,
            b.housename,
            b.gender,
            IFNULL(b.dateofbirth,'') dateofbirth, 
            IFNULL(b.place,'') place, 
            IFNULL(b.dioceses,'') dioceses,
            IFNULL(b.parish,'') parish,
            IFNULL(b.contact,'') contact, 
            IFNULL(b.email,'') email, 
            IFNULL(b.booking_date,'') booking_date, 
            IFNULL(b.booking_status,'') booking_status_value, 
            CASE
                WHEN booking_status = ". PEDDING ." THEN 'Pending'
                WHEN booking_status = ". WAITING ." THEN 'Waiting'
                WHEN booking_status = ". CONFIRMED ." THEN 'Confirmed'
                WHEN booking_status = ". CANCELED ." THEN 'Canceled'
                ELSE 'Pending'
            END booking_status,
            IFNULL(b.confirm_date,'') confirm_date,      
            IFNULL(b.STATUS,'Active') status,
            IFNULL(b.isread,'0') isread
            FROM tbl_retreatbooking b  
            LEFT JOIN tbl_retreat r ON r.id=b.retreat_id 
            LEFT JOIN tbl_deligates d ON d.id=r.deligate_id  
            LEFT JOIN tbl_retreattype t ON t.retreattype_id=r.retreattype_id  
            WHERE IFNULL(b.isdeleted,0)=0 
            AND IFNULL(b.STATUS,'Active')='Active' 
            AND b.name='$name' AND b.housename='$housename' AND b.contact='$contact' 
            ORDER BY r.retreatstartdate DESC";

    

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