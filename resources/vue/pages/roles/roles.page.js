import { createApp } from "vue";
import RolesPage from "./roles.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(RolesPage).use(VueSimpleAlert).mount("#roles-page");