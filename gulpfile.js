const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('laravel-elixir-webpack');

//Override default settings and makes command "gulp watch" works
/*
elixir.config.js.webpack.watchify = {
	enabled: true,
	options: {
		poll: true
	}
}
*/

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

elixir(function (mix) {
	mix.sass('app.scss')
			.webpack('main.js');
});

/* Combine and minify styles for GitHub User Dashboard */
elixir(function (mix) {
	mix.styles([
		'/github-web/bootstrap.min.css',
		'/github-web/github-dash.css',
		'/github-web/font-awesome.min.css',
	], 'public/css/github-dash.css');
	mix.copy('resources/assets/css/fonts', 'public/build/fonts');
	mix.scripts([
		'/github-web/jquery.js',
		'/github-web/bootstrap.js',
		'/github-web/github-dash.js'
	], 'public/js/github-dash.js');
	mix.version(['css/github-dash.css','js/github-dash.js']);
});

