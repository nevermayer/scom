<template>
    <div>
        <input type="checkbox" id="sidebar-toggle">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3 class="brand">
                    <span class="ti-bolt"></span> 
                    <span>ScoM</span>
                </h3> 
                <label for="sidebar-toggle" class="ti-menu-alt"></label>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <router-link to="/admin/dashboard">
                            <span class="ti-home"></span>
                            <span>Principal</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/categories">
                            <span class="ti-face-smile"></span>
                            <span>Categorias</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/productos">
                            <span class="ti-agenda"></span>
                            <span>Productos</span>
                        </router-link>
                    </li>

                    <li>
                        <router-link to="/admin/ordenes">
                            <span class="ti-clipboard"></span>
                            <span>Ordenes</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/usuarios">
                            <span class="ti-folder"></span>
                            <span>Usuarios</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/clientes">
                            <span class="ti-folder"></span>
                            <span>Clientes</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/mesas">
                            <span class="ti-agenda"></span>
                            <span>Mesas</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/ingredientes">
                            <span class="ti-agenda"></span>
                            <span>Ingredientes</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        
        
        <div class="main-content">
            
            <header>
                <div class="search-wrapper">
                    <span class="ti-search"></span>
                    <input type="search" placeholder="Buscar...">
                </div>
                
                <div class="social-icons">
                    <span @click="signout" class="ti-power-off"></span>
                    <div></div>
                </div>
            </header>
            
            <main>
                <slot></slot>
            </main>
            
        </div>
    </div>
</template>

<script>
export default {
    name: 'DashboardLayout',
    methods: {
        signout() {
            this.$axios.get('/api/logout', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            localStorage.removeItem('token')
            localStorage.removeItem('admin')
            this.$router.push('/admin/login');
        }
    }
}
</script>