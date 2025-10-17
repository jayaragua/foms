const mix = require('laravel-mix');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');
		var webpackConfig = {
    			plugins: [
        			new VuetifyLoaderPlugin()
        			// other plugins ...
    			]
			// other webpack config ...
		}
		mix.webpackConfig(webpackConfig);
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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');


	// mix.js('resources/js/app.js', 'public/js')
	// .sass('resources/sass/app.scss', 'public/css');   

	mix.js(['resources/js/app.js','public/js/popper.min.js',
			'public/js/bootstrap.min.js',
			'public/js/bs-custom-file-input.min.js',
			'public/js/adminlte.min.js',
			
			'public/js/bootstrap-datetimepicker.min.js',
			'public/js/bootstrap4-toggle.min.js',
			'public/js/select2.min.js',
			'public/js/bootstrap-switch.min.js',
			'public/js/axios.min.js',
			
			], 'public/js');

			mix.styles([
				'public/css/all.min.css',
				'public/css/bootstrap4-toggle.min.css',
				'public/css/adminlte.min.css',
				'public/css/icheck-bootstrap.min.css',
				'public/css/select2.min.css',
				'public/css/bootstrap-datetimepicker.min.css',
				'public/css/materialdesignicons.min.css',
				'public/css/css.css',
				'public/css/font-awesome.min.css',
				
				
				], 'public/css/css_all.css');

	// mix.js(['resources/js/app.js','public/js/popper.min.js',
	// 		], 'public/js')


	// <script src="{{ asset('js/popper.min.js') }}"></script>
    // <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    // <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>
    // <script src="{{ asset('js/adminlte.min.js') }}"></script>
    // <script src="{{ asset('js/moment.min.js') }}"></script>
    // <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    // <script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>
    // <script src="{{ asset('js/select2.min.js') }}"></script>
    // <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    // <script src="{{ asset('js/axios.min.js') }}"></script>

	// <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
	// <link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
	// <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
	// <link href="{{ asset('css/icheck-bootstrap.min.css') }}" rel="stylesheet">
	
	// <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
	// <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	// <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
   
	// <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	// <link href="{{ asset('css/css.css') }}" rel="stylesheet">
	

	// <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> -->

	
