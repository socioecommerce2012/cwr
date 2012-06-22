<?php

include_once('mysqlInfo.php');
include_once('mysqlUtilities.php');

class ImagesFromDb {

    public static $logger;

    function __construct() {
        self::$logger = Logger::getLogger("ImagesFromDb");
    }

    public static function getImages($lowerLimit, $upperLimit) {

        $sql = "SELECT * FROM " . mysqlInfo::$itemInfoTable . " Limit " . $lowerLimit . "," . $upperLimit;
        // self::$logger->info("Trying To Fetch Images From Db");
        $result = mysqlUtilities::executeSqlStatement($sql);
        if (!$result) {
            //   self::$logger->error("Error While getting Data" . mysql_error());
            echo "Error While Getting Data" . mysql_error();
        }
        // self::$logger->info("Successful in Fetching Images From Db");
        $arrayImageWithinfo = array();
        while ($row = mysql_fetch_assoc($result)) {
            array_push($arrayImageWithinfo, $row);
        }
        return $arrayImageWithinfo;
    }

    public static function getImagesAsPerCategory($lowerLimit, $upperLimit, $category) {
        //self::init();
        $sql = "SELECT * FROM " . mysqlInfo::$itemInfoTable . " WHERE category like '%$category%' Limit " . $lowerLimit . "," . $upperLimit;
        //self::$logger->phpInfoLogger("Trying To Fetch Images From Db according for category " . $category);
        $result = mysqlUtilities::executeSqlStatement($sql);
        if (!$result) {
            //  self::$logger->phpInfoLogger("Error While getting Data");
            // self::$logger->mysqlErrorLogger("Error While getting Data " . mysql_error());
            echo mysql_error();
        }
        //self::$logger->phpInfoLogger("Successful in Fetching Images From Db for category" . $category);
        $arrayImageWithinfo = array();
        while ($row = mysql_fetch_assoc($result)) {
            array_push($arrayImageWithinfo, $row);
        }
        return $arrayImageWithinfo;
    }

    public static function getAllUserInterests($emailId) {

        //self::init();

        $sql = "SELECT interests FROM " . mysqlInfo::$userTable . " WHERE  emailId=" . $emailId;

        //self::$logger->phpInfoLogger("Trying To Fetch Interests for given Email Id " . $emailId);
        $result = mysqlUtilities::executeSqlStatement($sql);

        if (!$result) {
            //  self::$logger->phpInfoLogger("Error While getting Data");
            //self::$logger->mysqlErrorLogger("Error While getting Data " . mysql_error());
            echo $mysql_error();
        }
        //        self::$logger->phpInfoLogger("Successful in Fetching Interests for given emailId" . $emailId);

        while ($row = mysql_fetch_assoc($result)) {
            array_push($arrayImageWithinfo, $row);
        }
        return $arrayImageWithinfo;
    }

    public static function getImagesBasedOnInterests($emailId, $interestPercentage) {

        //self::init();
        //Gets All Interests for the given emailId
        // $interests = self::getAllUserInterests($emailId);
        $lowerLimit = 0;
        $upperLimit = 10;
        $interests = array("art", "Amazon", "Mobile", "gadgets", "apple");

        if (!is_null($interests)) {
            $sql = "SELECT itemId,possibleInterests FROM " . mysqlInfo::$itemInfoTable . " Limit " . $lowerLimit . "," . $upperLimit;

            //  self::$logger->phpInfoLogger("Trying To Fetch Image id and possible interests from Db according for category " . $emailId);
            $result = mysqlUtilities::executeSqlStatement($sql);
            if (!$result) {
                //    self::$logger->phpInfoLogger("Error While getting Data");
                //   self::$logger->mysqlErrorLogger("Error While getting Data " . mysql_error());
                echo mysql_error();
            }
            //self::$logger->phpInfoLogger("Successful in Fetching Image ids From Db for emailId" . $emailId);
            $arrayImageIdsForInterests = array();
            while (list($itemId, $possibleInterests) = mysql_fetch_array($result)) {
                $truthValue = self::compareInterests($possibleInterests, $interests);
                if ($truthValue) {
                    array_push($arrayImageIdsForInterests, $itemId);
                    if (count($arrayImageIdsForInterests) >= $interestPercentage) {
                        return $arrayImageIdsForInterests;
                    }
                }
            }
            return $arrayImageIdsForInterests;
        }
        return null;
    }

