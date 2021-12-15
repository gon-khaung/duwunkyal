const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/build/js")
    .vue()
    .sass("resources/sass/app.scss", "public/build/css");

mix.webpackConfig({
    resolve: {
        extensions: [".js", ".vue"],
        alias: {
            "@": __dirname + "/resources/js"
        }
    },
    module: {
        rules: [
            {
                enforce: "pre",
                exclude: /node_modules/,
                loader: "eslint-loader",
                test: /\.(js|vue)?$/,
                options: {
                    fix: true
                }
            }
        ]
    }
});
