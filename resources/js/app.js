import { createApp } from 'vue';
import './bootstrap';
import router from './router/router';

import app from './layouts/app.vue'
createApp(app)
    .use(router)
    .mount('#app')



