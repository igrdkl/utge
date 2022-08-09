// lang select

document.onclick = (e) => {
  changeLang(e);
}

// admin login on input "admin"

let text = [],
    blank = ['KeyA', 'KeyD', 'KeyM', 'KeyI', 'KeyN'];

document.onkeydown = pressKey;

function pressKey (event)
{
  text.push(event.code);
  checkText();
}

function checkText ()
{
  for (let i = 0; i < text.length; i++) {
    if (text[i] != blank[i]) {
      text = [];
    }
    if (i == blank.length-1 && text[i] == blank[i]) {
      location.href = `${location.origin}/admin`;
    }
  }
}

// burger menu

let burger_btn = document.querySelector('.burger-btn'),
    burger_close = document.querySelector('.close'),
    nav = document.querySelector('nav');


burger_btn.onclick = (e) => {
    e.preventDefault();
    burger_btn.classList.toggle('burger-active');
}

nav.onclick = burgerClose;
burger_close.onclick = burgerClose;

function burgerClose ()
{
    burger_btn.classList.remove('burger-active');
}

