<template>
    <transition name="fade">
        <div>
            <router-link to="/likes/device">收藏設備</router-link>

            <router-view></router-view>
        </div>
    </transition>
</template>


<script>
    export default {
        mounted: function () {
            console.log(this.$store.state.user.name);
        },
    }
</script>