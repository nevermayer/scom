<template>

</template>

<script>
export default {
    name: 'Nav',
    methods: {
        signout() {
            localStorage.removeItem('authtoken')
            localStorage.removeItem('admin')
            this.$router.push('/admin/login');
        }
    }
}
</script>