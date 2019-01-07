'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var del = require('del');
var cache = require('gulp-cache');
var cssmin = require('gulp-cssmin');

var buildPath = './public';
var srcPath = './public/assets';
var scssPath = srcPath+'/scss';
var buildCssPath = buildPath+'/css';

// clean
gulp.task('clean', function(done) {
    del(['build']);
    return cache.clearAll(done);
});

// sass compilation
gulp.task('styles', function(){
    return gulp.src(scssPath+'/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(buildCssPath));
});

gulp.task('watch', function() {
    gulp.watch(scssPath+'/**/*.scss', ['styles']);
});