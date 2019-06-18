$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('nav.navbar').css({
                "background-color": "rgba(97, 97, 97, .9)"
            });
            $('.navbar-nav .nav-link').css({
                "color": "rgb(230, 231, 233)"
            });
        } else {
            $('nav.navbar').css({
                "background-color": "rgba(97, 97, 97, .3)"
            });
            $('.navbar-nav .nav-link').css({
                "color": "white"});
        }
    });
});
