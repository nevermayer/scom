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
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(category, index) in categories" :key="index">
                                        <td>#{{index + 1}}</td>
                                        <td>{{category.name}}</td>
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
                    this.orders = res.data.data
                    this.orders.map(order => {
                        order.items = JSON.parse(order.items)
                        return order
                    })
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
    }
}
</script>