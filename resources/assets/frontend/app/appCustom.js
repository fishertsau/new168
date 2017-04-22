//Back to top code
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        screen_to_top();
    });

    $('#back-to-top').tooltip('show');
});


/*** Navbar dropdown menu control*/
$(document).ready(function () {
    $(".dropdown").hover(
        function () {
            $('.dropdown-menu', this)
                .not('.in .dropdown-menu')
                .stop(true, true)
                .slideDown("fast");
            $(this).toggleClass('open');
        },
        function () {
            $('.dropdown-menu', this)
                .not('.in .dropdown-menu')
                .stop(true, true)
                .slideUp("fast");
            $(this).toggleClass('open');
        }
    );
});


/*** fixedBottom-Navbar control*/
$(document).ready(function () {
    $(".fixedBottom-navbar__item").click(function () {
        var title = this.getAttribute('title');
        var activeNavbar = ".slideNavbar[title='" + title + "']";

        $(".slideNavbar").removeClass('slideNavbar--active');
        $(activeNavbar).addClass('slideNavbar--active');
        screen_to_top();
    });

    $(".main-content-block").click(function () {
        $(".slideNavbar").removeClass('slideNavbar--active');
    });
});

function screen_to_top() {
    $('body,html').animate({
        scrollTop: 0
    }, 1000);
    return false;
}

function closeMobileNavbar() {
    $(".slideNavbar").removeClass('slideNavbar--active');
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {
});