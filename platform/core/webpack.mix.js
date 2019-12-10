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

const resourcePath = 'platform/core';
const publicPath = 'public/vendor/core';

let fs = require('fs');

let themePath = resourcePath + '/base/resources/assets/sass/base/themes';
let paths = fs.readdirSync(themePath);
for (let i = 0; i < paths.length; i++) {
    if (paths[i].indexOf('.scss') > 0 && paths[i].charAt(0) !== '_') {
        let file = themePath + '/' + paths[i];
        mix.sass(file, publicPath + '/css/themes')
            .copy(publicPath + '/css/themes/' + paths[i].replace('.scss', '.css'), resourcePath + '/base/public/css/themes');
    }
}

mix
    .sass(resourcePath + '/base/resources/assets/sass/core.scss', publicPath + '/css')
    .copy(publicPath + '/css/core.css', resourcePath + '/base/public/css')
    .sass(resourcePath + '/base/resources/assets/sass/custom/admin-bar.scss', publicPath + '/css')
    .copy(publicPath + '/css/admin-bar.css', resourcePath + '/base/public/css')
    .sass(resourcePath + '/base/resources/assets/sass/custom/system-info.scss', publicPath + '/css')
    .copy(publicPath + '/css/system-info.css', resourcePath + '/base/public/css')
    .sass(resourcePath + '/base/resources/assets/sass/custom/email.scss', publicPath + '/css')
    .copy(publicPath + '/css/email.css', resourcePath + '/base/public/css')

    .js(resourcePath + '/base/resources/assets/js/app.js', publicPath + '/js')
    .copy(publicPath + '/js/app.js', resourcePath + '/base/public/js')
    .js(resourcePath + '/base/resources/assets/js/core.js', publicPath + '/js')
    .copy(publicPath + '/js/core.js', resourcePath + '/base/public/js');

// Modules Core
mix
    .js(resourcePath + '/base/resources/assets/js/editor.js', publicPath + '/js')
    .copy(publicPath + '/js/editor.js', resourcePath + '/base/public/js')
    .js(resourcePath + '/base/resources/assets/js/plugin.js', publicPath + '/js')
    .copy(publicPath + '/js/plugin.js', resourcePath + '/base/public/js')
    .js(resourcePath + '/base/resources/assets/js/cache.js', publicPath + '/js')
    .copy(publicPath + '/js/cache.js', resourcePath + '/base/public/js')
    .js(resourcePath + '/base/resources/assets/js/tags.js', publicPath + '/js')
    .copy(publicPath + '/js/tags.js', resourcePath + '/base/public/js')
    .js(resourcePath + '/base/resources/assets/js/system-info.js', publicPath + '/js')
    .copy(publicPath + '/js/system-info.js', resourcePath + '/base/public/js')

    .js(resourcePath + '/setting/resources/assets/js/setting.js', publicPath + '/js')
    .copy(publicPath + '/js/setting.js', resourcePath + '/setting/public/js')
    .sass(resourcePath + '/setting/resources/assets/sass/setting.scss', publicPath + '/css')
    .copy(publicPath + '/css/setting.css', resourcePath + '/setting/public/css')

    .js(resourcePath + '/table/resources/assets/js/table.js', publicPath + '/js')
    .copy(publicPath + '/js/table.js', resourcePath + '/table/public/js')
    .js(resourcePath + '/table/resources/assets/js/filter.js', publicPath + '/js')
    .copy(publicPath + '/js/filter.js', resourcePath + '/table/public/js')
    .sass(resourcePath + '/table/resources/assets/sass/table.scss', publicPath + '/css/components')
    .copy(publicPath + '/css/components/table.css', resourcePath + '/table/public/css/components')

    .js(resourcePath + '/dashboard/resources/assets/js/dashboard.js', publicPath + '/js')
    .copy(publicPath + '/js/dashboard.js', resourcePath + '/dashboard/public/js')

    .js(resourcePath + '/acl/resources/assets/js/profile.js', publicPath + '/js')
    .copy(publicPath + '/js/profile.js', resourcePath + '/acl/public/js')
    .js(resourcePath + '/acl/resources/assets/js/login.js', publicPath + '/js')
    .copy(publicPath + '/js/login.js', resourcePath + '/acl/public/js')
    .js(resourcePath + '/acl/resources/assets/js/role.js', publicPath + '/js')
    .copy(publicPath + '/js/role.js', resourcePath + '/acl/public/js');

// Media
mix
    .sass(resourcePath + '/media/resources/assets/sass/media.scss', publicPath + '/media/css')
    .copy(publicPath + '/media/css/media.css', resourcePath + '/media/public/css')
    .js(resourcePath + '/media/resources/assets/js/media.js', publicPath + '/media/js')
    .copy(publicPath + '/media/js/media.js', resourcePath + '/media/public/js')
    .js(resourcePath + '/media/resources/assets/js/jquery.addMedia.js', publicPath + '/media/js')
    .copy(publicPath + '/media/js/jquery.addMedia.js', resourcePath + '/media/public/js')
    .js(resourcePath + '/media/resources/assets/js/integrate.js', publicPath + '/media/js')
    .copy(publicPath + '/media/js/integrate.js', resourcePath + '/media/public/js');

// JS Validation
mix
    .copy('./vendor/proengsoft/laravel-jsvalidation/public/js/jsvalidation.min.js', publicPath + '/js/form-validation.js')
    .copy(publicPath + '/js/form-validation.js', resourcePath + '/base/public/js');

