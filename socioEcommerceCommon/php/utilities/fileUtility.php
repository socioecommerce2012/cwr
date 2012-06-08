<?php

class fileUtility {

     public static function openFile($filePath, $mode) {
        $fileHandler = fopen("$filePath", $mode);
        if (is_null($fileHandler)) {
            die("Not Able to Open The File");
        }
        return $fileHandler;
    }

     public static function appendContentToAFile($filePath, $stringToBeWrittenToFile) {
        
        
        $fileHandler = self::openFile($filePath, "a+"); //read + append
        
        fwrite($fileHandler, $stringToBeWrittenToFile);
        
        self::closeFile($fileHandler);
    }

    public static function closeFile($fileHandler){
        fclose($fileHandler);
    }
}

?>
