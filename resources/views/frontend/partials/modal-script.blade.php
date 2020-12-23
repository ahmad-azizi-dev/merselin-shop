<script>
    <!-- The Cart Modal -->
  function cartModal() {
    $(".modal-content.cart").removeClass('cart').prepend(
        "<div class='modal-header'>" +
	        "<h5 class='modal-title text-danger d-flex align-items-center'>" +
	            "<i class='lni lni-cross-circle mr-2'></i>" +
                "<span style='font-size: 13.5pt'> @lang('mainFrontend.FooterNav-cart') </span>" +
            "</h5>" +
	        "<button type='button' class='close' data-dismiss='modal'>" +
                 "&times;" +
            "</button>" +
        "</div>" +
        "<div class='modal-body'>" +
            "@lang('product.areYouSureDelete')" +
        "</div>");

    $(".modal-content.wishlist").removeClass('wishlist').prepend(
        "<div class='modal-header'>" +
            "<h5 class='modal-title text-danger d-flex align-items-center'>" +
                "<i class='lni lni-heart-filled mr-2'></i>" +
	            "<span style='font-size: 13.5pt'> @lang('mainFrontend.FooterNav-heart') </span>" +
             "</h5>" +
             "<button type='button' class='close' data-dismiss='modal'>" +
                 "&times;" +
             "</button>" +
	    "</div>" +
        "<div class='modal-body'>" +
             "@lang('product.areYouSureDeleteWishlist')" +
        "</div>");

    $(".modal-footer.flag button").addClass("btn btn-danger w-25 mx-2 pr-4 pl-4").append("@lang('product.yes')");
    $(".modal-footer.flag").removeClass('flag').prepend(
        "<button type='button' class='btn btn-secondary w-50 mr-5' data-dismiss='modal'>" +
            "@lang('product.no')" +
        "</button>");
  }
  cartModal();

</script>
