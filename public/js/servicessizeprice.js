let sizeprice = document.querySelector('.size-price'),
    size_price_add_btn = document.querySelector('#add-size-price'),
    size_price_delete_btn = document.querySelector('#delete-size-price'),
    auto_value_inuts = [],
    auto_selects = [],
    new_auto_value_inuts,
    new_auto_selects,
    options,
    counter = 1;

size_price_add_btn.onclick = addSizePrice;
size_price_delete_btn.onclick = deleteSizePrice;

function addSizePrice(e)
{
    if (e != null) {
        e.preventDefault();
    }

    counter++;
    countSizePrices (counter);
}

function deleteSizePrice(e)
{
    if (e != null) {
        e.preventDefault();
    }

    if (counter <= 1) {
        return false;
    }

    counter--;
    countSizePrices (counter);
}

function countSizePrices (counter)
{
    let text = "";
    for (let i = 1; i <= counter; i++) {
        text += getStructure(i);
    }

    auto_value_inuts = document.querySelectorAll('.auto-value');
    sizeprice.innerHTML = text;
    new_auto_value_inuts = document.querySelectorAll('.auto-value');

    for (let i = 0; i < auto_value_inuts.length; i++) {
        if (auto_value_inuts[i].value != "") {
            if (i > new_auto_value_inuts.length-1) {
                break;
            }
            new_auto_value_inuts[i].value = auto_value_inuts[i].value;
        }
    }
}

auto_value_inuts.forEach(elem => {
    elem.oninput = (e) => {
        e.target.setAttribute('value', elem.value);
    }
});
