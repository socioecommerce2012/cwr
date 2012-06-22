<?php
session_start();

?>
<script>
    
    $('body').on('click','a.category_label',function(){
        var id=$(this).attr("id");
        $("input:#category").val(id);
      
        $.ajax({
            type : "POST",
            url : '../src/getCategory.php',
            data:{
              category:id  
            },
            start : function(){
                $(".mainContent").append("<img src='BouncingLoader.gif' width=\"64\" height=\"64\" />");
            },
            success: function(data) {
               $(".mainContent").html("");
               
               if(data!=""){
                $(".mainContent").append(data);
               }
               else{
                 $(".mainContent").append("data doesnt exists for this category");  
               }
            },
            error : function() {
                alert("Sorry, The requested property could not be found.");
            }
        });
    });
</script>
<form action="getCategory.php" method="post" id="categoryForm">
    <input type="hidden" name="category" id="category" />
</form>
<ul id="menu">
    <li>
        <a href="#" class="drop hoverBlock">Home</a><!-- Begin Home Item -->
    </li><!-- End Home Item -->
    <li><a href="#" class="drop">Categories</a><!-- Begin 4 columns Item -->
        <div class="dropdown_3columns"><!-- Begin 4 columns container -->

            <div class="col_3">
                <h2>Choose a category</h2>
            </div>
            <span class="category_list">
                <div class="col_1">
                    <ul>
                        <li><a href="#" class="category_label" id="men">Men's</a></li>
                        <li><a href="#" class="category_label" id="women">Women's</a></li>
                        <li><a href="#" class="category_label" id="kids">Kids</a></li>
                        <li><a href="#" class="category_label" id="pets">Pets</a></li>
                        <li><a href="#" class="category_label" id="home decor">Home Decor</a></li>
                        <li><a href="#" class="category_label" id="handicrafts">Handicrafts</a></li>
                        <li><a href="#" class="category_label" id="fashion">Fashion</a></li>
                    </ul>   

                </div>

                <div class="col_1">
                    <ul>
                        <li><a href="#" class="category_label" id="gadgets">Gadgets</a></li>
                        <li><a href="#" class="category_label" id="art">Art</a></li>
                        <li><a href="#" class="category_label" id="food">Food</a></li>
                        <li><a href="#" class="category_label" id="architecture">Architecture</a></li>
                        <li><a href="#" class="category_label" id="sportsAndOutdoors">Sports & Outdoors</a></li>
                        <li><a href="#" class="category_label" id="carsAndBikes">Cars and Bikes</a></li>
                        <li><a href="#" class="category_label" id="other">Other</a></li>
                    </ul>   
                </div>
            </span>    

            <div class="col_1">
                <ul>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Sales</a></li>
                    <li><a href="#">Deals</a></li>
                    <li><a href="#">Brands and stores</a></li>

                </ul>   

            </div>

        </div><!-- End 4 columns container -->

    </li><!-- End 4 columns Item -->

    <li>
        <a href="#" class="drop">Add</a><!-- Begin Home Item -->
    </li><!-- End Home Item -->
    <?php if(strtolower($_SESSION["loggedIn"]) == strtolower("YES")) :?>
    <li class="menu_left"><a href="#" class="drop">Me</a>
        <div class="dropdown_1column align_left">
            <div class="col_1">
                <ul class="simple">
                    
                    <li><a href="#">My Favourites</a></li>
                    <li><a href="#">Shown To You</a></li>
                    <li><a href="#">My Catalog</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="<?php echo $logoutUrl; ?>">Sign Out</a></li>
                    
                </ul>   
            </div>
        </div>
    </li>
    <?php else :?>
    <li class="menu_left"><a href="<?php echo $loginUrl?>" class="drop">Login</a></li>
    <?php endif;?>
</ul>

