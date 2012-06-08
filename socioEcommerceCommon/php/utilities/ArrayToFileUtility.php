<?php

include_once 'excelUtility.php';
include_once '../mysql/mysqlUtilities.php';
include_once '../webpages/homePagePhp.php';

//This is used to generate the string which is used to store into metadata

function ArrayToFileUtility($arrayImagesWithInfo) {
    $removeRegex = "/[\n\t\r]/";
    foreach ($arrayImagesWithInfo as $key => $imageInfo) {
        foreach ($imageInfo as $key => $value) {
            $value = replaceCharacter($removeRegex, "", $value);
            $stringToBeWrittenToFile = $stringToBeWrittenToFile . '\'' . $value . "\',";
        }
        $stringToBeWrittenToFile = $stringToBeWrittenToFile . "\n";
    }

    return $stringToBeWrittenToFile;
}

//This Utility Is Used to Store info present in the csv into the database table

function arrayToSqlStatement($arrayImageWithInfo, $tableName) {
    $removeRegex = "/[\n\t\r]/";

    foreach ($arrayImageWithInfo as $key => $imageInfo) {
        foreach ($imageInfo as $key => $value) {
            $value = replaceCharacter($removeRegex, "", $value);
            $tableNameColumns = $tableNameColumns . $key . ",";
            $dataToBeInsertedText = $dataToBeInsertedText . '\'' . $value . "',";
        }
        $tableNameColumns = substr($tableNameColumns, 0, -1);
        $dataToBeInsertedText = substr($dataToBeInsertedText, 0, -1);
        mysqlUtilities::insertIntoTable($tableName, $tableNameColumns, $dataToBeInsertedText);
        $dataToBeInsertedText = "";
        $tableNameColumns = "";
    }
}

function replaceCharacter($searchRegex, $replacementRegex, $value) {
    $value = trim($value);
    return preg_replace($searchRegex, $replacementRegex, $value);
}

function readFromExcelSheetAndStoreIntoImageInfoDataBase($excelFilePath,$imagePath) {
    $arrayImages = parseExcel($excelFilePath, $imagePath);

    $arrayImageWithInfo = getImagesInfoV2($arrayImages);

    arrayToSqlStatement($arrayImageWithInfo, "itemInfo");
}

readFromExcelSheetAndStoreIntoImageInfoDataBase("/Users/kodakand/Desktop/Test_data.xls", "../../src/img/");
?>


