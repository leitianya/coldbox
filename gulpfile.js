var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var browserSync = require('browser-sync');
var autoprefixer = require('gulp-autoprefixer');
var cssnext = require('postcss-cssnext');
var notify = require('gulp-notify');
var cssmin = require('gulp-cssmin');
var minify = require('gulp-minify');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var concat = require("gulp-concat");
var runSequence = require('run-sequence');
var del = require('del');

gulp.task( 'sass', function() {
  var processors = [
    cssnext({ browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009' })
  ];
  return gulp.src(['sass/*.scss'])
  .pipe(sourcemaps.init())
  .pipe(plumber({ errorHandler: notify.onError('<%= error.message %>') }))
  .pipe(sass({ outputStyle: 'expanded', }))
  .pipe(postcss(processors))
  .pipe(rename({ prefix: 'cd-', }))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('assets/css/'));
});

gulp.task( 'css-min', function () {
  gulp.src( 'assets/css/style.css' )
  .pipe(cssmin())
  .pipe(rename({
    prefix: 'cd-',
    suffix: '.min'
  }))
  .pipe(gulp.dest('assets/css/'));
});


gulp.task( 'js-min', function() {
  return gulp.src( 'assets/js/cd-scripts.js' )
  .pipe( minify({ ext:{ min:'.min.js', }, }) )
  .pipe( gulp.dest( 'assets/js/' ) );
});

gulp.task( 'js-concat-hljs', ['js-min'], function() {
  return gulp.src( ['assets/js/highlight.js', 'assets/js/cd-scripts.js'] )
  .pipe( concat( 'cd-scripts+hljs.js' ) )
  .pipe( gulp.dest( 'assets/js/' )  );
});

gulp.task( 'js-concat-hljs-web', ['js-min'], function() {
  return gulp.src( ['assets/js/highlight-web.js', 'assets/js/cd-scripts.js'] )
  .pipe( concat( 'cd-scripts+hljs_web.js' ) )
  .pipe( gulp.dest( 'assets/js/' ) );
});

gulp.task( 'js-min-concat', ['js-concat-hljs', 'js-concat-hljs-web'], function() {
  return gulp.src( ['assets/js/cd-scripts+hljs.js', 'assets/js/cd-scripts+hljs_web.js'] )
  .pipe( minify({ ext:{ min:'.min.js', }, }) )
  .pipe( gulp.dest( 'assets/js' ) );
});


gulp.task( 'browser-sync', function () {
  browserSync({
    open: 'external',
    notify: false,
    proxy: "http://coldbox.vccw/",
  });
});

gulp.task( 'editor-sass', function() {
  var processors = [ cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'}) ];
  return gulp.src('parts/editor-style.scss')
  .pipe(sourcemaps.init())
  .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
  .pipe(sass({outputStyle: 'expanded',}))
  .pipe(postcss(processors))
  .pipe(gulp.dest( 'parts' ));
});

gulp.task( 'editor-min', ['editor-sass'], function() {
  gulp.src('parts/editor-style.css')
  .pipe(cssmin())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('parts'));
});

gulp.task( 'bs-reload', function () {
  browserSync.reload();
});
gulp.task( 'default', ['browser-sync'], function () {
  gulp.watch("sass/*.scss", ['sass', 'bs-reload', 'css-min']);
  gulp.watch("js/*.*", ['bs-reload', 'js-min', 'js-concat-hljs-web', 'js-concat-hljs']);
  gulp.watch("parts/*.*", ['bs-reload']);
  gulp.watch("parts/*.scss", ['editor-sass', 'editor-min'])
  gulp.watch("czr/*.*", ['bs-reload']);
  gulp.watch("*.php", ['bs-reload']);
});

gulp.task( 'clean', function() {
  del( ['style.min.css'] );
});

gulp.task( 'sass-dev', function() {
  var processors = [
    cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'})
  ];
  return gulp.src(['sass/*.scss'])
  .pipe(sass({outputStyle: 'expanded',}))
  .pipe(postcss(processors))
  .pipe(gulp.dest('assets/css/'));
});

gulp.task( 'copy', function() {
  return gulp.src(
    [ '*.php', '*.css', 'readme.txt', 'screenshot.jpg', 'CHANGELOG.md',
      'parts/*.php', 'parts/*.css', 'parts/tgm/*.php', 'page-templates/*.php', 'js/*.js', 'img/*.*', 'czr/*.*',
      'fonts/fontawesome/css/*.css', 'fonts/fontawesome/fonts/*.*', 'fonts/icomoon/*.css', 'fonts/icomoon/fonts/*.*',
      'languages/coldbox.pot', 'assets/js/*.js', 'assets/css/*.css' ],
    { base: '.' }
  )
  .pipe( gulp.dest( 'dist' ) );
} );

gulp.task( 'dist', function(cb){
    return runSequence( ['sass-dev', 'editor-sass'], ['css-min', 'editor-min'], 'js-min-concat', 'clean', 'copy', cb );
});