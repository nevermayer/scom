<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Factura</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Total</label>
                                <input type="number" v-model="Factura.total" class="form-control" placeholder="Total">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" v-model="Factura.fecha" class="form-control"
                                    placeholder="Fecha de emision">
                            </div>
                            <div class="form-group">
                                <label for="">Cajero Id</label>
                                <input type="number" v-model="Factura.cajero_id" class="form-control"
                                    placeholder="cajero id">
                            </div>
                            <div class="form-group">
                                <label for="">Orden Id</label>
                                <input type="number" v-model="Factura.orden_id" class="form-control"
                                    placeholder="orden id">
                            </div>
                            <div class="form-group">
                                <label for="">Cliente Id</label>
                                <input type="number" v-model="Factura.cliente_id" class="form-control"
                                    placeholder="cliente id">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="editFactura" class="btn btn-main">Submit</button>
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
    name: "Editar",
    components: {
        DashboardLayout
    },
    mounted: function () {0
        this.facturaid = this.$route.params.id
        this.$axios.get('/api/factura/' + this.facturaid)
            .then(datos => {
                this.Factura.total = datos.data.total
                this.Factura.fecha = datos.data.fecha
                this.Factura.cajero_id = datos.data.cajero_id
                this.Factura.orden_id = datos.data.orden_id
                this.Factura.cliente_id = datos.data.cliente_id
            })
    },
    data() {
        return {
            facturaid: null,
            Factura: {
                total: '',
                fecha: '',
                cajero_id: '',
                orden_id: '',
                cliente_id: ''
            }
        }
    }, methods: {
        editFactura() {
            this.$axios.put('/api/factura/' + this.facturaid, <this class="Factura"></this>, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/facturas')
                })
        }
    }
}
</script>