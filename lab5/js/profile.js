"use strict";

let container = document.querySelector(".content .container .orders");

let nameDisplay = document.querySelector("#user-name-display");
let passwordDisplay = document.querySelector("#password-display");
let addressDisplay = document.querySelector("#address-display");

let nameEditButton = document.querySelector("#user-name-edit-button");
let nameEditInput = document.querySelector("#user-name-input");
let nameEditSubmitButton = document.querySelector("#user-name-edit-submit-button");
let nameEditDiscardButton = document.querySelector("#user-name-edit-discard-button");

let passwordEditButton = document.querySelector("#password-edit-button");
let passwordEditInput = document.querySelector("#password-input");
let passwordEditSubmitButton = document.querySelector("#password-edit-submit-button");
let passwordEditDiscardButton = document.querySelector("#password-edit-discard-button");

let addressEditButton = document.querySelector("#address-edit-button");
let addressEditInput = document.querySelector("#address-input");
let addressEditSubmitButton = document.querySelector("#address-edit-submit-button");
let addressEditDiscardButton = document.querySelector("#address-edit-discard-button");

fetch("../php/get-profile-info.php", {
    method: "GET"
}).then((response) => {
    response.json().then((json) => {
        let userinfo = JSON.parse(json["message"]);

        nameDisplay.textContent = userinfo["name"]
        addressDisplay.textContent = userinfo["address"]
    });
});

fetch("../php/get-orders.php", {
    method: "GET"
}).then(async (response) => {
    let json = await response.json();
    let items = JSON.parse(json["message"]);

    for(let item of items) {
        let element = createOrderElement(item);
        
        container.appendChild(element);
    }
});


// Name

nameEditButton.addEventListener("click", () => {
    nameDisplay.classList.add("hidden");
    nameEditButton.classList.add("hidden");

    nameEditInput.value = "";
    nameEditInput.classList.remove("hidden");
    
    nameEditSubmitButton.classList.remove("hidden");
    nameEditDiscardButton.classList.remove("hidden");
});

nameEditDiscardButton.addEventListener("click", () => {
    nameDisplay.classList.remove("hidden");
    nameEditButton.classList.remove("hidden");

    nameEditInput.value = "";
    nameEditInput.classList.add("hidden");
    
    nameEditSubmitButton.classList.add("hidden");
    nameEditDiscardButton.classList.add("hidden");
});

nameEditSubmitButton.addEventListener("click", async () => {
    nameDisplay.classList.remove("hidden");
    nameEditButton.classList.remove("hidden");

    nameEditInput.classList.add("hidden");
    
    nameEditSubmitButton.classList.add("hidden");
    nameEditDiscardButton.classList.add("hidden");

    let response = await fetch("../php/change-name.php", {
       method: "POST",
       body: JSON.stringify({"value": nameEditInput.value })
    });

    let responseJson = await response.json();

    if (responseJson["success"]) {
        nameDisplay.textContent = nameEditInput.value;
    }
});

// Password

passwordEditButton.addEventListener("click", () => {
    passwordDisplay.classList.add("hidden");
    passwordEditButton.classList.add("hidden");

    passwordEditInput.value = "";
    passwordEditInput.classList.remove("hidden");
    
    passwordEditSubmitButton.classList.remove("hidden");
    passwordEditDiscardButton.classList.remove("hidden");
});

passwordEditDiscardButton.addEventListener("click", () => {
    passwordDisplay.classList.remove("hidden");
    passwordEditButton.classList.remove("hidden");

    passwordEditInput.value = "";
    passwordEditInput.classList.add("hidden");
    
    passwordEditSubmitButton.classList.add("hidden");
    passwordEditDiscardButton.classList.add("hidden");
});

passwordEditSubmitButton.addEventListener("click", async () => {
    passwordDisplay.classList.remove("hidden");
    passwordEditButton.classList.remove("hidden");

    passwordEditInput.classList.add("hidden");
    
    passwordEditSubmitButton.classList.add("hidden");
    passwordEditDiscardButton.classList.add("hidden");

    let response = await fetch("../php/change-password.php", {
       method: "POST",
       body: JSON.stringify({"value": passwordEditInput.value })
    });

    let responseJson = await response.json();
});

// Address

addressEditButton.addEventListener("click", () => {
    addressDisplay.classList.add("hidden");
    addressEditButton.classList.add("hidden");

    addressEditInput.value = "";
    addressEditInput.classList.remove("hidden");
    
    addressEditSubmitButton.classList.remove("hidden");
    addressEditDiscardButton.classList.remove("hidden");
});

addressEditDiscardButton.addEventListener("click", () => {
    addressDisplay.classList.remove("hidden");
    addressEditButton.classList.remove("hidden");

    addressEditInput.value = "";
    addressEditInput.classList.add("hidden");
    
    addressEditSubmitButton.classList.add("hidden");
    addressEditDiscardButton.classList.add("hidden");
});

addressEditSubmitButton.addEventListener("click", async () => {
    addressDisplay.classList.remove("hidden");
    addressEditButton.classList.remove("hidden");

    addressEditInput.classList.add("hidden");
    
    addressEditSubmitButton.classList.add("hidden");
    addressEditDiscardButton.classList.add("hidden");

    let response = await fetch("../php/change-address.php", {
       method: "POST",
       body: JSON.stringify({"value": addressEditInput.value })
    });

    let responseJson = await response.json();

    if (responseJson["success"]) {
        addressDisplay.textContent = addressEditInput.value;
    }
});

function createOrderElement(ord) {
    let order = document.createElement("div");
    order.classList.add("order");

    let id = document.createElement("p");
    id.classList.add("description");
    id.classList.add("bold");
    id.textContent = `Номер заказа: ${ord["order_id"]}`;
    
    let time = document.createElement("p");
    time.classList.add("description");
    time.textContent = `Время заказа: ${convertTime(ord["order_time"])}`;

    let price = document.createElement("p");
    price.classList.add("description");
    price.textContent = `Стоимость заказа: ${ord["order_price"]} ₽`;

    let products = document.createElement("p");
    products.classList.add("description");
    products.textContent = `Товары: `;

    order.appendChild(id);
    order.appendChild(time);
    order.appendChild(price);
    order.appendChild(products);

    for (let product of ord["products"]) {
        let productContainer = document.createElement("div");
        productContainer.classList.add("product-container");

        let productImage = document.createElement("div");
        productImage.classList.add("product-image");
        productImage.style.backgroundImage = `url(../images/keyboards/${product["id"]}.png)`;
        productImage.style.backgroundSize = `cover`;
        productImage.style.backgroundPosition = `center`;

        let description = document.createElement("div");
        productContainer.classList.add("product-description-container");

        let productName = document.createElement("div");
        productName.classList.add("product-description");
        productName.textContent = `Название: ${product["name"]}`;

        let productPrice = document.createElement("div");
        productPrice.classList.add("product-description");  
        productPrice.textContent = `Цена: ${product["price"]} ₽`;

        description.appendChild(productName);
        description.appendChild(productPrice);

        productContainer.appendChild(productImage);
        productContainer.appendChild(description);

        order.appendChild(productContainer);
    }

    return order;
}

function convertTime(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Нобря','Декабря'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
    return time;
}