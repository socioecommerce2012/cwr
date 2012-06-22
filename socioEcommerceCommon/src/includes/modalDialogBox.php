<?php
include_once('../../php/mysql/ImagesFromDb.php');
?>
<script>
    $(document).ready(function(){
                
        $(".container").on("click","#tleft",function(){
            var currentLeftPosition= $("#trending_collectionRecords").position().left ;
            currentLeftPosition= Number(currentLeftPosition) - 70;
            $("#trending_collectionRecords").css("left",currentLeftPosition+"px"); 
        });
                
        $(".container").on("click","#tright",function(){
            var currentLeftPosition= $("#trending_collectionRecords").position().left ;
            currentLeftPosition= Number(currentLeftPosition) + 70;
            $("#trending_collectionRecords").css("left",String(currentLeftPosition)+"px"); 
                    
        });
        $(".container").on("click","#rleft",function(){
            var currentLeftPosition= $("#recent_collectionRecords").position().left ;
            currentLeftPosition= Number(currentLeftPosition) - 70;
            $("#recent_collectionRecords").css("left",currentLeftPosition+"px"); 
        });
                
        $(".container").on("click","#rright",function(){
            var currentLeftPosition= $("#recent_collectionRecords").position().left ;
            currentLeftPosition= Number(currentLeftPosition) + 70;
            $("#recent_collectionRecords").css("left",String(currentLeftPosition)+"px"); 
                    
        });
                
        $(".records").on("click",".roundedBorderImage",function(e){
            $("#screen").html("");
            var imageSrc = $(this).attr("src");
            var width="250px";
            var height="250px";
            var contentToBeAppended = "<img src=\""+imageSrc+"\" width="+width+" height="+height+"/>";
            $("#screen").append(contentToBeAppended);
            $("#screen > img").addClass("imageInsideScreen");
        });
                
    });
</script>
<style>
    #upload{
        width:150px;
        height:150px;
        z-index:100;
        position:fixed;
        left:600px;
        top:200px;
        color:white;
    }
</style>
<div class="opacityDialogBox" style="display:none">
    <div class="opacity"></div>
    <div id="content">
        <div id="upload" style="display:none">
            <div>
                <form action="storeImage.php" method="post" enctype="multipart/form-data">
                    <label for="fileUpload">
                        Choose File
                    </label>
                    <input name="uploadedfile" type="file" />
                    <input type="submit" value="upload"/>
                </form>
            </div>
        </div>
        <div class="carouselcontainer" id="trendingContainer"><span style="color:white">Trending Items</span>
            <div class="mainCarousel">
                <div class="leftArrowIndicator"><a id="tleft" class="left"> ◄ </a></div>
                <div class="carousel_container">
                    <?php $arrayImagesForTrending = ImagesFromDb::getImageIdsForGivenEmailId("avikodak@gmail.com", "10", "50"); ?>
                    <div id="trending_collectionRecords">
                        <?php
                        for ($i = 0; $i < 10; $i++):
                            ?>
                            <div class="carousel_records">
                                <div class="records">
                                    <img class="roundedBorderImage" style="margin-top: 0px;" src="<?php echo $arrayImagesForTrending[$i]["url"] ?>" width="50px" height="50px"/>

                                </div>
                            </div>
                            <?php
                        endfor;
                        ?>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="rightArrowIndicator"><a id="tright" class="right"> ► </a></div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div id="dialogBox">
            <div id="mainContentDialogBox">
                <header id="header_dialogBox">
                    <div class="close">Close</div>
                    <p class="mainHeading">
                        <span id="modal_titleItem"></span> 
                    </p>
                    <p class="subHeading">Price <span id="price"></span> Discount <span id="discount"></span></p>

                </header>
                <div id="dialogContent">
                    <div id="col1_dialogBox">
                        <div class="imageInDialogBox">
                            <img class="roundedBorderImage" width="200px" height="200px" src="" alt="Broken Image">
                        </div>
                        <div id="moreInfo"><a href="#">Get More Information</a></div>
                    </div>
                    <div id="col2_dialogBox">
                        <div id="checkBoxSection">
                            <form>
                                <?php ?>
                            </form>
                            <span id="description">Short Description</span>
                        </div>
                        <!--
                        <div id="createNewList">
                            <form>
                               <div id="createCategory"><input type="text" name="categories" placeholder=" + Add New Category" class="noOutline width_100p textBox_Dialog"/></div>
                            </form>
                        </div>-->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="footer_dialogBox">
                    <div class="rfloat">
                        <div class="thoughtbot">Plan To Buy</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carouselcontainer" id="recentContainer"><span style="color:white">Related To A Category</span>
            <div class="mainCarousel">
                <div class="leftArrowIndicator"><a id="rleft" class="left"> ◄ </a></div>
                <div class="carousel_container">
                    <?php
                    $recentArrayImages = ImagesFromDb::getImageIdsForGivenEmailId("avikodak@gmail.com", "10", "50");
                    ?>
                    <div id="recent_collectionRecords">
                        <?php
                        for ($i = 0; $i < 10; $i++):
                            ?>
                            <div class="carousel_records">
                                <div class="records">
                                    <img class="roundedBorderImage" style="margin-top: 0px;" src="<?php echo $recentArrayImages[$i]["url"] ?>" width="50px" height="50px"/>

                                </div>
                            </div>
                            <?php
                        endfor;
                        ?>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="rightArrowIndicator"><a id="rright" class="right"> ► </a></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div>

