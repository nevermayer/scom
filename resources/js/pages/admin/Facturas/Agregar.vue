<template>
    <dashboard-layout>
        <form enctype="multipart/form-data">
            <div id="print-area">
                <div class="row ">
                    <hr />
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h2>Solicitud de Factura :</h2>
                    </div>
                </div>
                <div class="row activity-card">
                    <hr />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped  table-hover">
                                <thead>
                                    <tr>
                                        <th class='text-center'>ID</th>
                                        <th>Total</th>
                                        <th class='text-center'>Fecha</th>
                                        <th class='text-center'>Cajero Id</th>
                                        <th class='text-center'>Orden Id</th>
                                        <th class='text-right'></th>
                                    </tr>
                                </thead>
                                <tbody class='items'>
                                    <tr v-for="(item, index) in Factura.items" :key="index">
                                        <td class='text-center'>{{item.id}}</td>
                                        <td>{{item.nombre}}</td>
                                        <td class='text-center'>{{item.cantidad}}</td>
                                        <td class='text-right'><button type="button" class="btn btn-main-gradient"
                                                @click="dropItem(index)"><span class="ti-trash"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-info btn-sm" @click="addFactura()">
                                                Agregar Pedido</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr />
            </div>
            <div class="row pad-bottom  pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-success" @click="addFactura()">Generar Factura</button>
                </div>
            </div>
        </form>
    </dashboard-layout>
    <modal v-if="additemModal" @close="additemModal = false">
        <template #header>
            <h4 class="modal-title" id="myModalLabel">Agregar Pedidop1</h4>
        </template>
        <template #body>
            <div class="col-md-12">
                <label>Pedido</label>
                <input class="form-control" v-model="item.nombre">
                <input type="hidden" class="form-control" v-model="item.id">
                <ul v-if="item.id==0">
                    <li v-for="(Orden, index) in Orden" :key="index"
                        @click="selecOrden(Orden)">{{Orden.nombre}}</li>
                </ul>
            </div>
            <div class="col-md-12">
                <label>Cantidad</label>
                <input type="number" class="form-control" v-model="item.cantidad" required>

            </div>
        </template>
        <template #footer>
            <div class="modal-footer">
                <button class="btn btn-main-gradient" @click="clean()">
                    Cerrar
                </button>
                <button class="btn btn-main" @click="addTable(item)">
                    Agregar
                </button>
            </div>
        </template>
    </modal>
</template>

<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'
import modal from '@/components/Modal.vue'
export default {
    name: 'Agregar',
    components: {
        DashboardLayout,
        modal
    },
    data() {
        return {
            additemModal: false,
            item: {
                id: 0,
                nombre: '',
                cantidad: 1
            },
            categories: [],
            Factura: {
                total:'',
                fecha:'',
            },
            usuario:''
        }
    },
    mounted() {
        if (localStorage.user){
            this.usuario = JSON.parse(localStorage.user)
        }
        this.$axios.get('/api/facturas')
            .then(res => {
                this.facturas = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
    },
    methods: {
        clean() {
            this.item = {
                id: 0,
                nombre: '',
                cantidad: 1
            }
            this.additemModal = false
        },
        addOrden() {
            this.additemModal = true
        },
        addTable(item) {
            this.Factura.items.push(item)
            this.clean()
        },
        selectOrden(item) {
            this.item.id = item.id
            this.item.nombre = item.nombre
        },
        dropItem(index) {
            this.Factura.items.splice(index, 1)
        },
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