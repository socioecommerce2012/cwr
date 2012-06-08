<?php
include_once 'mysqlBaseClass.php';

class mysqlUtilities {

    private static $logger;
    
    public static function init(){
        self::$logger = new loggerUtility("mysqlUtilities");
    }
    public static function createPreparedStatements() {
        
    }

    public static function insertIntoTable($tableName, $tableNameColumns,$dataToBeInsertedText) {
        
        $sql = "INSERT INTO " . $tableName . " (" . $tableNameColumns . ") VALUES(" . $dataToBeInsertedText . ");";
        $result=self::executeSqlStatement($sql);
        if($result){
            self::$logger->mysqlInfoLogger("Stored Data Successfully");
        }else{
            self::$logger->mysqlInfoLogger("Error While Storing Data");
        }
    }

    public static function executeSqlStatement($sql) {
        self::init();
        $db = mysqlBaseClass::getMysqlDBConnection();
        self::$logger->mysqlInfoLogger("Trying To execute given sql Statement");
        $result = mysql_query($sql, $db);
        if (!$result) {
            $msg = "Error While Executing given SQL statement\n".$sql."\n".  mysql_error();
            self::$logger->phpInfoLogger("Something Went Wrong Please Check Mysql Error Logs");
            self::$logger->mysqlErrorLogger($msg);
            error_log("ERROR. Check Logs");
        }
        self::$logger->mysqlInfoLogger("Executed given sql Statement Successfully");
        return $result;
    }
    
    
}


?>
