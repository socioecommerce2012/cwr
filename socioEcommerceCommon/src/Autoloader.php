<?php

class autoloader{
    private static $classes = array(
        
        /*FOR FB UTILITY CLASSES*/
        'FBBasicInfo' => 'php/fb/FBBasicInfo.php',
        'fb'=>'php/fb/getFromfb.php',
        
        /*FOR FB MYSQL CLASSES*/
        'ImagesFromDb'=> 'php/mysql/ImagesFromDb.php',
        'mysqlBaseClass'=> 'php/mysql/mysqlBaseClass.php',
        'mysqlUtilities'=> 'php/mysql/mysqlUtilities.php',
        'mysqlInfo'=>'php/mysql/mysqlInfo.php'
    );
    
    
    public static function autoload($className) {
		if(isset(self::$classes[$className])) {
			include dirname(__FILE__) . self::$classes[$className];
		}
	}
}
?>
