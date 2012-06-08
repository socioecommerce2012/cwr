<?php

include_once('fileUtility.php');

class loggerUtility {

    private $className;
    
    public function __construct($className) {
        $this->className = $className;
        date_default_timezone_set("Asia/Calcutta");
    }

    public function logToAFile($filePath, $msg) {
        $basePath = getcwd();
        $filePath=  realpath($basePath."/../".$filePath);
        fileUtility::appendContentToAFile($filePath, $msg);
    }

    public function phpInfoLogger($msg) {

       
        $filePath = "logs/php.log";
        
        $msg = "[INFO]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "\n";

        $this->logToAFile($filePath, $msg);
    }

    public  function phpWarningLogger($msg) {


       $filePath = "logs/php.log";
        $msg = "[WARNING]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "\n";
        $this->logToAFile($filePath, $msg);
    }

    public function phpErrorLogger($msg) {


        $filePath = "logs/php.log";
        $msg = "[ERROR]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className. "] ::" . $msg . "\n";
        $this->logToAFile($filePath, $msg);
    }
    
    public function mysqlInfoLogger($msg) {


        $filePath = "logs/mysql.log";
        $msg = "[INFO]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "\n";

        $this->logToAFile($filePath, $msg);
    }

    public  function mysqlWarningLogger($msg) {


        $filePath = "logs/mysql.log";
        $msg = "[WARNING]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "\n";
        $this->logToAFile($filePath, $msg);
    }

    public function mysqlErrorLogger($msg) {


        $filePath = "logs/mysql.log";
        $msg = "[ERROR]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className. "] ::" . $msg . "\n";
        $this->logToAFile($filePath, $msg);
    }
}

?>
