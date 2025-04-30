import { createApp } from "vue";
import NuevaFichaPage from "./nueva-ficha.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(NuevaFichaPage).use(VueSimpleAlert).mount("#nueva-ficha-page");