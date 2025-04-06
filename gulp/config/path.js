import * as nodePath from 'path';
const rootFolder = nodePath.basename(nodePath.resolve());

const buildFolder = `./assets`;
const srcFolder = `./src`;

export const path = {
	build: {
		files: `${buildFolder}/files/`,
		html: `${buildFolder}/`,
		css: `${buildFolder}/css/`,
		cssLibs: `${buildFolder}/css/libs/`,
		normalize: `${buildFolder}/css/`,
		js: `${buildFolder}/js/`,
		jsLibs: `${buildFolder}/js/libs/`,
		jsChunks: `${buildFolder}/js/`,
		images: `${buildFolder}/img/`,
		favicon: `${buildFolder}/`,
		fonts: `${buildFolder}/fonts/`,
		json: `${buildFolder}/json/`,
	},
	src: {
		files: `${srcFolder}/files/**/*.*`,
		html: `${srcFolder}/*.html`,
		scss: `${srcFolder}/scss/style.scss`,
		cssLibs: `${srcFolder}/scss/libs/**/*.*`,
		normalize: `${srcFolder}/scss/reset.scss`,
		favicon: `${srcFolder}/fav/**/*`,
		js: `${srcFolder}/js/app.js`,
		uiJs: `${srcFolder}/js/ui.js`,
		jsLibs: `${srcFolder}/js/libs/**/*.*`,
		jsChunks: `${srcFolder}/js/chunks/**/*.*`,
		images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp}`,
		svg: `${srcFolder}/img/**/*.svg`,
		json: `${srcFolder}/json/*.*`,

	},
	watch: {
		files: `${srcFolder}/files/**/*.*`,
		html: `${srcFolder}/**/*.html`,
		scss: `${srcFolder}/scss/**/*.scss`,
		normalize: `${srcFolder}/scss/reset.scss`,
		js: `${srcFolder}/js/**/*.js`,
		images: `${srcFolder}/img/**/*.{jpg,jpeg,png,svg,gif,ico,webp}`,
		json: `${srcFolder}/json/*.*`,
		fonts: `${srcFolder}/fonts/*.{ttf,otf,woff,woff2}`,
		php: `**/*.php`,
	},
	clean: buildFolder,
	srcFolder: srcFolder,
	rootFolder: rootFolder,
	ftp: ``
}