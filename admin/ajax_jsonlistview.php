<?php
include_once("db_connection.php");
//echo '<option value="">---select---</option>';	
if(isset($_GET["valueField"])){
    $valueField=$_GET["valueField"];
    $textField=$_GET["textField"];
    $table=$_GET["table"];
    $sql = "SELECT ". $valueField .",". $textField." FROM ".$table." WHERE t1.isdeleted=0 AND IFNULL(t1.STATUS,'Active')='Active' ";
    if(isset($_GET["where"])){
        $where=$_GET["where"];
        $sql.=$where;
    }
    $sql.=" ORDER BY ".$textField." ASC";
    $results = $con->query($sql);
    $row = array();
    $row["list1"] = $results->fetch_all(MYSQLI_ASSOC);
    $results->free_result(); 

    if(isset($_GET["table2"])){
        $valueField2=$_GET["valueField2"];
        $textField2=$_GET["textField2"];
        $table2=$_GET["table2"];
        $sql2 = "SELECT ". $valueField2 .",". $textField2." FROM ".$table2." WHERE t1.isdeleted=0 AND IFNULL(t1.STATUS,'Active')='Active' ";
    
        if(isset($_GET["where2"])){
            $where2=$_GET["where2"];
            $sql2.=$where2;
        }
        $sql2.=" ORDER BY ".$textField2." ASC";
        $results2 = $con->query($sql2);
        $row["list2"] = $results2->fetch_all(MYSQLI_ASSOC);
        $results2->free_result();
    }
    echo json_encode($row);
}
$con->close();		
?>