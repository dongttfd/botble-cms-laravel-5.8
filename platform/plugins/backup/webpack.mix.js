let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/backup';
const resourcePath = './platform/plugins/backup';

mix
    .js(resourcePath + '/resources/assets/js/backup.js', publicPath + '/js')
    .copy(publicPath + '/js/backup.js', resourcePath + '/public/js')

    .sass(resourcePath + '/resources/assets/sass/backup.scss', publicPath + '/css')
    .copy(publicPath + '/css/backup.css', resourcePath + '/public/css');