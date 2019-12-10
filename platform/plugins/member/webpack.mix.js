let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/member';
const resourcePath = './platform/plugins/member';

mix
    .js(resourcePath + '/resources/assets/js/member-admin.js', publicPath + '/js')
    .copy(publicPath + '/js/member-admin.js', resourcePath + '/public/js')

    .sass(resourcePath + '/resources/assets/sass/member.scss', publicPath + '/css')
    .copy(publicPath + '/css/member.css', resourcePath + '/public/css');

mix
    .js(resourcePath + '/resources/assets/js/app.js', publicPath + '/js')
    .copy(publicPath + '/js/app.js', resourcePath + '/public/js')
    .sass(resourcePath + '/resources/assets/sass/app.scss', publicPath + '/css')
    .copy(publicPath + '/css/app.css', resourcePath + '/public/css');