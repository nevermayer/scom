<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Clientes</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/clientes/add')"><span class="ti-plus"></span> Nuevo Cliente</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Clientes</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>email</th>
                                        <th>Telefono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(cliente, index) in clientes" :key="index" >
                                        <td>{{cliente.id}}</td>
                                        <td>{{cliente.nombre}}</td>
                                        <td>{{cliente.apellido_pat}}</td>
                                        <td>{{cliente.apellido_mat}}</td>
                                        <td>{{cliente.email}}</td>
                                        <td>{{cliente.telefono}}</td>
                                        <td><button class="btn" @click="editar(cliente.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: 'clientes',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            clientes: []
        }
    },
    mounted() {
        this.getclientes()
    },
    methods: {
        getclientes() {
            this.$axios.get('/api/clientes', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                console.log(res.data)
                this.clientes = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/clientes/'+id)
        },
    }
}
</script>