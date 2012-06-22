<?php
session_start();
?>
<?php
include_once '../php/homePagePhp.php';

$imageInfo = $_POST['imageInfo'];

$category = $_POST['category'];


$url = $_GET['url'];

list($width, $height, $type, $attr) = getimagesize($url);





?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SocioEcommerce</title>
        <link type="text/css" href="../css/common.css" rel="Stylesheet" />
        <link type="text/css" href="../css/test.css" rel="Stylesheet" />
        <link type="text/css" href="../css/navigation.css" rel="Stylesheet" />
        <link type="text/css" href="../css/itemDescription.css" rel="Stylesheet" />
        <link type="text/css" href="../scripts/jquery-ui-1.8.17.custom/css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="Stylesheet" />
        <script type="text/javascript" src="../scripts/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="../scripts/jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js"></script>
        <style>

        </style>
        <script>
            $(document).ready(function(){
               $('.userInfo').on('click','.getInfoForItem',function(){
                   if($(".info").css("display")==="none"){
                       $(".info").css("display","block");
                   }
                   else{
                       $(".info").css("display","none");
                   }
               });
               
               var userId='<?php echo $_SESSION['userId']?>';
              
               if(userId.toLowerCase() != "guest"){
                   $('.userInfo').off('click','.getInfoForItem');
               }
               
            });
        </script>
    </head>
    <body>
<?php
include "includes/header.php";
?>
        <div class="container">
            <div id="content">
                <div id="space">hidden</div>
                <div class="mainContent" style="position:relative">

                    <div id="column1">
                        <div id="itemImage" style="height:<?php echo $height . "px" ?>">
                            <div class="centerImage" style="width:<?php echo $width . "px" ?>"><img class="roundedBorderImage"src="<?php echo $url ?>" width="<?php echo $width . "px" ?>" height="<?php echo $height . "px" ?>" /></div>
                        </div>
                        <div id="commentsSection">
                            <ul class="commentslist">
                                <li class="chat-bubble">
                                    <div class="profileInfo"><span class="profilePic"><img src="../src/images/thumbnails/avikodak.jpg" width="30px" height="30px"/></span><p class="username">Username</p></div>
                                    <div class="comment"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p></div>
                                    <div class="chat-bubble-arrow-border"></div>
                                    <div class="chat-bubble-arrow"></div>
                                </li>
                                <li class="chat-bubble">
                                    <div class="profileInfo"><span class="profilePic"><img src="../src/images/thumbnails/avikodak.jpg" width="30px" height="30px"/></span><p class="username">Username</p></div>
                                    <div class="comment"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p></div>
                                    <div class="chat-bubble-arrow-border"></div>
                                    <div class="chat-bubble-arrow"></div>
                                </li>
                                <li class="chat-bubble">
                                    <div class="profileInfo"><span class="profilePic"><img src="../src/images/thumbnails/avikodak.jpg" width="30px" height="30px"/></span><p class="username">Username</p></div>
                                    <div class="comment"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p></div>
                                    <div class="chat-bubble-arrow-border"></div>
                                    <div class="chat-bubble-arrow"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="trendingItems">

                        </div>
                        <div class="relatedContents">

                        </div>
                    </div>
                    <div id="column2">
                        
                        <div class="infoSection">
                            <ul id="itemInfo">
                                <li><a class="itemlinks itemInfoLabel">Price</a><div class="indiInfo"></div></li>
                                <li><a class="itemlinks">Discount</a><div class="indiInfo"></div></li>    
                            </ul>
                        </div>
                        
                        <div class="options">
                            <ul id="itemRelatedLinks">
                                <li><a class="itemlinks"><span class="addFav"></span>Add To Favourites</a></li>
                                <li><a class="itemlinks"><span class="like"></span>Like</a></li>    
                                <li><a class="itemlinks"><span class="reco"></span>Recommend Someone</a></li>    
                            </ul>
                        </div>
                        <div class="userInfo">
                            <a class="getInfoForItem thoughtbot"><span class="call"></span>Ask Seller To Contact Back</a>
                            <div class="info">
                                <form>
                                    <table>
                                        <tr>
                                            <td><input type="text" placeholder="Name" name="name" id="infoName" style="outline: none;" class="inputText"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="email" placeholder="Email" name="email" id="infoEmail" style="outline: none;"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" placeholder="Mobile" name="name" id="infoMobile" style="outline: none;"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="requestSubmit"><input type="submit" value="Send Request" /></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
