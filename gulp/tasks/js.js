import webpack from 'webpack-stream'

export const uiJs = () => {
    return app.gulp.src(app.path.src.uiJs, { sourcemaps: app.isDev })
        .pipe(app.plugins.plumber(
            app.plugins.notify.onError({
                title: "JS",
                message: "Error: <%= error.message %>"
            }))
        )
        .pipe(webpack({
            mode: app.isDev ? 'development' : 'production',
            output: {
                filename: 'ui.min.js',
            }
        }))
        .pipe(app.gulp.dest(app.path.build.js))
        .pipe(app.gulp.src(app.path.src.uiJs))
        .pipe(app.gulp.dest(app.path.build.js))
        .pipe(app.plugins.browsersync.stream());
}

export const js = () => {
    return app.gulp.src(app.path.src.js, { sourcemaps: app.isDev })
        .pipe(app.plugins.plumber(
            app.plugins.notify.onError({
                title: "JS",
                message: "Error: <%= error.message %>"
            }))
        )
        .pipe(webpack({
            mode: app.isDev ? 'development' : 'production',
            output: {
                filename: 'app.min.js',
            }
        }))
        .pipe(app.gulp.dest(app.path.build.js))
        .pipe(app.gulp.src(app.path.src.js))
        .pipe(app.gulp.dest(app.path.build.js))
        .pipe(app.plugins.browsersync.stream());
}


export const jsChunks = () => {
    return app.gulp.src(app.path.src.jsChunks)
        .pipe(app.gulp.dest(app.path.build.jsChunks))
}

export const copyJsLibs = () => {
    return app.gulp.src(app.path.src.jsLibs)
        .pipe(app.gulp.dest(app.path.build.jsLibs))
}
