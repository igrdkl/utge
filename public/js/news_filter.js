let form = document.querySelector('#filter'),
    categories = form.querySelectorAll('input[type=radio]'),
    checked_category = form.querySelector('input[checked'),
    all_news = form.querySelector('#all-news');

categories.forEach(elem => {
    if (elem != all_news) {
        elem.onchange = () => {
            form.submit();
        }
    }
});

all_news.onclick = ()=>{
    location.href = `news`;
};
