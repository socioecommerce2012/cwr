<?php
class mysqliBaseClass{
    
    
    private static $logger;

    public static function init() {
        self::$logger = new loggerUtility("mysqlBaseClass");
    }
    
}
?>
