<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Mesas</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/mesas/add')"><span class="ti-plus"></span> Nuevo mesa</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Mesas</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Min capacidad</th>
                                        <th>Max capacidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(mesa, index) in mesas" :key="index" >
                                        <td>{{mesa.id}}</td>
                                        <td>{{mesa.nombre}}</td>
                                        <td>{{mesa.min_capacidad}}</td>
                                        <td>{{mesa.max_capacidad}}</td>
                                        <td>{{mesa.status}}</td>
                                        <td><button class="btn" @click="editar(mesa.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: 'mesas',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            mesas: []
        }
    },
    mounted() {
        this.getmesas()
    },
    methods: {
        getmesas() {
            this.$axios.get('/api/mesa', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                console.log(res.data)
                this.mesas = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/mesas/'+id)
        },
    }
}
</script>