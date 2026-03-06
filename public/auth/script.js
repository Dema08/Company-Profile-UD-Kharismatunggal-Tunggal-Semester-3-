const wrapper = document.querySelector(".wrapper");
//salah penamaan tadi namae  loginLink sedangkan di login hmtl mu namae login-link
const loginLink = document.querySelector(".login-link");
const registerLink = document.querySelector(".register-link");
const btnPopup = document.querySelector(".btnLogin-popup");
const iconClose = document.querySelector(".icon-close");

registerLink.addEventListener("click", () => {
    wrapper.classList.add("active");
});

loginLink.addEventListener("click", () => {
    wrapper.classList.remove("active");
});

btnPopup.addEventListener("click", () => {
    wrapper.classList.add("active-popup");
});

iconClose.addEventListener("click", () => {
    wrapper.classList.remove("active-popup");
});

document.querySelectorAll(".input-box input").forEach((input) => {
    input.addEventListener("focus", function () {
        this.previousElementSibling.classList.add("active");
    });
    input.addEventListener("blur", function () {
        if (!this.value) {
            this.previousElementSibling.classList.remove("active");
        }
    });
});
