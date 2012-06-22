<?php

include '../php/mysql/mysqlUtilities.php';

$sql = "SELECT itemId,possibleInterests FROM itemInfo";
$result = mysqlUtilities::executeSqlStatement($sql);

while (list($itemId, $interests) = mysql_fetch_array($result)) {
    echo "ARRAY \n";
    echo $interests;
    echo "\n====================================\n";
    $arrayInterest = explode(",", $interests);

    for ($i = 0; $i < count($arrayInterest); $i++) {
        if (!is_null($arrayInterest[$i])) {
            echo "\nProcessing " . $arrayInterest[$i];
            echo "\n==============================\n";
            $sql2 = "SELECT interestId FROM interests_md WHERE interest='" . strtolower($arrayInterest[$i]) . "'";
            $result1 = mysqlUtilities::executeSqlStatement($sql2);
            if (mysql_num_rows($result1) > 0) {
                echo "Interest Already Exists Extracting InterestId";
                list($interestId) = mysql_fetch_array($result1);
            } else {
                echo "\nInterest doesnt exists .. Insert Operation in progress";
                $sql3 = "INSERT INTO interests_md (interest) VALUES ('".strtolower($arrayInterest[$i])."')";
                $result2 = mysqlUtilities::executeSqlStatement($sql3);
                if (!is_null($result2)) {
                    $sql4 = "SELECT interestId FROM interests_md WHERE interest='" . strtolower($arrayInterest[$i]) . "'";
                    $result3 = mysqlUtilities::executeSqlStatement($sql4);
                    list($interestId) = mysql_fetch_array($result3);
                }
            }
            echo "\nINTEREST ID FOR INTEREST " . $arrayInterest[$i] . " IS " . $interestId;
            echo "\nInterest Id " . $interestId . " Item Id " . $itemId;
            $sql5 = "INSERT INTO interestItemMap (interestId,itemId) VALUES('$interestId','$itemId')";
            $result5 = mysqlUtilities::executeSqlStatement($sql5);
        }
    }
}
?>
