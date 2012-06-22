<?php

function getWholeDataForGivenCategory($fbBaseUrl, $facebook) {

    $url = $fbBaseUrl;
    do {
        $userInterests = $facebook->api($url, 'GET');

        if (count($userInterests["data"]) > 0) {
            $fbInterestsClass = new FBInterests_Class($userInterests);
            $interestsAsString = $fbInterestsClass->getAllInterests($interestsAsString);
            $nextPageUrl = $fbInterestsClass->getNextUrl();
            $nextPageUrl = parse_url($nextPageUrl);
            $queryParameters = $nextPageUrl["query"];
            $url = $fbBaseUrl . "?" . $queryParameters;
        } else {
            break;
        }
    } while (1);

    return $interestsAsString;
}

function getWholeStatus($facebook) {
    $fbBaseUrl = "/me/statuses";
    $url = $fbBaseUrl;
    do {
        $userStatuses = $facebook->api($url, 'GET');

        if (count($userStatuses["data"]) > 0) {
            $allStatus = getAllStatusMessages($userStatuses, $allStatus);
            $nextPageUrl = $userStatuses["paging"]["next"];
            $nextPageUrl = parse_url($nextPageUrl);
            $queryParameters = $nextPageUrl["query"];
           
            $url = $fbBaseUrl . "?" . $queryParameters;
        } else {
            break;
        }
    } while (1);
    return $allStatus;
}

function getAllStatusMessages($array, $toBeAppendedString) {
    
    $array = array_values($array["data"]);
    
    for ($i = 0; $i < count($array); $i++) {
        $likes=  getAllLikesForStatus($array[$i]["likes"], $likes);
        $comments = getAllCommentsForStatus($array[$i]["comments"], $comments);
        $toBeAppendedString = $toBeAppendedString . $array[$i]["message"] . "::" . $array[$i]["updated_time"] ."::".$likes."::".$comments. "$$\n";
        //$toBeAppendedString =$toBeAppendedString ."[STARTMESSAGE]\n" .$array[$i]["message"] . "::" . $array[$i]["updated_time"] ."\n[ENDMESSAGE]\n";
        $likes="";
        $comments="";
    }
    return $toBeAppendedString;
}


function getAllLikesForStatus($array,$toBeAppendedString)
{
    $array = array_values($array["data"]);
    
    $toBeAppendedString = $toBeAppendedString ."\n[STARTLIKES]\n";
    for ($i = 0; $i < count($array); $i++) {
        
        $toBeAppendedString = $toBeAppendedString ."\n".$array[$i]["id"] . "***" . $array[$i]["name"]."\n";
    }
    $toBeAppendedString = $toBeAppendedString ."\n[ENDLIKES]\n";
    return $toBeAppendedString;
}


function getAllCommentsForStatus($array,$toBeAppendedString){
   $array = array_values($array["data"]);
    $toBeAppendedString = $toBeAppendedString ."\n[STARTCOMMENT]\n";
    for ($i = 0; $i < count($array); $i++) {
        
        $toBeAppendedString = $toBeAppendedString ."\n". $array[$i]["id"] . "^^^^" . $array[$i]["from"]["id"]."^^^^".$array[$i]["from"]["name"]."^^^^".$array[$i]["message"]."^^^^".$array[$i]["created_time"]."^^^^".$array[$i]["like_count"]."\n";
    } 
    $toBeAppendedString = $toBeAppendedString ."[ENDCOMMENT]";
    return $toBeAppendedString;
}
?>
