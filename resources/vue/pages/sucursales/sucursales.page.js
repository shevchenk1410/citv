import { createApp } from "vue";
import SucursalPage from "./index.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(SucursalPage).use(VueSimpleAlert).mount("#sucursales-page");