const mix = require( 'laravel-mix' );


/**
 * Compile JavaScript
 */
mix.js('src/main.js', 'assets/js/index.js').vue({ version: 2 });