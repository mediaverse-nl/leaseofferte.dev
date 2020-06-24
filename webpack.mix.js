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
// mix.setPublicPath('../public');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/solutions.js', 'public/js')
    .js('resources/js/collapse-text.js', 'public/js')
    .js('resources/js/calculator.js', 'public/js')
    .js('resources/js/lease-offers.js', 'public/js')
    .js('resources/js/info-checker.js', 'public/js')
    .js('resources/js/portfolio-banner.js', 'public/js')

    .sass('resources/sass/lease-offers.scss', 'public/css')
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/contact.scss', 'public/css')
    .sass('resources/sass/solutions.scss', 'public/css')
    .sass('resources/sass/solution.scss', 'public/css')
    .sass('resources/sass/calculator.scss', 'public/css')
    .sass('resources/sass/collapse-text.scss', 'public/css')
    .sass('resources/sass/portfolio-banner.scss', 'public/css')
    // .sass('resources/sass/info.scss', 'public/css')
    // .sass('resources/sass/operational.scss', 'public/css')
    .sass('resources/sass/autolease.scss', 'public/css')
    // .sass('resources/sass/solution.scss', 'public/css')
    .sass('resources/sass/faq.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
    // .sass('resources/sass/home.scss', 'public/css/home');
