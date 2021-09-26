const menuBar = document.getElementById('menu-bar')

const menu = document.querySelector('.menu')

menuBar.addEventListener('click', () => {
  menu.classList.toggle('show')
})