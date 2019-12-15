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
    .sass('resources/sass/admin-v2/app.scss', 'public/css/admin')
    .copyDirectory('resources/img', 'public/img')
    .copyDirectory('resources/fonts', 'public/fonts')

    .js('resources/js/admin/app.js', 'public/js/admin')
