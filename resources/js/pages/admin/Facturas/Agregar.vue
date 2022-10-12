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
                <div class="form-group">
                    <label for="">NIT</label>
                    <input type="number" v-model="cliente.id" class="form-control" placeholder="NIT/ID Cliente">
                </div>
                <div class="form-group">
                    <button type="button" @click="buscarCliente()" class="btn btn-main"> Buscar Cliente</button>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" v-model="cliente.nombre" class="form-control" placeholder="Nombre Cliente">
                </div>
                <div class="row activity-card">
                    <hr />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped  table-hover">
                                <thead>
                                    <tr>
                                        <th class='text-center'>ID</th>
                                        <th>Producto</th>
                                        <th class='text-center'>Cantidad</th>
                                        <th class='text-center'>Precio unitario</th>
                                        <th class='text-center'>Importe</th>
                                        <th class='text-right'></th>
                                    </tr>
                                </thead>
                                <tbody class='items'>
                                    <tr v-for="(item, index) in Factura.items" :key="index">
                                        <td class='text-center'>{{item.id}}</td>
                                        <td>{{item.nombre}}</td>
                                        <td class='text-center'>{{item.pivot.cantidad}}</td>
                                        <td class='text-center'>{{item.precio}}</td>
                                        <td class='text-center'>{{item.pivot.cantidad*item.precio}}</td>
                                        <td class='text-right'><button type="button" class="btn btn-main-gradient"
                                                @click="dropItem(index)"><span class="ti-trash"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-info btn-sm" @click="addOrden()">
                                                Agregar Orden</button>
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
            <h4 class="modal-title" id="myModalLabel">Agregar Orden</h4>
        </template>
        <template #body>
            <div class="col-md-12">
                <label>Orden</label>
                <input class="form-control" v-model="ordenid">
            </div>
        </template>
        <template #footer>
            <div class="modal-footer">
                <button class="btn btn-main-gradient" @click="clean()">
                    Cerrar
                </button>
                <button class="btn btn-main" @click="additemsOrder()">
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
            cliente: {
                id: '',
                nombre: '',
                apellido_pat: '',
                apellido_mat: '',
                email: '',
                password: '',
                telefono: '',
                activo: ''
            },
            ordenid: 0,
            categories: [],
            Factura: {
                total: '',
                fecha: '',
                items: []
            },
            usuario: '',

        }
    },
    mounted() {
        if (localStorage.user) {
            this.usuario = JSON.parse(localStorage.user)
        }
        this.$axios.get('/api/facturas')
            .then(res => {
                this.Factura = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
    },
    methods: {
        buscarCliente() {
            this.$axios.get('/api/cliente/' + this.cliente.id)
                .then(res => {
                    console.log(res.data)
                    this.cliente = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        additemsOrder() {
            console.log(this.ordenid)
            this.$axios.get('/api/orden/' + this.ordenid)
                .then(res => {
                    console.log(res.data.productos)
                    this.Factura.items = res.data.productos
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
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
            console.log(this.usuario.cajeros[0].id)
            let total=0
            this.Factura.items.map(item => {
                total += Number(item.precio) * Number(item.pivot.cantidad)
            })
            const data = {
                cajero_id: this.usuario.cajeros[0].id,
                items: JSON.stringify(this.Factura.items),
                orden_id: this.ordenid,
                cliente_id:this.cliente.id,
                total:        total    
            }
            this.$axios.post('/api/factura', data, {
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
    }, computed: {
        search() {

        }

    }
}
</script>

<style scoped>
@import "@/assets/css/bootstrap.min.css";
</style>