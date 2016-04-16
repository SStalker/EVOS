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
/*
 Zum ausschalten der '*.css.map' dateien, den Kommentar der folgenden Zeile entfernen
 */
//elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.styles(['bootstrap.css'], 'public/css/styles.css');
    mix.scripts(['jquery-2.2.2.js', 'bootstrap.js'], 'public/js/all.js');
});
