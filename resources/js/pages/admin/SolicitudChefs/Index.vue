<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Solicitudes</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/solicitudchefs/add')"><span class="ti-plus"></span> Nueva Solicitud</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Solicitudes</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Id Ingredientes</th>
                                        <th>Id Chef</th>
                                        <th>Cantidad</th>
                                        <th>Status</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(solicitudchef, index) in solicitudchef" :key="index" >
                                        <td>{{solicitudchef.id}}</td>
                                        <td>{{solicitudchef.id_ingrediente}}</td>
                                        <td>{{solicitudchef.id_chef}}</td>
                                        <td>{{solicitudchef.cantidad}}</td>
                                        <td>{{solicitudchef.status}}</td>
                                        <td>{{solicitudchef.fecha}}</td>
                                        <td><button class="btn" @click="editar(solicitudchef.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: 'SolicitudChefs',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            solicitudchefs: []
        }
    },
    mounted() {
        this.getSolicitudChefs()
    },
    methods: {
        getSolicitudChefs() {
            this.$axios.get('/api/solicitudchefs', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                console.log(res.data)
                this.solicitudchefs = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/solicitudchefs/'+id)
        },
    }
}
</script>