window.onload = () => {
    let productPlus = document.querySelectorAll('.product-plus'),
        productMinus = document.querySelectorAll('.product-minus'),
        productQuantify = document.querySelectorAll('.product-quantify'),
        productPrice = document.querySelectorAll('.basket-price'),
        deleteProduct = document.querySelectorAll('.delete-product'),
        generalPrice = document.querySelectorAll('.general-price'),
        generalQuantify = document.querySelector('.general-quantify'),
        helperProductMass = [];

    firstLoad();

    productPlus.forEach(element => {
        element.onclick = () => { quantifyCounter(element); }
    });

    productMinus.forEach(element => {
        element.onclick = () => { quantifyCounter(element); }
    });

    productQuantify.forEach(element => {
        element.oninput = () => { quantifyCounter(element); }
    });

    function firstLoad() {
        checkingBasketIsEmpty();

        document.querySelectorAll('.product-row').forEach((element, i) => {
            element.setAttribute('data-product-number', i);
            quantifyInput = element.querySelector('.product-quantify').value;
            defaultPrice = element.querySelector('.default-price');
            productPrice = element.querySelector('.basket-price');

            productPrice.innerHTML = defaultPrice.value * quantifyInput + ' грн';
        });

        generalCounter();
    }

    function quantifyCounter (element)
    {
        event.preventDefault();
        product = element.closest('.product-row');
        quantifyInput = product.querySelector('.product-quantify');


        if (element.classList.contains('product-minus') && quantifyInput.value > 1)
        {
            quantifyInput.value --;
        }

        if (element.classList.contains('product-quantify'))
        {
            quantifyInput.value = quantifyInput.value
        }

        if (element.classList.contains('product-plus'))
        {
            quantifyInput.value++;
        }

        priceCounter(quantifyInput.value, product);
        generalCounter();
        pushToLocalStorage();
    }

    function priceCounter (productQuantify, parent)
    {
        defaultPrice = parent.querySelector('.default-price');
        productPrice = parent.querySelector('.basket-price');

        productPrice.innerHTML = defaultPrice.value * productQuantify + ' грн';
    }

    function generalCounter() {
        totalQuantify = 0,
        totalPrice = 0;

        document.querySelectorAll('.product-quantify').forEach(e => {
            totalQuantify += Number(e.value);
        });

        document.querySelectorAll('.basket-price').forEach(e => {
            totalPrice += Number(e.textContent.split(' ')[0]);
        });

        generalQuantify.innerHTML = totalQuantify + ' шт';

        generalPrice.forEach(element => {
            element.innerHTML = totalPrice + ' грн';
        });
    }

    deleteProduct.forEach((elem) => {
        elem.onclick = (event) => {
            event.preventDefault()

            basketProducts = JSON.parse(localStorage.basketProduct)

            for (let i = 0; i < basketProducts.length; i++){
                if (event.target.closest('.product-row').getAttribute('data-product-id') == basketProducts[i]['id']) {
                    basketProducts.splice(i, 1)
                    break
                }
            }

            localStorage.basketProduct = JSON.stringify(basketProducts)

            elem.closest('.product-row').remove();
            document.querySelectorAll('.product-tr')[elem.closest('.product-row').getAttribute('data-product-number')].remove();

            document.querySelectorAll('.product-row').forEach((productRow, i) => {
                productRow.setAttribute('data-product-number', i);
                console.log(i);
            });

            showBasketNum();
            checkingBasketIsEmpty();
            generalCounter();
        }
    });

    function pushToLocalStorage() {
        productsMass = [];
        helperProductMass = [];

        products = document.querySelectorAll('.product-row');

        products.forEach(element => {

            productsMass.push({
                id: element.getAttribute('data-product-id'),
                quantify:  element.querySelector('.product-quantify').value,
                size:  element.querySelector('.default-size').value,
            });

            helperProductMass.push({
                id: element.getAttribute('data-product-id'),
                quantify:  element.querySelector('.product-quantify').value,
                size:  element.querySelector('.default-size').value,
                price:  element.querySelector('.basket-price').textContent.split(' ')[0],
            });
        });

        localStorageBasket = JSON.parse(localStorage.basketProduct)

        localStorageBasket.forEach((e, i) => {
            if (e['id'] == productsMass[i]['id'] && e['size'] == productsMass[i]['size'])
            {
                e['quantify'] = productsMass[i]['quantify'];
            }
        });

        localStorage.basketProduct = JSON.stringify(localStorageBasket)
    }



    document.querySelector('#to-order-btn').onclick = function (){
        pushToLocalStorage();

        document.querySelector('.basket-table').style.display = 'none';
        document.querySelector('.placing-an-order').style.display = 'block';

        let products = [];
        basketProducts = JSON.parse(localStorage.basketProduct);

        if (basketProducts != []) {
            for (let i = 0; i < basketProducts.length; i++) {
                products.push([basketProducts[i]['id'], basketProducts[i]['quantify'], basketProducts[i]['size'], basketProducts[i]['price']]);
            }
        }
        document.querySelector('#products').value = JSON.stringify(products);

        document.querySelectorAll('.product-tr').forEach((element, i) => {
            if (element.getAttribute('data-product-id') == helperProductMass[i]['id']) {
                element.querySelector('.product-quantify-order').innerHTML = helperProductMass[i]['quantify'] + 'шт';
                element.querySelector('.product-price-order').innerHTML = helperProductMass[i]['price'] + 'грн';
            }
        });
    }

    function showBasketNum ()
    {
        basket_button.querySelector('span').innerText = JSON.parse(localStorage.basketProduct).length;
    }
    // ------------------------
    // delivery block
    // ------------------------

    let selfDelivery = document.querySelector('.self_delivery'),
        adressDelivery = document.querySelectorAll('.adress_delivery'),
        postDelivery = document.querySelectorAll('.post_delivery'),
        selfDeliveryLabel = document.querySelector('.self_delivery_label'),
        postDeliveryLabel = document.querySelector('.post_delivery_label'),
        adressDeliveryLabel = document.querySelector('.adress_delivery_label');
        accordingTariffs = document.querySelector('.accordingTariffs-p');
        freeDelivery = document.querySelector('.freeDelivery-p');


    selfDelivery.onclick = () => {
        selfDeliveryLabel.style.display = 'none';
        selfDeliveryLabel.querySelector('input').removeAttribute('required');
        accordingTariffs.style.display = 'none';
        freeDelivery.style.display = 'block';

    };

    adressDelivery.forEach(element => {
        element.onclick = () => {
            selfDeliveryLabel.style.display = 'block';
            selfDeliveryLabel.querySelector('input').setAttribute('required', '');
            postDeliveryLabel.style.display = 'none';
            adressDeliveryLabel.style.display = 'inline-block';
            accordingTariffs.style.display = 'block';
            freeDelivery.style.display = 'none';
        };
    });

    postDelivery.forEach(element => {

        element.onclick = () => {
            selfDeliveryLabel.style.display = 'block';
            selfDeliveryLabel.querySelector('input').setAttribute('required', '');
            postDeliveryLabel.style.display = 'inline-block';
            adressDeliveryLabel.style.display = 'none';
            accordingTariffs.style.display = 'block';
            freeDelivery.style.display = 'none';
        };
    });

    // ------------------------
    // end delivery block
    // ------------------------

    function checkingBasketIsEmpty() {
        if (localStorage.basketProduct == undefined || JSON.parse(localStorage.basketProduct).length == 0)
        {
            document.querySelector('.basket-empty-popup').style.display = 'flex';
        }
        else
        {
            document.querySelector('.basket-empty-popup').style.display = 'none';
        }
    }
}
