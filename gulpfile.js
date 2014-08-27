var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

var paths = {
    less: [],
    scripts: [
    './assets/vendors/plupload/js/plupload.full.min.js',
    './assets/vendors/colorbox/jquery.colorbox-min.js',
    './assets/js/image-manager.js'
    ]
};
/**
Less Compile
 **/
gulp.task('less', function () {
    gulp.src(paths.less)
    .pipe(sourcemaps.init())
    .pipe(less({
        paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./public/assets/css'));
});

/** 
File Combine and js Minify
**/

gulp.task('compress', function() {
    gulp.src(paths.scripts)
    .pipe(sourcemaps.init())
    .pipe(concat('imageManager.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('./public/js'));
});


// Rerun the task when a file changes
gulp.task('watch', function() {
    //gulp.watch(paths.less, ['less']);
    gulp.watch(paths.scripts, ['compress']);
});
gulp.task('default', ['watch', 'compress']);