let basket_button = document.querySelector('.basket'),
    basket_count = basket_button.querySelector('span'),
    add_button = document.querySelectorAll('.add-to-basket')
    basketProduct = [],
    pr_weight = 0,
    pr_price = 0,
    quantify = 1;


showBasketNum();
if (localStorage.basketProduct !== undefined) {
    basketProduct = JSON.parse(localStorage.basketProduct);
    showBasketNum();
}

add_button.forEach(elem => {
    elem.onclick = addToBasket;
});

function addToBasket (e)
{
    e.preventDefault();
    let product = e.target.closest('.product_id');

    if (product.classList.contains('not_available') || product.classList.contains('waiting_available')) {
        return false;
    }

    pr_weight = product.querySelector('.active-size').textContent;
    pr_price = product.querySelector('.active-price').textContent;

    if (product.querySelector('.product-quantify') != null){
        quantify = +product.querySelector('.product-quantify').value;
    }

    if (basketProduct.length == 0) {
        basketProduct.push({id: product.getAttribute('data-product-id'), quantify: Number(quantify), size: pr_weight, price: pr_price});
    } else {
        for (let i = 0; i < basketProduct.length; i++) {

            if (basketProduct[i]['id'] == product.getAttribute('data-product-id') && basketProduct[i]['size'] == pr_weight) {
                basketProduct[i]['quantify']+=Number(quantify);
                break;
            } else if (i == basketProduct.length-1) {
                basketProduct.push({id: product.getAttribute('data-product-id'), quantify: Number(quantify), size: pr_weight, price: pr_price});
                break;
            }
        }
    }

    showBasketNum();
    showAddBasketPopup();
    product.querySelector('.add-to-basket').classList.add('active-add-to-basket');
    setTimeout(() => {
        product.querySelector('.add-to-basket').classList.remove('active-add-to-basket');
    }, 3000);
    localStorage.basketProduct = JSON.stringify(basketProduct);
}

basket_button.onclick = openBasket;

function openBasket (e)
{
    let products = [];

    if (basketProduct != []) {
        for (let i = 0; i < basketProduct.length; i++) {
            products.push([basketProduct[i]['id'], basketProduct[i]['quantify'], basketProduct[i]['size'], basketProduct[i]['price']]);
        }
    } else {
        products = [''];
    }
    document.querySelector('#basket_products').value = JSON.stringify(products);
}

function showBasketNum ()
{
    basket_button.querySelector('span').innerText = basketProduct.length;
}

function showAddBasketPopup ()
{
    document.querySelector('.add-to-basket-popup').style.display = 'block';

    setTimeout(closeAddBasketPopup, 3000);
}

function closeAddBasketPopup ()
{
    document.querySelector('.add-to-basket-popup').style.display = 'none';

}

if (document.querySelector('.close-basket-popup-btn') != null)
{
    document.querySelector('.close-basket-popup-btn').onclick = () => { closeAddBasketPopup(); }
}
