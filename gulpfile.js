const { dest, parallel, src, watch } = require("gulp");
const concat = require("gulp-concat");
const csso = require("gulp-csso");
const rename = require("gulp-rename");
const rtlcss = require("gulp-rtlcss");
const sass = require("gulp-dart-sass");

function admin() {
  return src("./*/colors.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(csso())
    .pipe(dest("./"))
    .pipe(rtlcss())
    .pipe(rename({ suffix: "-rtl" }))
    .pipe(dest("./"));
}

exports.build = parallel(admin);

exports.default = function () {
  watch("*/colors.scss", admin);
};
