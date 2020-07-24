let mix = require("laravel-mix");
mix.setPublicPath("public/modules/");

mix.setResourceRoot("../../");

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
mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: "jquery",
                jQuery: "jquery",
                jquery: "jquery",
                "window.jQuery": "jquery"
            })
        ]
    };
});

mix.js("resources/painel/js/app.js", "public/modules/painel/js")
    .scripts(
        [
            "node_modules/datatables.net/js/jquery.dataTables.js",
            "node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"
        ],
        "public/modules/painel/js/datatable.js"
    )
    .styles(
        ["node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css"],
        "public/modules/painel/css/datatable.css"
    )
    .sass("resources/painel/sass/app.scss", "public/modules/painel/css")
    .minify("public/modules/painel/css/app.css");
mix.copy("node_modules/tinymce/skins", "public/modules/painel/js/skins");
