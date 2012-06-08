<?php
$state = $_REQUEST['state'];
$code = $_REQUEST['code'];


session_start();
$_SESSION['loggedIn'] = "no";
$_SESSION['userId'] = "Guest";

?>


<?php
$pathInfo = '../php/constants/PathConstants.php';
include($pathInfo);
include_once($FB_GLOBAL_DEFINES);
include($FB_PHP);
include($FB_BASIC_INFO);
include('../php/mysql/dbCommonFunction.php');
global $userLoggedIn;
global $logoutUrl;

$config = array(
    'appId' => $appId,
    'secret' => $appSecret,
);
if (!is_null($code)) {
    $_SESSION['state'] = $state;
    $_SESSION['code'] = $code;
    $_SESSION['loggedIn'] = "Yes";
    
    $facebook = new Facebook($config);
    $userId = $facebook->getUser();
    if ($userId != 0) {
        $_SESSION['userId'] = $userId;
        $_SESSION['loggedIn'] = "Yes";
    } else {

        $token_url = "https://graph.facebook.com/oauth/access_token?" . "client_id=" . $appId . "&redirect_uri=" . urlencode("http://localhost:8888/ecommerce/src/homeV5.php") . "&client_secret=" . $appSecret . "&code=" . $code;
        $response = file_get_contents($token_url);
        $params = null;
        parse_str($response, $params);
        $accesstoken = $params['access_token'];
        $facebook->setAccessToken($params['access_token']);
        $userId = $facebook->getUser();
        $_SESSION['userId'] = $userId;
    }
    $checkUserStatus = checkUserStatus($userId);
   
    if ($checkUserStatus == 0) {

        $userProfile = $facebook->api('/me', 'GET');

        $userProfilePicArray = $facebook->api('/me?fields=picture', 'GET');

        $fbBasicInfo = new FBBasicInfo($userProfile, $userProfilePicArray);

        $userlikes = $facebook->api('/me/likes', 'GET');
        
    }
   
    
    $logoutconfig = array('next' => $LOGIN_PAGE_NO_USER_URL);

    $logoutUrl = $facebook->getLogoutUrl($logoutconfig);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SocioEcommerce</title>
        <link type="text/css" href="../css/common.css" rel="Stylesheet" />
        <link type="text/css" href="../css/test.css" rel="Stylesheet" />
        <link type="text/css" href="../css/navigation.css" rel="Stylesheet" />
        <link type="text/css" href="../css/dialogBox.css" rel="Stylesheet" />

        <script type="text/javascript" src="../scripts/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="../scripts/jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js"></script>
        <script type="text/javascript" src="../scripts/homePage.js"></script>
        <style>
            /*BUTTON */
            .thoughtbot {
                -webkit-box-shadow:rgba(255, 115, 100, 0.398438) 0 0 0 1px inset, #333333 0 1px 3px;
                background-color:#EE432E;
                background-image:-webkit-linear-gradient(top, #EE432E 0%, #C63929 50%, #B51700 50%, #891100 100%);
                border:1px solid #951100;
                border-bottom-left-radius:5px;
                border-bottom-right-radius:5px;
                border-top-left-radius:5px;
                border-top-right-radius:5px;
                box-shadow:rgba(255, 115, 100, 0.398438) 0 0 0 1px inset, #333333 0 1px 3px;
                color:#FFFFFF;
                font-family:'helvetica neue', helvetica, arial, sans-serif;
                font-size:10px;
                font-style:normal;
                font-variant:normal;
                font-weight:bold;
                line-height:1;
                padding:5px 5px 8px 8px;
                text-align:center;
                text-shadow:rgba(0, 0, 0, 0.796875) 0 -1px 1px;

            }


        </style>
    </head>
    <body>
        <?php
        include("includes/modalDialogBox.php");
        include("includes/header.php");
        include_once('../php/webpages/homePagePhp.php');
        ?>
        <div class="container">
            <div id="content">
                <div id="space">hidden</div>
                <div class="mainContent" style="position:relative">
                    <?php
                    include_once('../php/mysql/ImagesFromDb.php');



                    $arrayImageWithInfo = ImagesFromDb::getImages(0, 10);

                    $rowCount = 2;

                    $maxWidth = 730;

                    getImagesDivForPartner($arrayImageWithInfo, 0, $rowCount, $maxWidth);
                    ?>
                </div>
            </div>

            <?php
            include("includes/footer.php");
            ?>
        </div>

    </body>

    <script>
            
        var userId='<?php
            if ($_SESSION['loggedIn'] == "Yes") {
                echo $userId;
            } else {
                echo "guest";
            }
            ?>';
        
                $(".mainContent").on("click",".thoughtbot",function(event){
                    var parent = $(this).parent().get(0);
                    var srcOfImageElement= parent.getElementsByTagName("img")[0].getAttribute("src");
                    displayModalBoxForShortDesc(event,userId,srcOfImageElement);
                    
                });
    
                $("#header_dialogBox").on("click",".close",function(){
                    closeModalBoxForShortDesc();
                });
    
                $("#moreInfo").on("click","a",function(event){
                    var baseUrlItemDescription="http://localhost:8888/socioEcommerceCommon/src/itemDescription.php?url=";
                    redirectToUrlForLongDesc(event,baseUrlItemDescription);
                });
            
    </script>
</html>
