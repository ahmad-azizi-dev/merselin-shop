
    //  Dropdown Menu
    function dropdownMenu() {
        $(".sidenav-nav").find("li.suha-dropdown-menu").append("<div class='dropdown-trigger-btn'><i class='lni lni-chevron-down'></i></div>");
        $(".dropdown-trigger-btn").on('click', function () {
            $(this).siblings('ul').stop(true, true).slideToggle(700);
            $(this).toggleClass('active');
        });
    }

    dropdownMenu();
