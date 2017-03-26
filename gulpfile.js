/**
 * Created by vali on 26.03.2017.
 */

var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js, bootstrap.js and all of my custom js files
gulp.task('js', function () {
    return gulp.src(
        [
            "web/assets/js/jquery.js",
            "web/assets/js/uikit.min.js",
            "web/assets/js/components/parallax.min.js",
            "web/assets/js/components/sticky.min.js",
            "web/assets/js/components/slider.min.js",
            "web/assets/js/components/slideshow.min.js",
            "web/assets/js/rating.js",
            "web/assets/js/price-range.js",
            "web/assets/js/jquery.countdown.min.js",
            "web/assets/js/jquery.countTo.js",
            "web/assets/js/config.js",
            "web/assets/js/gmaps.js",
            "web/assets/js/config-contact.js",
            'web/assets/js/jquery-3.1.1.min.js',
            'web/assets/js/bootstrap.min.js',
            'web/assets/js/theme/jquery.magnific-popup.min.js',
            'web/assets/js/theme/theme.js',
            'web/assets/js/theme/view.home.js',
            'web/assets/js/theme/theme.init.js'
        ]
    )
        .pipe(concat('app.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//CSS TASK: write one minified css file out of bootstrap.less and all of my custom less files
gulp.task('css', function () {
    return gulp.src(
        [
            'web/assets/css/uikit.min.css',
            'web/assets/css/components/slideshow.min.css',
            'web/assets/css/components/slidenav.min.css',
            'web/assets/css/components/dotnav.min.css',
            'web/assets/css/components/slider.min.css',
            'web/assets/css/style.css',
            'web/assets/css/responsive.css',
            'web/assets/css/skins/red.css',
            'web/assets/css/bootstrap.min.css',
            'web/assets/css/theme/theme.css',
            'web/assets/css/theme/theme-elements.css',
            'web/assets/css/default.css',
            'web/assets/css/app.css'
        ]
    )
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('app.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/css'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
// gulp.task('img', function() {
    //return gulp.src('app/Resources/public/img/**/*.*')
      //  .pipe(gulp.dest('web/img'));
//});

//define executable tasks when running "gulp" command
gulp.task('default', ['js', 'css'/*, 'img'*/]);