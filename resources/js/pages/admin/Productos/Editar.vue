<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Producto</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="Producto.nombre" class="form-control" placeholder="nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <input type="text" v-model="Producto.descripcion" class="form-control"
                                    placeholder="descripcion">
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="number" v-model="Producto.precio" class="form-control"
                                    placeholder="precio">
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="number" v-model="Producto.cantidad" class="form-control"
                                    placeholder="cantidad">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="editProducto" class="btn btn-main">Submit</button>
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
        this.productoid = this.$route.params.id
        this.$axios.get('/api/Producto/' + this.productoid)
            .then(datos => {
                this.Producto.nombre = datos.data.data.nombre
                this.Producto.descripcion = datos.data.data.descripcion
                this.Producto.precio= datos.data.data.precio
                this.Producto.cantidad= datos.data.cantidad
                
            })
    },
    data() {
        return {
            Productoid: null,
            Producto: {
                nombre: '',
                descripcion: '',
                precio: '',
                cantidad: '',
            }
        }
    }, methods: {
        editProducto() {
            this.$axios.put('/api/Producto/' + this.productoid, this.Producto, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/productos')
                })
        }
    }
}
</script>