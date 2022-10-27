<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Mesas</h2>

            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/mesas/add')"><span class="ti-plus"></span>
                    Nuevo mesa</button>
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
                                        <th>ID Camarero</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(mesa, index) in mesas" :key="index">
                                        <td>{{ mesa.id }}</td>
                                        <td>{{ mesa.nombre }}</td>
                                        <td>{{ mesa.min_capacidad }}</td>
                                        <td>{{ mesa.max_capacidad }}</td>
                                        <td>{{ mesa.status }}</td>
                                        <td>{{ mesa.id_camarero }}</td>
                                        <td><button class="btn btn-main" @click="tomarOrden(mesa.id)"><span
                                                    class="ti-pencil-alt"></span></button>
                                            <button class="btn" @click="editar(mesa.id)"><span
                                                    class="ti-pencil-alt"></span></button>
                                            <button type="button" class="btn btn-info"
                                                @click="AsignarCamarero(mesa.id)">Asignar Camarero</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
    <modal v-if="additemModal" @close="additemModal = false">
        <template #header>
            <h4 class="modal-title" id="myModalLabel">Asignar Camarero</h4>
        </template>
        <template #body>
            <div class="col-md-12">
                <label>Camareros</label>
                <select class="form-control">
                    <option value="">escoge un camarero</option>
                    <option value="1">camarero1</option>
                    <option value="2">camarero2</option>
                    <option value="3">camarero3</option>
                </select>
            </div>
        </template>
        <template #footer>
            <div class="modal-footer">
                <button class="btn btn-main-gradient" @click="clean()">
                    Cerrar
                </button>
                <button class="btn btn-main" @click="AsitemsCama()">
                    Asignar
                </button>
            </div>
        </template>
    </modal>
</template>
<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'
import modal from '@/components/Modal.vue'
export default {
    name: 'mesas',
    components: {
        DashboardLayout,
        modal
    },
    data() {
        return {
            additemModal: false,
            Mesa: {
                id_camarero: 0

            },
            mesas: [],
            item: {
                id_usuario: 0
            },
            camareros: ''
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
                    this.mesas = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        selectCamarero(item) {
            this.item.id_usuario = item.id_usuario
        },
        clean() {
            this.item = {
                id: 0,
            }
            this.additemModal = false
        },
        editar(id) {
            this.$router.push('/admin/mesas/' + id)
        },
        tomarOrden(id) {
            this.$router.push('/menu/' + id)
        },
        additemtable(item) {
            this.Factura.items.push(item)
        },
        AsitemsCama() {
            this.mesaid = this.$route.params.id
            this.$axios.get('/api/mesa/' + this.mesaid)
                .then(datos => {
                    this.Mesa.id_camarero = datos.data.id_usuario
                })
            this.$axios.put('/api/mesa/' + this.mesaid, this.Mesa, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/mesas')
                })
        },
        AsignarCamarero(id) {
            this.additemModal = true
        },

    }
}
</script>
<style scoped>
@import "@/assets/css/bootstrap.min.css";
</style>