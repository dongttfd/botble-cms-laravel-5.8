let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/language';
const resourcePath = './platform/plugins/language';

mix
    .js(resourcePath + '/resources/assets/js/language.js', publicPath + '/js/language.js')
    .copy(publicPath + '/js/language.js', resourcePath + '/public/js')

    .js(resourcePath + '/resources/assets/js/language-global.js', publicPath + '/js/language-global.js')
    .copy(publicPath + '/js/language-global.js', resourcePath + '/public/js')

    .js(resourcePath + '/resources/assets/js/language-public.js', publicPath + '/js')
    .copy(publicPath + '/js/language-public.js', resourcePath + '/public/js')

    .sass(resourcePath + '/resources/assets/sass/language.scss', publicPath + '/css')
    .copy(publicPath + '/css/language.css', resourcePath + '/public/css')

    .sass(resourcePath + '/resources/assets/sass/language-public.scss', publicPath + '/css')
    .copy(publicPath + '/css/language-public.css', resourcePath + '/public/css');