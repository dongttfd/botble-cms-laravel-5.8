let mix = require('laravel-mix');

const resourcePath = 'platform/themes/ripple';
const publicPath = 'public/themes/ripple';

mix
    .sass(resourcePath + '/assets/sass/style.scss', publicPath + '/css')
    .copy(publicPath + '/css/style.css', resourcePath + '/public/css')
    .js(resourcePath + '/assets/js/ripple.js', publicPath + '/js')
    .copy(publicPath + '/js/ripple.js', resourcePath + '/public/js');
