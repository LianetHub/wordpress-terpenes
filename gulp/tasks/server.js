export const server = (done) => {
    app.plugins.browsersync.init({
        proxy: "http://wordpress-terpenes/",
        notify: false,
        port: 3000,
    });
    done();
};
