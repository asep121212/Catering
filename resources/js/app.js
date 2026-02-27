import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
document.addEventListener("DOMContentLoaded", function () {
    const profileButton = document.getElementById("profileButton");
    const profileDropdown = document.getElementById("profileDropdown");
    const arrowIcon = document.getElementById("arrowIcon");

    if (!profileButton) return;

    profileButton.addEventListener("click", function (e) {
        e.stopPropagation();

        profileDropdown.classList.toggle("opacity-0");
        profileDropdown.classList.toggle("scale-95");
        profileDropdown.classList.toggle("invisible");

        arrowIcon.classList.toggle("rotate-180");
    });

    document.addEventListener("click", function (e) {
        if (
            !profileDropdown.contains(e.target) &&
            !profileButton.contains(e.target)
        ) {
            profileDropdown.classList.add("opacity-0", "scale-95", "invisible");
            arrowIcon.classList.remove("rotate-180");
        }
    });
});
