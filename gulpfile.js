var gulp = require('gulp');
var bulkSass = require('gulp-sass-bulk-import');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var notify  = require('gulp-notify');
var uglify = require("gulp-uglify");
var rename = require('gulp-rename');
// New Module
var newer = require('gulp-newer');
var imagemin  = require ('gulp-imagemin');
var mozjpeg = require('imagemin-mozjpeg');
var pngquant = require('imagemin-pngquant');
// New Module for Install Wordpress
var fs = require('fs');
var clean = require('gulp-clean');
var unzip = require('gulp-unzip');
var download = require('gulp-download2');
var wait = require('gulp-wait');
//New connect
var browserSync = require("browser-sync");
var gulpRanInThisFolder = process.cwd();
var res = gulpRanInThisFolder.split("/");
var ProjectName = res[res.length - 1];
url  = ""+ProjectName+".test";
var sourcemaps = require('gulp-sourcemaps');
// :nested
// :compact
// :expanded
// :compressed

// Common Settings
// ---------------------------------------------------------------------------
var srcDir = 'src/';
var distDir = 'dist/';


gulp.task('downloadWP', function(done) {
	if(!fs.existsSync(distDir + 'wp/wp-admin/index.php')) {
		return download('https://wordpress.org/wordpress-4.9.9.zip')
			.pipe(gulp.dest(distDir));
	} else console.log('-- [Checked] Exists Wordpress!');
	done();
});

gulp.task('unzipWP', ['downloadWP'], function(done) {
	if(!fs.existsSync(distDir + 'wp/wp-admin/index.php')) {
		return gulp.src(distDir + 'wordpress-4.9.9.zip')
		  .pipe(unzip())
		  .pipe(gulp.dest(distDir))
	} else console.log('-- [Checked] Exists Wordpress!');
	done();
});

gulp.task('renameWP', ['unzipWP'], function(done) {
	if(!fs.existsSync(distDir + '_wp/') && fs.existsSync(distDir + 'WordPress/')) {
		fs.rename(distDir + 'wp', distDir + '_wp', function (err) {
	    if (err) throw err;
	    console.log("-- [Renamed] wp > _wp successfully");
			if(fs.existsSync(distDir + 'WordPress/')) {
			  fs.rename(distDir + 'WordPress', distDir + 'wp', function (err) {
			    if (err) throw err;
			    console.log("-- [Renamed] WordPress > wp successfully");
			    done();
			    return;
			  })
			}
	  })
	} else {
		console.log('-- [Checked] Exists Wordpress!');
		done();
	}
});

gulp.task('copyWP', ['renameWP'], function(done) {
	if(fs.existsSync(distDir + '_wp/')) {
		gulp.src(distDir + '_wp/wp-content/themes/wp-templ/**/*')
		.pipe(gulp.dest(distDir + 'wp/wp-content/themes/wp-templ'))
		console.log("-- [Copy] Template successfully");
		return gulp.src(distDir + '_wp/wp-content/plugins/**/*')
		.pipe(gulp.dest(distDir + 'wp/wp-content/plugins'))
		console.log("-- [Copy] Plugins successfully");
	} else {
		console.log('-- [Checked] Exists Wordpress!');
		done();
	}
})

gulp.task('delWPTemp', ['copyWP'], function(done) {
	if(fs.existsSync(distDir + '_wp/')) {
		gulp.src(distDir + '_wp/', {read: false})
			.pipe(wait(9999))
			.pipe(clean({force: true}))
		console.log('-- [Remove] _wp directory successfully');
	}
	if(fs.existsSync(distDir + 'wordpress-4.9.9.zip')) {
		gulp.src(distDir + 'wordpress-4.9.9.zip', {read: false})
			.pipe(wait(9999))
			.pipe(clean({force: true}))
		console.log('-- [Remove] wordpress-4.9.9.zip successfully');
	}
	if(fs.existsSync(distDir + 'wp/wp-content/themes/twentyfifteen/')) {
		gulp.src(distDir + 'wp/wp-content/themes/twentyfifteen/', {read: false})
			.pipe(clean({force: true}))
		console.log('-- [Remove] template twentyfifteen successfully');
	}
	if(fs.existsSync(distDir + 'wp/wp-content/themes/twentyseventeen/')) {
		gulp.src(distDir + 'wp/wp-content/themes/twentyseventeen/', {read: false})
			.pipe(clean({force: true}))
		console.log('-- [Remove] template twentyseventeen successfully');
	}
	if(fs.existsSync(distDir + 'wp/wp-content/themes/twentysixteen/')) {
		gulp.src(distDir + 'wp/wp-content/themes/twentysixteen/', {read: false})
			.pipe(clean({force: true}))
		console.log('-- [Remove] template twentysixteen successfully');
	}
	done();
})


