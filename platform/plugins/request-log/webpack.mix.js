let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/request-log';
const resourcePath = './platform/plugins/request-log';

mix
    .js(resourcePath + '/resources/assets/js/request-log.js', publicPath + '/js')
    .copy(publicPath + '/js/request-log.js', resourcePath + '/public/js');