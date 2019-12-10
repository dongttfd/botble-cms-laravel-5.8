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

const resourcePath = 'platform/packages/menu';
const publicPath = 'public/vendor/core/packages/menu';

mix
    .js(resourcePath + '/resources/assets/js/menu.js', publicPath + '/js')
    .copy(publicPath + '/js/menu.js', resourcePath + '/public/js');
