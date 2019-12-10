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

const resourcePath = 'platform/packages/widget';
const publicPath = 'public/vendor/core/packages/widget';

mix
    .js(resourcePath + '/resources/assets/js/widget.js', publicPath + '/js')
    .copy(publicPath + '/js/widget.js', resourcePath + '/public/js');
