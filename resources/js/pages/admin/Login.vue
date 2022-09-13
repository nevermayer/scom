<template>
    <div class="admin-login-wrapper">
        <div class="admin-form-wrapper">
            <h3>Panel de Administración SCOM</h3>

            <div class="form-group">
                <label for="">Nombre de cuenta</label>
                <input type="text" v-model="creds.nombre_cuenta" class="form-control" placeholder="nombre de cuenta" />
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" v-model="creds.password" class="form-control" placeholder="**********" />
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
            }
        }
    },
    methods: {
        signin() {
            const { nombre_cuenta, password } = this.creds
            if (!nombre_cuenta || !password) {
                console.log("hola");
                return;
                // return this.$alertify.error('Incomplete credentials');
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/login', {
                    nombre_cuenta,
                    password
                })
                    .then(response => {
                        if (response.data.success) {
                            localStorage.setItem('token',response.data.access_token);
                            router.push('/admin/dashboard');
                           //this.$router.go('Home');
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })

        },
    }
}
</script>