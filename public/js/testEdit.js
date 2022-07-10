/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/testEdit.js ***!
  \**********************************/


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

{
  // フォームのカウンタ変数
  var hideRemoveButton = function hideRemoveButton() {
    var scoreFormButtons = document.getElementsByClassName('removeFormButton');

    _toConsumableArray(scoreFormButtons).forEach(function (scoreFormButton) {
      scoreFormButton.classList.add('hidden');
    });
  };

  var appearRemoveButton = function appearRemoveButton() {
    var scoreFormButtons = document.getElementsByClassName('removeFormButton');

    _toConsumableArray(scoreFormButtons).forEach(function (scoreFormButton) {
      scoreFormButton.classList.remove('hidden');
    });
  }; // TODO:項目が一つしかないときは, 削除ボタンが表示されないようにする
  // フォームの作成


  var addForm_btn = document.getElementById('addForm');
  var removeFormRoots = document.getElementById('scoreForms');
  var i = 1;
  addForm_btn.addEventListener('click', function () {
    // 8人以上なら処理を終了
    // メッセージが出るようにする
    if (i > 8) {
      return true;
    }

    var scoreForms = document.getElementById('scoreForms');
    var templateScoreForm = scoreForms.childNodes[1];
    var newElement = templateScoreForm.cloneNode(true);
    scoreForms.appendChild(newElement);
    appearRemoveButton();
    i++;
  }); // HACK:removeを使えば, もっと簡単になる
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