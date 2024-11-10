/*===================
18. Theme Setting js
=======================*/
const themeBtnParent = document.querySelector(".theme-btns");
const darkBtn = document.querySelector("#dark-btn");
const html = document.querySelector("html");
const body = document.querySelector("body");

themeBtnParent?.addEventListener("click", function (e) {
    e.preventDefault();
    const clicked = e.target.closest(".btntheme")?.id;
    if (!clicked) return;
    if (clicked === "dark-btn") {
        darkBtn.id = "light-btn";
        darkBtn.innerHTML = `<i class="fa-solid fa-sun"></i> <div class="dark">Light</div>`;
        body.classList.add("dark");
        localStorage.setItem("body", "dark");
        localStorage.setItem('darkId', 'light-btn');
        localStorage.setItem('textContentDark', `<i class="fa-solid fa-sun"></i> <div class="dark">Light</div>`);
    }
    if (clicked === "light-btn") {
        darkBtn.id = "dark-btn";
        darkBtn.innerHTML = `<i class="fa-regular fa-moon"></i> <div class="dark">Dark</div>`;
        body.classList.remove("dark");
        localStorage.setItem("body", "");
        localStorage.setItem('darkId', 'dark-btn');
        localStorage.setItem('textContentDark', `<i class="fa-regular fa-moon"></i> <div class="dark">Dark</div>`);
    }
});


// Dark
darkBtn.id = localStorage.getItem("darkId") ? localStorage.getItem("darkId") : "dark-btn";
darkBtn.innerHTML = localStorage.getItem("textContentDark") ? localStorage.getItem("textContentDark") : `<i class="fa-regular fa-moon"></i> <div class="dark">Dark</div>`;
if (localStorage.getItem("body") === "dark") {
    body.classList.add("dark");
}

/// Bootstrap Tool Tip ///
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
