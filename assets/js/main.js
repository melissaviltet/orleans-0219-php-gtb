/***NAVBAR***/

require('jquery');

$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('nav.navbar').css({
                backgroundColor  : "rgba(97, 97, 97, .9)",
                transition       : 'all .5s ease-in-out'
            });
            $('.navbar-nav .nav-link').css({
                color            : 'rgb(230, 231, 233)',
            });
        } else {
            $('nav.navbar').css({
                backgroundColor  : "rgba(97, 97, 97, .3)",
                transition       : 'all .5s ease-in-out'
            });
            $('.navbar-nav .nav-link').css({
                color            : "white",
            });
        }
    });

    $('.custom-file-input').on('change', function (event) {
        let inputFile = event.currentTarget;
        $(inputFile).parent()
            .find('.custom-file-label')
            .html(inputFile.files[0].name);
    });
});


