function toggleMenu() {
    const topnav = document.querySelector("#myTopnav");
    const placeholder = document.querySelector("#nav-placeholder");

    if(topnav.classList.contains("responsive")) {
        topnav.classList.remove("responsive");
        placeholder.classList.remove("responsive")
    } else {
        topnav.classList.add("responsive");
        placeholder.classList.add("responsive");
    }
}