<template>
    <dashboard-layout>
        <div slot="main-content">
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
                                        <td>#{{order.id}}</td>
                                        <td>{{order.total}}</td>
                                        <td>{{order.estado}}</td>
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
    name: 'Ordenes',
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
        },
    }
}
</script>