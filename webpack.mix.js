const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         require('postcss-import'),
//         require('tailwindcss'),
//     ]);

mix.sass('resources/sass/style.scss','public/css/style.css').options({
    processCssUrls: false
});

mix.copyDirectory('resources/LineIcons-Package-2.0/LineIcons-fonts', 'public/fonts/LineIcons-fonts');

mix.sass('resources/sass/custom-simple-lightbox.scss','public/css/simple-lightbox.css');

mix.copy('node_modules/admin-lte/dist/css/adminlte.min.css','public/admin/css');
mix.copy('node_modules/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css','public/admin/css');
mix.sass('resources/sass/fontawesome.scss','public/css/');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts','public/webfonts');
mix.copy('node_modules/admin-lte/plugins/toastr/toastr.css','public/admin/css/');
mix.copy('node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css','public/admin/css/');
mix.copy('node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css','public/admin/css/');
mix.copy('node_modules/admin-lte/plugins/select2/css/select2.min.css','public/admin/css/');
mix.copy('node_modules/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css','public/admin/css/');
