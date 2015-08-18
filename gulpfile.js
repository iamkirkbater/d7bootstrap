var gulp = require('gulp'),
    sass = require('gulp-sass'),
    neat = require('node-neat'),
    normalize = require('node-normalize-scss'),
    watch = require('gulp-watch'),
    plumber = require('gulp-plumber'),
    sourcemaps = require('gulp-sourcemaps');

var paths = {
    sass: neat.with(normalize.includePaths)
};

gulp.task('sass', function() {
    return gulp.src('assets/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass({
            includePaths: paths.sass
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./assets/css'));
});

gulp.task('watch', function() {
    gulp.watch('assets/scss/**/*.scss', ['sass']);
});

gulp.task('default', ['sass', 'watch']);