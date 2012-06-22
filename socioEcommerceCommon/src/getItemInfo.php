<?php
include_once '../php/mysql/mysqlUtilities.php';
$itemId = $_POST["itemId"];
$sql = "SELECT * FROM itemInfo WHERE itemId='$itemId'";
$result = mysqlUtilities::executeSqlStatement($sql);
$row  = mysql_fetch_array($result,MYSQL_ASSOC);
echo json_encode($row,JSON_FORCE_OBJECT);


?>