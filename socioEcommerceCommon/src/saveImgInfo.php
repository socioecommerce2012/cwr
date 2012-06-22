<?php
include '../php/webpages/homePagePhp.php';
include '../php/mysql/mysqlInfo.php';
include '../php/mysql/mysqlUtilities.php';
$fileName= $_POST['fileName'];
$title = $_POST['title'];
$description = $_POST['desc'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$categories = $_POST['category'];
if(!is_null($fileName)&&!is_null($title)&&!is_null($description)&&!is_null($price)&&!is_null($discount)&&!is_null($categories)){
    $imageInfo = getImagesInfoForUrl($fileName);
    $width = $imageInfo["width"];
    $height = $imageInfo["height"];
    $display=$imageInfo["display"];
    $userId = "guest";
    $option =  mysql_escape_string("Buy this,Add to favourites, Recommend this");
    $sqlInsertImageInfo = "INSERT INTO ".mysqlInfo::$itemInfoTable." (".implode(",",mysqlInfo::$itemInfoTableColumns).") VALUES('$title','$description','$price','$discount','$fileName','$option','$width','$height','$display','$userId')";
    mysqlUtilities::executeSqlStatement($sqlInsertImageInfo);
}
?>