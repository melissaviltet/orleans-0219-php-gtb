$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('nav.navbar').css({
                "background-color": "rgba(97, 97, 97, .9)",
                WebkitTransition : 'all .5s ease-in-out',
                MozTransition    : 'all .5s ease-in-out',
                MsTransition     : 'all .5s ease-in-out',
                OTransition      : 'all .5s ease-in-out',
                transition       : 'all .5s ease-in-out'
            });
            $('.navbar-nav .nav-link').css({
                color            : 'rgb(230, 231, 233)',
            });
        } else {
            $('nav.navbar').css({
                "background-color": "rgba(97, 97, 97, .3)",
                WebkitTransition : 'all .5s ease-in-out',
                MozTransition    : 'all .5s ease-in-out',
                MsTransition     : 'all .5s ease-in-out',
                OTransition      : 'all .5s ease-in-out',
                transition       : 'all .5s ease-in-out'
            });
            $('.navbar-nav .nav-link').css({
                color            : "white",
            });
        }
    });
});
