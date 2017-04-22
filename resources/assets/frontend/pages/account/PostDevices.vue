<template>
    <transition name="fade">
        <div>
            <div>刊登設備</div>
            <ul>
                <li v-for="device in $store.state.userDevices">{{device.title}}</li>
            </ul>
            <hr>
            <a href="/devicePosters/create" class="btn full-width btn-danger">新增設備</a>
        </div>
    </transition>
</template>

<script>
    export default {}
</script>