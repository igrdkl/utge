window.onload = function (){
  let buttons_uk = document.querySelectorAll("#editControls1 a"),
      editor_uk = document.querySelector("#editor1"),
      code_uk = document.querySelector("#desc_uk"),
      buttons_ru = document.querySelectorAll("#editControls2 a"),
      editor_ru = document.querySelector("#editor2"),
      code_ru = document.querySelector("#desc_ru")
  
  buttons_uk.forEach(item => {
    item.onclick = function(e) {
      e.preventDefault()

      switch(this.getAttribute("data-role")) {
        case "h1":
        case "h2":
        case "h3":
        case "p":
          document.execCommand("formatBlock", false, this.getAttribute("data-role"))
          break
        case "switchEditor":
          if(getComputedStyle(code_uk).display == "none"){
            code_uk.style.display = "block"
            editor_uk.style.display = "none"
            code_uk.value = editor_uk.innerHTML.trim()
          } else {
            code_uk.style.display = "none"
            editor_uk.style.display = "block"
            editor_uk.innerHTML = code_uk.value
          }
          break
        case "insertTable":
          let rows = prompt("How many rows?"),
              cells = prompt("How many cells?"),
              table = "<div class='adaptive-table'><table>",
              cellsCount
          while (rows != 0) {
            cellsCount = cells
            table += "<tr>"
            while (cellsCount != 0) {
              table += "<td>&nbsp;</td>"
              cellsCount--
            }
            table += "</tr>"
            rows--
          }
          table += "</table></div>"
          document.execCommand("insertHTML", false, table);
          break
        case "createlink":
        case "insertimage":
          let url = prompt('Enter the link here: ', 'http:\/\/');
          document.execCommand(this.getAttribute("data-role"), false, url);
          break
        default:
          document.execCommand(this.getAttribute("data-role"), false, null)
          break
      }
    }
  })

  buttons_ru.forEach(item => {
    item.onclick = function(e) {
      e.preventDefault()

      switch(this.getAttribute("data-role")) {
        case "h1":
        case "h2":
        case "h3":
        case "p":
          document.execCommand("formatBlock", false, this.getAttribute("data-role"))
          break
        case "switchEditor":
          if(getComputedStyle(code_ru).display == "none"){
            code_ru.style.display = "block"
            editor_ru.style.display = "none"
            code_ru.value = editor_ru.innerHTML.trim()
          } else {
            code_ru.style.display = "none"
            editor_ru.style.display = "block"
            editor_ru.innerHTML = code_ru.value
          }
          break
        case "insertTable":
          let rows = prompt("Скільки рядів?"),
              cells = prompt("Скільки клітинок?"),
              table = "<div class='adaptive-table'><table>",
              cellsCount
          while (rows != 0) {
            cellsCount = cells
            table += "<tr>"
            while (cellsCount != 0) {
              table += "<td>&nbsp;</td>"
              cellsCount--
            }
            table += "</tr>"
            rows--
          }
          table += "</table></div>"
          document.execCommand("insertHTML", false, table);
          break
        case "createlink":
        case "insertimage":
          let url = prompt('Enter the link here: ', 'http:\/\/');
          document.execCommand(this.getAttribute("data-role"), false, url);
          break
        default:
          document.execCommand(this.getAttribute("data-role"), false, null)
          break
      }
    }
  })
}

// save textarea value

document.querySelector('#save-btn').onclick = function(e){
  document.querySelector("#converToCode1").click();    
  document.querySelector("#converToCode2").click();    
}