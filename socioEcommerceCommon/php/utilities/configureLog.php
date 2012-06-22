<?php
include_once dirname(__FILE__).'/../logger/src/main/php/Logger.php';
class loggerUtility{
    public static function configLogger()  {
        Logger::configure(dirname(__FILE__) .'/../../src/loggerConfig.xml');
    }

}
?>
