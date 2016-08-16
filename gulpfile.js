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
    mix.styles(['bootstrap.css', 'bootstrap-toggle.css', 'frontEnd.css'], 'public/css/frontend.css');
    mix.styles(['bootstrap.css', 'bootstrap-toggle.css', 'backend.css'], 'public/css/backend.css');
    mix.styles(['bootstrap.css', 'bootstrap-toggle.css', 'backend.css', 'frontEndUser.css' ], 'public/css/quizzes.css');
    mix.scripts(['jquery-2.2.2.js', 'bootstrap.js', 'bootstrap-toggle.js'], 'public/js/frameworks.js');
    mix.scripts(['jquery-2.2.2.js', 'bootstrap.js', 'bootstrap-toggle.js', 'frontEnd.js'], 'public/js/frontEnd.js');
});
