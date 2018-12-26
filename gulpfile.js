var gulp                = require('gulp'), // GULP
    sass                = require('gulp-sass'), // Компиляция из SASS в CSS
    autoprefixer        = require('gulp-autoprefixer'), // Добавление вендорных прификсов
    concat              = require('gulp-concat'), // Конкатинация(объединение)
    browserSync         = require('browser-sync'), // liveReload - обновление страницы при сохранении
    uglify              = require('gulp-uglifyjs'), // Сжатие js
    cssnano             = require('gulp-cssnano'), // Минификация css
    uncss               = require('gulp-uncss'), // Удаление не используемых классов в CSS
    rename              = require('gulp-rename'), // Переименование
    imagemin            = require('gulp-imagemin'), // Сжатие img
    imageminPngquant    = require('imagemin-pngquant'), // Сжатие png
    cache               = require('gulp-cache'), // Очистка кеша
    del                 = require('del'), // Удаление
    spritesmith         = require('gulp.spritesmith'), // CSS Sprite
    tiny                = require('gulp-tinypng-nokey'), // Ультра-сжатие изображений
    zip                 = require('gulp-zip'), // Архивирование в ZIP
    gutil               = require('gulp-util'), // Подсвечивание ошибок
    ftp                 = require('gulp-ftp'), // Выгрузка на хостинг
    csso                = require('gulp-csso'), // Оптимизация css
    stripCssComments    = require('gulp-strip-css-comments'), // Удаление комментариев из CSS
    strip               = require('gulp-strip-comments'), // Удаление комментриев из HTML и JS
    svgSprite           = require('gulp-svg-sprites'), // Создание SVG sprite
    cheerio             = require('gulp-cheerio'), // Изменение HTML и XML-файлов
    replace             = require('gulp-replace'), // Удаление атрибутов
    svgmin              = require('gulp-svgmin'), // Минификая SVG
    critical            = require('critical'), // Критический CSS
    plumber             = require('gulp-plumber'), // Перехват ошибок
    webp                = require('gulp-webp'), // Конвертация в Webp
    imageminMozjpeg     = require('imagemin-mozjpeg'), // Сжатие jpeg
    responsive          = require('gulp-responsive'), // Изменение изображений
    merge               = require('gulp-merge'); // Объедините несколько потоков в один поток по порядку

// Компиляция из sass в css в папку с темой
gulp.task('sass-style', function () {
    return gulp.src('sass/style.sass')
    .pipe(sass({outputStyle: 'expanded'}).on('error' , sass.logError)) // Компиляция в css
    .pipe(autoprefixer({ // автопрефиксер 
            browsers: ['last 15 versions', 'ie >= 9', 'and_chr >= 2.3'],
            cascade: true
        }))
 // .pipe(browserSync.reload({stream: true})) // livereload pipe
    .pipe(gulp.dest('./'))

});

// Компиляция из sass в css в папку css
gulp.task('sass-page', function () {
    return gulp.src([
        'blocks/page-contents/404/404.sass',
        'blocks/page-contents/search/search.sass',
        ])
    .pipe(sass({outputStyle: 'expanded'}).on('error' , sass.logError)) // Компиляция в css
    .pipe(autoprefixer({ // автопрефиксер 
            browsers: ['last 15 versions', 'ie >= 9', 'and_chr >= 2.3'],
            cascade: true
        }))
 // .pipe(browserSync.reload({stream: true})) // livereload pipe
    .pipe(gulp.dest('css'))

});

// livereload task
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "DOMEN",
        notify: false
    });
});

// Сжатие js
gulp.task('uglify', function () {
    return gulp.src('js/scripts.js')
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'));
});

// Сжатие js
gulp.task('js-settings', function() {
    return gulp.src('js/settings/settings.js')
       .pipe(strip()) // Удаление комментариев
       .pipe(uglify()) // Сжатие js
       .pipe(rename({ // Переименование файла
			suffix: ".min",
		}))
        .pipe(gulp.dest('js'));
});

 // Конкатинация JS-min файлов
gulp.task('js-settings-min', function() {
    return gulp.src([
    'libs/Settings/settings.min.js'
    ])
    .pipe(concat('scripts.js')) // Название файла в который идет конкатинация
    .pipe(strip()) // Удаление комментариев
    .pipe(rename({ // Переименование файла
            suffix: ".min",
        }))
    .pipe(gulp.dest('dist/js'));
});

gulp.task('scripts', gulp.series('js-settings', 'js-settings-min')); 

