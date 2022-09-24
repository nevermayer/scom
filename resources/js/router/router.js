import { createWebHistory, createRouter } from "vue-router";
//importando paginas
import home from '@/pages/home.vue';
import carta from '@/pages/Carta.vue';
import Account from '@/pages/Account.vue';
import register from '@/pages/register.vue';
//administracion
import dashboard from '@/pages/admin/dashboard.vue'
import categories from '@/pages/admin/Categories.vue'
import Login from '@/pages/admin/Login.vue'
//usuarios
import User from '@/pages/admin/Usuarios/index.vue'
import AddUser from '@/pages/admin/Usuarios/Agregar.vue'
import EditUser from '@/pages/admin/Usuarios/Editar.vue'
//productos
import Producto from '@/pages/admin/Productos/index.vue'
import AddProducto from '@/pages/admin/Productos/Agregar.vue'
import EditProducto from '@/pages/admin/Productos/Editar.vue'
//Clientes
import Cliente from '@/pages/admin/Clientes/index.vue'
import AddCliente from '@/pages/admin/Clientes/Agregar.vue'
import EditCliente from '@/pages/admin/Clientes/Editar.vue'
//Mesas
import Mesa from '@/pages/admin/Mesas/index.vue'
import AddMesa from '@/pages/admin/Mesas/Agregar.vue'
import EditMesa from '@/pages/admin/Mesas/Editar.vue'
//Ordenes
import Orden from '@/pages/admin/Ordenes/index.vue'
import ingredientes from '@/pages/admin/Ingredientes.vue'
//definiendo rutas
const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },
    {
        path: '/menu',
        name: 'Menu',
        component: carta
    },
    {
        path: '/account',
        name: 'Account',
        component: Account
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
        component: User
    },
    {
        path: '/admin/usuarios/add',
        name: 'AddUser',
        component: AddUser
    }
    ,
    {
        path: '/admin/usuarios/:id',
        name: 'EditUser',
        component: EditUser
    },
    {
        path: '/admin/productos',
        name: 'Productos',
        component: Producto
    },
    {
        path: '/admin/productos/add',
        name: 'AddProducto',
        component: AddProducto
    }
    ,
    {
        path: '/admin/productos/:id',
        name: 'EditProducto',
        component: EditProducto
    },
    {
        path: '/admin/clientes',
        name: 'Clientes',
        component: Cliente
    },
    {
        path: '/admin/clientes/add',
        name: 'AddCliente',
        component: AddCliente
    }
    ,
    {
        path: '/admin/clientes/:id',
        name: 'EditCliente',
        component: EditCliente
    },//
    {
        path: '/admin/mesas',
        name: 'Mesas',
        component: Mesa
    },
    {
        path: '/admin/mesas/add',
        name: 'AddMesa',
        component: AddMesa
    }
    ,
    {
        path: '/admin/mesas/:id',
        name: 'EditMesa',
        component: EditMesa
    },
    {
        path: '/admin/ordenes',
        name: 'Orden',
        component: Orden
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