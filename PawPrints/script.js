/*Side bar*/
let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.side_bar');

    btn.addEventListener('click', function() {
      sidebar.classList.toggle('active');
    });