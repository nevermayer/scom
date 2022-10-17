<template>
    <dashboard-layout>
        <div slot="main-content">
            <div class="alert alert-info" v-if="message">
            {{message}}
            </div> 
            <h2 class="dash-title">Ordenes</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Ordenes</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(order, index) in orders" :key="index">
                                        <td>{{order.id}}</td>
                                        <td>{{order.total}}</td>
                                        <td>{{order.estado}}</td>
                                        <button class="btn btn-success" @click="editar(order.id)"><span class="ti-pencil-alt"></span></button>
                                        <li v-if="user !== null && role=='camarero'">
                                           <router-link to="/admin/ordenes" >
                                           <td class='text-right'><button type="button" class="btn btn-main-gradient"
                                                @click="eliminar(order.id)"><span class="ti-trash"></span></button></td>
                                           </router-link>
                                        </li>
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
import { useToast } from "vue-toastification"
export default {
    name: 'Ordenes',
    setup() {
        const toast = useToast()
        return { toast }
    },
    components: {
        DashboardLayout,
    },
    data() {
        return {
            orders: []
        }
    },
    
    mounted() {
        this.getOrders()
    },
    methods: {
        getOrders() {
            this.$axios.get('/api/orden', {
                headers: {
                    Authorization: `Bearer ${localStorage.authtoken}`
                }
            })
                .then(res => {
                    console.log(res.data)
                    this.orders = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        }, eliminar(id) {
            this.$axios.delete('/api/orden/'+id)
           .then(res => {
                console.log(res);
                this.toast.success("Se elimino orden")
            
                 } )
            .catch(error => {
                console.log(error.response)
            })
        }
        ,editar(id){
            this.$router.push('/admin/ordenes/'+id)
        }
    }, computed: {
        user() {
            return this.$store.getters.getUser
        },
        role(){
            return this.$store.getters.getRole
        }
    }
}

</script>
<style scoped>
@import "@/assets/css/bootstrap.min.css";
</style>