// Оптимизация и минификая css
gulp.task('css-min', function() {
    return gulp.src('css/style.css')
    .pipe(stripCssComments({ // Удаление комментариев
        preserve: false
    }))
    .pipe(uncss({ // Удаление лишних классов
        html: [ // Файлы в которых проверяются CSS классы на использование
        '*.html',
        'http://cv56344.tmweb.ru/',
        ],
        ignore: [
        /\.webfont-loaded/, 
        /\.js-menu-open/, 
        /\.is-active/,
       ]
    }))
    .pipe(csso({ // Оптимизация css
        restructure: false,
        sourceMap: true,
        debug: true
    }))
    .pipe(cssnano()) // Минификая css
    .pipe(rename({  // Переименование файла
      suffix: ".min",
    }))
    .pipe(gulp.dest('dist/css'));
}); 

// Критический CSS
gulp.task('critical', function (cb) {
    critical.generate({
        inline: false,
        base: '',
       // html: 'index.html',
        src: 'index.html',
        css: ['css/style.css'],
        dest: 'css/critical-style.css',
        minify: true,
        width: 1920,
        height: 480
    });
});


// Изменение изображений
gulp.task('resp', function () {
  return gulp.src('images/Sprite/png/sprite.png')
     .pipe(responsive({
    
     '6.png': [{
        // image-small.jpg is 200 pixels wide
        width: 200,
        rename: {
          suffix: '-mobile',
          extname: '.jpg',
        },
      }, {
        // image-small@2x.jpg is 400 pixels wide
        width: 200 * 2,
        rename: {
          suffix: '-@2x',
          extname: '.jpg',
        },
      }],

      '7.png': [{
        width: 200,
        rename: { suffix: '-200px'}
      }],

      'bg-color3.png': [{
        width: 200,
        rename: { suffix: '-200px'}
      }],

      '*.png': [{
        width: 7896 * 2,
        rename: { suffix: '-200px'}
      }],

    }))

    .pipe(gulp.dest('images/Resp'));
});


// Конвертация в Webp
gulp.task('webp', () =>
    gulp.src([
        'images/*.jpg',
        'images/*.png'
        ])
        .pipe(webp({
            // quality: 80,
            // preset: 'photo',
            // method: 6,
            lossless: true // Сжатие без потерь
        }))
        .pipe(gulp.dest('./images'))
);

// Минификация SVG и вышрузка в папку dist/images/SVG
gulp.task('build-svg', () =>
    gulp.src([
        './images/SVG/*.svg',
        ])
        .pipe(svgmin())
        .pipe(gulp.dest('dist/images/SVG'))
);

// Сжатие изображений
gulp.task('compress', function() {
    gulp.src([
        'images/*.png',
        'images/*.jpg',
        'images/*.jpg',
        'images/*.gif',
        'libs/Sprites/css/sprite.png'
    ])
    .pipe(cache(imagemin({
        interlaced: true,
        progressive: true,
        svgoPlugins: [{removeViewBox: false}],
        une: [imageminPngquant()]
    })))
    .pipe(gulp.dest('./images'));
});

// Сжатие jpeg
gulp.task('jpg', () =>
    gulp.src('images/*.jpg')
    .pipe(imagemin([imageminMozjpeg({
        quality: 85
    })]))
    .pipe(gulp.dest('./images'))
);

// Ультра-сжатие изображений
gulp.task('tinypng', function(cb) {
    return gulp.src([
        'images/*.png',
        'images/*.jpg',
        'images/*.jpg',
        'images/*.gif',
        'libs/Sprites/css/sprite.png'
        ])
        .pipe(tiny())
        .pipe(gulp.dest('./images'));
});

// Архивирование в zip
gulp.task('zip', () =>
    gulp.src('dist/**')
        .pipe(zip('ready.zip'))
        .pipe(gulp.dest(''))
);

// CSS Sprite
gulp.task('sprite', function () {
  var spriteData = gulp.src([
    'images/Icons/*.jpg',
    'images/Icons/*.png'
  ]).pipe(spritesmith({
    imgName: 'sprite.png',
    cssName: 'sprite.sass',
    imgPath: '/wp-content/themes/wow/images/Sprite/png/sprite.png',
    algorithm: 'left-right'
  }));
  return spriteData.pipe(gulp.dest('images/Sprite/png'));
});

// SVG Sprite
gulp.task('svg', function () {
    return gulp.src('images/SVG/*.svg')
        .pipe(svgmin()) // Минификация SVG
    /*  .pipe(cheerio(function ($) {
            $('svg').attr('style',  'display:none');
        })) */
        .pipe(svgSprite({mode: "symbols"}))
        .pipe(gulp.dest("images/Sprite"));
});

