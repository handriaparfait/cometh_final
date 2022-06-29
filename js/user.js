let sidebar = document.querySelector(".sidebar");
sidebar.classList.toggle("open");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();
});


function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        document.getElementsByTagName('body')[0].style.marginLeft = "10%";
    } else {
        document.getElementsByTagName('body')[0].style.marginLeft = "5%";
    }
}
