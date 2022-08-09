/*Phone Mask*/
let phoneInput1 = document.querySelector("#popup-phone"),
    phoneInput2 = document.querySelector("#registration-phone")

if (phoneInput1 != null) 
{
  phoneInput1.onkeyup = function(){this.value = this.value.replace(/[^\d]/g,'')}
}
if (phoneInput2 != null) 
{
  phoneInput2.onkeyup = function(){this.value = this.value.replace(/[^\d]/g,'')}
}
