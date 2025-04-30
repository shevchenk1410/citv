import { createApp } from "vue";
import OperacionDiariaPage from "./index.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(OperacionDiariaPage).use(VueSimpleAlert).mount("#operaciones-diarias-page");