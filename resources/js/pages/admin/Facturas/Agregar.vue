<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nueva Factura</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Total</label>
                                <input type="number" v-model="Factura.total" class="form-control" placeholder="Total de la Factura">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" v-model="Factura.fecha" class="form-control"
                                    placeholder="Fecha de emision">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addFactura" class="btn btn-main">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'

export default {
    name: 'Agregar',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            categories: [],
            Factura: {
                total:'',
                fecha:'',
            }
        }
    },
    mounted() {

    },
    methods: {
        addFactura() {

            if (!this.Factura.total || !this.Factura.fecha ) {
                return this.$alertify.error('Incomplete form data')
            }
            this.$axios.post('/api/factura', this.Factura, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/facturas')
                })
                .catch(error => {
                    if (error.response.data.message) {
                        return this.$alertify.error(error.response.data.message)
                    }
                    this.$alertify.error(Object.values(error.response.data)[0][0])
                })
        }
    }
}
</script>

<style lang="css">
.pad-1 {
    padding: 1rem
}
</style>