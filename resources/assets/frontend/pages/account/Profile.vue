<template>
    <transition name="fade">
        <div>
            <h3 class="text-warning">Name: {{$store.state.user.name}}</h3>
            <h4 class="text-danger">編輯個人資料&大頭貼</h4>

            <div>
                <p>{{test}}</p>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        data: function () {
            return {test: 'I am the whole world.'}
        },
        beforeMount(){
            console.log('will mount profile');
        },
        mounted(){
            console.log('mounted profile');
        }
    }
</script>