let favourite_button = document.querySelector('.like'),
    favourite_count = favourite_button.querySelector('span'),
    add_favourite_button = document.querySelectorAll('.add-to-favourite'),
    favouriteProduct = [];

showFavNum();
if (localStorage.favouriteProduct !== undefined) {
    favouriteProduct = JSON.parse(localStorage.favouriteProduct);
    showFavNum();
    checkLike();
}

add_favourite_button.forEach(elem => {
    elem.onclick = toggleFav;
});

function toggleFav (e)
{
    e.preventDefault();
    let product = e.target.closest('.product_id');

    if (!product.classList.contains('liked')) {
        product.querySelector('.like svg use').setAttribute('xlink:href', 'img/sprite.svg#like_active');

        if (favouriteProduct.length == 0) {
            favouriteProduct.push(product.getAttribute('data-product-id'));
        } else {
            for (let i = 0; i < favouriteProduct.length; i++) {
                if (favouriteProduct[i] == product.getAttribute('data-product-id')) {
                    break;
                } else if (i == favouriteProduct.length-1) {
                    favouriteProduct.push(product.getAttribute('data-product-id'));
                    break;
                }
            }
        }
    } else {
        product.querySelector('.like svg use').setAttribute('xlink:href', 'img/sprite.svg#like');

        favouriteProduct.splice(favouriteProduct.indexOf(product.getAttribute('data-product-id')), 1);

        if (location.pathname == '/favourite') {
            openfavourite(e);
        }
    }

    product.classList.toggle('liked');
    showFavNum();
    localStorage.favouriteProduct = JSON.stringify(favouriteProduct);
}

favourite_button.onclick = openfavourite;

function openfavourite (e)
{
    e.preventDefault();

    if (favouriteProduct == []) {
        location.href = `${location.origin}/favourite?products=[]`;
    } else {
        location.href = `${location.origin}/favourite?products=${JSON.stringify(favouriteProduct)}`;
    }
}

function checkLike (){
    for (let i = 0; i < favouriteProduct.length; i++) {
        let product = document.querySelector(`.product[data-product-id="${favouriteProduct[i]}"]`);

        if (product == null) {
            return false;
        }

        product.classList.add('liked');

        product.querySelector('.like svg use').setAttribute('xlink:href', 'img/sprite.svg#like_active');
    }
}

function showFavNum ()
{
    favourite_button.querySelector('span').innerText = favouriteProduct.length;
}
