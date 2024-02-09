const mix = require('laravel-mix');
require("laravel-mix-svg-vue");
require("laravel-mix-bundle-analyzer");
const path = require("path");
const fastGlob = require('fast-glob');

const config = require("./webpack.config"); 
mix.setPublicPath('./');
mix.webpackConfig(config);

// mix.browserSync("site.test");

mix .sass('resources/sass/app.scss', 'dist/css');
const sassFiles = fastGlob.sync(['resources/sass/single/*.scss']);
sassFiles.forEach(file => {
  mix.sass(file, `dist/css`);
});
const sassBlock = fastGlob.sync(['template-parts/blocks/**/*.scss']);
sassBlock.forEach(file => {
  mix.sass(file, `dist/css/blocks`);
});
mix.options({
    processCssUrls: false,
    postCss: [
        require("postcss-import"),
        require("tailwindcss/nesting"),
        require("tailwindcss"),
        require("autoprefixer"),
    ],
  });

const jsFiles = fastGlob.sync(['resources/js/*.js', 'resources/js/paged/*.js']);
jsFiles.forEach(file => {
  mix.js(file, `dist/js`);
});
const jsBlock = fastGlob.sync(['template-parts/blocks/**/*.js']);
jsBlock.forEach(file => {
  mix.js(file, `dist/js/blocks`);
})

mix.version();
mix.sourceMaps().version();
mix.disableSuccessNotifications();

if (!mix.inProduction()) {
    mix.bundleAnalyzer();
}

mix.webpackConfig({
  stats: {
      children: true,
  },
});