// Gulp update
gulp.task('up', function () {
  var update = require('gulp-update')();
 
  gulp.watch('./package.json').on('change', function (file) {
    update.write(file);
  });
 
});

// Очистка кэша
gulp.task('cache', function() {
    return cache.clearAll();
});

// Удаление
gulp.task("clean", clean);
function clean() {
    return del(["./dist"]);
}

// Наблюдение
gulp.task('watch', function() {
    // Наблюдение
    gulp.watch('sass/**/*.sass' , gulp.parallel('sass-style', 'sass-page')); 
    gulp.watch('blocks/**/*.sass' , gulp.parallel('sass-style', 'sass-page')); 
    gulp.watch('js/settings/settings.js' , gulp.parallel('scripts'));
    // Обновление страницы
    gulp.watch('./style.css').on('change', browserSync.reload); // reload css
    gulp.watch('**/*.php').on('change', browserSync.reload); // reload php
    gulp.watch('js/settings/settings.js').on('change', browserSync.reload); // reload js
});

// Выгрузка на хостинг
gulp.task('deploy', function () {
    return gulp.src('dist/**')
        .pipe(ftp({
            host: 'cm96985.tmweb.ru',
            user: 'cm96985',
            pass: '******',
            remotePath: 'public_html'
        }))
        .pipe(gutil.noop());
});

// Пути к файлам
var paths = {

    css: {
        css: [
            './css/*.css'
        ],
        cssProject: './*.css',
    },
    fonts: './fonts/**',
    images: {
        images: [
            './images/*.JPG',
            './images/*.jpg',
            './images/*.png',
            './images/*.gif',
        ],
        favicon: [
            './images/Favicon/*.png',
            './images/Favicon/*.jpg',
            './images/Favicon/*.JPG',
        ],
        icons: [
            './images/Icons/*.JPG',
            './images/Icons/*.jpg',
            './images/Icons/*.png',
            './images/Icons/*.gif',
        ],
        JPEG2: './dist/images/JPEG 2000/**',
        JPEGXR: './dist/images/JPEG XR/**',
        OpenGraph: [
            './images/OpenGraph/*.jpg',
            './images/OpenGraph/*.JPG',
            './images/OpenGraph/*.png',
        ],
        Sprite: './images/Sprite/png/*.png',
        SpriteSVG: './images/Sprite/svg/*.svg',
        SVG: './images/SVG/*.svg',
        WebP: './images/WebP/*.webp',
    },
    frameworkCustomizations: './framework-customizations/**',
    inc: './inc/*.php',
    js: './js/*.js',
    layouts: './layouts/*.css',
    settings: [
        './settings/**',
        '!./settings/ht.access'
    ],
    htaccess: './settings/ht.access',
    templateParts: './template-parts/*.php',
    TGM: './TGM/**',
    woocommerce: './woocommerce/**',
    php: './*.php',
    txt: [
        './*.txt',
        '!./gulp plugins.txt',
        '!./Инструкция.txt'
    ],
    languages: './languages/**',
    scrin: './screenshot.png',
    dist: {
        dist: './dist',
        fonts: './dist/fonts',
        css: './dist/css',
        images: {
            images: './dist/images',
            icons: './dist/images/Icons',
            JPEG2: './dist/images/JPEG 2000',
            JPEGXR: './dist/images/JPEG XR',
            OpenGraph: './dist/images/OpenGraph',
            Sprite: './dist/images/Sprite/png',
            SpriteSVG: './dist/images/Sprite/svg',
            SVG: './dist/images/SVG',
            WebP: './dist/images/WebP',
            favicon: './dist/images/Favicon',
        },
        frameworkCustomizations: './dist/framework-customizations',
        inc: './dist/inc',
        js: './dist/js',
        layouts: './dist/layouts',
        templateParts: './dist/template-parts',
        TGM: './dist/TGM',
        woocommerce: './dist/woocommerce',
        languages: './dist/languages'

    }

};

// Выгрузка в папку dist/css
gulp.task('build-css', function() {

    // Файлы из папки css
    var destToCss = gulp.src(paths.css.css)
    // Выгрузка в папку dist/css
    return merge(destToCss)
        .pipe(gulp.dest(paths.dist.css));

});

// Выгрузка в папку dist/fonts
gulp.task('build-fonts', function() {

    // Файлы из папки fonts
    var destToFonts = gulp.src(paths.fonts)
    // Выгрузка в папку dist/fonts
    return merge(destToFonts)
        .pipe(gulp.dest(paths.dist.fonts));

});

