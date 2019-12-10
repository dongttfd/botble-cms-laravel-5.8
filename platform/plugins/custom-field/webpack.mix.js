let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/custom-field';
const resourcePath = './platform/plugins/custom-field';

mix
    .sass(resourcePath + '/resources/assets/sass/edit-field-group.scss', publicPath + '/css')
    .copy(publicPath + '/css/edit-field-group.css', resourcePath + '/public/css')

    .sass(resourcePath + '/resources/assets/sass/custom-field.scss', publicPath + '/css')
    .copy(publicPath + '/css/custom-field.css', resourcePath + '/public/css')

    .js(resourcePath + '/resources/assets/js/edit-field-group.js', publicPath + '/js')
    .copy(publicPath + '/js/edit-field-group.js', resourcePath + '/public/js')

    .js(resourcePath + '/resources/assets/js/use-custom-fields.js', publicPath + '/js')
    .copy(publicPath + '/js/use-custom-fields.js', resourcePath + '/public/js')

    .js(resourcePath + '/resources/assets/js/import-field-group.js', publicPath + '/js')
    .copy(publicPath + '/js/import-field-group.js', resourcePath + '/public/js');