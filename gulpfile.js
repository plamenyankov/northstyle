var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.assetsPath = 'resources/themes/default/assets';
elixir.config.publicPath = 'public/themes/default/assets';
elixir.config.publicFontsPath = elixir.config.publicPath + '/fonts';

elixir.config.css.sass.pluginOptions.includePaths = [
	'node_modules/bootstrap-sass/assets/stylesheets',
	'node_modules/font-awesome/scss',
	'node_modules/eonasdan-bootstrap-datetimepicker/src/sass',
	'node_modules/jquery-ui/themes/base',
	'node_modules/simplemde/src/css'
];

elixir(function(mix) {
	mix.copy('node_modules/bootstrap-sass/assets/fonts', elixir.config.publicFontsPath);
	mix.copy('node_modules/font-awesome/fonts', elixir.config.publicFontsPath);

	mix.sass('backend.scss');
	mix.sass('frontend.scss');

	mix.browserify('app.js');
});
