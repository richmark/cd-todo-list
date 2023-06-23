import './bootstrap';
import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./router.js";
import App from './components/App.vue';

import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives'


const vuetify = createVuetify({
  components,
  directives,
  theme: { defaultTheme: 'light' },
});

const app = createApp(App);

app.use(router);
app.use(createPinia());
app.use(vuetify);

app.mount('#app');
