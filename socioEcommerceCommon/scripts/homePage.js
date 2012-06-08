$(document).ready(function(){
    
    windowWidth = $(window).width(); //retrieve current window width
    windowHeight = $(window).height(); //retrieve current window height
    documentWidth = $(document).width(); //retrieve current document width
    documentHeight = $(document).height(); //retrieve current document height
    vScrollPosition = $(document).scrollTop(); //retrieve the document scroll ToP position
    hScrollPosition = $(document).scrollLeft(); //retrieve the document scroll Left position    
    
    $(".infiniteScrollBtn").click(function(){
        
        $.ajax({
            type : "POST",
            url : '../src/textAjax.php',
            start : function(){
                $(".mainContent").append("<img src='BouncingLoader.gif' width=\"64\" height=\"64\" />");
            },
            success: function(data) {

                $(".mainContent").append(data);
            },
            error : function() {
                alert("Sorry, The requested property could not be found.");
            }
        });
    });
    
    $("#msg").ajaxError(function(event, request, settings){
        $(this).append("<li>Error requesting page " + settings.url + "</li>");
    });
   
    $(".mainContent").on("mouseenter",".image", function() {
        $(this).children(".getInfoForPic").css("display","inline");
        $(this).children(".imageInfo").css("display","inline");
       
    });
    
    $(".mainContent").on("mouseleave",".image", function() {
        $(this).children(".getInfoForPic").css("display","none");
        $(this).children(".imageInfo").css("display","none");
       
    });

});

function displayModalBoxForShortDesc(event,userId,srcOfImageElement){
    
    
    displayModalDialog(srcOfImageElement);
    
    $.ajax({
        type : "POST",
        url : '../src/storeEvents.php',
        data:{
            event:"mayBeInterested",
            itemId:srcOfImageElement,
            userId:userId,
            timeStamp:event.timeStamp
        },
        success: function(data) {
            console.log("Event Stored Successfully");
        },
        error : function() {
            alert("Sorry, The requested property could not be found.");
        }
    });
}

function setContentInModalDialog(srcOfImageElement){
    
    $("..imageInDialogBox > .roundedBorderImage").attr("src",srcOfImageElement);
    
}


function displayModalDialog(srcOfImageElement)
{
    
    setContentInModalDialog(srcOfImageElement);
    $(".opacityDialogBox").css("display","inline-block");
    document.body.style.overflow="hidden";
}


function redirectToUrlForLongDesc(event,baseUrlItemDescription)
{
  
    var urlImage=$(".imageInDialogBox > .roundedBorderImage").attr("src");
    var hrefValue = baseUrlItemDescription+urlImage;
    $.ajax({
        type : "POST",
        url : '../src/storeEvents.php',
        data:{
            event:"Interested",
            itemId:urlImage,
            userId:userId,
            timeStamp:event.timeStamp
        },
        success: function(data) {
            console.log("Event Stored Successfully");
        }
    });
    window.location.href=hrefValue;
        
}

function closeModalBoxForShortDesc(){
    $(".opacityDialogBox").css("display","none");
    document.body.style.overflow="auto";
}