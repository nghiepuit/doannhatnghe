$(document).ready(function() {

    $(".input-validate").blur(function () {
        var index = $(".input-validate").index(this);
        if($(".input-validate").eq(index).val() == ""){
            $(".require").eq(index).css("opacity","1");
            $(".input-validate").eq(index).focus();
        }else{
            $(".require").eq(index).css("opacity","0");
        }
    });

    $("#input-repassword").blur(function () {
        if($("#input-repassword").val() != $("#password").val()){
            $("#required-repassword").css("opacity","1");
        }else{
            $(".required-repassword").css("opacity","0");
        }
    });

    $("#owl-slider").owlCarousel({
        autoPlay : 8000,
        navigation:true,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        transitionStyle:"fade"
    });

    $("#owl-slider").trigger('owl.play',8000);

    $(".owl-next").text("");
    $(".owl-prev").text("");

    $("#owl-spcl").owlCarousel({
        items : 4,
        lazyLoad : true,
        navigation : true,
        slideSpeed: 1000,
        navigationText : false
    });

    $("#owl-sale").owlCarousel({
        items : 1,
        lazyLoad : true,
        navigation : true,
        slideSpeed: 1000,
        navigationText : false
    });

    $(".logo-fixtop").css("display","none");
    $(window).scroll(function(){

        if($(this).scrollTop() > 200){
            $(".wrapper-nav").addClass("wrapper-fixtop");
            $(".nav").addClass("nav-fixtop");
            $(".logo-fixtop").css("display","block");
        }else{
            $(".wrapper-nav").removeClass("wrapper-fixtop");
            $(".nav").removeClass("nav-fixtop");
            $(".logo-fixtop").css("display","none");
        }



    });

    $(window).scroll(function () {
        if ($(this).scrollTop() === 0) {
            $(".backtotop").addClass("hidden-top")
        } else {
            $(".backtotop").removeClass("hidden-top")
        }
    });

    $('.backtotop').click(function () {
        $('body,html').animate({
            scrollTop:0
        }, 1200);
        return false;
    });

});