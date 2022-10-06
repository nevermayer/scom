<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Auditorias</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Auditorias</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id User</th>
                                        <th>Nombre de cuenta</th>
                                        <th>Id Auditoria</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, auditoria, index) in users" :key="index" >
                                        <td>{{user.id}}</td>
                                        <td>{{user.nombre_cuenta}}</td>
                                        <td>{{auditoria.id}}</td>
                                        <td>{{auditoria.fecha}}</td>
                                        <td><button class="btn" @click="editar(user.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: 'Auditorias',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            auditorias: []
        }
    },
    mounted() {
        this.getAuditorias()
    },
    methods: {
        getAuditorias() {
            this.$axios.get('/api/auditorias', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                this.users = res.data.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/usuarios/'+id)
        },
    }
}
</script>