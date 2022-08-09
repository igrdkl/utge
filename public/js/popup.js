let popupBtn = document.querySelector('#popupBtn'),
    popupCloseBtn = document.querySelector('.close-popup-btn'),
    popupCloseBox = document.querySelector('#popupCloseBox'),
    popupBox = document.querySelector('#popupBox'),
    popup = document.querySelector('#popup'),
    oldPosition = 0,
    check = false;


popupBtn.onclick = function (e) {
    if (popupBtn.classList.contains('send-order-btn')) {
        document.querySelectorAll('input[type=text][required]').forEach(elem => {
            if (elem.value == '') {
                check = true;
            }
        });
    } else {
        popupBox.style.display = 'flex';
    }
}

popupCloseBox.onclick = closePopup;
if (popupCloseBtn != null) {
    popupCloseBtn.onclick = closePopup;
}

function closePopup() {
    popupBox.style.display =  'none';
}
