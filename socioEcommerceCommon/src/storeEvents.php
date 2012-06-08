<?php

include '../php/utilities/fileUtility.php';

session_start();

$event=$_POST['event'];
$itemId=$_POST['itemId'];
$timeStamp=$_POST['timeStamp'];
$userId=$_SESSION['userId'];

$stringToBeWrittenToFile=$event."|".$itemId."|".$timeStamp."|".$userId."\n";

$filePath="../logs/events";

fileUtility::appendContentToAFile($filePath, $stringToBeWrittenToFile);



?>
