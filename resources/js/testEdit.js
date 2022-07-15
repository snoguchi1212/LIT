'use strict'

//　 入力フォームの追加・削除
// HACK:ファイル分割
{
    const startDateForm = document.getElementById('start_date');
    const endDateForm = document.getElementById('end_date');

    const checkDateForm = function (e) {
        const startDateForm = document.getElementById('start_date');
        const endDateForm = document.getElementById('end_date');
        const DateFormErrorMessage = document.getElementById('date_form_error')

        const startDate = startDateForm.value;
        const endDate = endDateForm.value;

        if (startDate <= endDate || startDate == "" || endDate == "") {
            DateFormErrorMessage.classList.add('hidden')
        }
        else {DateFormErrorMessage.classList.remove('hidden')}

    }

    startDateForm.addEventListener('change', checkDateForm);
    endDateForm.addEventListener('change', checkDateForm);

    /**
     * 3桁.1桁の確認->できていなければ, invalid属性をつける
    */
    const checkFirstDecimalAlert = function (e) {
        var regex = new RegExp(/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/);
        // 判定
        if (regex.test(e.target.value) != true) {
            e.target.nextElementSibling.nextElementSibling.classList.add('invalid');
        } else {
            e.target.nextElementSibling.nextElementSibling.classList.remove('invalid');
        }

    }

    /**
     * 3桁.1桁の確認->できていなければ, 文字を消す
    */
    const checkFirstDecimalClear = function (e) {
        var regex = new RegExp(/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/);
        // 判定
        if (regex.test(e.target.value) != true) {
            e.target.value = ""
        } else {
        }

    }

    function checkAverageScoreForms()
    {
        const averageScoreForms = document.getElementsByClassName("average");

        for(let i=0 ;i<averageScoreForms.length; i++){
            averageScoreForms[i].removeEventListener('input', checkFirstDecimalAlert);
            averageScoreForms[i].removeEventListener('change', checkFirstDecimalClear);
        }

        for(let i=0 ;i<averageScoreForms.length; i++){
            averageScoreForms[i].addEventListener('input', checkFirstDecimalAlert);
            averageScoreForms[i].addEventListener('change', checkFirstDecimalClear);
        }

    }

    function checkDeviationValueForms()
    {
        const deviationValueForms = document.getElementsByClassName("deviation");

        for(let i=0 ;i<deviationValueForms.length; i++){
            deviationValueForms[i].removeEventListener('input', checkFirstDecimalAlert);
            deviationValueForms[i].removeEventListener('change', checkFirstDecimalClear);
        }

        for(let i=0 ;i<deviationValueForms.length; i++){
            deviationValueForms[i].addEventListener('input', checkFirstDecimalAlert);
            deviationValueForms[i].addEventListener('change', checkFirstDecimalClear);
        }

    }

    /**
     * 7桁の確認->できていなければ, 文字を消す
    */
    const checkRankingSlice = function (e) {
        var regex = new RegExp(/^[0-9]{0,7}$/);
        // console.log(e.target.value);
        // 判定
        if (regex.test(e.target.value) != true) {
            e.target.value = e.target.value.slice(0, 7)
        } else {
            e.target.value = e.target.value.slice(0, 7)
        }

    }

    function checkRankingForms()
    {
        const rankingForms = document.getElementsByClassName('ranking');

        for(let i=0 ;i<rankingForms.length; i++){
            rankingForms[i].removeEventListener('input', checkRankingSlice);
        }

        for(let i=0 ;i<rankingForms.length; i++){
            rankingForms[i].addEventListener('input', checkRankingSlice);
        }

    }

    /**
     * 7桁の確認->できていなければ, 文字を消す
    */
    const checkScore = function (e) {
        var regex = new RegExp(/^[0-9]{0,4}$/);
        // console.log(e.target.value);
        // 判定
        if (regex.test(e.target.value) != true) {
            e.target.value = e.target.value.slice(0, 4)
        } else {
            e.target.value = e.target.value.slice(0, 4)
        }

    }

    function checkScoreForms()
    {
        const rankingForms = document.getElementsByClassName('score');

        for(let i=0 ;i<rankingForms.length; i++){
            rankingForms[i].removeEventListener('input', checkScore);
        }

        for(let i=0 ;i<rankingForms.length; i++){
            rankingForms[i].addEventListener('input', checkScore);
        }

    }

    function checkForms() {
        checkAverageScoreForms();
        checkDeviationValueForms();
        checkRankingForms();
        checkScoreForms();
    }

    const addForm_btn = document.getElementById('addForm');
    const removeFormRoots = document.getElementById('scoreForms');
    const scoreForm = document.getElementsByClassName('scoreForm');

    const upperLimit = 10
    let i = scoreForm.length // フォームのカウンタ変数

    if(i > 1){appearRemoveButton()};

    // 削除ボタンを削除する
    function hideRemoveButton() {
        const removeFormButtons =document.getElementsByClassName('removeFormButton');
        [...removeFormButtons].forEach(removeFormButton => {
            removeFormButton.classList.add('hidden');
        });
    }

    // 削除ボタンを表示する
    function appearRemoveButton() {
        const removeFormButtons =document.getElementsByClassName('removeFormButton');
        [...removeFormButtons].forEach(removeFormButton => {
            removeFormButton.classList.remove('hidden');
        });
    }

    function hideAddButton() {
        const addFormButton = document.getElementById('addForm');
        const unableAddFormButton = document.getElementById('unableAddForm')

        addFormButton.classList.add('hidden');
        unableAddFormButton.classList.remove('hidden');
    }

    function appearAddButton() {
        const addFormButton = document.getElementById('addForm');
        const unableAddFormButton = document.getElementById('unableAddForm')

        addFormButton.classList.remove('hidden');
        unableAddFormButton.classList.add('hidden');
    }


    function addForm() {
            // 10個以上フォームがあるなら処理を終了
            if(i > upperLimit){
                return true;
            }
            const formTemplate = document.getElementById('form-template');
            const templateScoreForm = formTemplate.content.cloneNode(true);


            const scoreForms = document.getElementById('scoreForms');
            scoreForms.appendChild(templateScoreForm);
            checkForms();
            i++;
            if(i > 1){
                appearRemoveButton();
            }
            if(i >= upperLimit){
                hideAddButton();
            }

    };

    window.addEventListener('DOMContentLoaded',checkForms);

    // ボタン押下時に追加
    addForm_btn.addEventListener('click',addForm);

    // HACK:removeを使えば, もっと簡単になる
    // HACK:要素を取得する部分はもっと簡単に書けるのかな?
    // フォームの削除
    removeFormRoots.addEventListener('click', (e) => {

        if (i == 1) {
            return true;
        }
        let x = e.clientX;
        let y = e.clientY;
        let element = document.elementFromPoint(x, y);
        if (!element.classList.contains('removeFormButton')) {
            return true;
        };

        let targetRemoveForm = element.closest('.scoreForm')
        removeFormRoots.removeChild(targetRemoveForm);
        i--;
        if (i < upperLimit) {appearAddButton()};
        if (i == 1) {hideRemoveButton()};
    });

}

{

    var onBeforeunloadHandler = function(e) {
        e.returnValue = "このページを離れると編集内容が破棄されます。";
    };

    window.addEventListener('beforeunload', onBeforeunloadHandler, false);

    const form = document.getElementById('form');

    form.addEventListener('keydown', function (event) {
        if (event.keyCode === 13) {
          // エンターキーが押されたときの動作
        if (event.srcElement.type != 'submit') {
            // submitボタン、テキストエリア以外の場合はイベントをキャンセル
            return false;
        }
        }
    });

    form.addEventListener('submit', function() {
        // イベントを削除
        window.removeEventListener('beforeunload', onBeforeunloadHandler, false);
    }, false);

}
