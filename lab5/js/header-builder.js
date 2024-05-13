"use strict";

let buttonsContainer = document.querySelector(".header .container .buttons");

buttonsContainer.appendChild(createButton("shop-button", "Ассортимент", "shop.php"));

if (sessionStorage.getItem("authorized") == 1) {
    let profileButton = createButton("profile-button", "Личный кабинет", "profile.php");
    let logoutButton = createButton("logout-button", "Выйти", "#");
    let cartButton = createButton("cart-button", "Корзина", "cart.php");

    addLogoutButtonBehaviour(logoutButton);

    buttonsContainer.appendChild(profileButton);
    buttonsContainer.appendChild(cartButton);
    buttonsContainer.appendChild(logoutButton);
}
else {
    let registrationButton = createButton("registration-button", "Регистрация", "#");
    let authorizationButton = createButton("authorization-button", "Авторизация", "#")

    addRegistrationButtonBehaviour(registrationButton);
    addAuthorizationButtonBehaviour(authorizationButton);
    
    buttonsContainer.appendChild(authorizationButton);
    buttonsContainer.appendChild(registrationButton);
}

function createButton(id, textContent, href) {
    let button = document.createElement("a");

    button.setAttribute("class", "button");
    button.setAttribute("href", href);
    button.setAttribute("id", id);
    button.textContent = textContent;

    return button;
}

function addRegistrationButtonBehaviour(button) {
    let registrationContainer = document.querySelector("#registration-popup");

    button.addEventListener("click", () => {
        registrationContainer.classList.remove("hidden");
        popupBackground.classList.remove("hidden");
    });
}

function addAuthorizationButtonBehaviour(button) {
    let authorizationContainer = document.querySelector("#authorization-popup");

    button.addEventListener("click", () => {
        authorizationContainer.classList.remove("hidden");
        popupBackground.classList.remove("hidden");
    });
}

function addLogoutButtonBehaviour(button) {
    button.addEventListener("click", async () => {
        let response = await fetch("../php/logout.php", {
            method: "GET"
        });

        sessionStorage["authorized"] = 0;

        location.href = "index.php";
    });
}