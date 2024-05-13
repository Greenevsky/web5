"use strict";

let container = document.querySelector(".content .container .left");
let fullPriceDisplay = document.querySelector("#full-price-display");

let submitOrderButton = document.querySelector("#submit-order-button");

let fullPrice = 0;

submitOrderButton.addEventListener("click", async () => {
    let response = await fetch("../php/submit-order.php", {
        method: "POST",
        body: JSON.stringify({"price": fullPrice})
    });

    var json = await response.json();
    
    if (json["success"]) {
        alert("Заказ оформлен!");

        let response = await fetch("../php/assign-new-cart.php", {
            method: "GET"
        });
        location.reload();
    }
});  

fetch("../php/get-cart-items.php", {
    method: "GET"
}).then(async (response) => {
    let json = await response.json();
    let items = JSON.parse(json["message"]);

    for(let item of items) {
        let keyboardResponse = await fetch("../php/get-keyboard.php", {
            method: "POST",
            body: JSON.stringify({"id": item["Клавиатура"] })
        }); 

        let keyboardResponseJson = await keyboardResponse.json();
        let keyboard = JSON.parse(keyboardResponseJson["message"])

        let element = createCartItemElement(item, keyboard);
        
        container.appendChild(element);

        fullPrice += Number(keyboard["Цена"]);
    }

    fullPriceDisplay.textContent = `Полная стоимость: ${fullPrice} ₽`;
});

function createCartItemElement(cartItem, keyboard) {
    let item = document.createElement("div");
    item.classList.add("item");

    let imageBox = document.createElement("div");
    imageBox.classList.add("image-box");
    imageBox.style.backgroundImage = `url(../images/keyboards/${cartItem["Клавиатура"]}.png)`;
    imageBox.style.backgroundSize = `cover`;
    imageBox.style.backgroundPosition = `center`;

    let infoBox = document.createElement("div");
    infoBox.classList.add("info-box");

    let name = document.createElement("h1");
    name.classList.add("title");
    name.textContent = keyboard["Название"];

    let price = document.createElement("h1");
    price.classList.add("title");
    price.textContent = `${keyboard["Цена"]} ₽`;

    let deleteButton = document.createElement("div");
    deleteButton.classList.add("delete-button");

    addDeleteButtonBehaviour(deleteButton, cartItem["id"], item, keyboard["Цена"]);

    infoBox.appendChild(name);
    infoBox.appendChild(price);

    item.appendChild(imageBox);
    item.appendChild(infoBox);
    item.appendChild(deleteButton);

    return item;
}

function addDeleteButtonBehaviour(button, itemId, itemElement, price) {
    button.addEventListener("click", async () => {
        let response = await fetch("../php/remove-from-cart.php", {
            method: "POST",
            body: JSON.stringify({"id": itemId })
        });

        container.removeChild(itemElement);

        fullPrice -= Number(price);
        fullPriceDisplay.textContent = `Полная стоимость: ${fullPrice} ₽`
    });  
}