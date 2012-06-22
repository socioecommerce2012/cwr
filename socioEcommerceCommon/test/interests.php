<?php
include '../php/mysql/mysqlUtilities.php';
$sqlForInterestsIntoMetadata = "SELECT interests FROM userDetails";
$result = mysqlUtilities::executeSqlStatement($sqlForInterestsIntoMetadata);
if (!is_null(result)) {
    while (list($interest) = mysql_fetch_array($result)) {
        $arrayInterest = explode("$$", $interest);
        for ($i = 0; $i < count($arrayInterest); $i++) {
            $sqlCheckInterestExist = "select interestId from interests_md where interest= '" . strtolower($arrayInterest[$i]) . "'";
            $result1 = mysqlUtilities::executeSqlStatement($sqlCheckInterestExist);
            list($interestId) = mysql_fetch_array($result1);
            echo "Processing Interest " . $arrayInterest[$i] . "\n";
            echo "===========================================\n";
            if (is_null($interestId) || $interestId == '') {
                if (strtolower($arrayInterest[$i]) != '') {
                    $sqlInsertInterest = "INSERT INTO interests_md (interestId,interest) VALUES (NULL,'" . strtolower($arrayInterest[$i]) . "')";
                    $result2 = mysqlUtilities::executeSqlStatement($sqlInsertInterest);
                    if ($result2) {
                        echo "Inserted " . $arrayInterest[$i] . " into Database\n";
                    }
                }
            } else {
                echo $arrayInterest[$i] . " exists in Database\n";
            }
        }
    }
}
?>
