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

mix
    .sass('resources/sass/admin/app.scss', 'public/css/admin')
    .sass('resources/sass/admin/login.scss', 'public/css/admin')
    .sass('resources/sass/admin/header.scss', 'public/css/admin')
    .sass('resources/sass/admin/sidebar.scss', 'public/css/admin')
    .sass('resources/sass/admin/settings.scss', 'public/css/admin')
    .sass('resources/sass/admin/main.scss', 'public/css/admin')

    .js('resources/js/admin/app.js', 'public/js/admin')
