<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Productos</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/productos/add')"><span class="ti-plus"></span> Nuevo Producto</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Productos</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(producto, index) in productos" :key="index" >
                                        <td>{{producto.id}}</td>
                                        <td>{{producto.nombre}}</td>
                                        <td>{{producto.descripcion}}</td>
                                        <td>{{producto.precio}}</td>
                                        <td>{{producto.cantidad}}</td>
                                        <td><button class="btn" @click="editar(producto.id)"><span class="ti-pencil-alt"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
</template>
<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'

export default {
    name: 'Productos',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            productos: []
        }
    },
    mounted() {
        this.getProductos()
    },
    methods: {
        getProductos() {
            this.$axios.get('/api/productos', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                this.productos = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/productos/'+id)
        },
    }
}
</script>