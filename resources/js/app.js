import { createApp } from 'vue'
import './bootstrap';
import axios from 'axios'
import router from './router/router'
import store from './store'

import App from './layouts/app.vue'
const app =createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router)
app.use(store)
app.mount('#app')