    public static function compareInterests($imgInterests, $personInterests) {
        $imgInterests = explode(",", $imgInterests);

        for ($i = 0; $i < count($personInterests); $i++) {
            $val = in_array($personInterests[$i], $imgInterests);
            if ($val) {
                return 1;
            }
        }
        return 0;
    }

    public static function getImagesBasedOnAdv($arrayImgForInterests, $total) {
        //self::init();
        $imgIdsForInterests = implode(",", $arrayImgForInterests);
        $sql = "SELECT itemId FROM " . mysqlInfo::$itemInfoTable . " where itemId not in (" . $imgIdsForInterests . ")";
        $result = mysqlUtilities::executeSqlStatement($sql);
        if (!$result) {
            //  self::$logger->phpInfoLogger("Error While getting Data");
            // self::$logger->mysqlErrorLogger("Error While getting Data " . mysql_error());
        }
        //self::$logger->phpInfoLogger("Successful in Fetching Image ids From Db for ADVT" );
        $arrayImageIdsForAdvt = array();

        if (mysql_num_rows($result) > 0) {
            while (list($itemId) = mysql_fetch_array($result)) {
                array_push($arrayImageIdsForAdvt, $itemId);
                if (count($arrayImageIdsForAdvt) >= $total) {
                    return $arrayImageIdsForAdvt;
                }
            }

            return $arrayImageIdsForInterests;
        }
        return null;
    }

    public static function getImageIdsForGivenEmailId($emailId, $total, $interestPercentage) {

        //self::init();
        $interestNumber = ($total) * ($interestPercentage / 100);
        $arrayImgInterests = self::getImagesBasedOnInterests($emailId, $interestNumber);

        $arrayImgAdvt = self::getImagesBasedOnAdv($arrayImgInterests, $total - $interestNumber);
        $unionIds = array_unique(array_merge($arrayImgInterests, $arrayImgAdvt));
        $arrayImgWithInfo = self::getImageInfoForIds($unionIds);
        return $arrayImgWithInfo;
    }

    public static function getImageInfoForIds($ids) {
        $idsAsString = implode(",", $ids);
        if (count($idsAsString) > 0) {
            $sql = "SELECT * FROM " . mysqlInfo::$itemInfoTable . " where itemId in (" . $idsAsString . ")";
            $result = mysqlUtilities::executeSqlStatement($sql);
            if (!$result) {
                // self::$logger->phpInfoLogger("Error While getting Data");
                //  self::$logger->mysqlErrorLogger("Error While getting Data " . mysql_error());
            }
            //self::$logger->phpInfoLogger("Successful in Fetching Image Info");
            $arrayImageWithinfo = array();
            while ($row = mysql_fetch_assoc($result)) {
                array_push($arrayImageWithinfo, $row);
            }
            return $arrayImageWithinfo;
        }
        return null;
    }

    public static function getImagesForCategoryNotNullUserNull($categoryName, $total) {
        $categoryId = ImagesFromDb::getCategoryId($categoryName);
        if ($categoryId != 0) {
            try {
                $sqlCategoryNotNull = "SELECT cim.itemId from categoryItemMap AS cim JOIN itemInfo AS ii on ii.itemId=cim.itemId Where cim.categoryId='$categoryId' ORDER BY ii.priority";
                echo $sqlCategoryNotNull;
                $result = mysqlUtilities::executeSqlStatement($sqlCategoryNotNull);
                $arrayItemPerCategory = array();
                if (mysql_num_rows($result) > 0) {
                    while ($total && list($itemId) = mysql_fetch_array($result)) {
                        array_push($arrayItemPerCategory, $itemId);
                        $total--;
                    }
                    return $arrayItemPerCategory;
                }
            } catch (Exception $e) {
                echo "There was an error while executing the getItemForCategory";
            }
        }
        return null;
    }

