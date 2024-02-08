const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js','public/select/js' , 'public/ckeditor/ckeditor.js' ).postCss('resources/css/app.css', 'public/css', 'public/select/css' ,'public/css/animate.css' ,'public/css/style.css' , [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
