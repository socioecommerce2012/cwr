<?php

include_once 'mysqlInfo.php';
class mysqlBaseClass {

    private static $logger;

    public static function init() {
        self::$logger = new loggerUtility("mysqlBaseClass");
    }

    public static function getMysqlConnection() {

        self::init();

        $con = mysql_connect(mysqlInfo::$host, mysqlInfo::$username, mysqlInfo::$password);

        self::$logger->phpInfoLogger("Trying to establish mysql connection");
       
        if (!$con) {

            self::$logger->phpErrorLogger("Something Gone Wrong Check Mysql Error");
            $msg = "Error While Establishing Connection " . mysql_error();
            self::$logger->mysqlErrorLogger($msg);
            error_log("ERROR PLEASE CHECK LOGS");
        }
        self::$logger->phpInfoLogger("Connection to mysql Successful");
        return $con;
    }
    
    
    
    
    public static function getMysqlDBConnection() {

        self::init();

        $con = self::getMysqlConnection();

        $db = mysql_select_db(mysqlInfo::$db);

        self::$logger->phpInfoLogger("Trying to connect to database");
        
        if (!$db) {

            self::$logger->phpErrorLogger("Something Gone Wrong Check Mysql Error logs");
            $msg = "Error While Establishing Connection " . mysql_error();
            self::$logger->mysqlErrorLogger($msg);
            error_log("ERROR PLEASE CHECK LOGS");
        }
        
        self::$logger->phpInfoLogger("Connection to db... Successful");
        return $con;
    }
    
    
   
}

?>
