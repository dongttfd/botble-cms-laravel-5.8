let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/contact';
const resourcePath = './platform/plugins/contact';

mix
    .sass(resourcePath + '/resources/assets/sass/contact.scss', publicPath + '/css')
    .copy(publicPath + '/css/contact.css', resourcePath + '/public/css')

    .js(resourcePath + '/resources/assets/js/contact.js', publicPath + '/js')
    .copy(publicPath + '/js/contact.js', resourcePath + '/public/js');