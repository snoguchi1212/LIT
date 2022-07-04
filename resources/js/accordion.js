'use strict';

{

    const studentTests=document.querySelectorAll('div.studentTest');
    console.log(studentTests);

    studentTests.forEach(studentTest => {
        console.log(studentTest.parentNode);
        studentTest.addEventListener('click', () => {
            studentTest.parentNode.classList.toggle('appear');
            console.log('clicked');
            console.log(studentTest.parentNode);
        })
    });



}
