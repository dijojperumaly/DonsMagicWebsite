<?php
include_once("adminsession.php");
include_once("db_connection.php");


// Set the INSERT SQL data
$sql = "SELECT   p.id, 
        IFNULL(p.title,'')title, 
        IFNULL(p.product_code,'')product_code, 
        IFNULL(p.aboutproduct,'') aboutproduct, 
        p.MRP, 
        IFNULL(p.offerprice,'') offerprice, 
        CASE WHEN IFNULL(p.isfeatured,0)=0 THEN 'NO' ELSE 'YES' END isfeatured , 
        IFNULL(p.image_1,'') image_1,
        IFNULL(p.image_2,'') image_2,
        IFNULL(p.image_3,'') image_3,
        IFNULL(p.image_4,'') image_4,
        IFNULL(p.STATUS,'Active') status,
        IFNULL(p.orderno,0) orderno,
        IFNULL(p.label,'') label,
        IFNULL(p.color,'') color,
        t.producttype_id,
        t.producttype,
        GROUP_CONCAT(s.size  ORDER BY s.orderno ASC) size
        FROM tbl_product p     
        LEFT JOIN tbl_producttype t ON t.producttype_id=p.producttype_id
        LEFT JOIN tbl_availablesizes a On a.product_id=p.id
        LEFT JOIN tbl_size s ON a.size_id=s.size_id
        WHERE IFNULL(p.isdeleted,0)=0 
        GROUP BY p.id
        ORDER BY IFNULL(p.orderno,0) ASC,p.id DESC";

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