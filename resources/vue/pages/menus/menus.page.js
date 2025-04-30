import { createApp } from "vue";
import MenusPage from "./menus.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(MenusPage).use(VueSimpleAlert).mount("#menus-page");