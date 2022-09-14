import { createWebHistory, createRouter } from "vue-router";
//importando paginas
import home from '@/pages/home.vue';
import login from '@/pages/login.vue';
import register from '@/pages/register.vue';
//administracion
import dashboard from '@/pages/admin/dashboard.vue'
import categories from '@/pages/admin/Categories.vue'
import Login from '@/pages/admin/Login.vue'
import usuarios from '@/pages/admin/Usuarios.vue'
import AddUser from '@/pages/admin/AddUser.vue'
import clientes from '@/pages/admin/Clientes.vue'
import productos from '@/pages/admin/Productos.vue'
import ordenes from '@/pages/admin/Ordenes.vue'
import ingredientes from '@/pages/admin/Ingredientes.vue'
//definiendo rutas
const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },
    {
        path: '/login',
        name: 'Login',
        component: login
    },
    {
        path: '/register',
        name: 'Register',
        component: register
    },//admin
    {
        path: '/admin/dashboard',
        name: 'Dashboard',
        component: dashboard
    },
    {
        path: '/admin/login',
        name: 'ALogin',
        component: Login
    },
    {
        path: '/admin/categories',
        name: 'Categories',
        component: categories
    },
    {
        path: '/admin/usuarios',
        name: 'Usuarios',
        component: usuarios
    },
    {
        path: '/admin/usuarios/add',
        name: 'AddUser',
        component: AddUser
    },
    {
        path: '/admin/clientes',
        name: 'Clientes',
        component: clientes
    },
    {
        path: '/admin/ordenes',
        name: 'Ordenes',
        component: ordenes
    },
    {
        path: '/admin/productos',
        name: 'Productos',
        component: productos
    },
    {
        path: '/admin/ingredientes',
        name: 'Ingredientes',
        component: ingredientes
    }

];
const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;