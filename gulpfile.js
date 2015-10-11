var gulp        = require('gulp'),
    path        = require('path'),
    stylecow    = require('gulp-stylecow'),
    rename      = require('gulp-rename'),
    requirejs   = require('requirejs'),
    browserSync = require('browser-sync').create();

gulp.task('css', function() {
    var config = require('./stylecow.json');

    config.files.forEach(function (file) {
        gulp.src(file.input)
            .pipe(stylecow(config))
            .pipe(rename(file.output))
            .pipe(gulp.dest('./'))
            .pipe(browserSync.stream());
    });
});

gulp.task('js', function (ready) {
    requirejs.optimize({
        appDir: "source/js",
        baseUrl: '.',
        mainConfigFile : 'source/js/main.js',
        dir: 'public/js',
        removeCombined: true,
        modules: [
            {
                name: 'main',
                include: ['../../bower_components/almond/almond.js']
            }
        ]
    }, function () {
        ready();
    }, function (error) {
        console.error('requirejs task failed', JSON.stringify(error))
        process.exit(1);
    });
});

gulp.task('sync', ['default'], function () {
    browserSync.watch('source/**/*', function (event, file) {
        if (event !== 'change') {
            return;
        }

        switch (path.extname(file)) {
            case '.yml':
            case '.php':
                browserSync.reload('*.html');
                return;

            default:
                browserSync.reload(path.basename(file));
                return;
        }
    });

    browserSync.init({
        port: process.env.APP_SYNC_PORT || 3000,
        proxy: process.env.APP_URL || 'http://127.0.0.1:8000'
    });

    gulp.watch('source/**/*.js', ['js']);
    gulp.watch('source/**/*.css', ['css']);
});

gulp.task('default', ['css', 'js']);
