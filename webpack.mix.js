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

mix.js('resources/js/app.js', 'public/js')
		.js('resources/js/toggle.js', 'public/js')
		.js('resources/js/layout.js', 'public/js')
		.scripts([
			'public/js/app.js',
			'public/js/toggle.js',
			'public/js/layout.js'
		], 'public/js/all.js')
		.sass('resources/css/sass/app.scss', 'public/css')
    /*.postCss('resources/css/app.css', 'public/css', [
        //
    ])*/
    .version();
