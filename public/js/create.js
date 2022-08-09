let slide_buttons = document.querySelectorAll('.create-list a'),
    slides = document.querySelectorAll('.current-slide-wrap>div'),
    active_btn = document.querySelector('.current-btn'),
    active_slide = document.querySelector('.current-slide');

for(let i = 0; i < slide_buttons.length; i++){
  slide_buttons[i].onclick = (e) => {
    e.preventDefault();
    active_btn.classList.remove('current-btn');
    active_slide.classList.remove('current-slide');
    e.target.classList.add('current-btn');
    slides[i].classList.add('current-slide');

    active_btn = document.querySelector('.current-btn');
    active_slide = document.querySelector('.current-slide');
  }
};