// Выгрузка в папку dist/images
gulp.task('build-images', function() {

    // Файлы из папки images
    var destToImages = gulp.src(paths.images.images)
    // Выгрузка в папку dist/images
    return merge(destToImages)
        .pipe(tiny()) // Ультра-сжатие изображение
        .pipe(gulp.dest(paths.dist.images.images));

});

// Выгрузка в папку dist/images/favicon
gulp.task('build-favicon', function() {

    // Файлы из папки images
    var destToImagesFavicon = gulp.src(paths.images.favicon)
    // Выгрузка в папку dist/images/favicon
    return merge(destToImagesFavicon)
        .pipe(tiny()) // Ультра-сжатие изображение
        .pipe(gulp.dest(paths.dist.images.favicon));

});

// Выгрузка в папку dist/images/Icons
gulp.task('build-icons', function() {

    // Файлы из папки images
    var destToImagesIcons = gulp.src(paths.images.icons)
    // Выгрузка в папку dist/images/Icons
    return merge(destToImagesIcons)
        .pipe(tiny()) // Ультра-сжатие изображение
        .pipe(gulp.dest(paths.dist.images.icons));

});

// Выгрузка в папку dist/images/JPEG 2000
gulp.task('build-jpeg2', function() {

    // Файлы из папки images
    var destToImagesJPEG2 = gulp.src(paths.images.JPEG2)
    // Выгрузка в папку dist/images/JPEG 2000
    return merge(destToImagesJPEG2)
        .pipe(gulp.dest(paths.dist.images.JPEG2));

});

// Выгрузка в папку dist/images/JPEG XR
gulp.task('build-jpegxr', function() {

    // Файлы из папки images
    var destToImagesJPEGXR = gulp.src(paths.images.JPEGXR)
    // Выгрузка в папку dist/images/JPEG XR
    return merge(destToImagesJPEGXR)
        .pipe(gulp.dest(paths.dist.images.JPEGXR));

});

// Выгрузка в папку dist/images/OpenGraph
gulp.task('build-og', function() {

    // Файлы из папки images
    var destToImagesOpenGraph = gulp.src(paths.images.OpenGraph)
    // Выгрузка в папку dist/images/OpenGraph
    return merge(destToImagesOpenGraph)
        .pipe(tiny()) // Ультра-сжатие изображение
        .pipe(gulp.dest(paths.dist.images.OpenGraph));

});

// Выгрузка в папку dist/images/Sprite
gulp.task('build-sprite', function() {

    // Файлы из папки images
    var destToImagesSprite = gulp.src(paths.images.Sprite)
    // Выгрузка в папку dist/images/Sprite
    return merge(destToImagesSprite)
        .pipe(tiny()) // Ультра-сжатие изображение
        .pipe(plumber()) // Перехват ошибок
        .pipe(gulp.dest(paths.dist.images.Sprite));

});

// Выгрузка в папку dist/images/Sprite/svg
gulp.task('build-svg-sprite', function() {

    // Файлы из папки images/Sprite/svg
    var destToImagesSpriteSvg = gulp.src(paths.images.SpriteSVG)
    // Выгрузка в папку dist/images/Sprite/svg
    return merge(destToImagesSpriteSvg)
        .pipe(gulp.dest(paths.dist.images.SpriteSVG));

});

// Выгрузка в папку dist/images/WebP
gulp.task('build-webp', () =>
    gulp.src([
        'images/*.jpg',
        'images/*.png'
        ])
        .pipe(webp({
            // quality: 80,
            // preset: 'photo',
            // method: 6,
            lossless: true // Сжатие без потерь
        }))
        .pipe(gulp.dest('./dist/images'))
);

// Выгрузка в папку dist/framework-customizations
gulp.task('build-fc', function() {

    // Файлы из папки framework-customizations
    var destToframeworkCustomizations = gulp.src(paths.frameworkCustomizations)
    // Выгрузка в папку dist/framework-customizations
    return merge(destToframeworkCustomizations)
        .pipe(gulp.dest(paths.dist.frameworkCustomizations));

});

// Выгрузка в папку dist/inc
gulp.task('build-inc', function() {

    // Файлы из папки inc
    var destToInc = gulp.src(paths.inc)
    // Выгрузка в папку dist/inc
    return merge(destToInc)
        .pipe(gulp.dest(paths.dist.inc));

});

// Выгрузка в папку dist/js
gulp.task('build-js', function() {

    // Файлы из папки js
    var destToJs = gulp.src(paths.js)
    // Выгрузка в папку dist/js
    return merge(destToJs)
        .pipe(gulp.dest(paths.dist.js));

});

