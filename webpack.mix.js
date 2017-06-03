const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/bootstrap-sass/assets/fonts', 'public/fonts')
    .copy('resources/assets/css/my-style.css', 'public/css')
    .copy('resources/assets/css/fake-loader.css', 'public/css')
    .copy('resources/assets/js/my-AJAX.js', 'public/js')
    .copy('resources/assets/js/fake-loader.min.js', 'public/js')
    .copyDirectory('resources/assets/images', 'public/images');
