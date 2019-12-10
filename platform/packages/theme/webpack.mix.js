let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const resourcePath = 'platform/packages/theme';
const publicPath = 'public/vendor/core/packages/theme';

mix
    .js(resourcePath + '/resources/assets/js/custom-css.js', publicPath + '/js')
    .copy(publicPath + '/js/custom-css.js', resourcePath + '/public/js')

    .js(resourcePath + '/resources/assets/js/theme-options.js', publicPath + '/js')
    .copy(publicPath + '/js/theme-options.js', resourcePath + '/public/js')

    .js(resourcePath + '/resources/assets/js/theme.js', publicPath + '/js')
    .copy(publicPath + '/js/theme.js', resourcePath + '/public/js')

    .sass(resourcePath + '/resources/assets/sass/custom-css.scss', publicPath + '/css')
    .copy(publicPath + '/css/custom-css.css', resourcePath + '/public/css');
