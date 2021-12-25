const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .js('resources/js/menu/services.js', 'public/js/menu/services.js')
    .js('resources/js/profile/documents.js', 'public/js/profile/documents.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/layouts/profile/documents.scss', 'public/css/layouts/profile/documents.css')
    .sass('resources/sass/layouts/menu/services.scss', 'public/css/layouts/menu/services.css');
