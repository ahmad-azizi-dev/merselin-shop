<script>

    @includeWhen(Auth::check(),'frontend.partials.DropdownMenu')

    //  Add To Cart Notify
    Livewire.on('productAdded', totalCart => {
        $("#Cart").text('(' + totalCart + ')');
        $("#lniCart").removeClass("lni-cart").addClass("lni-cart-full lni-tada-effect");
        $("body").append("<div class='add2cart-notification animated fadeIn'> @lang('mainFrontend.AddToCartNotify') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();

        @auth() dropdownMenu(); @endauth
    })
    //  Remove From Cart Notify
    Livewire.on('productRemoved', totalCart => {
        if (totalCart) {
            $("#Cart").text('(' + totalCart + ')');
            $("#lniCart").removeClass("lni-cart").addClass("lni-cart-full lni-tada-effect");
        } else {
            $("#Cart").text('');
            $("#lniCart").removeClass("lni-cart-full lni-tada-effect").addClass("lni-cart");
        }
        $("body").append("<div class='add2cart-notification animated fadeIn bg-danger'> @lang('mainFrontend.RemoveFromCart') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();

        @auth() dropdownMenu(); @endauth
    })
</script>
