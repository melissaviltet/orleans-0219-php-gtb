/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
require('../scss/admin.scss');
require('../fonts/Dusha.ttf');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
//const $ = require('jquery');
require('./main.js');
//create global $ and jQuery variables
global.$ = global.jQuery = $;

// require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
require('summernote');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(document).ready(function () {
    $('.summernote').summernote();
});

