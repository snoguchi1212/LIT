/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/accordion.js ***!
  \***********************************/


{
  var studentTests = document.querySelectorAll('div.studentTest');
  studentTests.forEach(function (studentTest) {
    studentTest.addEventListener('click', function () {
      studentTest.parentNode.classList.toggle('appear');
    });
  });
}
/******/ })()
;