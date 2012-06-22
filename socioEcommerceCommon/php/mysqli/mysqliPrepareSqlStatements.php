<?php

/**
 * Description of mysqliPrepareSqlStatements
 *
 * @author kodakand
 */
class mysqliPrepareSqlStatements {

    public static function getPreparedStatment($sql, $params, $mysqli) {

//        $countOfCharacters = substr_count($sql, '?');
//        $sizeOfArray = count($params);
//        $firstParamOfPreparedStatement;
//        $secondParamOfPreparedStatement;
//
//
//
//        if ($countOfCharacters != $sizeOfArray) {
//            echo 'Count Of Parameters To Be Replaces Is Not Equal To The Params Present In Array';
//            return null;
//        }
//
//        if (!$preparedStatement = $mysqli->prepare($sql)) {
//            
//        }
//        for ($i = 0; $i < count($params); $i++) {
//
//            if (is_string($params[$i])) {
//                $firstParamOfPreparedStatement .= 's';
//                $secondParamOfPreparedStatement .= $params[$i];
//            } else {
//                $firstParamOfPreparedStatement .= 'd';
//
//                $secondParamOfPreparedStatement .= $params[$i];
//            }
//        }
//        echo $firstParamOfPreparedStatement . "\n";
//        echo $secondParamOfPreparedStatement."\n";
//        if (!$preparedStatement->bind_param($firstParamOfPreparedStatement, $secondParamOfPreparedStatement)) {
//            echo "Binding parameters failed: (" . $preparedStatement->errno . ") " . $preparedStatement->error;
//        }
//        
//        echo is_object($preparedStatement)."\n";
//        if (!($res = $preparedStatement->get_result())) {
//            echo "Getting result set failed: (" . $preparedStatement->errno . ") " . $preparedStatement->error;
//        }
//        
//        var_dump($res->fetch_all());



        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO interestUserMap(interestId,userId) VALUES (?,?)"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        $id = 0;
        if (!$stmt->bind_param("ii", $id,$id)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        /* Prepared statement: repeated execution, only data transferred from client to server */
        for ($id = 2; $id < 5; $id++) {
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        }

        /* explicit close recommended */
        $stmt->close();

        /* Non-prepared statement */
        $res = $mysqli->query("SELECT interestId,userId FROM interestUserMap");
        var_dump($res->fetch_all());
    }

}

?>
