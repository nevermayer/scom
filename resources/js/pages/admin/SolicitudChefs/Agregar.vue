<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nueva Solicitud</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="number" v-model="SolicitudChef.cantidad" class="form-control"
                                    placeholder="cantidad">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select v-model="SolicitudChef.status" class="form-control">
                                    <option selected value="Status">Status</option>
                                    <option value="completada">Completado</option>
                                    <option value="sin completar">Sin Completar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" v-model="SolicitudChef.fecha" class="form-control"
                                    placeholder="fecha de solicitud">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addSolicitudChef" class="btn btn-main">Submit</button>
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
            SolicitudChef: {
                items: [],
                id_chef: '',
                cantidad: '',
                status: '',
                fecha:'',
            }
        }
    },
    mounted() {

    },
    methods: {
        addSolicitudChef() {

            if (!this.SolicitudChef.id_ingrediente || !this.SolicitudChef.id_chef || !this.SolicitudChef.cantidad || !this.SolicitudChef.status || this.SolicitudChef.fecha) {
                return this.$alertify.error('Incomplete form data')
            }
            this.$axios.post('/api/solicitud-chef', this.SolicitudChef, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/solicitudchefs')
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