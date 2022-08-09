// child page select

    document.querySelector('#child-page-select').addEventListener('mouseenter', e => {
        document.querySelector('#child-page-first-option').disabled = true;
        document.querySelector('#child-page-first-option').style.visibility = 'hidden';
    });

    document.querySelector('#child-page-select').addEventListener('mouseleave', e => {
        document.querySelector('#child-page-first-option').disabled = false;
        document.querySelector('#child-page-first-option').style.visibility = 'visible';
    });

// photo and desckription show
     //image block
     document.querySelector('.img-box').style.display = 'none';
     document.querySelector('.img-box-none').style.display = 'block';
     document.querySelector('.this-block-img').style.display = 'none';
     document.querySelector('.choose-block-img').style.display = 'block';
     
     document.querySelectorAll('.img-input').forEach(e => {
         e.name = 'imageFalse';
     });

     //description block
     document.querySelector('.desc-box-none').style.display = 'block';
     document.querySelector('.this-block-desc').style.display = 'none';
     document.querySelector('.choose-block-desc').style.display = 'block';
     
     document.querySelectorAll('.desc-box').forEach(e => {
         e.style.display = 'none';
     });
     document.querySelector('.desc-input-uk').name = 'descriptionFalse';
        document.querySelector('.desc-input-ru').name = 'descriptionFalse';

     //name block
     document.querySelector('.name-box-none').style.display = 'block';
     document.querySelector('.this-block-name').style.display = 'none';
     document.querySelector('.choose-block-name').style.display = 'block';
     
     document.querySelectorAll('.name-box').forEach(e => {
         e.style.display = 'none';
     });

    document.querySelector('.name-input-uk').name = 'titleFasle';
    document.querySelector('.name-input-ru').name = 'titleFasle';

    //phone block
    document.querySelector('.phone-box').style.display = 'none';
    document.querySelector('.phone-input').name = 'phoneFasle';

    //email block
    document.querySelector('.email-box').style.display = 'none';
    document.querySelector('.email-input').name = 'emailFalse';

    document.querySelector('#child-page-select').oninput = function(e){
        
    switch (document.querySelector('#child-page-select').value) {
        case 'phone':
            //image block
            document.querySelector('.img-box').style.display = 'none';
            document.querySelector('.img-box-none').style.display = 'block';
            document.querySelector('.this-block-img').style.display = 'block';
            document.querySelector('.choose-block-img').style.display = 'none';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'imageFalse';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'block';
            document.querySelector('.this-block-desc').style.display = 'block';
            document.querySelector('.choose-block-desc').style.display = 'none';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.desc-input-uk').name = 'descriptionFalse';
            document.querySelector('.desc-input-ru').name = 'descriptionFalse';
            

            //name block
            document.querySelector('.name-box-none').style.display = 'block';
            document.querySelector('.this-block-name').style.display = 'block';
            document.querySelector('.choose-block-name').style.display = 'none';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.name-input-uk').name = 'titleFalse';
            document.querySelector('.name-input-ru').name = 'titleFalse';

            //phone block
            document.querySelector('.phone-box').style.display = 'block';
            document.querySelector('.phone-input').name = 'phone';

            //email block
            document.querySelector('.email-box').style.display = 'none';
            document.querySelector('.email-input').name = 'emailFalse';
            break;
        
        case 'logo-img':
            //image block
            document.querySelector('.img-box').style.display = 'block';
            document.querySelector('.img-box-none').style.display = 'none';
            document.querySelector('.this-block-img').style.display = 'none';
            document.querySelector('.choose-block-img').style.display = 'none';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'image';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'block';
            document.querySelector('.this-block-desc').style.display = 'block';
            document.querySelector('.choose-block-desc').style.display = 'none';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.desc-input-uk').name = 'descriptionFalse';
            document.querySelector('.desc-input-ru').name = 'descriptionFalse';
            

            //name block
            document.querySelector('.name-box-none').style.display = 'block';
            document.querySelector('.this-block-name').style.display = 'block';
            document.querySelector('.choose-block-name').style.display = 'none';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.name-input-uk').name = 'titleFalse';
            document.querySelector('.name-input-ru').name = 'titleFalse';

            //phone block
            document.querySelector('.phone-box').style.display = 'none';
            document.querySelector('.phone-input').name = 'phoneFasle';

            //email block
            document.querySelector('.email-box').style.display = 'none';
            document.querySelector('.email-input').name = 'emailFalse';
            break;

        case 'logo-name':
        case 'footer-place':
            //image block
            document.querySelector('.img-box').style.display = 'none';
            document.querySelector('.img-box-none').style.display = 'block';
            document.querySelector('.this-block-img').style.display = 'block';
            document.querySelector('.choose-block-img').style.display = 'none';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'imageFalse';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'block';
            document.querySelector('.this-block-desc').style.display = 'block';
            document.querySelector('.choose-block-desc').style.display = 'none';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.desc-input-uk').name = 'descriptionFalse';
            document.querySelector('.desc-input-ru').name = 'descriptionFalse';
            

            //name block
            document.querySelector('.name-box-none').style.display = 'none';
            document.querySelector('.this-block-name').style.display = 'none';
            document.querySelector('.choose-block-name').style.display = 'none';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'block';
            });

            document.querySelector('.name-input-uk').name = 'title_uk';
            document.querySelector('.name-input-ru').name = 'title_ru';

            //phone block
            document.querySelector('.phone-box').style.display = 'none';
            document.querySelector('.phone-input').name = 'phoneFalse';

            //email block
            document.querySelector('.email-box').style.display = 'none';
            document.querySelector('.email-input').name = 'emailFalse';
            break;

        case 'email':
            //image block
            document.querySelector('.img-box').style.display = 'none';
            document.querySelector('.img-box-none').style.display = 'block';
            document.querySelector('.this-block-img').style.display = 'block';
            document.querySelector('.choose-block-img').style.display = 'none';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'imageFalse';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'block';
            document.querySelector('.this-block-desc').style.display = 'block';
            document.querySelector('.choose-block-desc').style.display = 'none';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.desc-input-uk').name = 'descriptionFalse';
            document.querySelector('.desc-input-ru').name = 'descriptionFalse';
            

            //name block
            document.querySelector('.name-box-none').style.display = 'block';
            document.querySelector('.this-block-name').style.display = 'block';
            document.querySelector('.choose-block-name').style.display = 'none';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'none';
            });

            document.querySelector('.name-input-uk').name = 'titleFalse';
            document.querySelector('.name-input-ru').name = 'titleFalse';

            //phone block
            document.querySelector('.phone-box').style.display = 'none';
            document.querySelector('.phone-input').name = 'phoneFalse';

            //email block
            document.querySelector('.email-box').style.display = 'block';
            document.querySelector('.email-input').name = 'email';
            break;

        case 'about_us':
            //image block
            document.querySelector('.img-box').style.display = 'none';
            document.querySelector('.img-box-none').style.display = 'block';
            document.querySelector('.this-block-img').style.display = 'block';
            document.querySelector('.choose-block-img').style.display = 'none';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'imageFalse';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'none';
            document.querySelector('.this-block-desc').style.display = 'none';
            document.querySelector('.choose-block-desc').style.display = 'none';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'block';
            });

            document.querySelector('.desc-input-uk').name = 'description_uk';
            document.querySelector('.desc-input-ru').name = 'description_ru';

            //name block
            document.querySelector('.name-box-none').style.display = 'none';
            document.querySelector('.this-block-name').style.display = 'none';
            document.querySelector('.choose-block-name').style.display = 'none';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'block';
            });
            
            document.querySelector('.name-input-uk').name = 'title_uk';
            document.querySelector('.name-input-ru').name = 'title_ru';

            //phone block
            document.querySelector('.phone-box').style.display = 'none';
            document.querySelector('.phone-input').name = 'phoneFalse';

            //email block
            document.querySelector('.email-box').style.display = 'none';
            document.querySelector('.email-input').name = 'emailFalse';
            break;

        case 'payment':
        case 'delivery':
        case 'contacts': 
            //image block
            document.querySelector('.img-box').style.display = 'block';
            document.querySelector('.img-box-none').style.display = 'none';
            document.querySelector('.this-block-img').style.display = 'none';
            document.querySelector('.choose-block-img').style.display = 'none';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'image';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'none';
            document.querySelector('.this-block-desc').style.display = 'none';
            document.querySelector('.choose-block-desc').style.display = 'none';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'block';
            });

            document.querySelector('.desc-input-uk').name = 'description_uk';
            document.querySelector('.desc-input-ru').name = 'description_ru';

            //name block
            document.querySelector('.name-box-none').style.display = 'none';
            document.querySelector('.this-block-name').style.display = 'none';
            document.querySelector('.choose-block-name').style.display = 'none';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'block';
            });
            
            document.querySelector('.name-input-uk').name = 'title_uk';
            document.querySelector('.name-input-ru').name = 'title_ru';

            //phone block
            document.querySelector('.phone-box').style.display = 'none';
            document.querySelector('.phone-input').name = 'phoneFalse';

            //email block
            document.querySelector('.email-box').style.display = 'none';
            document.querySelector('.email-input').name = 'emailFalse';
            break;
    
        default:
            //image block
            document.querySelector('.img-box').style.display = 'none';
            document.querySelector('.img-box-none').style.display = 'block';
            document.querySelector('.this-block-img').style.display = 'none';
            document.querySelector('.choose-block-img').style.display = 'block';
            
            document.querySelectorAll('.img-input').forEach(e => {
                e.name = 'imageFalse';
            });

            //description block
            document.querySelector('.desc-box-none').style.display = 'block';
            document.querySelector('.this-block-desc').style.display = 'none';
            document.querySelector('.choose-block-desc').style.display = 'block';
            
            document.querySelectorAll('.desc-box').forEach(e => {
                e.style.display = 'none';
            });
            document.querySelectorAll('.desc-input').forEach(e => {
                e.name = 'descriptionFalse';
            });

            //name block
            document.querySelector('.name-box-none').style.display = 'block';
            document.querySelector('.this-block-name').style.display = 'none';
            document.querySelector('.choose-block-name').style.display = 'block';
            
            document.querySelectorAll('.name-box').forEach(e => {
                e.style.display = 'none';
            });
            document.querySelectorAll('.name-input').forEach(e => {
                e.name = 'nameFalse';
            });

            //phone block
            document.querySelector('.phone-box').style.display = 'none';
            document.querySelector('.phone-input').name = 'phoneFasle';

            //email block
            document.querySelector('.email-box').style.display = 'none';
            document.querySelector('.email-input').name = 'emailFalse';
            
            break;
    }

}


// phone mask
    window.addEventListener("DOMContentLoaded", function() {
        [].forEach.call( document.querySelectorAll('.phone-input'), function(input) {
            let keyCode;
            document.querySelector('.phone-input').value = '+38 (';
            function mask(event) {
                event.keyCode && (keyCode = event.keyCode);
                let pos = this.selectionStart;
                if (pos < 3) event.preventDefault();
                let matrix = "+38 (___) ___ __ __",
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = this.value.replace(/\D/g, ""),
                    new_value = matrix.replace(/[_\d]/g, function(a) {
                        return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                    });
                i = new_value.indexOf("_");
                if (i != -1) {
                    i < 5 && (i = 3);
                    new_value = new_value.slice(0, i)
                }
                let reg = matrix.substr(0, this.value.length).replace(/_+/g,
                    function(a) {
                        return "\\d{1," + a.length + "}"
                    }).replace(/[+()]/g, "\\$&");
                reg = new RegExp("^" + reg + "$");
                if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                if (event.type == "blur" && this.value.length < 5)  this.value = "";
            }

            input.addEventListener("input", mask, false);
            input.addEventListener("focus", mask, false);
            input.addEventListener("blur", mask, false);
            input.addEventListener("keydown", mask, false)
        });
    });