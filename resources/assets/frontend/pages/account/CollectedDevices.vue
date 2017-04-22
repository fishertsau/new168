<template>
    <transition name="fade">
        <div>
            <h3 class="text-warning">Device Collected</h3>
            <ul>
                <li v-for="device in $store.state.likeDevices">{{device.title}}</li>
            </ul>
        </div>
    </transition>
</template>

<script>
    export default {
        mounted: function () {
            console.log(this.$store.state.user.id);
        },
    }
</script>

