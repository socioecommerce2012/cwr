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
        $fileHandler = self::openFile($filePath, "a"); //read + append
        echo "<br/>FILE HANDLER".$fileHandler;
        fseek($fileHandler,SEEK_END);
         echo "<br/>DATA".$stringToBeWrittenToFile;
         echo "<br/>PATH".$filePath;
        //file_put_contents($filePath, $stringToBeWrittenToFile, FILE_APPEND | LOCK_EX);
        
        fwrite($fileHandler,$stringToBeWrittenToFile);
        self::closeFile($fileHandler);
    }

    public static function closeFile($fileHandler){
        fclose($fileHandler);
    }
}

?>
