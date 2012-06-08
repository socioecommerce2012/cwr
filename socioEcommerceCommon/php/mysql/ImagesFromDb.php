<?php

include_once('mysqlInfo.php');
include_once('mysqlUtilities.php');


class ImagesFromDb {

    private static $logger;

    public static function init() {
        self::$logger = new loggerUtility("ImagesFromDb");
    }

    public static function getImages($lowerLimit, $upperLimit) {
        self::init();
        $sql = "SELECT * FROM " . mysqlInfo::$itemInfoTable . " Limit " . $lowerLimit . "," . $upperLimit;
        self::$logger->phpInfoLogger("Trying To Fetch Images From Db");
        $result = mysqlUtilities::executeSqlStatement($sql);
        if (!$result) {
            self::$logger->phpInfoLogger("Error While getting Data");
            self::$logger->mysqlErrorLogger("Error While getting Data".  mysql_error());
            die();
        }
        self::$logger->phpInfoLogger("Successful in Fetching Images From Db");
        $arrayImageWithinfo=array();
        while($row = mysql_fetch_assoc($result)) {
            array_push($arrayImageWithinfo, $row);
        }
        return $arrayImageWithinfo;
    }
    
    public static function getImagesAsPerCategory($lowerLimit,$upperLimit,$category){
        self::init();
        $sql = "SELECT * FROM " . mysqlInfo::$itemInfoTable . " WHERE category like '%$category%' Limit " . $lowerLimit . "," . $upperLimit;
        self::$logger->phpInfoLogger("Trying To Fetch Images From Db according for category ".$category);
        $result = mysqlUtilities::executeSqlStatement($sql);
        if (!$result) {
            self::$logger->phpInfoLogger("Error While getting Data");
            self::$logger->mysqlErrorLogger("Error While getting Data ".  mysql_error());
            die();
        }
        self::$logger->phpInfoLogger("Successful in Fetching Images From Db for category".$category);
        $arrayImageWithinfo=array();
        while($row = mysql_fetch_assoc($result)) {
            array_push($arrayImageWithinfo, $row);
        }
        return $arrayImageWithinfo;
    }
    
    
}


?>
