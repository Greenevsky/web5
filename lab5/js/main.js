"use strict";

let valueDisplay = document.querySelector("#counter");
let keyboardWordDisplay = document.querySelector("#keyboard-word");

fetch("../php/get-orders-amount.php", {
    method: "GET"
}).then((response) => {
    response.json().then((json) => {
        if (json["success"]) {
            let value = Number(json["message"]);
            let word = value % 10 == 1
                ? "клавиатура" 
                : value % 10 < 5 
                    ? "клавиатуры"
                    : "клавиатур";

            valueDisplay.textContent = json["message"];
            keyboardWordDisplay.textContent = word;
        }
        else {
            valueDisplay.textContent = ":c";
        }
    });
});