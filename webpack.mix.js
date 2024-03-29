const mix = require('laravel-mix');

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

mix
.webpackConfig({
    node: {
      fs: "empty"
    },
    resolve: {
        extensions: ['.js', '.jsx'],
        modules: ['node_modules', path.resolve(__dirname, 'core')]
  },
})
//.copy('node_modules/font-awesome/fonts', 'public/fonts')
.react('resources/js/app.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.extract([
        'axios',
        'bootstrap',
        'jquery',
        'lodash',
        'popper.js',
        'react',
        'react-dom'
        ]);

