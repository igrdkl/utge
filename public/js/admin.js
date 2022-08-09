// add menu toggle


let drop_btn = document.querySelectorAll(".drop-btn"),
    drop_list = document.querySelectorAll(".drop-list");

for (let i = 0; i < drop_btn.length; i++) {
    drop_btn[i].setAttribute('data-number', i);
    drop_list[i].setAttribute('data-number', i);
}

document.onclick = (e) => {
    changeLang(e);
    drop_btn.forEach(elem => {
        if (e.target == elem || elem.contains(e.target)) {
            e.preventDefault();
            elem.classList.toggle('focus');
            drop_list[elem.getAttribute('data-number')].classList.toggle('hidden');
        } else {
            elem.classList.remove('focus');
            drop_list[elem.getAttribute('data-number')].classList.add('hidden');
        }
    });
}

// chosen list item

let list = document.querySelectorAll(".aside-menu li a"),
selectedItem;

list.forEach((elem) => {

  if (elem.href == location.href) {
      elem.classList.add('selected-item');
      if (elem.closest('.drop-list') != null) {
        elem.closest('.drop-list').closest('li').querySelector('.drop-btn').classList.add('focus');
        elem.closest('.drop-list').classList.remove('hidden');
    }
  }
});


