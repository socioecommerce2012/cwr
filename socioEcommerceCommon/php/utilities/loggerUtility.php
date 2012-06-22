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
       $filePath = $basePath . $filePath;
       $filePath = realpath($filePath);
       echo "IS WRITABLE ".is_writable($filePath);
       echo "<br/>$filePath";
       fileUtility::appendContentToAFile($filePath, $msg);
    }

    public function phpInfoLogger($msg) {
        
        $filePath="/../logs/php.php";
        $msg = "[INFO]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "<br/>";
        $this->logToAFile($filePath, $msg);
    }

    public function phpWarningLogger($msg) {
        $filePath="/../logs/php.php";
        $msg = "[WARNING]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "<br/>";
        $this->logToAFile($filePath, $msg);
    }

    public function phpErrorLogger($msg) {


        $filePath = "logs/php.php";
        $msg = "[ERROR]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "<br/>";
        $this->logToAFile($filePath, $msg);
    }

    public function mysqlInfoLogger($msg) {


        $filePath = "logs/mysql.php";
        $msg = "[INFO]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "<br/>";

        $this->logToAFile($filePath, $msg);
    }

    public function mysqlWarningLogger($msg) {


        $filePath = "logs/mysql.php";
        $msg = "[WARNING]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "<br/>";
        $this->logToAFile($filePath, $msg);
    }

    public function mysqlErrorLogger($msg) {


        $filePath = "logs/mysql.php";
        $msg = "[ERROR]::" . "[" . date("d/m/y : H:i:s", time()) . "] ::" . "[" . $this->className . "] ::" . $msg . "<br/>";
        $this->logToAFile($filePath, $msg);
    }

}

?>
