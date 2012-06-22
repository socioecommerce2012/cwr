<?php
include "../php/mysql/dbCommonFunction.php";
include "../php/mysql/mysqlUtilities.php";
$uploadedTargetPath = $_GET["target"];
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            #uploadedimage{
                display:inline;
                width: 200px;
                height: 200px;
                float:left;
            }

            .infoUpload{
                display:inline-block;

            }

            .info{

            }

            .inputText{
                width:200px;
                height:30px;
                padding: 5px;
                line-height: 15px;
                outline: none;
            }
        </style>
    </head>
    <body>

        <div>
            <div id="uploadedimage">
                <img src="<?php echo $uploadedTargetPath ?>" width="200px" height="200px"/>
            </div> 
            <div class="infoUpload">
                <h3>Tell Us Few Things About The Image You Have Uploaded</h3>
                <form action="saveImgInfo.php" method="POST">
                    <input type="hidden" name="fileName" value="<?php echo $uploadedTargetPath?>"/>
                    <table>
                        <tr>
                            <td class="labelUpload">TITLE</td>
                            <td><input type="text" name="title" placeholder="Enter title" class="inputText"/></td>
                        </tr>

                        <tr>
                            <td class="labelUpload">DESCRIPTION</td>
                            <td><textarea name="desc" rows="10" cols="40" placeholder="Enter Description" style="resize: none;"></textarea></td>
                        </tr>

                        <tr>
                            <td class="labelUpload">PRICE</td>
                            <td><input type="text" name="price"  placeholder="Enter price" class="inputText"/></td>
                        </tr>


                        <tr>
                            <td class="labelUpload">DISCOUNT</td>
                            <td><input type="text" name="discount"  placeholder="Enter discount" class="inputText"/></td>
                        </tr>

                        <tr>
                            <td class="labelUpload">CATEGORIES</td>
                            <td>
                                <select name="category[]" multiple="multiple">
                                    <?php
                                    $categories = getAllCategories();
                                    echo count($categories);
                                    for ($i = 0; $i < count($categories); $i++):
                                        ?>
                                        <option value="<?php echo $categories[$i] ?>"><?php echo ucwords($categories[$i]) ?></options>
                                            <?php
                                        endfor;
                                        ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="submit"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </body>
</html>
<!--
/* all */
::-webkit-input-placeholder  { color:#f00; }
input:-moz-placeholder { color:#f00; }

/* individual: webkit */
#field2::-webkit-input-placeholder { color:#00f; }
#field3::-webkit-input-placeholder { color:#090; background:lightgreen; text-transform:uppercase; }
#field4::-webkit-input-placeholder { font-style:italic; text-decoration:overline; letter-spacing:3px; color:#999; }

/* individual: mozilla */
#field2::-moz-placeholder { color:#00f; }
#field3::-moz-placeholder { color:#090; background:lightgreen; text-transform:uppercase; }
#field4::-moz-placeholder { font-style:italic; text-decoration:overline; letter-spacing:3px; color:#999; }
-->