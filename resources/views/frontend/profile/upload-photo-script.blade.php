<script>
    @include('frontend.partials.DropdownMenu')

    //  Update Photo Notify
    Livewire.on('photoAdded', totalCart => {
        $("#sidebar-img").attr("src", $("#profile-img").attr("src"));
        $("body").append("<div class='add2cart-notification animated fadeIn bg-warning'> @lang('mainFrontend.UploadedPhotoSuccessful') </div>");
        $(".add2cart-notification").delay(3500).fadeOut();
    })
</script>
