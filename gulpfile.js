var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    browserSync = require('browser-sync'), // Подключаем Browser Sync
    concat      = require('gulp-concat'), // Подключаем gulp-concat (для конкатенации файлов)
    uglify      = require('gulp-uglifyjs'), // Подключаем gulp-uglifyjs (для сжатия JS)
    cssnano     = require('gulp-cssnano'), // Подключаем пакет для минификации CSS
    rename      = require('gulp-rename'), // Подключаем библиотеку для переименования файлов
    del         = require('del'), // Подключаем библиотеку для удаления файлов и папок
    imagemin    = require('gulp-imagemin'), // Подключаем библиотеку для работы с изображениями
    pngquant    = require('imagemin-pngquant'), // Подключаем библиотеку для работы с png
    cache       = require('gulp-cache'), // Подключаем библиотеку кеширования
    autoprefixer = require('gulp-autoprefixer');// Подключаем библиотеку для автоматического добавления префиксов




gulp.task('sass', function() {
    return gulp.src('scss/*.+(scss|sass)')
        .pipe(sass())
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
        .pipe(gulp.dest('stylesheets'));
        //.pipe(browserSync.reload({stream: true}));// Обновляем CSS на странице при изменении
});

gulp.task('browser-sync', function() { // Создаем таск browser-sync
   browserSync({ // Выполняем browser Sync
       proxy: "ptashka-design.com",
       notify: false
    });
});

gulp.task('scripts', function() {
    return gulp.src([ // Берем все необходимые библиотеки
        // 'libs/jquery/dist/jquery.min.js', // Берем jQuery
        // 'libs/bootstrap/dist/js/bootstrap.min.js'// Бутстрап
        // 'libs/magnific-popup/slick.min.js', // Слайдер
        //'libs/flexslider/jquery.flexslider-min.js'

    ])
        .pipe(concat('libs.min.js')) // Собираем их в кучу в новом файле libs.min.js
        .pipe(uglify()) // Сжимаем JS файл
        .pipe(gulp.dest('js')); // Выгружаем в папку js
});

// gulp.task('css-libs', ['sass'], function() {
//     return gulp.src('stylesheets/libs.css') // Выбираем файл для минификации
//         .pipe(cssnano()) // Сжимаем
//         .pipe(rename({suffix: '.min'})) // Добавляем суффикс .min
//         .pipe(gulp.dest('stylesheets')); // Выгружаем в папку css
// });

gulp.task('img', function() {
    return gulp.src('img/**/*') // Берем все изображения
        .pipe(cache(imagemin({  // Сжимаем их с наилучшими настройками с учетом кеширования
            interlaced: true,
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        })))
        .pipe(gulp.dest('img')); //
});

gulp.task('watch', ['browser-sync', 'scripts', 'sass'], function () {
    gulp.watch('scss/**/*.+(scss|sass)', ['sass'], browserSync.reload);
    gulp.watch('stylesheets/*.css',  browserSync.reload);
    gulp.watch('template-parts/*.php', browserSync.reload);
    gulp.watch('inc/*.php', browserSync.reload); // Наблюдение за php файлами шаблонов
    gulp.watch('./**/*.php', browserSync.reload); // Наблюдение за php файлами в корне проекта
    gulp.watch('./**/*.php', browserSync.reload); // Наблюдение за php файлами в корне проекта
    gulp.watch('js/**/*.js', browserSync.reload); // Наблюдение за JS файлами в папке js

});

gulp.task('clean', function() {
    return del.sync('dist'); // Удаляем папку dist перед сборкой
});

gulp.task('build', ['clean', 'img', 'sass', 'scripts'], function() {

    var buildCss = gulp.src([ // Переносим библиотеки в продакшен
        'stylesheets/style.css',
        'stylesheets/libs.min.css'
    ])
        .pipe(gulp.dest('dist/stylesheets'));

    var buildFonts = gulp.src('fonts/**/*') // Переносим шрифты в продакшен
        .pipe(gulp.dest('dist/fonts'));

    var buildJs = gulp.src('js/**/*') // Переносим скрипты в продакшен
        .pipe(gulp.dest('dist/js'));

    var buildHtml = gulp.src('*.html') // Переносим HTML в продакшен
        .pipe(gulp.dest('dist'));
});

gulp.task('clear', function () {
    return cache.clearAll();
});

gulp.task('default', ['watch']);