<template>
 <div>
        <div class="front-header">
            <nav>
                <div>
                    <h3>SCOM</h3>
                    <small>Platillos, Postres y Bebidas de locura!</small>
                </div>
                <div class="front-search">
                    <span class="ti-search"></span>
                    <input type="search" placeholder="Buscar producto...." />
                </div>
                <div class="front-nav-links">
                    <div v-if="user == null">
                        <router-link to="/account"><small>Entrar</small></router-link> | <router-link to="/account"><small>Registrese</small></router-link>
                    </div>

                    <div v-else>
                        <button class="btn-link" @click="signout"><small><span class="ti-user"></span> Perfil</small></button> | <button class="btn-link" @click="signout"><small><span class="ti-power-off"></span> Logout</small></button>
                    </div>
                    
                    <div>
                        <button class="btn btn-main-gradient">
                            <span class="ti-shopping-cart"></span>
                            <span>{{cart.length}}</span>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Nav',
    props: ['user', 'cart', 'categories'],
    methods: {
        signout() {
            localStorage.removeItem('user')
            localStorage.removeItem('token')
            location.reload()
        }
    }
}
</script>