gulp.task('sass', function () {
	gulp.src([srcDir + 'scss/style.scss'])
		.pipe(bulkSass())
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed',
			errLogToConsole: false,
			includePaths: [ srcDir, 'mod/' ],
		}))
		.on('error', function(err) {
			notify().write(err);
			this.emit('end');
		})
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write('/maps'))
		.pipe(gulp.dest( distDir + 'assets/css'))
	 	.pipe(browserSync.reload({
	 		stream: true
		}));
	gulp.src([srcDir + 'scss/page/*'])
		.pipe(bulkSass())
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed',
			errLogToConsole: false,
			includePaths: [ srcDir, 'mod/' ],
		}))
		.on('error', function(err) {
			notify().write(err);
			this.emit('end');
		})
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write('/maps'))
		.pipe(gulp.dest( distDir + 'assets/css/page'))
		.pipe(browserSync.reload({
			stream: true
	}));
	return;
});

// js Task Settings
gulp.task('js', function() {
	return gulp.src('src/js/**/*.js')
	.pipe(plumber())
	//.pipe(concat()) //file join
	//.pipe(rename('app.js'))  // file rename
	.pipe(uglify({ //minfy
		// preserveComments: 'some' // comment options
	}))
	.pipe(rename({suffix: '.min'}))
	.pipe(gulp.dest(distDir + 'assets/js')) // file dir
	//.pipe(notify('js task finished')); // message
});

// Images
gulp.task('images', function(){
	var imageDir = distDir + 'assets/img/';
	return gulp.src([
		srcDir + 'img/**/*'
	])
	.pipe(newer(imageDir))
	.pipe(imagemin([
		pngquant({
			quality: [0.8, 0.9],
			speed: 1,
			floyd: 0
		}),
		mozjpeg({
			// quality:85,
			progressive: true
		}),
		imagemin.svgo(),
		imagemin.optipng(),
		imagemin.gifsicle()
	]))
	.pipe(gulp.dest(imageDir));
	// .pipe(notify('Image Copy & Minify Done.'));
});



gulp.task('reload', function (){
	browserSync.reload();
});
gulp.task('reload_stream', function (){
	browserSync.reload({
		stream: true
	});
});

gulp.task('browser-sync', function() {
	var files = [
		'**/*.php',
		'**/*.{png,jpg,gif}'
	];
	browserSync.init(files, {
		// Read here http://www.browsersync.io/docs/options/
		host: url,
		proxy: url,
		port: 10001,
		notify: false,
		open: 'external',
		// Inject CSS changes
		injectChanges: true,
		// Open the site in Chrome
	});
});

gulp.task('build', [
	'sass',
	'js',
	'images',
]);

gulp.task('watch', function () {
	gulp.watch(srcDir + "scss/**/*.scss",["sass"]); //run compass
	gulp.watch(srcDir + "js/**/*.js",["js"]); //run compass
	gulp.watch(['**/*.css'], ["reload_stream"]);
	gulp.watch(['**/*.php'], ["reload"]);
	gulp.watch(srcDir + 'img/**/*',["images"]);
});

gulp.task('default', [ 'build', 'watch','browser-sync' ]);
gulp.task('wp', [ 'downloadWP', 'unzipWP', 'renameWP', 'copyWP', 'delWPTemp' ]);
