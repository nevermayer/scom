<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nuevo Ingrediente</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="ingrediente.nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" v-model="ingrediente.stock" class="form-control"
                                    placeholder="stock">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Vencimiento</label>
                                <input type="date" v-model="ingrediente.fecha_vencimiento" class="form-control"
                                    placeholder="fecha_vencimiento">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addIngrediente" class="btn btn-main">Submit</button>
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
            ingrediente: {
                nombre: '',
                stock: '',
                fecha_vencimiento: '',
            }
        }
    },
    mounted() {

    },
    methods: {
        addIngrediente() {

            if (!this.ingrediente.nombre || !this.ingrediente.stock || !this.ingrediente.fecha_vencimiento ) {
                return this.$alertify.error('Incomplete form data')
            }

            this.$axios.post('/api/register', this.ingrediente, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/ingredientes')
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