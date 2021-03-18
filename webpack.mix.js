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

mix.styles([
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
    'resources/assets/admin/plugins/select2/select2-bootstrap4-theme/select2-bootstrap4.min.css',
    'resources/assets/admin/css/main.css',
    ],
    'public/assets/admin/css/admin.css');
mix.copy('resources/assets/admin/plugins/fontawesome-free/css/all.min.css', 'public/assets/css/fontawesome.css');
mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');
mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/plugins/select2/js/select2.min.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js'
],'public/assets/admin/js/admin.js');

mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/webfonts');

mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');

mix.copy('resources/assets/admin/js/adminlte.min.js.map', 'public/assets/admin/js/adminlte.min.js.map');
mix.copy('resources/assets/admin/js/jquery.session.js','public/assets/admin/js/jquery.session.js');
mix.copy('resources/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js', 'public/assets/admin/js/bs-custom-file-input.min.js');

mix.styles([
    'resources/assets/front/css/main.css',
    'resources/assets/front/css/menu.css',
    'resources/assets/front/css/search.css',
    'resources/assets/front/css/responsive.css',
], 'public/assets/front/css/front.css');
mix.copy('resources/assets/front/css/uikit.min.css', 'public/assets/front/css/uikit.min.css');
mix.copy('resources/assets/front/css/uikit-rtl.min.css', 'public/assets/front/css/uikit-rtl.min.css');

mix.scripts([
    'resources/assets/front/js/main.js',
], 'public/assets/front/js/front.js');
mix.copy('resources/assets/front/js/uikit.min.js', 'public/assets/front/js/uikit.min.js');
mix.copy('resources/assets/front/js/uikit-icons.min.js', 'public/assets/front/js/uikit-icons.min.js');
mix.copy('resources/assets/front/js/fontawesome.min.js', 'public/assets/front/js/fontawesome.min.js');

mix.copyDirectory('resources/assets/front/fonts', 'public/assets/front/fonts');
mix.copyDirectory('resources/assets/front/img', 'public/assets/front/img');
mix.browserSync('laravel.blog');
