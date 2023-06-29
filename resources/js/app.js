import "./bootstrap";
import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
import "./suneditor";
import "suneditor/dist/css/suneditor.min.css";

import.meta.glob(["../fonts/**"]);
import nunito from "../fonts/nunito-400.woff2";

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

window.addEventListener("toggleDarkMode", (event) => {
    if (event.detail.darkMode) {
        // Get the HTML document root element
        var rootElement = document.documentElement;

        // Add the "dark" class to the root element
        rootElement.classList.add("dark");
    } else {
        // Get the HTML document root element
        var rootElement = document.documentElement;

        // Add the "dark" class to the root element
        rootElement.classList.remove("dark");
    }
});
