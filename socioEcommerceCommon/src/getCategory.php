<?php

$category = $_POST['category'];
include_once '../php/mysql/ImagesFromDb.php';
include_once '../php/webpages/homePagePhp.php';


$total=10;

$arrayImageWithInfo = ImagesFromDb::getItems($category,null,$total);

if (count($arrayImageWithInfo) > 0) {
    
    $rowCount = 2;

    $maxWidth = 730;

    getImagesDivForPartner($arrayImageWithInfo, 0, $rowCount, $maxWidth);
}

?>