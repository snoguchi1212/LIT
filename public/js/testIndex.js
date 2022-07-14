/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/testIndex.js ***!
  \***********************************/


{
  var studentTests = document.querySelectorAll('div.studentTest');
  studentTests.forEach(function (studentTest) {
    studentTest.addEventListener('click', function () {
      studentTest.parentNode.classList.toggle('appear');
    });
  });
  var deleteButtons = document.querySelectorAll('button.delete_btn');

  var deletePost = function deletePost(e) {
    var ans = confirm('本当に削除してもいいですか?');

    if (!ans) {
      return false;
    }

    document.getElementById('delete_' + e.target.dataset.id).submit();
  };

  deleteButtons.forEach(function (deleteButton) {
    deleteButton.addEventListener('click', deletePost);
  });
}
/******/ })()
;