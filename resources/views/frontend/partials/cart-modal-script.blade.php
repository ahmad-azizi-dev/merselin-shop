<script>
    <!-- The Cart Modal -->
    $(".modal-content").prepend(
        "<div class='modal-header'>" +
	        "<h5 class='modal-title text-danger'>" +
	            "<i class='fa fa-window-close'></i>" +
                "<span style='font-size: 13.5pt'> @lang('mainFrontend.FooterNav-cart') </span>" +
            "</h5>" +
	        "<button type='button' class='close' data-dismiss='modal'>" +
                 "&times;" +
            "</button>" +
        "</div>" +
        "<div class='modal-body'>" +
            "@lang('product.areYouSureDelete')" +
        "</div>");
    
    $(".modal-footer button").addClass("btn btn-danger w-25 mx-2 pr-4 pl-4").append("@lang('product.yes')");
    $(".modal-footer").prepend(
        "<button type='button' class='btn btn-secondary w-50 mr-5' data-dismiss='modal'>" +
            "@lang('product.no')" +
        "</button>");
</script>