<template>
    <dashboard-layout>
        <h2>Orden #{{ordenid}}</h2>
        <hr />
        <div class="mainText">

            <div>
                <h5>Camarero:</h5>
                <h5>Chef:</h5>
               
            </div>
            <div>
                <h5>null</h5>
                <h5>null</h5>
            </div>
            <div>
                <h5>Estado:</h5>
                <h5>Total:</h5>
                <h5>Fecha:</h5>
            </div>
            <div>
                <h5>{{Orden.estado}}</h5>
                <p>{{Orden.total}}Bs</p>
                <p>{{Orden.fecha}}</p>
            </div>
        </div>

        <div>
            <table class="table table-borderless factura">
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Nombre</th>
                        <th>Precio Unitario</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                        <td>{{item.pivot.cantidad}}</td>
                        <td>{{item.nombre}}</td>
                        <td>{{item.precio}}</td>
                        <td>{{item.precio*item.pivot.cantidad}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Total Orden</th>
                        <th>Bs. {{Orden.total}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div>
            <div style="flex">
<button class="btn btn-primary">generar Factura</button>
<button class="btn btn-main">Imprimir Orden</button>
            </div>
        </div>
    </dashboard-layout>
</template>
<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'
export default {
    name: 'ViewOrdenes',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            ordenid: 0,
            Orden: {
                nombre: '',
                estado: '',
                total: 0,
                fecha: 0
            },
            items: []
        }
    },
    mounted() {
        this.ordenid = this.$route.params.id
        this.$axios.get('/api/orden/' + this.ordenid)
            .then(datos => {
                this.Orden.nombre = datos.data.nombre
                this.Orden.estado = datos.data.estado
                this.Orden.total = datos.data.total
                this.Orden.fecha=datos.data.fecha
                this.items = datos.data.productos
                console.log(datos.data.productos)
            })
        // this.getOrders()
    }, methods: {
        getOrders() {
            this.$axios.get('/api/orden', {
                headers: {
                    Authorization: `Bearer ${localStorage.authtoken}`
                }
            })
                .then(res => {
                    console.log(res.data.data)
                    this.orders = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        }, editar(id) {
            this.$router.push('/admin/ordenes/' + id)
        }
        }
}
</script>
<style scoped>
@import "@/assets/css/bootstrap.min.css";

.mainText {
    display: flex;
    justify-content: space-evenly;
}

.factura {
    table-layout: fixed;
}

.fact-info>div>h5 {
    font-weight: bold;
}

.factura>thead {
    border-top: solid 3px #000;
    border-bottom: 3px solid #000;
}

.factura>thead>tr>th:nth-child(2),
.factura>tbod>tr>td:nth-child(2) {
    width: 300px;
}

.factura>thead>tr>th:nth-child(n+3) {
    text-align: right;
}

.factura>tbody>tr>td:nth-child(n+3) {
    text-align: right;
}

.factura>tfoot>tr>th,
.factura>tfoot>tr>th:nth-child(n+3) {
    font-size: 24px;
    text-align: right;
}

.cond {
    border-top: solid 2px #000;
}
</style>