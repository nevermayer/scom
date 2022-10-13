<template>
    <dashboard-layout>
        <section id="print">
            <strong>Orden #{{ordenid}}</strong>
            <div class="mainText">
                <div>

                </div>
                <div>

                </div>
                <div>
                    <strong>Total :</strong>
                    <br><strong>Fecha :</strong>
                </div>
                <div>
                    <p>{{Orden.total}}Bs</p>
                    <p>{{Orden.fecha}}</p>
                </div>
            </div>


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
            <p class="centered">Gracias por su pedido!
            </p>
        </section>

        <div>
            <div style="flex">
                <button class="btn btn-main" @click="print()">Imprimir Orden</button>
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
            items: [],
            usuario: ''
        }
    },
    mounted() {
        this.ordenid = this.$route.params.id
        this.$axios.get('/api/orden/' + this.ordenid)
            .then(datos => {
                this.Orden.nombre = datos.data.nombre
                this.Orden.estado = datos.data.estado
                this.Orden.total = datos.data.total
                this.Orden.fecha = datos.data.fecha
                this.items = datos.data.productos
                console.log(datos.data.productos)
            })
        if (localStorage.user)
            this.usuario = JSON.parse(localStorage.user)
    }, methods: {
        generarFactura() {
            const data = {
                cajero_id: this.usuario.cajeros[0].id,
                orden_id: this.ordenid,
                total: this.Orden.total
            }
            this.$axios.post('/api/factura', data, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            }).then(res => {
                console.log(res.data.data)
                this.$router.push('/admin/facturas/' + res.data.data)
            }).catch(error => {
                if (error) {
                    return console.log(error)
                }
                this.$alertify.error(Object.values(error.response.data)[0][0])
            })
        },
        print() {
            window.print()
        },
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

@media print {
    body * {
        visibility: hidden;
    }

    #print,
    #print * {
        visibility: visible;
    }

}

.mainText {
    display: flex;
    justify-content: space-evenly;
}

.centered {
    text-align: center;
    align-content: center;
}
</style>