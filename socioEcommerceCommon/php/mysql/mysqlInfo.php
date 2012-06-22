<?php

class mysqlInfo{
    
//    public static $host=':/Applications/MAMP/tmp/mysql/mysql.sock';
//    public static $username="root";
//    public static $password="root";  
//    public static $port="8889";
//    public static $db="socioecommerce";
    public static $host='ecom-socioecommerce2012.dotcloud.com:16177';
    public static $username="root";
    public static $password="5S3KblIKIH2jQPj5qUKO";  
    public static $port="8889";
    public static $db="socioecommerce";
    
    
    public static $userTable="userDetails";
    public static $userTableColumns=array("type","facebookurl","facebookuserid","user_id","firstname","lastname","name","email","locale","verified","username","profilepicurl","firstlogintimestamp","lastlogintimestamp");
    
    public static $itemInfoTable="itemInfo";
    public static $itemInfoTableColumns=array("title","description","price","discount","url","options","width","height","display","provider");
    
    public static $interactionTable="interaction";
    public static $interactionTableColumn=array("userid","itemid","timestamp","info");
    
    
}

?>
