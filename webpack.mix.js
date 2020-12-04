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

mix.sass('resources/sass/admin/app.scss', 'public/assets/admin/css')
    .js('resources/js/admin/app.js', 'public/assets/admin/js')
    .copyDirectory('resources/img/admin', 'public/assets/admin/img');
    //.browserSync('laurel.cms.loc');
