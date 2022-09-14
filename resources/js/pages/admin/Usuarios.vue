<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Usuarios</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/usuarios/add')"><span class="ti-plus"></span> Nuevo usuario</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Usuarios</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre de cuenta</th>
                                        <th>Nombre</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Cargo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users" :key="index" >
                                        <td>#{{index + 1}}</td>
                                        <td>{{user.nombre_cuenta}}</td>
                                        <td>{{user.nombre}}</td>
                                        <td>{{user.apellido_pat}}</td>
                                        <td>{{user.apellido_mat}}</td>
                                        <td>{{user.role}}</td>
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
    name: 'Usuarios',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            users: []
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            this.$axios.get('/api/users/all', {
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
    }
}
</script>