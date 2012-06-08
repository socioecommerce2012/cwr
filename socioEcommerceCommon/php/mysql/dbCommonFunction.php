<?php

function checkUserStatus($facebookuserid) {
       $logger = new loggerUtility("mysqlUtilities");
        $sqlCheckUserStatustatement = "SELECT 1 FROM userDetails WHERE facebookuserid=$facebookuserid";
        $result = mysqlUtilities::executeSqlStatement($sqlCheckUserStatustatement);
        $logger->phpInfoLogger("Checking User Status " . $facebookuserid);
        if (is_null($result)) {
            $logger->phpErrorLogger("Error While Checking Whether User Exists Or Not " . $facebookuserid);
            $logger->mysqlErrorLogger("Error While Checking Whether User Exists Or Not " . $facebookuserid . "\n" . mysql_error());
            return -1;
        }
        $logger->phpInfoLogger("Execution Of Checking User Status  " . $facebookuserid . " was Successful");
        if (mysql_num_rows($result) == 0) {
            return 0;
        } else {
            return 1;
        }
    }
?>
