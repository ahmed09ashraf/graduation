const mix = require('laravel-mix');
require('events').EventEmitter.defaultMaxListeners = 50;


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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/js')


.postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.copy('resources/css/style.css', 'public/css/style.css')
    .copy('resources/css/admin.css', 'public/css/admin.css');
