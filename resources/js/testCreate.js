'use strict'

//　 入力フォームの追加・削除
{

    const addForm_btn = document.getElementById('addForm');
    const removeFormRoots = document.getElementById('scoreForms');

    const upperLimit = 10
    let i = 1 // フォームのカウンタ変数

    const checkFirstDecimal = function (e) {
        var regex = new RegExp(/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/);
        // 判定
        if (regex.test(e.target.value) != true) {
            e.target.nextElementSibling.nextElementSibling.classList.add('invalid');
        } else {
            e.target.nextElementSibling.nextElementSibling.classList.remove('invalid');
        }

    }

    function checkAverageScoreForms()
    {
        const averageScoreForms = document.getElementsByClassName("average");

        for(let i=0 ;i<averageScoreForms.length; i++){
            averageScoreForms[i].removeEventListener('input', checkFirstDecimal);
        }

        for(let i=0 ;i<averageScoreForms.length; i++){
            averageScoreForms[i].addEventListener('input', checkFirstDecimal);
        }

    }

    function checkDeviationValueForms()
    {
        const deviationValueForms = document.getElementsByClassName("deviation");
        console.log(deviationValueForms.length);

        for(let i=0 ;i<deviationValueForms.length; i++){
            deviationValueForms[i].removeEventListener('input', checkFirstDecimal);
            deviationValueForms[i].removeEventListener('input', sliceMaxLength);
        }

        for(let i=0 ;i<deviationValueForms.length; i++){
            deviationValueForms[i].addEventListener('input', checkFirstDecimal);
            deviationValueForms[i].addEventListener('input', sliceMaxLength);
        }

    }

    function checkForms() {
        checkAverageScoreForms();
        checkDeviationValueForms();
    }

    // 削除ボタンを削除する
    function hideRemoveButton() {
        const scoreFormButtons =document.getElementsByClassName('removeFormButton');
        [...scoreFormButtons].forEach(scoreFormButton => {
            scoreFormButton.classList.add('hidden');
        });
    }

    // 削除ボタンを表示する
    function appearRemoveButton() {
        const scoreFormButtons =document.getElementsByClassName('removeFormButton');
        [...scoreFormButtons].forEach(scoreFormButton => {
            scoreFormButton.classList.remove('hidden');
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
            // TODO:メッセージが出るようにする
            if(i > upperLimit){
                return true;
            }
            const formTemplate = document.getElementById('form-template');
            const templateScoreForm = formTemplate.content.cloneNode(true);


            const scoreForms = document.getElementById('scoreForms');
            scoreForms.appendChild(templateScoreForm);

            checkForms();
            appearRemoveButton();

            i++;
            if(i >= upperLimit){
                hideAddButton();
            }

    };

    // 読み込み時に追加
    window.addEventListener('DOMContentLoaded',addForm);
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

{

    // console.log(deviationValueForms);

    // deviationValueForms.forEach(function(deviationValueForm) {
    // console.log('hoge');

    //     deviationValueForm.addEventListener('onchange', function() {
    //     })
    // });

}

