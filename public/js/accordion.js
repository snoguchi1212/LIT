/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/accordion.js ***!
  \***********************************/


{
  var studentTests = document.querySelectorAll('div.studentTest');
  console.log(studentTests);
  studentTests.forEach(function (studentTest) {
    console.log(studentTest.parentNode);
    studentTest.addEventListener('click', function () {
      studentTest.parentNode.classList.toggle('appear');
      console.log('clicked');
      console.log(studentTest.parentNode);
    });
  });
}
/******/ })()
;