<?php

include_once '../php/webpages/homePagePhp.php';
include_once '../php/utilities/excelUtility.php';
include_once '../php/mysql/ImagesFromDb.php';



$arrayImageWithInfo = ImagesFromDb::getImages(0, 10);

$rowCount = 2;

$maxWidth = 730;

getImagesDivForPartner($arrayImageWithInfo, 0, $rowCount, $maxWidth);
?>