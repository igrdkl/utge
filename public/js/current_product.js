let product = document.querySelector('#product'),
    productPlus = document.querySelector(".product-plus"),
    productMinus = document.querySelector(".product-minus"),
    productQuantify = document.querySelector(".product-quantify"),
    productPrice = document.querySelector(".general-price span");

setPrice();


productPlus.onclick = prPlus;
productMinus.onclick = prMinus;

function setPrice ()
{
    product.setAttribute('data-price', productPrice.textContent);
}

function prMinus(event)
{
    event.preventDefault();

    if (productQuantify.value > 1) {
        productQuantify.value = productQuantify.value - 1;
        productQuantify.setAttribute("value", productQuantify.value);


        // productPrice.innerHTML = `${parseInt(productPrice.getAttribute("data-product-price")) - parseInt(productPrice.getAttribute("data-product-starting-price"))} грн`
        // productPrice.dataset.productPrice = productPrice.textContent.slice(0, productPrice.textContent.length - 1)
        // totalPriceCount()
    } else {
        return false;
    }
}

function prPlus(event) {
    event.preventDefault();
    // productNumber = this.closest(".product-row").getAttribute("data-product-number")
    // productId = this.closest(".product-row").getAttribute("data-product-id")

    productQuantify.value = parseInt(productQuantify.value) + 1;
    productQuantify.setAttribute("value", productQuantify.value);

    //     storeQuantify (productId, productQuantify.value)

    // productPrice.innerHTML = `${parseInt(productPrice.getAttribute("data-product-starting-price")) + parseInt(productPrice.getAttribute("data-product-price"))} грн`
    // productPrice.dataset.productPrice = productPrice.textContent.slice(0, productPrice.textContent.length - 1)
    // totalPriceCount()
}
