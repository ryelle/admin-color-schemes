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

function editor() {
  return src("./*/editor.scss")
    .pipe(sass.sync().on("error", sass.logError))
    .pipe(concat("editor.css"))
    .pipe(dest("./"));
}

exports.build = parallel(admin, editor);

exports.default = function () {
  // You can use a single task
  watch("*/colors.scss", admin);
  watch("*/editor.scss", editor);
};
