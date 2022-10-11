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
                                    <tr v-for="(auditoria, index) in auditoria" :key="index" >
                                        <td>{{auditoria.id}}</td>
                                        <td>{{auditoria.nombre_cuenta}}</td>
                                        <td>{{auditoria.id}}</td>
                                        <td>{{auditoria.fecha}}</td>
                                        <td><button class="btn" @click="editar(auditoria.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: 'Auditoria',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            auditoria: []
        }
    },
    mounted() {
        this.getAuditoria()
    },
    methods: {
        getAuditoria() {
            this.$axios.get('/api/auditoria', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                this.auditoria = res.data
                
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/auditorias/'+id)
        },
    }
}
</script>