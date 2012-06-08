<?php
include_once '/Applications/MAMP/htdocs/socioEcommerceCommon/php/mysql/mysqlUtilities.php';
include_once '/Applications/MAMP/htdocs/socioEcommerceCommon/php/utilities/loggerUtility.php';


class FBBasicInfo {

    private $profileArray;
    private $facebookUserId;
    private $name;
    private $firstName;
    private $lastName;
    private $link; //link to fb url
    private $username;
    private $bday;
    private $gender;
    private $email;
    private $timeZone;
    private $locale;
    private $verified;
    private $profilePicUrl;
    private $address;
    private $mobile;
    private static $logger;

    function __construct($profileArray, $userProfilePicArray) {
        $this->profileArray = $profileArray;
        $this->profilePicUrl = $userProfilePicArray["picture"];
        $this->init();
        $this->storeProfileInfoIntoDb();
    }

    private function init() {
        self::$logger = new loggerUtility("mysqlUtilities");
        $this->facebookUserId = $this->profileArray["id"] ? $this->profileArray["id"] : "NA";
        $this->name = isset($this->profileArray["name"]) ? $this->profileArray["name"] : "NA";
        $this->firstName = isset($this->profileArray["first_name"]) ? $this->profileArray["first_name"] : "NA";
        $this->lastName = isset($this->profileArray["last_name"]) ? $this->profileArray["last_name"] : "NA";
        $this->email = isset($this->profileArray["email"]) ? $this->profileArray["email"] : "NA";
        $this->gender = isset($this->profileArray["gender"]) ? $this->profileArray["gender"] : "NA";
        $this->bday = isset($this->profileArray["birthday"]) ? $this->profileArray["birthday"] : "NA";
        $this->link = isset($this->profileArray["link"]) ? $this->profileArray["link"] : "NA";
        $this->locale = isset($this->profileArray["locale"]) ? $this->profileArray["locale"] : "NA";
        $this->timeZone = isset($this->profileArray["timezone"]) ? $this->profileArray["timezone"] : "NA";
        $this->verified = isset($this->profileArray["verified"]) ? $this->profileArray["verified"] : "NA";
        $this->username = isset($this->profileArray["username"]) ? $this->profileArray["username"] : "NA";
        $this->address = isset($this->profileArray["address"]) ? $this->profileArray["address"] : "NA";
        $this->mobile = isset($this->profileArray["mobile"]) ? $this->profileArray["mobile"] : "NA";

        error_log("FaceBookUserIdInit " . $this->facebookUserId);
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getName() {
        return $this->name;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getLink() {
        return $this->link;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getBday() {
        return $this->bday;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTimeZone() {
        return $this->timeZone;
    }

    public function getLocale() {
        return $this->locale;
    }

    public function getVerified() {
        return $this->verified;
    }

    private function storeProfileInfoIntoDb() {
        $userStatus = $this->checkUserStatus($this->facebookUserId);

        if ($userStatus == -1) {
            die("Error Occured Please try Again Later");
        }
        if (!$userStatus) {
            $insertProfileInfo = "INSERT INTO "
                    . "userDetails" .
                    "(name,firstname,lastname,username,facebookuserid,locale,email,verified,type,facebookurl,profilepicurl,firstlogintimestamp,lastlogintimestamp)
                             VALUES('$this->name','$this->firstName','$this->lastName','$this->username','$this->facebookUserId','$this->locale','$this->email','$this->verified','user','$this->link','$this->profilePicUrl',".time().",".time().");   
                            ";
            self::$logger->phpInfoLogger("Inserting User Information with userId " . $this->facebookUserId);
            $result = mysqlUtilities::executeSqlStatement($insertProfileInfo);
            if (is_null($result)) {
                self::$logger->phpErrorLogger("Error While inserting new user data into database");
                die("Error Occured Please try Again Later");
            }
            self::$logger->phpInfoLogger("Insertion Information was successful " . $this->facebookUserId);
        } else {
            $updateDetails = "UPDATE " . mysqlInfo::$userTable . " SET lastlogintimestamp=" . time() . " WHERE facebookuserid ='$this->facebookUserId'";
            self::$logger->phpInfoLogger("Updating User Information with userId " . $this->facebookUserId);
            $result = mysqlUtilities::executeSqlStatement($updateDetails);
            if (is_null($result)) {
                self::$logger->phpErrorLogger("Error While Updating user data into database");
                die("Error Occured Please try Again Later");
            }
            self::$logger->phpInfoLogger("Updation was Successful for user with" . $this->facebookUserId);
        }
    }

    private function checkUserStatus($facebookuserid) {
       
        $sqlCheckUserStatustatement = "SELECT 1 FROM userDetails WHERE facebookuserid=$facebookuserid";
        $result = mysqlUtilities::executeSqlStatement($sqlCheckUserStatustatement);
        self::$logger->phpInfoLogger("Checking User Status " . $facebookuserid);
        if (is_null($result)) {
            self::$logger->phpErrorLogger("Error While Checking Whether User Exists Or Not " . $facebookuserid);
            self::$logger->mysqlErrorLogger("Error While Checking Whether User Exists Or Not " . $facebookuserid . "\n" . mysql_error());
            return -1;
        }
        self::$logger->phpInfoLogger("Execution Of Checking User Status  " . $facebookuserid . " was Successful");
        if (mysql_num_rows($result) == 0) {
            return 0;
        } else {
            return 1;
        }
    }

}
?>

<?php

//
//  Storing and retreving Information using Shell Scripts Will Be Useful Dont Delete
//  ================================================================================
// 
//  private function storeProfileInfoIntoFile() {
//        
//        $userStatus = $this->checkUserStatusUsingScript($this->facebookUserId);
//        
//        $date = new DateTime();
//        
//        if (!$userStatus) {
//            
//            $insertProfileInfo = $this->facebookUserId . '|' . $this->username . '|' . $this->firstName . '|' . $this->lastName . '|' . $this->name . '|' . $this->address . '|' . $this->email . '|' . $this->mobile . '|' . 'user' . '|' . $this->locale . '|' . $this->verified . '|' . $this->profilePicUrl . '|' . $date->getTimestamp() . '|' . $date->getTimestamp()."\n";
//            
//            self::appendInfoToFileUsingScript("../metadata/userinfo",$insertProfileInfo);
//            
//        }
//        else{
//           // self::updateLastLoginTimeStamp($this->facebookUserId,$date->getTimestamp());
//        }
//        
//    }
//    
//    public static function updateLastLoginTimeStamp($facebookuserid,$timeStamp){
//        
//        $fileLocation ="/Applications/MAMP/htdocs/socioEcommerceCommon/metadata/userinfo";
//        
//        $cmd="./../scripts/shellscripts/replaceAFieldInFile ".$facebookuserid." 14 ".$timeStamp." ".$fileLocation;
//        
//        $stringToBeWrittenToFile = self::executeScript($cmd);
//        
//        $file = fopen($fileLocation, "w") or die("can't open file");
//        
//        fwrite($file, $stringToBeWrittenToFile);
//        
//        fclose($file);
//        
//    }
//    
//    public static function appendInfoToFileUsingScript($scriptFileLocation, $stringToBeWrittenToFile) {
//        
//        $file = fopen($scriptFileLocation, "a+") or die("can't open file");
//        
//        fwrite($file, $stringToBeWrittenToFile);
//        
//        fclose($file);
//        
//    }
//
//    public static function executeScript($cmd) {
//        $string = exec($cmd);
//        return $string;
//    }
//
//    private function checkUserStatusUsingScript($facebookuserid) {
//        
//        $cmd="./../scripts/shellscripts/checkUserIdExists ".$facebookuserid;
//        $status=self::executeScript($cmd);
//        if(!strcmp ($status ,"exists")){
//            return 1;
//        }else{
//            return 0;
//        }
//        
//    }
?>