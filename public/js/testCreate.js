/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/testCreate.js ***!
  \************************************/
 //　 入力フォームの追加・削除

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

{
  var checkAverageScoreForms = function checkAverageScoreForms() {
    var averageScoreForms = document.getElementsByClassName("average");

    for (var _i = 0; _i < averageScoreForms.length; _i++) {
      averageScoreForms[_i].removeEventListener('input', checkFirstDecimal);
    }

    for (var _i2 = 0; _i2 < averageScoreForms.length; _i2++) {
      averageScoreForms[_i2].addEventListener('input', checkFirstDecimal);
    }
  };

  var checkDeviationValueForms = function checkDeviationValueForms() {
    var deviationValueForms = document.getElementsByClassName("deviation");
    console.log(deviationValueForms.length);

    for (var _i3 = 0; _i3 < deviationValueForms.length; _i3++) {
      deviationValueForms[_i3].removeEventListener('input', checkFirstDecimal);

      deviationValueForms[_i3].removeEventListener('input', sliceMaxLength);
    }

    for (var _i4 = 0; _i4 < deviationValueForms.length; _i4++) {
      deviationValueForms[_i4].addEventListener('input', checkFirstDecimal);

      deviationValueForms[_i4].addEventListener('input', sliceMaxLength);
    }
  };

  var checkForms = function checkForms() {
    checkAverageScoreForms();
    checkDeviationValueForms();
  }; // 削除ボタンを削除する


  var hideRemoveButton = function hideRemoveButton() {
    var scoreFormButtons = document.getElementsByClassName('removeFormButton');

    _toConsumableArray(scoreFormButtons).forEach(function (scoreFormButton) {
      scoreFormButton.classList.add('hidden');
    });
  }; // 削除ボタンを表示する


  var appearRemoveButton = function appearRemoveButton() {
    var scoreFormButtons = document.getElementsByClassName('removeFormButton');

    _toConsumableArray(scoreFormButtons).forEach(function (scoreFormButton) {
      scoreFormButton.classList.remove('hidden');
    });
  };

  var hideAddButton = function hideAddButton() {
    var addFormButton = document.getElementById('addForm');
    var unableAddFormButton = document.getElementById('unableAddForm');
    addFormButton.classList.add('hidden');
    unableAddFormButton.classList.remove('hidden');
  };

  var appearAddButton = function appearAddButton() {
    var addFormButton = document.getElementById('addForm');
    var unableAddFormButton = document.getElementById('unableAddForm');
    addFormButton.classList.remove('hidden');
    unableAddFormButton.classList.add('hidden');
  };

  var addForm = function addForm() {
    // 10個以上フォームがあるなら処理を終了
    // TODO:メッセージが出るようにする
    if (i > upperLimit) {
      return true;
    }

    var formTemplate = document.getElementById('form-template');
    var templateScoreForm = formTemplate.content.cloneNode(true);
    var scoreForms = document.getElementById('scoreForms');
    scoreForms.appendChild(templateScoreForm);
    checkForms();
    appearRemoveButton();
    i++;

    if (i >= upperLimit) {
      hideAddButton();
    }
  };

  var addForm_btn = document.getElementById('addForm');
  var removeFormRoots = document.getElementById('scoreForms');
  var upperLimit = 10;
  var i = 1; // フォームのカウンタ変数

  var checkFirstDecimal = function checkFirstDecimal(e) {
    var regex = new RegExp(/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/); // 判定

    if (regex.test(e.target.value) != true) {
      e.target.nextElementSibling.nextElementSibling.classList.add('invalid');
    } else {
      e.target.nextElementSibling.nextElementSibling.classList.remove('invalid');
    }
  };

  ; // 読み込み時に追加

  window.addEventListener('DOMContentLoaded', addForm); // ボタン押下時に追加

  addForm_btn.addEventListener('click', addForm); // HACK:removeを使えば, もっと簡単になる
  // HACK:要素を取得する部分はもっと簡単に書けるのかな?
  // フォームの削除

  removeFormRoots.addEventListener('click', function (e) {
    if (i == 1) {
      return true;
    }

    var x = e.clientX;
    var y = e.clientY;
    var element = document.elementFromPoint(x, y);

    if (!element.classList.contains('removeFormButton')) {
      return true;
    }

    ;
    var targetRemoveForm = element.closest('.scoreForm');
    removeFormRoots.removeChild(targetRemoveForm);
    i--;

    if (i < upperLimit) {
      appearAddButton();
    }

    ;

    if (i == 1) {
      hideRemoveButton();
    }

    ;
  });
}
{
  var onBeforeunloadHandler = function onBeforeunloadHandler(e) {
    e.returnValue = "このページを離れると編集内容が破棄されます。";
  };

  window.addEventListener('beforeunload', onBeforeunloadHandler, false);
  var form = document.getElementById('form');
  form.addEventListener('keydown', function (event) {
    if (event.keyCode === 13) {
      // エンターキーが押されたときの動作
      if (event.srcElement.type != 'submit') {
        // submitボタン、テキストエリア以外の場合はイベントをキャンセル
        return false;
      }
    }
  });
  form.addEventListener('submit', function () {
    // イベントを削除
    window.removeEventListener('beforeunload', onBeforeunloadHandler, false);
  }, false);
}
{// console.log(deviationValueForms);
  // deviationValueForms.forEach(function(deviationValueForm) {
  // console.log('hoge');
  //     deviationValueForm.addEventListener('onchange', function() {
  //     })
  // });
}
/******/ })()
;