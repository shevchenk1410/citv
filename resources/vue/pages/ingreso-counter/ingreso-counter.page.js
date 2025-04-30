import { createApp } from "vue";
import IngresoCounterPage from "./ingreso-counter.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(IngresoCounterPage).use(VueSimpleAlert).mount("#ingreso-counter-page");