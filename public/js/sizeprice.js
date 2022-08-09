let sizeprice = document.querySelector('.size-price'),
    size_price_add_btn = document.querySelector('#add-size-price'),
    size_price_delete_btns = document.querySelectorAll('.size-price-bt-min'),
    counter_input = document.querySelector('#product-counter'),
    auto_value_inuts = [],
    auto_selects = [],
    new_auto_value_inuts,
    new_auto_selects,
    options,
    counter = size_price_delete_btns.length;

size_price_add_btn.onclick = addSizePrice;

size_price_delete_btns.forEach(elem => {
    elem.onclick = deleteSizePrice;
});

// countSizePrices (counter)

function addSizePrice(e)
{
    if (e != null) {
        e.preventDefault();
    }

    counter++;

    countSizePrices (counter);

    counter_input.value = counter;
}

function deleteSizePrice(e)
{
    if (e != null) {
        e.preventDefault();
    }

    if (counter <= 1) {
        alert('Має залишатись хоча б одна грамовка. Щоб видалити її, спочатку додайте нову');
        return false;
    }

    counter--;

    e.target.closest('.size').remove();
    countSizePrices(counter);
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
            auto_value_inuts[i].name = 2;

            if (auto_value_inuts[i].hasChildNodes()) {
                options = auto_value_inuts[i].querySelectorAll('option');
                options.forEach(elem => {
                    if (elem.value == auto_value_inuts[i].value) {
                        elem.setAttribute('selected', 'selected');
                    }
                });
            }
        }
    }

    counter_input.value = counter;
    size_price_delete_btns = document.querySelectorAll('.size-price-bt-min');
    size_price_delete_btns.forEach(elem => {
        elem.onclick = deleteSizePrice;
    });
}



auto_value_inuts.forEach(elem => {
    elem.oninput = (e) => {
        e.target.setAttribute('value', elem.value);
    }
});

