let categories = document.querySelectorAll('.category-item'),
    form = document.querySelector('#filter'),
    sub = document.querySelectorAll('.sub-list input[type=checkbox]'),
    filter_btn = document.querySelector('.filter-btn button'),
    close_bg = document.querySelector('.close-filter-bg'),
    filter_menu = document.querySelector('.filter-menu'),
    close_btn = document.querySelector('.close-btn');

categories.forEach(elem => {
    elem.onclick = (e) => {
        e.target.classList.toggle('checked-category');
    }
});

sub.forEach(elem => {
    elem.onchange = () => {
        form.submit();
    }
});

showCategory ();

function showCategory ()
{
    sub.forEach(elem => {
        if (elem.checked == true) {
            elem.closest('.category-li').querySelector('.category-item').classList.add('checked-category');
        }
    });
}

filter_btn.onclick = () => {
    filter_menu.classList.toggle('active-filter');
};

close_bg.onclick = () => {
    filter_menu.classList.remove('active-filter');
}

close_btn.onclick = () => {
    filter_menu.classList.remove('active-filter');
}

