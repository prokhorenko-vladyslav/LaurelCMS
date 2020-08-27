<template>
    <div class="container-fluid p-0">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Main",
        data: () => ({
            loaded : true
        }),
        created() {
            console.log(this.$router);
            let script = document.createElement('script');

            script.setAttribute('src','/admin/js/additional-routes.js')

            console.log(this.hasActiveApp('admin.auth.forgot'))
            document.head.appendChild( script );

            setTimeout(() => {
                window.routes = window.additional_routes;
                this.resetRouter()
                //this.$router.matcher = window.createRouter().matcher;

                console.log(this.hasActiveApp('admin.auth.forgot'))
            }, 2000)
        },
        methods : {
            hasActiveApp(appName) {
                const link = this.$router.resolve({
                    name: appName,
                });
                if (link && link.href !== '/') {
                    return true;
                }
                return false;
            },
            resetRouter() {
                const newRouter = window.createRouter()
                this.$router.matcher = newRouter.matcher // reset router
                this.$router.options.routes = []
            }
        }
    }
</script>

<style scoped>

</style>
