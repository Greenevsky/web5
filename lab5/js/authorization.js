"use strict";

let authorizationForm = document.querySelector("#authorization");
let authorizationResponseDisplay = document.querySelector(".authorization-content .response-display");

authorizationForm.addEventListener("submit", async (evt) => {
    evt.preventDefault();

    let authorizationResponse = await fetch("../php/authorization.php", {
        method: "POST",
        body: new FormData(authorizationForm) 
    });

    let parsedAuthorizationResponse = await authorizationResponse.json();

    authorizationResponseDisplay.classList.remove("invisible");
    authorizationResponseDisplay.textContent = parsedAuthorizationResponse["message"];

    if (parsedAuthorizationResponse["success"]) {
        sessionStorage.setItem("authorized", 1);
        document.location.href = "../profile.php";
    }
});