import $ from 'jquery';

/***Sponsors Carousel Human Settings***/

let screenWidth = $(window).width();
let slidesToShow;

if (screenWidth < 576) {
    slidesToShow = 1;
} else if (screenWidth > 576 && screenWidth < 720) {
    slidesToShow = 2;
} else if (screenWidth > 720 && screenWidth < 960) {
    slidesToShow = 4;
} else {
    slidesToShow = 5;
}

window.jQuery('#eclipse5').eclipse({
    margin: 20,
    slidesToShow: slidesToShow,
    countIndex: 1,
    autoplay: true,
    interval: 2000,
    autoControl: true
});