// Require our dependencies.
var autoprefixer = require('autoprefixer');
var mqpacker     = require('css-mqpacker');
var gulp         = require('gulp');
var notify       = require('gulp-notify');
var	plumber      = require('gulp-plumber');
var postcss      = require('gulp-postcss');
var	rename       = require('gulp-rename');
var	sass         = require('gulp-sass');
var	sourcemaps   = require('gulp-sourcemaps');
var uglify       = require('gulp-uglify');

/**
 * Compile Sass.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
gulp.task('sass', function () {

gulp.src('assets/styles/styles.scss')

	// Notify on error
	.pipe(plumber({
		errorHandler: notify.onError("Error: <%= error.message %>")
	}))

	// Process sass
	.pipe(sass({
		outputStyle: 'compressed'
	}))

	// Parse with PostCSS plugins.
	.pipe(postcss([
		autoprefixer({
			browsers: 'last 2 versions'
		}),
		mqpacker({
			sort: true
		}),
	]))

	// Add .min suffix.
	.pipe(rename({
		suffix: '.min'
	}))

	// Write source map.
	.pipe(sourcemaps.write('./'))

	// Output the compiled sass to this directory.
	.pipe(gulp.dest('assets/styles'))

	// Notify on successful compile (uncomment for notifications).
	.pipe(notify("Compiled: <%= file.relative %>"));

});

/**
 * Create default task.
 */
gulp.task('default', function () {

	gulp.start('sass');

});
