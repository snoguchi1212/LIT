/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/testCreate.js ***!
  \************************************/
 //　 入力フォームの追加・削除
// HACK:ファイル分割

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
      averageScoreForms[_i].removeEventListener('input', checkFirstDecimalAlert);

      averageScoreForms[_i].removeEventListener('change', checkFirstDecimalClear);
    }

    for (var _i2 = 0; _i2 < averageScoreForms.length; _i2++) {
      averageScoreForms[_i2].addEventListener('input', checkFirstDecimalAlert);

      averageScoreForms[_i2].addEventListener('change', checkFirstDecimalClear);
    }
  };

  var checkDeviationValueForms = function checkDeviationValueForms() {
    var deviationValueForms = document.getElementsByClassName("deviation");

    for (var _i3 = 0; _i3 < deviationValueForms.length; _i3++) {
      deviationValueForms[_i3].removeEventListener('input', checkFirstDecimalAlert);

      deviationValueForms[_i3].removeEventListener('change', checkFirstDecimalClear);
    }

    for (var _i4 = 0; _i4 < deviationValueForms.length; _i4++) {
      deviationValueForms[_i4].addEventListener('input', checkFirstDecimalAlert);

      deviationValueForms[_i4].addEventListener('change', checkFirstDecimalClear);
    }
  };
  /**
   * 7桁の確認->できていなければ, 文字を消す
  */


  var checkRankingForms = function checkRankingForms() {
    var rankingForms = document.getElementsByClassName('ranking');

    for (var _i5 = 0; _i5 < rankingForms.length; _i5++) {
      rankingForms[_i5].removeEventListener('input', checkRankingSlice);
    }

    for (var _i6 = 0; _i6 < rankingForms.length; _i6++) {
      rankingForms[_i6].addEventListener('input', checkRankingSlice);
    }
  };
  /**
   * 7桁の確認->できていなければ, 文字を消す
  */


  var checkScoreForms = function checkScoreForms() {
    var rankingForms = document.getElementsByClassName('score');

    for (var _i7 = 0; _i7 < rankingForms.length; _i7++) {
      rankingForms[_i7].removeEventListener('input', checkScore);
    }

    for (var _i8 = 0; _i8 < rankingForms.length; _i8++) {
      rankingForms[_i8].addEventListener('input', checkScore);
    }
  };

  var checkForms = function checkForms() {
    checkAverageScoreForms();
    checkDeviationValueForms();
    checkRankingForms();
    checkScoreForms();
  };

  // フォームのカウンタ変数
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
    checkForms();
    i++;

    if (i > 1) {
      appearRemoveButton();
    }

    if (i >= upperLimit) {
      hideAddButton();
    }
  };

  var startDateForm = document.getElementById('start_date');
  var endDateForm = document.getElementById('end_date');

  var checkDateForm = function checkDateForm(e) {
    var startDateForm = document.getElementById('start_date');
    var endDateForm = document.getElementById('end_date');
    var DateFormErrorMessage = document.getElementById('date_form_error');
    var startDate = startDateForm.value;
    var endDate = endDateForm.value;

    if (startDate <= endDate || startDate == "" || endDate == "") {
      DateFormErrorMessage.classList.add('hidden');
    } else {
      DateFormErrorMessage.classList.remove('hidden');
    }
  };

  startDateForm.addEventListener('change', checkDateForm);
  endDateForm.addEventListener('change', checkDateForm);
  /**
   * 3桁.1桁の確認->できていなければ, invalid属性をつける
  */

  var checkFirstDecimalAlert = function checkFirstDecimalAlert(e) {
    var regex = new RegExp(/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/); // 判定

    if (regex.test(e.target.value) != true) {
      e.target.nextElementSibling.nextElementSibling.classList.add('invalid');
    } else {
      e.target.nextElementSibling.nextElementSibling.classList.remove('invalid');
    }
  };
  /**
   * 3桁.1桁の確認->できていなければ, 文字を消す
  */


  var checkFirstDecimalClear = function checkFirstDecimalClear(e) {
    var regex = new RegExp(/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/); // 判定

    if (regex.test(e.target.value) != true) {
      e.target.value = "";
    } else {}
  };

  var checkRankingSlice = function checkRankingSlice(e) {
    var regex = new RegExp(/^[0-9]{0,7}$/); // console.log(e.target.value);
    // 判定

    if (regex.test(e.target.value) != true) {
      e.target.value = e.target.value.slice(0, 7);
    } else {
      e.target.value = e.target.value.slice(0, 7);
    }
  };

  var checkScore = function checkScore(e) {
    var regex = new RegExp(/^[0-9]{0,4}$/); // console.log(e.target.value);
    // 判定

    if (regex.test(e.target.value) != true) {
      e.target.value = e.target.value.slice(0, 4);
    } else {
      e.target.value = e.target.value.slice(0, 4);
    }
  };

  var addForm_btn = document.getElementById('addForm');
  var removeFormRoots = document.getElementById('scoreForms');
  var scoreForm = document.getElementsByClassName('scoreForm');
  var upperLimit = 10;
  var i = scoreForm.length;
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
/******/ })()
;