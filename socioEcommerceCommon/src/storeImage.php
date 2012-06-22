<?php
include '../php/mysql/dbCommonFunction.php';
$target_path = "img/";
$fileName=$_FILES['uploadedfile']['name'];
if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
} else {
    $format = getImageFormat($fileName);
    if ($format!=-1) {
        $uuid = createUniqueId($fileName);
        $target_path .= $uuid;
        $target_path .= $format;
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            $path = "http://localhost:8888/upload/src/giveImgInfo.php?target=".$target_path;
            echo "Please Wait...";
            echo '<script>window.location.href="'.$path.'"</script>';
        } else {
            echo "There was an error uploading the file, please try again!";
        }
    }
    else{
        echo "We Upload Only jpeg,jpg,png,gif format files";
    }
}




?>
