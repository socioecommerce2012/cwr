<?php

class mysqlInfo{
    
    public static $host=':/Applications/MAMP/tmp/mysql/mysql.sock';
    public static $username="root";
    public static $password="root";  
    public static $port="8889";
    public static $db="socioecommerce";
    
    public static $userTable="userDetails";
    public static $userTableColumns=array("type","facebookurl","facebookuserid","user_id","firstname","lastname","name","email","locale","verified","username","profilepicurl","firstlogintimestamp","lastlogintimestamp");
    
    public static $itemInfoTable="itemInfo";
    public static $itemInfoTableColumns=array("itemId","title","desc","price","discount","url","category","options","width","height","display","provider");
    
    public static $interactionTable="interaction";
    public static $interactionTableColumn=array("userid","itemid","timestamp","info");
    
    
}

?>
