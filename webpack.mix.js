let mix = require('laravel-mix');

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
	.styles([
		'resources/assets/css/font-awesome.min.css',
		'resources/assets/css/coreui-icons.min.css',
		'resources/assets/css/flag-icon.min.css',
		'resources/assets/css/flag-icon.min.css',
		'resources/assets/css/simple-line-icons.css',
		'resources/assets/css/style.css',
		'resources/assets/css/pace.min.css',
		'resources/assets/css/custom.css',
	], 'public/css/style-main.css')
	.scripts([
		'resources/assets/js/jquery.min.js',
		'resources/assets/js/popper.min.js',
		'resources/assets/js/bootstrap_.min.js',
		'resources/assets/js/pace.min.js',
		'resources/assets/js/perfect-scrollbar.min.js',
		'resources/assets/js/coreui.min.js',
		'resources/assets/js/custom.js',
	], 'public/js/script-main.js')
   	.copy('resources/assets/css/dataTables.bootstrap4.min.css', 'public/css/dataTables.bootstrap4.min.css')
	.copy('resources/assets/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js')
	.copy('resources/assets/js/dataTables.bootstrap4.min.js', 'public/js/dataTables.bootstrap4.min.js')
	.copy('resources/assets/css/vex.css', 'public/css/vex.css')
	.copy('resources/assets/css/vex-theme-os.css', 'public/css/vex-theme-os.css')
	.copy('resources/assets/css/select2.css', 'public/css/select2.css')
	.copy('resources/assets/js/select2.js', 'public/js/select2.js')
	.copy('resources/assets/css/bootstrap-datepicker.css', 'public/css/bootstrap-datepicker.css')
	.copy('resources/assets/js/bootstrap-datepicker.js', 'public/js/bootstrap-datepicker.js')
	.copy('resources/assets/js/Chart.min.js', 'public/js/Chart.min.js')
	.copy('resources/assets/js/custom-tooltips.min.js', 'public/js/custom-tooltips.min.js')
    .copy('node_modules/simplemde/dist/simplemde.min.css', 'public/css/simplemde.min.css')
    .copy('node_modules/simplemde/dist/simplemde.min.js', 'public/js/simplemde.min.js')
	.copyDirectory('resources/assets/img', 'public/img')
	.copyDirectory('resources/assets/flags', 'public/flags')
	.copyDirectory('resources/assets/fonts', 'public/fonts');
