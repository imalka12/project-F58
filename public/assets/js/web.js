/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/web.js ***!
  \*****************************/
/**
 * Quick Ads Javascript functions
 *
 * @author Imalka Wijerathna
 */
var alertList = document.querySelectorAll(".notification-alert");
var alerts = [].slice.call(alertList).map(function (element) {
  return new bootstrap.Alert(element);
});
setTimeout(function () {
  var alertNode = document.querySelector(".notification-alert");
  var alert = bootstrap.Alert.getInstance(alertNode);

  if (alert != null) {
    alert.close();
  }
}, 5000);

if (ClassicEditor) {
  ClassicEditor.create(document.querySelector(".ckeditor-editor")).then(function (editor) {
    console.log(editor);
  })["catch"](function (error) {
    console.error(error);
  });
}
/******/ })()
;