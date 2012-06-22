<?php

/**
 * Description of mysqliUtitlities
 * @author kodakand
 */
include 'mysqliConnector.php';

class mysqliUtitlities {

    private $connHandler;
    private $mysqli;

    function __construct() {
        $this->mysqli = new mysqliConnector();
        $this->connHandler = $this->mysqli->getConnection();
    }

    public function executeQuery($sql) {
        try {
            if (!$sqlHandler = $this->connHandler->query("SELECT * FROM itemInfo LIMIT 10")) {
                throw new Exception;
            }
            return $sqlHandler;
        } catch (Exception $e) {
            die("Failed Executing The Given SQL statement");
        }
    }
    
    
    

}

$mysqlUtilities = new mysqliUtitlities();
$handler = $mysqlUtilities->executeQuery($sql);

while($row = $handler->fetch_object()){    // OBJECT RETURNS IN TERMS OF ASSOC ROWS RETURNS IN FORM OF  ARRAY
    print_r($row);
}
//
// /* Get field information for 2nd column */
//$result->field_seek(1);
//echo $handler->num_rows;
//echo $handler->fetch
//$row = $result->fetch_row();
/*
 @ $db = new mysqli($dbhost, $un, $ps, $dbname);
$query = "SELECT field1, field2 ".
         "FROM table1 ".
         "WHERE field1={$some_value}";
$results = $db->query($query);

while ($result = $results->fetch_object()) {
    // do something with the results
}

$query = "SELECT field1, field2 ".
         "FROM table2 ".
         "WHERE field1={$some_value2}";
// question 1
$results = $db->query($query);

while ($result = $results->fetch_object()) {
    // do something with the second set of results
}

// tidy up, question 2
if ($results) { $results->free(); }
if ($db) { $db->close(); }
 */
?>
