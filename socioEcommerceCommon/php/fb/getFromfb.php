<?php
include_once 'classes/FBParser.php';
class fb {

    private $facebook;
    private $accessToken;
    private $interests;
    private $statuses;
    private $likes;
    private $userProfile;
    private $userProfilePic;
    private static $GET = "GET";

    public function __construct($accesstoken) {
        
        $config = array(
            'appId' => $appId,
            'secret' => $appSecret,
        );
        $this->facebook = new Facebook($config);
        $this->facebook->setAccessToken($accesstoken);
    }

    public function getUserProfile() {
        $userProfileObject = self::callFbApi("/me", self::$GET);
        return $userProfileObject;
    }

    public function getInterestsAsString() {

        $fbBaseUrl = "/me/interests";
        $url = $fbBaseUrl;
        do {
            $userInterests = $this->callFbApi($url, self::$GET);

            if (count($userInterests["data"]) > 0) {
                $fbInterestsObj = new FBResponseParser($userInterests);
                $interestsAsString = $interestsAsString . $fbInterestsObj->getAllInterests($interestsAsString);
                $nextPageUrl = $fbInterestsObj->getNextUrl();
                $nextPageUrl = parse_url($nextPageUrl);
                $queryParameters = $nextPageUrl["query"];
                $url = $fbBaseUrl . "?" . $queryParameters;
            } else {
                break;
            }
        } while (1);

        return $interestsAsString;
    }

    public function getLikes() {
        $likesObject = $this->callFbApi("/me/likes", self::$GET);
        return $likesObject;
    }

    public function getStatuses() {
        $statusObject = $this->callFbApi("/me/statuses", self::$GET);
        return $statusObject;
    }
    
    public function getUserProfilePic(){
        $profilePicUrl = $this->callFbApi("/me?fields=picture", self::$GET);
        return $profilePicUrl;
    }
    
    public function parseStatuses() {
        
    }

    //This is used to parse similar elements to interests
    public function parseInterests() {
        
    }

    public function callFbApi($fbUrl, $method) {
        try {
            $reqObj = $this->facebook->api($fbUrl, $method);
        } catch (OAuthException $e) {
            echo "There was a error making a facebook call. Please check the parameters and the url";
        } catch (Exception $e) {
            echo "There was a exception";
            echo $e ."<br/>";
        }
        return $reqObj;
    }

}

/*
  {
  "error": {
  "message": "An access token is required to request this resource.",
  "type": "OAuthException",
  "code": 104
  }
  }
 */
?>