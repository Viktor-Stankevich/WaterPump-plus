const mix = require('laravel-mix');
require('laravel-mix-eslint');
const ESLintPlugin = require('eslint-webpack-plugin');

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
module.exports = {
  plugins: [new ESLintPlugin()],
};

mix.js('resources/js/app.js', 'public/js')
  .vue()
  .eslint({
    fix: true,
    extensions: ['js', 'vue'],
  })
  .sass('resources/sass/app.scss', 'public/css');
