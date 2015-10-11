// Install all gulp plugins at once
// npm install gulp --save-dev & npm install gulp-sass --save-dev & npm install gulp-autoprefixer --save-dev & npm install gulp-minify-css --save-dev & npm install gulp-uglify --save-dev & npm install gulp-rename --save-dev & npm install gulp-concat --save-dev & npm install gulp-notify --save-dev & npm install gulp-plumber --save-dev & npm install gulp-imagemin --save-dev & npm install gulp-uncss --save-dev

var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var concate = require('gulp-concat');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var imagemin = require('gulp-imagemin');
//var uncss = require('gulp-uncss');


/*
==========================================================
                    SASS
            ______________________
SASS compil -> Autoprefixr -> Uncss (remove non used CSS rules in *.html) ->
==========================================================
*/

/*gulp.task('bootstrapCSS', function(){
    gulp.src('assets/sass/bootstrap/bootstrap.scss')
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(minifyCSS())
    .pipe(rename("bootstrap.min.css"))
    .pipe(gulp.dest('./dist/css'));
});*/

gulp.task('style', function(){
    gulp.src('assets/sass/style.scss')
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass())
    .pipe(autoprefixer())/*
    .pipe(uncss({
        html: ['*.html'],
        ignore: ['.active', '.open']
    }))*/
    .pipe(minifyCSS())
    .pipe(rename("style.min.css"))
    .pipe(gulp.dest('/'));
});

gulp.task('adminStyle', function(){
    gulp.src('assets/sass/admin/style.scss')
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(minifyCSS())
    .pipe(rename("admin.css"))
    .pipe(gulp.dest('./dist/css'));
});


/*
==========================================================
                  Javascript
                ______________________

==========================================================
*/
gulp.task('customJS', function(){
    gulp.src([
      'assets/js/main.js'
    ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(uglify())
    .pipe(rename("main.min.js"))
    .pipe(gulp.dest('dist/js/'));
});

/*gulp.task('bootstrapJS', function(){
    gulp.src([
      'assets/js/bootstrap/transition.js',
      'assets/js/bootstrap/alert.js',
      'assets/js/bootstrap/button.js',
      'assets/js/bootstrap/carousel.js',
      'assets/js/bootstrap/collapse.js',
      'assets/js/bootstrap/dropdown.js',
      'assets/js/bootstrap/modal.js',
      'assets/js/bootstrap/tooltip.js',
      'assets/js/bootstrap/popover.js',
      'assets/js/bootstrap/scrollspy.js',
      'assets/js/bootstrap/tab.js',
      'assets/js/bootstrap/affix.js'
    ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(concate("bootstrap.js"))
    .pipe(uglify())
    .pipe(rename("bootstrap.min.js"))
    .pipe(gulp.dest('dist/js/'));
});*/

/*gulp.task('script',['bootstrapJS', 'customJS'],  function(){
    gulp.src([
        'dist/js/bootstrap.min.js',
        'dist/js/custom.min.js'
    ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(concate("main.js"))
    .pipe(rename("main.min.js"))
    .pipe(gulp.dest('dist/js/'));
});*/
/*
==========================================================
              Images
        ______________________

==========================================================
*/
gulp.task('images', function() {
    return gulp.src([
      'assets/pic/*.{gif,jpg,png,svg}',
      'assets/pic/*/*.{gif,jpg,png,svg}'
    ])
    .pipe(imagemin({
        progressive: true
    }))
    .pipe(gulp.dest('dist/pic/'));
});
/*
==========================================================
              Watch
         ___________________

    Déclencher une tâche particulière 
    si certains fichiers sont modifiés

==========================================================
*/
gulp.task('watch', function(){
    gulp.watch('assets/js/main.js', ['customJS']);/*
    gulp.watch('assets/js/bootstrap/*.js', ['bootstrapJS']);*/
    gulp.watch('assets/sass/*/*.scss', ['style']);
    gulp.watch('assets/sass/style.scss', ['style']);
    gulp.watch('*.html', ['style']);
});


/*
==========================================================
            Tache "Gulp" par Default
==========================================================
*/

gulp.task('default', ['style', 'customJS', 'images', 'watch'], function(){

});