"use strict";

let authorizationContainer = document.querySelector("#authorization-popup");
let registrationContainer = document.querySelector("#registration-popup");
let popupBackground = document.querySelector(".popup-background");

popupBackground.addEventListener("click", () => {
    registrationContainer.classList.add("hidden");
    authorizationContainer.classList.add("hidden");
    popupBackground.classList.add("hidden");
});