// $('.tip-content').filter('[data-cat="E-Commerce"]').hide();
const buttons = document.querySelectorAll('.navbar__btn')
const cards = document.querySelectorAll('.card')

function filterButtons(e) {
  let targetBtn = e.target.textContent.toLowerCase()
  targetBtn === 'all' ?
    cards.forEach(p => {
      p.classList.contains('hide') ?
        p.classList.remove('hide') : null
    }) :
  cards.forEach(p => {
    p.classList.add('hide')
    p.dataset.filter === targetBtn ?
      p.classList.remove('hide') : null
  })
}


buttons.forEach(function(button) {
  button.addEventListener('click', filterButtons)
})

const list = document.querySelector('.navbar__list');
const btns = list.getElementsByClassName("navbar__btn");
for (let i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
 	let current = document.getElementsByClassName("navbar__btn--active");
  current[0].className = current[0].className.replace("navbar__btn--active", "");
  this.className += " navbar__btn--active";
  });
}