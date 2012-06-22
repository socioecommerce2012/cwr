<?php

class mysqlBaseClass {

//    protected static $LOCAL_MYSQL_HOST =':/Applications/MAMP/tmp/mysql/mysql.sock';
//    protected static $LOCAL_MYSQL_USERNAME="root";
//    protected static $LOCAL_MYSQL_PASSWORD="root";  
//    protected static $LOCAL_MYSQL_PORT="8889";
//    protected static $LOCAL_MYSQL_DB="socioecommerce";
    protected static  $MYSQL_HOST_REMOTE = 'ecom-socioecommerce2012.dotcloud.com';
    protected static  $MYSQL_USERNAME_REMOTE = "root";
    protected static  $MYSQL_PASSWORD_REMOTE = "5S3KblIKIH2jQPj5qUKO";
    protected static  $MYSQL_PORT_REMOTE= "16177";
    protected static  $MYSQL_DB_REMOTE = "socioecommerce";
    public $userTable = "userDetails";
    public $userTableColumns = array("type", "facebookurl", "facebookuserid", "user_id", "firstname", "lastname", "name", "email", "locale", "verified", "username", "profilepicurl", "firstlogintimestamp", "lastlogintimestamp");
    public $itemInfoTable = "itemInfo";
    public $itemInfoTableColumns = array("title", "description", "price", "discount", "url", "options", "width", "height", "display", "provider");
    public $interactionTable = "interaction";
    public $interactionTableColumn = array("userid", "itemid", "timestamp", "info");

}

?>
