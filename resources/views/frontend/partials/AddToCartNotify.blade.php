<script>
    //  Add To Cart Notify
    $(".add2cart-notify").on("click", function () {
        $("body").append("<div class='add2cart-notification animated fadeIn'> @lang('mainFrontend.AddToCartNotify') </div>");
        $(".add2cart-notification").delay(2000).fadeOut();
    });
</script>
