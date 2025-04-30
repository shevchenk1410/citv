import { createApp } from "vue";
import UsuariosPage from "./usuarios.page.vue";
import VueSimpleAlert from "@/plugins/VueSimpleAlert";

createApp(UsuariosPage).use(VueSimpleAlert).mount("#usuarios-page");