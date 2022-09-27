<template>
    <div class="admin-login-wrapper">
        <div class="admin-form-wrapper">
            <h3>Panel de Administración SCOM</h3>
            <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                <strong>{{error}}</strong>
            </div>

            <div class="form-group">
                <label for="">Nombre de cuenta</label>
                <input type="text" v-model="creds.nombre_cuenta" class="form-control" autocomplete="username"
                    placeholder="nombre de cuenta" />
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" v-model="creds.password" class="form-control" placeholder="**********"
                    autocomplete="current-password" />
            </div>

            <div class="form-group">
                <button class="btn btn-main btn-block" @click="signin">Ingresar</button>
            </div>

            <div class="form-group form-link">
                <router-link to="/">Volver a Inicio</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import router from '../../router/router';

export default {
    name: 'AdminLogin',
    data() {
        return {
            creds: {
                nombre_cuenta: '',
                password: ''
            },
            error: null
        }
    },
    methods: {
        signin() {
            const { nombre_cuenta, password } = this.creds
            if (!nombre_cuenta || !password) {

                return this.error = 'complete los campos';
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/login', {
                    nombre_cuenta,
                    password
                })
                    .then(response => {
                        if (response.data.success) {
                            localStorage.setItem('token', response.data.access_token)
                            localStorage.user = JSON.stringify(response.data.user)
                            console.log(response.data.user.camareros[0])
                            if (typeof response.data.user.camareros[0] !== 'undefined')
                                localStorage.role = 'camarero'
                            if (typeof response.data.user.chefs[0] !== 'undefined')
                                localStorage.role = 'chef'
                            if (typeof response.data.user.cajeros[0] !== 'undefined')
                                localStorage.role = 'cajero'
                            if (typeof response.data.user.administradors[0] !== 'undefined')
                                localStorage.role = 'admin'
                            router.push('/admin/dashboard');
                            //this.$router.go('Home');
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        this.error = error.response.data.message;
                    });
            })

        },
    }
}
</script>