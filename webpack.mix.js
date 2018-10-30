const mix = require('laravel-mix')
const tailwindCss = require('tailwindcss')
const glob = require('glob-all')
const purgeCss = require('purgecss-webpack-plugin')
const importCss = require('postcss-import')

// Custom PurgeCSS extractor for Tailwind that allows special characters in
// class names.
//
// https://github.com/FullHuman/purgecss#extractor
// https://gist.github.com/andrewdelprete/277a5a2af33aea2481c54a6a8b35d6c3
class TailwindExtractor {
  static extract(content) {
    return content.match(/[A-Za-z0-9-:\/_]+/g) || []
  }
}

mix.js('resources/js/app.js', 'public/js')
  .options({
    processCssUrls: false
  })
  .postCss('resources/css/app.css', 'public/css', [
    importCss(),
    tailwindCss('tailwind.js'),
  ])
  .copyDirectory('resources/images', 'public/images');

// Only run PurgeCSS during production builds for faster development builds
// and so you still have the full set of utilities available during
// development.
if (mix.inProduction()) {
  mix.webpackConfig({
    plugins: [
      new purgeCss({
        paths: glob.sync([
          path.join(__dirname, 'resources/views/**/*.blade.php'),
          path.join(__dirname, 'resources/js/**/*.js'),
          path.join(__dirname, 'resources/js/**/*.vue')
        ]),
        extractors: [{
          extractor: TailwindExtractor,
          extensions: ['html', 'js', 'vue', 'php']
        }]
      })
    ]
  })
}
