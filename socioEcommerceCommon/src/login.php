<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link type="text/css" href="../css/login.css" rel="Stylesheet" />
        <?php
        require('../php/constants/PathConstants.php');
        require_once($FB_PHP);
        require_once($FB_GLOBAL_DEFINES);


        $config = array(
            'appId' => $appId,
            'secret' => $appSecret,
            
        );

        $facebook = new Facebook($config);

        $user_id = $facebook->getUser();
        $params = array(
            'scope' => 'read_stream, friends_likes,user_interests,email,user_status',
            'redirect_uri' => $HOME_PAGE_URL,
        );
        
        $loginUrl = $facebook->getLoginUrl($params);
        error_log($loginUrl);
        ?>
    </head>
    <body>
        <div id="loginBox">
            <form id="login">
                <h1>Log In</h1>
                <fieldset id="inputs">
                    <div class="username"></div> <input id="username" type="text" placeholder="Username"  required="">   
                    <div class="password"></div><input id="password" type="password" placeholder="Password" required="">
                </fieldset>
                <fieldset id="actions">

                    <input type="submit" id="submit" value="Log in">
                    <!--<a href="">Forgot your password?</a><a href="">Register</a>-->
                </fieldset>
            </form>
            <fieldset id="otherLogins">
                <a id="fBButton" href="<?php echo $loginUrl?>">f</a>
            </fieldset>
        </div>
    </body>
</html>
