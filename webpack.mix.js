let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

mix
	.js('resources/js/app.js', 'public/js')
	// .sass('resources/sass/app.scss', 'public/css')
	// .postCss('resources/css/main.css', 'public/css', [
	.postCss('resources/css/style.css', 'public/css', [
		tailwindcss('./tailwind.js'),
	])
	.version()
