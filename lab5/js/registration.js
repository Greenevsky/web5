"use strict";

let registrationForm = document.querySelector("#registration");
let registrationResponseDisplay = document.querySelector(".registration-content .response-display");

registrationForm.addEventListener("submit", async (evt) => {
    evt.preventDefault();

    let registrationResponse = await fetch("../php/registration.php", {
        method: "POST",
        body: new FormData(registrationForm) 
    });

    let json = await registrationResponse.json();

    if (json["success"]) {
        sessionStorage.setItem("authorized", 1);    
        document.location.href = "../profile.php";
    }
    else {
        registrationResponseDisplay.classList.remove("invisible");
        registrationResponseDisplay.textContent = json["message"];
    }
});