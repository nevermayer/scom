<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nuevo Producto</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="Producto.nombre" class="form-control" placeholder="Nombre">
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
                                <input type="password" v-model="Producto.cantidad" class="form-control"
                                    placeholder="cantidad">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addProducto" class="btn btn-main">Submit</button>
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
            Producto: {
                nombre: '',
                descripcion: '',
                precio: '',
                cantidad: '',
            }
        }
    },
    mounted() {

    },
    methods: {
        addProducto() {

            if (!this.Producto.nombre || !this.Producto.descripcion || !this.Producto.precio || !this.cantidad) {
                return this.$alertify.error('Incomplete form data')
            }

            this.$axios.post('/api/register', this.Producto, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/productos')
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