'use strict'
{

    const addForm_btn = document.getElementById('addForm');
    const removeFormRoots = document.getElementById('scoreForms');

    let i = 1 // フォームのカウンタ変数

    function hideRemoveButton() {
        const scoreFormButtons =document.getElementsByClassName('removeFormButton');
        [...scoreFormButtons].forEach(scoreFormButton => {
            scoreFormButton.classList.add('hidden');
        });
    }

    function appearRemoveButton() {
        const scoreFormButtons =document.getElementsByClassName('removeFormButton');
        [...scoreFormButtons].forEach(scoreFormButton => {
            scoreFormButton.classList.remove('hidden');
        });
    }

    // TODO:項目が一つしかないときは, 削除ボタンが表示されないようにする
    // フォームの作成
    addForm_btn.addEventListener('click', () => {
        // 8人以上なら処理を終了
        // メッセージが出るようにする

        if(i > 8){
            return true;
        }
        const scoreForms = document.getElementById('scoreForms');
        const templateScoreForm = scoreForms.childNodes[1];

        const newElement = templateScoreForm.cloneNode(true);
        scoreForms.appendChild(newElement);

        appearRemoveButton();

        i++;
    });


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

        if (i == 1) {hideRemoveButton()};
    });

}
