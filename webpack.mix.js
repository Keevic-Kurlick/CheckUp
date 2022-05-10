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
    .js('resources/js/elements/input_masks.js', 'public/js/elements/input_masks.js')
    .js('resources/js/admin/services/destroy.js', 'public/js/admin/services/destroy.js')
    .js('resources/js/admin/medical_certificates/destroy.js', 'public/js/admin/medical_certificates/destroy.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/layouts/profile/documents.scss', 'public/css/layouts/profile/documents.css')
    .sass('resources/sass/layouts/menu/services.scss', 'public/css/layouts/menu/services.css')
    .sass('resources/sass/elements.scss', 'public/css/elements.css')
    .sass('resources/sass/layouts/admin/services/index.scss', 'public/css/layouts/admin/services/index.css')
    .sass('resources/sass/layouts/admin/medical_certificates/index.scss', 'public/css/layouts/admin/medical_certificates/index.css')
    .sass('resources/sass/layouts/menu/about.scss', 'public/css/layouts/menu/about.css');
