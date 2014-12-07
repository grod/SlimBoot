var gulp       = require('gulp');
var jshint     = require('gulp-jshint');
var sass       = require('gulp-sass');
var concat     = require('gulp-concat');
var uglify     = require('gulp-uglify');
var rename     = require('gulp-rename');
var order      = require('gulp-order');
var livereload = require('gulp-livereload');

gulp.task('lint', function() {
  return gulp.src('app/assets/js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

gulp.task('sass', function() {
  return gulp.src('app/assets/scss/style.scss')
    .pipe(sass())
    .pipe(gulp.dest('public/css'))
    .pipe(livereload());
});

gulp.task('css', function(){
  return gulp.src('app/assets/css/**/*.css')
    .pipe(gulp.dest('public/css'))
    .pipe(livereload())
});

gulp.task('fonts', function(){
  return gulp.src('app/assets/fonts/*.*')
    .pipe(gulp.dest('public/fonts'))
});

gulp.task('images', function(){
  return gulp.src('app/assets/images/*.*')
    .pipe(gulp.dest('public/images'))
});

gulp.task('scripts', function() {
  return gulp.src(['app/assets/js/**/*.js', '!app/assets/js/vendor/**/*.js'])
    .pipe(concat('all.js'))
    .pipe(gulp.dest('public/js'))
    .pipe(rename('all.min.js'))
    .pipe(uglify())
    .pipe(livereload())

    // Vendor scripts
    .pipe(gulp.src('app/assets/js/vendor/**/*.js')) 
    // jQuery first
    .pipe(order([
      'jquery-*.js' 
    ]))
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('public/js'))
});

gulp.task('watch', function() {
  livereload.listen();

  gulp.watch('app/assets/js/*.js', ['lint', 'scripts']);
  gulp.watch('app/assets/scss/*.scss', ['sass']);
  gulp.watch('app/assets/css/*.css', ['css']);
  gulp.watch('app/views/**/*.html').on('change', livereload.changed);

});

gulp.task('default', ['lint', 'sass', 'css', 'scripts', 'fonts', 'images']);
