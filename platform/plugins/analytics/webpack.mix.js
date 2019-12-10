let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/analytics';
const resourcePath = './platform/plugins/analytics';

mix
    .js(resourcePath + '/resources/assets/js/analytics.js', publicPath + '/js')
    .copy(publicPath + '/js/analytics.js', resourcePath + '/public/js');