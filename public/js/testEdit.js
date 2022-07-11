/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/testEdit.js ***!
  \**********************************/
 //　 入力フォームの追加・削除

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

{
  // 削除ボタンを削除する
  var hideRemoveButton = function hideRemoveButton() {
    var removeFormButtons = document.getElementsByClassName('removeFormButton');

    _toConsumableArray(removeFormButtons).forEach(function (removeFormButton) {
      removeFormButton.classList.add('hidden');
    });
  }; // 削除ボタンを表示する


  var appearRemoveButton = function appearRemoveButton() {
    var removeFormButtons = document.getElementsByClassName('removeFormButton');

    _toConsumableArray(removeFormButtons).forEach(function (removeFormButton) {
      removeFormButton.classList.remove('hidden');
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
    if (i > upperLimit) {
      return true;
    }

    var formTemplate = document.getElementById('form-template');
    var templateScoreForm = formTemplate.content.cloneNode(true);
    var scoreForms = document.getElementById('scoreForms');
    scoreForms.appendChild(templateScoreForm);
    i++;

    if (i > 1) {
      appearRemoveButton();
    }

    if (i >= upperLimit) {
      hideAddButton();
    }
  };

  var addForm_btn = document.getElementById('addForm');
  var removeFormRoots = document.getElementById('scoreForms');
  var scoreForm = document.getElementsByClassName('scoreForm');
  var upperLimit = 10;
  var i = scoreForm.length; // フォームのカウンタ変数

  if (i > 1) {
    appearRemoveButton();
  }

  ;
  ; // ボタン押下時に追加

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
/******/ })()
;