'use strict';

{

    const studentTests=document.querySelectorAll('div.studentTest');

    studentTests.forEach(studentTest => {
        studentTest.addEventListener('click', () => {
            studentTest.parentNode.classList.toggle('appear');
        })
    });

    const deleteButtons=document.querySelectorAll('button.delete_btn')

    const deletePost = function (e) {
        let ans = confirm('本当に削除してもいいですか?')


        if (!ans) {return false;}
        document.getElementById('delete_' + e.target.dataset.id).submit();
    }

    deleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener('click',deletePost);
    });

}
