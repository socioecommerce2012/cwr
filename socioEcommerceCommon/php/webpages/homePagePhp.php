<?php

function getAllFileNamesInDir($directoryName, $parentDir, $count) {
    $fileNames = array();
    $marker = 0;
    if ($handle = opendir($directoryName)) {
        /* This is the correct way to loop over the directory. */
        while (false !== ($entry = readdir($handle)) && $marker < $count) {

            if (strpos($entry, ".php") || $entry == "thumbnails" || is_dir($entry)) {
                continue;
            }
            if ($entry != ".DS_Store" && $entry != "." && $entry != "..") {

                $fileNames[] = $parentDir . "/" . $entry;
            }
            $marker++;
        }
        closedir($handle);
    }
    return $fileNames;
}

function getImagesInfoV2($arrayImages) {

    for ($i = 0; $i < count($arrayImages); $i++) {

        if (strpos($arrayImages[$i]["url"], ".jpeg") || strpos($arrayImages[$i]["url"], ".jpeg")) {

            $image = imagecreatefromjpeg($arrayImages[$i]["url"]);
        }
        if (strpos($arrayImages[$i]["url"], ".gif") || strpos($arrayImages[$i]["url"], ".gif")) {
            $image = imagecreatefromgif($arrayImages[$i]["url"]);
        }
        if (strpos($arrayImages[$i]["url"], ".jpg") || strpos($arrayImages[$i]["url"], ".jpg")) {

            $image = imagecreatefromjpeg($arrayImages[$i]["url"]);
        }

        if (strpos($arrayImages[$i]["url"], ".png")) {
            $image = imagecreatefrompng($arrayImages[$i]["url"]);
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $arrayImages[$i]["url"]=  substr($arrayImages[$i]["url"],10);
        $arrayImages[$i]["width"] = $width;
        $arrayImages[$i]["height"] = $height;
        $arrayImages[$i]["display"] ="NO";
    }
    return $arrayImages;
}




function getImagesInfo($arrayImages) {

    for ($i = 0; $i < count($arrayImages); $i++) {

        if (strpos($arrayImages[$i]["url"], ".jpeg") || strpos($arrayImages[$i]["url"], ".jpeg")) {

            $image = imagecreatefromjpeg($arrayImages[$i]["url"]);
        }
        if (strpos($arrayImages[$i]["url"], ".gif") || strpos($arrayImages[$i]["url"], ".gif")) {
            $image = imagecreatefromgif($arrayImages[$i]["url"]);
        }
        if (strpos($arrayImages[$i]["url"], ".jpg") || strpos($arrayImages[$i]["url"], ".jpg")) {

            $image = imagecreatefromjpeg($arrayImages[$i]["url"]);
        }

        if (strpos($arrayImages[$i]["url"], ".png")) {
            $image = imagecreatefrompng($arrayImages[$i]["url"]);
        }

        $width = imagesx($image);
        $height = imagesy($image);
        
        $arrayImageWithInfo[$i] = array("url" => $arrayImages[$i]["url"], "width" => $width, "height" => $height, "display" => "no");
    }
    return $arrayImageWithInfo;
}

function sortArray($arrayImageWithInfo) {
    foreach ($arrayImageWithInfo as $c => $key) {
        $sort_width[] = $key['width'];
        $sort_height[] = $key['height'];
    }
    array_multisort($sort_width, SORT_ASC, $sort_height, SORT_DESC, $arrayImageWithInfo);
    return $arrayImageWithInfo;
}

function getImageCountInARow($arrayImageWithInfo, $maxImagesInRow, $marker, $maxWidth) {
    $CountHeight = array();
    $urlArray = array();
    $count = 0;
    $width = 0;
    $emValue = 16;
    $maxHeight = 0;
    
    for ($i = $marker; $i < count($arrayImageWithInfo); $i++) {
        
        if (!strcasecmp($arrayImageWithInfo[$i]["display"], "no")) {
            if ($width + $arrayImageWithInfo[$i]["width"] + $emValue >= $maxWidth) {
                if ($width < (0.6 * $maxWidth)) {
                    continue;
                }
                $CountHeight[] = array("arrayImageWithInfo" => $arrayImageWithInfo, "count" => $count, "maxHeight" => $maxHeight, "totalWidth" => $width, "imagesInfo" => $imagesInfo);
                return $CountHeight;
            }
            $imagesInfo[] = array("url" => $arrayImageWithInfo[$i]["url"], "width" => $arrayImageWithInfo[$i]["width"], "height" => $arrayImageWithInfo[$i]["height"],"title"=>$arrayImageWithInfo[$i]["title"]);

            $arrayImageWithInfo[$i]["display"] = "yes";
            $arrayImageWithInfo[$i]["display"] = "yes";
            $width = $width + $arrayImageWithInfo[$i]["width"] + $emValue;
            if ($maxHeight < $arrayImageWithInfo[$i]["height"]) {
                $maxHeight = $arrayImageWithInfo[$i]["height"];
            }

            $count++;
            if ($i - $marker > $maxImagesInRow) {
                $CountHeight[] = array("arrayImageWithInfo" => $arrayImageWithInfo, "count" => $count, "maxHeight" => $maxHeight, "totalWidth" => $width, "imagesInfo" => $imagesInfo);
                return $CountHeight;
            }
        }
    }
    $CountHeight[] = array("arrayImageWithInfo" => $arrayImageWithInfo, "count" => $count, "maxHeight" => $maxHeight, "totalWidth" => $width, "imagesInfo" => $imagesInfo);
    return $CountHeight;
}

function getNextDisplayNoMarker($arrayImageWithInfo, $i) {

    for ($j = $i; $j < count($arrayImageWithInfo); $j++) {

        if (!strcasecmp($arrayImageWithInfo[$j]["display"], "no")) {
            return $j;
        }
    }
    return -1;
}

function getImagesDivForPartner($arrayImageWithInfo, $startCount, $rowCount, $maxWidth) {


    echo '<div class="partner">';
    $totalImages = 0;
    $maxImagesInRow = 2;
    $emValue = 16;
    
    for ($i = $startCount; $i < count($arrayImageWithInfo) && $i != -1;) {
        
        $RowCountAndMaxHeightArray = getImageCountInARow($arrayImageWithInfo, 3, $i, $maxWidth);

        $arrayImageWithInfo = $RowCountAndMaxHeightArray[0]["arrayImageWithInfo"];
        $rowCount = $RowCountAndMaxHeightArray[0]["count"];
        $totalImages+=$rowCount;
        if ($rowCount == 0) {
            $i = getNextDisplayNoMarker($arrayImageWithInfo, $i + 1);
            continue;
        }
        $maxHeight = $RowCountAndMaxHeightArray[0]["maxHeight"];
        $totalWidth = $RowCountAndMaxHeightArray[0]["totalWidth"];
        $imagesInfo = $RowCountAndMaxHeightArray[0]["imagesInfo"];

        echo '<div class="imageRow">';
        echo '<div class="centerImages" style="width:' . $totalWidth . 'px">';
        for ($j = 0; $j < $rowCount; $j++) {
            //$width = ($maxWidth - (($rowCount*$emValue)/$rowCount));

            $imageUrl = $imagesInfo[$j]["url"];
            $imageHeight = $imagesInfo[$j]["height"];
            $height = $maxHeight;
            if ($imageHeight < $maxHeight) {
                $height = $imageHeight;
            }
            $imageDesc = $imagesInfo[$j]["title"];
            
            createDivForImage($imagesInfo[$j]["width"], $height, $maxHeight, $emValue, $imageUrl,$imageDesc);
        }
        echo "<div class='clearfix'></div>";
        echo '</div>';
        echo '</div>';

        $i = getNextDisplayNoMarker($arrayImageWithInfo, $i + 1);
    }
    echo '</div>';
  
}
?>
<?php

function createDivForImage($width, $height, $maxHeight, $emValue, $url ,$imageDesc) { ?>
    <div class="image" style="width:<?php echo $width . "px" ?>;">
        <div class="imageInfo imageModalBox" style="width:<?php echo $width . "px" ?>;height:<?php echo $maxHeight + (2 * $emValue) . "px" ?>" >
            <input type="hidden" name="uploadedBy" value="test"/>
            
            
        </div>
        <div class="imageSelector" style="z-index:-1;background-color: #FFFFFF;display:inline-block;height:<?php echo $maxHeight . "px" ?>;width:<?php echo $width . "px" ?>">
            <img class="Imgcenter roundedBorderImage" style="margin-top:<?php echo (($maxHeight-$height)/2)."px";?>" src="<?php echo $url ?>" width="<?php echo $width . 'px' ?>" height="<?php echo $height . 'px' ?>" />
        </div>
   
        <div class="imageContent" style="width:<?php echo $width . "px" ?>" >
            <?php echo $imageDesc; ?> 
        </div>
       <div class="getInfoForPic thoughtbot" style="left:<? echo ($width-(2 * $emValue))/2 ."px"?>;top:<?php echo ($maxHeight-(2 * $emValue))/2 ."px" ?>">GetInfo</div>
    </div>

<?php } ?>