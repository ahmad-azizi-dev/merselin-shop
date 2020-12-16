<script>

    @includeWhen(Auth::check(),'frontend.partials.DropdownMenu')

    //  Add to cart notify.
    Livewire.on('productAdded', totalCart => {
        $("#Cart").text('(' + totalCart + ')');
        $("#lniCart").removeClass("lni-cart").addClass("lni-cart-full lni-tada-effect");
        $("body").append("<div class='add2cart-notification animated fadeIn'> @lang('mainFrontend.AddToCartNotify') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })
    //  Remove from cart notify.
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
    })

    //  Add to wishlist notify.
    Livewire.on('addedWishlist', function () {
        $("body").append("<div class='add2cart-notification animated fadeIn'> @lang('product.addedWishlist') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })

    //  Remove from wishlist notify.
    Livewire.on('removedWishlist', function () {
        $("body").append("<div class='add2cart-notification animated fadeIn bg-danger'> @lang('product.removedWishlist') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })
	
	@auth()
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (message, component) => {
            dropdownMenu();
            cartModal();
        })
    });
	@endauth
</script>
