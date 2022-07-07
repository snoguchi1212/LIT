'use strict';

{

    const studentTests=document.querySelectorAll('div.studentTest');

    studentTests.forEach(studentTest => {
        studentTest.addEventListener('click', () => {
            studentTest.parentNode.classList.toggle('appear');
        })
    });



}
