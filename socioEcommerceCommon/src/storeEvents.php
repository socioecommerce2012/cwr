<?php

include '../php/utilities/fileUtility.php';
include '../php/mysql/mysqlInfo.php';
include '../php/mysql/mysqlUtilities.php';
include '../php/utilities/loggerUtility.php';
session_start();

$event = $_POST['event'];
$itemId = $_POST['itemId'];

$userId = $_SESSION['userId'];

$sql = "INSERT INTO " . mysqlInfo::$interactionTable . " " . explode(",", mysqlInfo::$interactionTableColumn) . " Values ('$userId','$itemId','".time()."','$event');";
$logger = new loggerUtility("storeEvents");
$result = mysqlUtilities::executeSqlStatement($sql);
if (!$result) {
    $logger->phpInfoLogger("Error While storing events");
    $logger->mysqlErrorLogger("Error While storing events " . mysql_error());
}
$logger->phpInfoLogger("Successful stored event for userId".$userId." timeStamp".$timeStamp." event".$event);
?>
