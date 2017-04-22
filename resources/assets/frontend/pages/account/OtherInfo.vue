<template>
    <transition name="fade">
        <div>其他資訊</div>
    </transition>
</template>

<script>
    export default {
        mounted: function () {
            this.$store.commit('increment', 10)
        },
    }
</script>