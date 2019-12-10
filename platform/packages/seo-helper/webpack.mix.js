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

const resourcePath = 'platform/packages/seo-helper';
const publicPath = 'public/vendor/core/packages/seo-helper';

mix
    .js(resourcePath + '/resources/assets/js/seo-helper.js', publicPath + '/js')
    .copy(publicPath + '/js/seo-helper.js', resourcePath + '/public/js');
