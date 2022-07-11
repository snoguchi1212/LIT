'use strict'
//　 入力フォームの追加・削除
{

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

            i++;
            if(i > 1){
                appearRemoveButton();
            }
            if(i >= upperLimit){
                hideAddButton();
            }

    };

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
