// let xhr = new XMLHttpRequest();
// function sendAjax (method, requestURL, params = null) {
//     console.log(params);

//     return new Promise ((resolve, reject) => {
//         const xhr = new XMLHttpRequest()
//         xhr.open(method, requestURL)
//         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
//         //  xhr.responseType = "json"
//         xhr.onerror = () => {
//             reject(xhr.response)
//         }
        
//         xhr.onreadystatechange = function (){
//             if (xhr.readyState !== 4) return;// відповідь від сервера
            
//             if (xhr.status !== 200 ) {// перевірка на наявність файлу
//                 console.log(xhr.status + ' ' + xhr.statusText);
//             } else {
//                 resolve(xhr.response)
//             }
//             }
//         xhr.send(params)
//     })
// }