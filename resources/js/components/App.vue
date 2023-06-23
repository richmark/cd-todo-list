<template>
    <div>
        <NavBar></NavBar>
        <div class="actualContent">
            <RouterView/>
        </div>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";

export default {
    name: 'App',
    components: {NavBar}
}
</script>

<style scoped>
    .actualContent {
        margin-top: 1%;
        margin-bottom: 1%;
        margin-right: 1%;
        margin-left: 1%;
    }
</style>