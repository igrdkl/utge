let change_lang = document.querySelector(".lang-select");

function changeLang (e)
{

    if(e.target == change_lang || change_lang.contains(e.target)) {
        console.log(location.pathname);
        if (location.pathname == '/basket') {
            e.preventDefault();
            alert('Для зміни мови перейдіть на головну сторінку');
            return false;
        }
        if (!document.querySelector(".lang-select").classList.contains('active-select')) {
            e.preventDefault();
        } else if (e.target == document.querySelector(".selected-lang") || document.querySelector(".selected-lang").contains(e.target)) {
            e.preventDefault();
        }

        document.querySelector(".lang-select").classList.toggle('active-select');
    } else {
        document.querySelector(".lang-select").classList.remove('active-select');
    }
}
