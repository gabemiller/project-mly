var gulp = require('gulp'),
    order = require('gulp-order'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifyCSS = require('gulp-minify-css'),
    autoprefixer = require('gulp-autoprefixer'),
    sass = require('gulp-sass');

gulp.task('site-js', function () {
    return gulp.src('app/assets/js/site/**/*.js')
        .pipe(order([
            "plugins/jquery.blueimp-gallery.min.js",
            "plugins/bootstrap-image-gallery.js",
            "plugins/*.js",
            "divide.js"
        ]))
        .pipe(concat("divide.min.js"))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('admin-js', function () {
    return gulp.src('app/assets/js/admin/**/*.js')
        .pipe(order([
            "plugins/*.js",
            "plugins/jquery.tablesorter.min.js",
            "plugins/jquery.tablesorter.pager.min.js",
            "plugins/jquery.tablesorter.widgets.min.js",
            "plugins/summernote.min.js",
            "plugins/summernote-hu-HU.js",
            "divide-admin.js"
        ]))
        .pipe(concat("divide-admin.min.js"))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('site-css', function () {
    return gulp.src('app/assets/css/site/divide.scss')
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 5 versions'],
            cascade: false
        }))
        .pipe(concat("divide.min.css"))
        .pipe(minifyCSS({keepSpecialComments: 0}))
        .pipe(gulp.dest('public/css'));
});

gulp.task('site-css-am', function () {
    return gulp.src('app/assets/css/site/divide.am.scss')
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 5 versions'],
            cascade: false
        }))
        .pipe(concat("divide.am.min.css"))
        .pipe(minifyCSS({keepSpecialComments: 0}))
        .pipe(gulp.dest('public/css'));
});

gulp.task('admin-css', function () {
    return gulp.src('app/assets/css/admin/**/*.css')
        .pipe(order([
            "plugins/alertify.core.css",
            "plugins/alertify.bootstrap.css",
            "plugins/summernote.css",
            "plugins/summernote-bs3.css",
            "plugins/*.css",
            "divide-admin.css"
        ]))
        .pipe(autoprefixer({
            browsers: ['last 5 versions'],
            cascade: false
        }))
        .pipe(concat("divide-admin.min.css"))
        .pipe(minifyCSS({keepSpecialComments: 0}))
        .pipe(gulp.dest('public/css'));
});


gulp.task('watch-site', function () {
    gulp.run('site-css');
    gulp.run('site-js');
    gulp.run('site-css-am');
    gulp.watch('app/assets/css/site/divide.scss', ['site-css']);
    gulp.watch('app/assets/css/site/divide.am.scss', ['site-css-am']);
    gulp.watch('app/assets/js/site/**/*.js', ['site-js']);
});

gulp.task('watch-admin-css', function () {
    gulp.run('admin-css');
    gulp.watch('app/assets/css/admin/**/*.css',['admin-css']);
});


