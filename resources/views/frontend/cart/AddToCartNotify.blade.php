<script>
    //  Add To Cart Notify
    Livewire.on('productAdded', totalCart => {
        @include('frontend.partials.counterUp')

        $("#Cart").text('(' + totalCart + ')');
        $("body").append("<div class='add2cart-notification animated fadeIn'> @lang('mainFrontend.AddToCartNotify') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })
    //  Remove From Cart Notify
    Livewire.on('productRemoved', totalCart => {
        @include('frontend.partials.counterUp')

        if (totalCart) {
            $("#Cart").text('(' + totalCart + ')');
        } else {
            $("#Cart").text('');
            $("#lniCart").removeClass("lni-cart-full lni-tada-effect").addClass("lni-cart");
        }
        $("body").append("<div class='add2cart-notification animated fadeIn bg-danger'> @lang('mainFrontend.RemoveFromCart') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })
</script>