// Выгрузка в папку dist/languages
gulp.task('build-languages', function() {

    // Файлы из папки languages
    var destToLanguages = gulp.src(paths.languages)
    // Выгрузка в папку dist/languages
    return merge(destToLanguages)
        .pipe(gulp.dest(paths.dist.languages));

});

// Выгрузка в папку dist/layouts
gulp.task('build-layouts', function() {

    // Файлы из папки layouts
    var destToLayouts = gulp.src(paths.layouts)
    // Выгрузка в папку dist/layouts
    return merge(destToLayouts)
        .pipe(gulp.dest(paths.dist.layouts));

});

// Выгрузка в папку dist/template-parts
gulp.task('build-template-parts', function() {

    // Файлы из папки template-parts
    var destToTemplateParts = gulp.src(paths.templateParts)
    // Выгрузка в папку dist/templateParts
    return merge(destToTemplateParts)
        .pipe(gulp.dest(paths.dist.templateParts));

});

// Выгрузка в папку dist/TGM
gulp.task('build-tgm', function() {

    // Файлы из папки TGM
    var destToTGM = gulp.src(paths.TGM)
    // Выгрузка в папку dist/TGM
    return merge(destToTGM)
        .pipe(gulp.dest(paths.dist.TGM));

});

// Выгрузка в папку dist/woocommerce
gulp.task('build-wc', function() {

    // Файлы из папки woocommerce
    var destToWoocommerce = gulp.src(paths.woocommerce)
    // Выгрузка в папку dist/woocommerce
    return merge(destToWoocommerce)
        .pipe(gulp.dest(paths.dist.woocommerce));

});

// Выгрузка в папку dist
gulp.task('build-php', function() {

    // Файлы из папки проекта .php
    var destToDistPhp = gulp.src(paths.php)

    // Выгрузка в папку dist
    return merge(destToDistPhp)
        .pipe(gulp.dest(paths.dist.dist));

});

// Выгрузка в папку dist
gulp.task('dest-txt', function() {

    // Файлы из папки проекта .txt
    var destToDistTxt = gulp.src(paths.txt)

    // Выгрузка в папку dist
    return merge(destToDistTxt)
        .pipe(gulp.dest(paths.dist.dist));

});

// Выгрузка в папку dist
gulp.task('build-cssProject', function() {

    // Файлы из папки проекта .css
    var destToDistCss = gulp.src(paths.css.cssProject)

    // Выгрузка в папку dist
    return merge(destToDistCss)
        .pipe(gulp.dest(paths.dist.dist));

});

// Выгрузка в папку dist
gulp.task('build-settings', function() {

    // Файлы из папки settings
    var destToDistSettings = gulp.src(paths.settings)

    // Выгрузка в папку dist
    return merge(destToDistSettings)
        .pipe(gulp.dest(paths.dist.dist));

});

// Выгрузка в папку dist
gulp.task('build-htaccess', function() {

    // Файлы из папки settings/ht.access
    var destToDistSettingsHtaccess = gulp.src(paths.htaccess)
        
    // Выгрузка в папку dist
    return merge(destToDistSettingsHtaccess)
        /*.pipe(rename({
            basename: ".",
            extname: "htaccess"
        }))*/
        .pipe(gulp.dest(paths.dist.dist));

});

// Выгрузка в папку dist
gulp.task('build-scrin', function() {

    // Файлы из папки проекта
    var destToDistScrin = gulp.src(paths.scrin)
        
    // Выгрузка в папку dist
    return merge(destToDistScrin)
        .pipe(tiny()) // Ультра-сжатие изображение
        .pipe(gulp.dest(paths.dist.dist));

});

// Сборка
gulp.task('build', gulp.series(
    'clean',
    'sass-style',
    'sass-page',
    'scripts',
    'build-css', 
    'build-fonts', 
    'build-images', 
    'build-favicon', 
    'build-icons',
    'build-jpeg2',
    'build-jpegxr',
    'build-og', 
    'build-svg', 
    'build-webp',
    'build-sprite',
    'build-svg-sprite',
    'build-fc',
    'build-inc',
    'build-js',
    'build-languages',
    'build-layouts',
    'build-template-parts',
    'build-tgm',
    'build-wc',
    'build-php',
    'dest-txt',
    'build-cssProject',
    'build-settings',
    'build-htaccess',
    'build-scrin',

)); 
 
// Команды по умолчанию
gulp.task('default', gulp.parallel('watch', 'sass-style', 'sass-page', 'scripts', 'browser-sync')); 