"use strict";

let container = document.querySelector(".content .items-container");

let searchBarInput = document.querySelector(".search-bar-input");
let searchBarButton = document.querySelector(".search-bar-button");
let filterTypeInput = document.querySelector(".filter-type-selection");

fetch("../php/get-shop-items.php", {
    method: "GET"
}).then((response) => {
    response.json().then((json) => {
        let items = JSON.parse(json["message"]);

        for(let item of items) {
            var element = createShopItemElement(item);
            
            container.appendChild(element);
        }
    });
});

searchBarButton.addEventListener("click", async () => {
    let response = await fetch("../php/get-shop-items.php", {
        method: "POST",
        body: JSON.stringify({
            "value": searchBarInput.value,
            "filter": filterTypeInput.value
        })
    });

    let json = await response.json();

    container.innerHTML = "";

    let items = JSON.parse(json["message"]);

    for(let item of items) {
        var element = createShopItemElement(item);
        
        container.appendChild(element);
    }
});

function createShopItemElement(item) {
    let box = document.createElement("div");
    box.classList.add("item-box");

    let left = document.createElement("div");
    left.classList.add("left");
    left.style.backgroundImage = `url(../images/keyboards/${item["id"]}.png)`;
    left.style.backgroundSize = `cover`;
    left.style.backgroundPosition = `center`;

    let right = document.createElement("div");
    right.classList.add("right");

    let info = document.createElement("div");
    info.classList.add("info");

    let title = document.createElement("h1");
    title.classList.add("info");
    title.textContent = item["Название"];

    let keysAmount = document.createElement("p");
    keysAmount.classList.add("description-line");
    keysAmount.textContent = `Количество клавиш: ${item["Количество_клавиш"]}`;

    let width = document.createElement("p");
    width.classList.add("description-line");
    width.textContent = `Ширина: ${item["Ширина_см"]} см.`;

    let length = document.createElement("p");
    length.classList.add("description-line");
    length.textContent = `Длина: ${item["Длина_см"]} см.`;

    let height = document.createElement("p");
    height.classList.add("description-line");
    height.textContent = `Высота: ${item["Ширина_см"]} см.`;

    let price = document.createElement("p");
    price.classList.add("description-line");
    price.textContent = `Цена: ${item["Цена"]} ₽`;
    
    let addToCartButton = document.createElement("p");
    addToCartButton.classList.add("add-to-cart-button");
    addToCartButton.textContent = "Добавить в корзину";

    createAddToCartButtonBehaviour(addToCartButton, item["id"]);

    info.appendChild(title);
    info.appendChild(width);
    info.appendChild(length);
    info.appendChild(height);
    info.appendChild(keysAmount);
    info.appendChild(price);

    right.appendChild(info);
    right.appendChild(addToCartButton);

    box.appendChild(left);
    box.appendChild(right);

    return box;
}

function createAddToCartButtonBehaviour(button, itemId) {
    button.addEventListener("click", async () => {
        let response = await fetch("../php/add-to-cart.php", {
            method: "POST",
            body: JSON.stringify({"keyboard-id": itemId })
        });
    });
}