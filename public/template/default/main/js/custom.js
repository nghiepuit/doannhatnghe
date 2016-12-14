$(document).ready(function () {

    $("select[name=sort]").change(function () {
        $("#frmFilter").submit();
    });

    $("select[name=limit]").change(function () {
        $("#frmFilter").submit();
    });

    $("#owl-product-spcl").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items : 5,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]

    });

    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })

    var quantity = parseInt(document.getElementById("quantity").value);
    $("#plus").click(function () {
        quantity++;
        document.getElementById("quantity").value = quantity;
    });
    $("#sub").click(function () {
        if(quantity > 1){
            quantity--;
            document.getElementById("quantity").value = quantity;
        }
    });

    var img = $('#img-detail');
    img.click(function () {
        $('#myModal').css("display","block");
        $("#img01").attr("src",$(this).attr("src"));
    });
    var span = $(".close").eq(0);
    span.click(function () {
        $('#myModal').css("display","none");
    });



});

function ajaxCart(url){
    $.ajax({
        type: "POST",
        url: url,
        success: function(data){
            var data = $.parseJSON(data);
            var pos = parseInt(data[0]);
            var quantity = data[1];
            var totalPrice = data[2];
            var total = data[3];
            $(".input_num_product").eq(pos).attr("value",quantity);
            $(".cart_total").eq(pos).text(totalPrice + " VNĐ");
            $(".tongtien").text(total + " VNĐ");
        }
    });
}