<?php

include 'mysqlInfo.php';

/**
 * Description of mysqliConnector
 *
 * @author kodakand
 */
class mysqliConnector extends mysqlBaseClass {

    private $hostName;
    private $port;
    private $userName;
    private $password;
    private $database;
    private $connectionHandler;

    public function __construct() {
        $this->hostName = parent::$MYSQL_HOST_REMOTE;
        $this->port     = parent::$MYSQL_PORT_REMOTE;
        $this->userName = parent::$MYSQL_USERNAME_REMOTE;
        $this->password = parent::$MYSQL_PASSWORD_REMOTE;
        $this->database = parent::$MYSQL_DB_REMOTE;
    }

    public function getConnection() {
        try {
            $this->connectionHandler = mysqli_connect($this->hostName, $this->userName, $this->password, $this->database, $this->port);
            if (mysqli_connect_error()) {
                throw new Exception("Connection With Mysql Was UnSuccessful . Please check the database connection");
            }
            return $this->connectionHandler;
        } catch (Exception $e) {
            die("Mysql Connection Failed . Please Check the Connection Factory");
        }
    }
    
    
    
}

/*
 mysqli_warning mysqli::get_warnings ( void )
 */

?>
