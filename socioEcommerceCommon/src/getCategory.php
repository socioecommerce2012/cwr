<?php

$category = $_POST['category'];
include_once '../php/mysql/ImagesFromDb.php';
include_once '../php/webpages/homePagePhp.php';
include '../php/utilities/loggerUtility.php';

error_log("CATEGORY" . $category);
$arrayImageWithInfo = ImagesFromDb::getImagesAsPerCategory(0, 10, $category);
error_log("IS SET".isset($arrayImageWithInfo));

if (count($arrayImageWithInfo) > 0) {
    $rowCount = 2;

    $maxWidth = 730;

    getImagesDivForPartner($arrayImageWithInfo, 0, $rowCount, $maxWidth);
}

?>