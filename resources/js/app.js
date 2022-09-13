import { createApp } from 'vue';
import './bootstrap';
import axios from 'axios'
import router from './router/router';

import App from './layouts/app.vue'
const app =createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')



