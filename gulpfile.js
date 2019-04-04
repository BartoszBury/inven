'use strict';

let gulp = require('gulp');
let sass = require('gulp-sass');
let browserSync = require('browser-sync').create();
let autoprefixer = require('gulp-autoprefixer');
//let bulkSass = require('gulp-sass-bulk-import');

gulp.task('default', ['task:watch', 'browser-sync']);

gulp.task('task:watch', function () {
    gulp.watch('./assets/*.sass', ['sass_admin', 'reload-browser']);

    gulp.watch('./sass/*.sass', ['sass', 'reload-browser']);
    gulp.watch('./sass/**/*.sass', ['sass', 'reload-browser']);
    gulp.watch('./sass/**/**/*.sass', ['sass', 'reload-browser']);
    gulp.watch('./sass/**/**/**/*.sass', ['sass', 'reload-browser']);
    gulp.watch('./sass/**/**/**/**/*.sass', ['sass', 'reload-browser']);

    gulp.watch('./templates/*.*', ['sass', 'reload-browser']);
    gulp.watch('./templates/**/*.*', ['sass', 'reload-browser']);
    gulp.watch('./templates/**/**/*.*', ['sass', 'reload-browser']);
    gulp.watch('./templates/**/**/**/*.*', ['sass', 'reload-browser']);
    gulp.watch('./templates/**/**/**/**/*.*', ['sass', 'reload-browser']);


});

gulp.task('sass_admin', function () {
    return gulp.src('./assets/admin.sass')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./assets/'));

});


gulp.task('sass', function () {
    return gulp.src('./sass/style.sass')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./'));

});

gulp.task('reload-browser', function () {
    browserSync.reload();
});

gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: "localhost/",
        browser: ["google-chrome"]
    });
});


