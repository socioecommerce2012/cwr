<?php

include_once dirname(__FILE__) . '/../logger/src/main/php/Logger.php';
include_once 'mysqlUtilities.php';

function checkUserStatus($facebookuserid) {

    Logger::configure(dirname(__FILE__) . '/../../src/loggerConfig.xml');
    $logger = Logger::getLogger("include.php > checkUserStatus");
    $sqlCheckUserStatustatement = "SELECT 1 FROM userDetails WHERE facebookuserid=$facebookuserid";
    $logger->info("Trying to execute the " . $sqlCheckUserStatustatement . " in checkUserStatus Method");
    $result = mysqlUtilities::executeSqlStatement($sqlCheckUserStatustatement);
    if (is_null($result)) {
        $logger->error("Error While Checking Whether User Exists Or Not " . $facebookuserid . " in checkUserStatus Method");
        return -1;
    }
    $logger->info("Execution Of Checking User Status  " . $facebookuserid . " in checkUserStatus Method was Successful");
    if (mysql_num_rows($result) == 0) {
        return 0;
    } else {
        return 1;
    }
}

function getAllCategories() {

    Logger::configure(dirname(__FILE__) . '/../../src/loggerConfig.xml');
    $logger = Logger::getLogger("include.php > getAllCategories()");
    $sqlGetAllCategories = "SELECT category FROM category_md";
    $result = mysqlUtilities::executeSqlStatement($sqlGetAllCategories);
    if (is_null($result)) {
        $logger->error("Error While Checking Whether User Exists Or Not " . $facebookuserid . "\n" . mysql_error());
        return -1;
    }
    $logger->info("Execution Of Checking User Status  " . $facebookuserid . " was Successful");
    $categoryArray = array();
    if (mysql_num_rows($result) == 0) {
        echo "No Categories Exists";
        return null;
    } else {
        while (list($category) = mysql_fetch_array($result)) {
            array_push($categoryArray, $category);
        }
        return $categoryArray;
    }
}

function createUniqueId($string) {
    static $guid = '';
    $uid = uniqid('', true);
    $data .= $string;
    $data .= $_SERVER['REQUEST_TIME'];
    $hash = strtoupper(hash('md5', $uid . $guid . md5($data)));
    return $hash;
}

function getImageFormat($fileName) {
    if (preg_match("/.jpeg$/", $fileName)) {
        return ".jpeg";
    } else {
        if (preg_match("/.jpg$/", $fileName)) {
            return ".jpg";
        } else {
            if (preg_match("/.png$/", $fileName)) {
                return ".png";
            } else {
                if (preg_match("/.gif$/", $fileName)) {
                    return ".gif";
                } else {

                    return -1;
                }
            }
        }
    }
}

function configureLogger() {
    Logger::configure(dirname(__FILE__) . '/../../src/loggerConfig.xml');
}

?>
