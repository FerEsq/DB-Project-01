import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import { createI18n } from "vue-i18n";

import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import Locale from "./lang/Locale";

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import CatalogsRolesEdit from "../../vendor/csgt/utils/src/resources/views/catalogs/RolesEdit.vue";
import CatalogsRoleModule from "../../vendor/csgt/utils/src/resources/views/catalogs/RoleModule.vue";
import CatalogsUsersEdit from "../../vendor/csgt/utils/src/resources/views/catalogs/UsersEdit.vue";
import Salons from "./components/salons/Salons.vue";
import Horarios from "./components/horarios/Horarios.vue";
import SalonsEdit from "./components/salons/SalonsEdit.vue";
import HorarioEdit from "./components/horarios/HorarioEdit.vue";
import Managers from "./components/managers/Managers.vue";

const app = createApp();
app.component("catalogs-roles-edit", CatalogsRolesEdit);
app.component("catalogs-rolemodule", CatalogsRoleModule);
app.component("catalogs-users-edit", CatalogsUsersEdit);
app.component("Salons", Salons);
app.component("salons-edit", SalonsEdit);
app.component("horarios", Horarios);
app.component('horarios-edit',HorarioEdit)
app.component('managers', Managers)

// const views = import.meta.globEager("./views/*.vue");
// const folders = import.meta.globEager("./views/*/*.vue");
// const files = { ...views, ...folders };

// Object.entries(files).map(([key, definition]) => {
//     let componentName = key
//         .split("./views/")
//         .pop()
//         .split(".")[0]
//         .replace("/", "-")
//         .toLocaleLowerCase();
//     app.component(componentName, definition.default);
// });

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

let lang = document.head.querySelector('meta[name="lang"]');
const i18n = createI18n({
    locale: lang ? lang.content : "en",
    messages: Locale,
});

app.use(pinia);
app.use(i18n);
app.mount("#app");
