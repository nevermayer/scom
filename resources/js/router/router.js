import { createWebHistory, createRouter } from "vue-router";
//importando paginas
import home from '@/pages/home.vue';
import login from '@/pages/login.vue';
import register from '@/pages/register.vue';
//administracion
import dashboard from '@/pages/admin/dashboard.vue'
import categories from '@/pages/admin/Categories.vue'
//definiendo rutas
const routes=[
    {
        path:'/',
        name:'Home',
        component:home
    },
    {
        path:'/login',
        name:'Login',
        component:login
    },
    {
        path:'/register',
        name:'Register',
        component:register
    },//admin
    {
        path:'/admin/dashboard',
        name:'Dashboard',
        component:dashboard
    },    
    {
        path:'/admin/categories',
        name:'Categories',
        component:categories
    }

];
const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;