    public static function getImagesForCategoryNullUserNull($total) {

        try {
            $sqlCategoryNull = "SELECT itemId from itemInfo ORDER BY priority";
            $result = mysqlUtilities::executeSqlStatement($sqlCategoryNull);
            $arrayItemPerCategory = array();
            if (mysql_num_rows($result) > 0) {
                while ($total && list($itemId) = mysql_fetch_array($result)) {
                    array_push($arrayItemPerCategory, $itemId);
                    $total--;
                }
                return $arrayItemPerCategory;
            }
        } catch (Exception $e) {
            echo "There was an error while executing the getItemForCategory";
        }

        return null;
    }

    /*
     * Returns categoryId if found else it returns 0 
     * 
     */

    public static function getCategoryId($categoryName) {
        $sqlCategoryId = "SELECT id FROM category_md where category='$categoryName'";
        $result = mysqlUtilities::executeSqlStatement($sqlCategoryId);
        if (mysql_num_rows($result) > 0) {
            $categoryId = mysql_fetch_array($result);
            return $categoryId["id"];
        }
        return 0;
    }

    public static function getItems($category, $user, $total, $percentage) {
        if (is_null($user)) {
            if (is_null($category)) {
                $arrayImagesIds = ImagesFromDb::getImagesForCategoryNullUserNull($total);
            } else {
                $arrayImagesIds = ImagesFromDb::getImagesForCategoryNotNullUserNull($category, $total);
            }
        } else {
            if (is_null($category)) {
                $arrayImagesIds = ImagesFromDb::getImagesForCategoryNullUserNotNull($user, $total);
            } else {
                $arrayImagesIds = ImagesFromDb::getImagesForCategoryNotNullUserNotNull($user, $category, $total, $percentage);
            }
        }

        $arrayImagesWithInfo = ImagesFromDb::getImageInfoForIds($arrayImagesIds);

        return $arrayImagesWithInfo;
    }

    public static function getImagesForCategoryNullUserNotNull($userId, $total) {
        $sqlCategoryNullUserNotNull = "SELECT DISTINCT iim.itemId FROM interestUserMap AS ium JOIN interestItemMap as iim ON ium.interestId=iim.interestId AND ium.userId='$userId'";
        $result = mysqlUtilities::executeSqlStatement($sqlCategoryNullUserNotNull);
        if (!is_null($result) && mysql_num_rows($result) > 0) {
            $arrayItemId = array();
            $count = 0;
            while (list($itemId) = mysql_fetch_array($result)) {
                array_push($arrayItemId, $itemId);
                $count++;
                if ($count >= $total) {
                    break;
                }
            }
            return $arrayItemId;
        }
        return null;
    }

    public static function getImagesForCategoryNotNullUserNotNull($userId, $category, $total, $percentage) {
        $maxBasedOnInterests = floor(($total * $percentage) / 100);
        $arrayImagesBasedOnInterests = self::getImagesForCategoryNullUserNotNull($userId, $maxBasedOnInterests);
        $countOfItemIdsBasedOnUserInterests = count($arrayImagesBasedOnInterests);
        $maxBasedOnCategory = $total - $countOfItemIdsBasedOnUserInterests;
        $arraimagesBasedOnCategory = self::getImagesForCategoryNotNullUserNull($category, $maxBasedOnCategory);
        if (!is_null($arraimagesBasedOnCategory) && !is_null($arrayImagesBasedOnInterests)) {
            $arrayIds = array_merge($arrayImagesBasedOnInterests, $arraimagesBasedOnCategory);
        } 
        else {
            if (!is_null($arraimagesBasedOnCategory)) {
                return $arraimagesBasedOnCategory;
            }else{
                return $arrayImagesBasedOnInterests;
            }
        }
        return $arrayIds;
    }

    public static function getCategoriesForItem($itemId) {
        if ($itemId > 0) {
            $sqlCategoryArray = "SELECT categoryId FROM categoryItemMap WHERE itemId = '$itemId'";
            $result = mysqlUtilities::executeSqlStatement($sqlCategoryArray);
            if (!$result) {
                echo "function getCategories<br/>" . mysql_error();
                return;
            }
            $categoryArray = array();
            if (mysql_num_rows($result) > 0) {
                while (list($categoryId) = mysql_fetch_array($result)) {
                    array_push($categoryArray, $categoryId);
                }
                return $categoryArray;
            }
        }
        return null;
    }

}
$array = ImagesFromDb::getImagesForCategoryNullUserNotNull("3", 10);
print_r($array);
?>
