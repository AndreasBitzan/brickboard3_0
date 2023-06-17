import "./bootstrap";
import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
import.meta.glob([
    '../fonts/**'
]);
import nunito from '../fonts/nunito-400.woff2';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
