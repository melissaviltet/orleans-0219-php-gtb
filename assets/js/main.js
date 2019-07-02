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

    let currentUrl = window.location.href;
    console.log(currentUrl);
    let aTags = document.getElementsByTagName('a');
    console.log(aTags);

    for (let i = 0; i < aTags.length; i++) {
        if (aTags[i].href === currentUrl && aTags[i].parentElement.className === 'nav-item nav-home flex-fill') {
            aTags[i].parentElement.className = 'active nav-item nav-home flex-fill';
        } else if (aTags[i].href === currentUrl) {
            aTags[i].className = 'active';
        }
    }
});


$('.custom-file-input').on('change', function (event) {
    let inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
});