<template>
    <div>
        <v-header></v-header>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import vHeader from '../components/vHeader.vue'

    export default{
        ready(){
        },
        data(){
            return{
            }
        },
        components:{
            vHeader
        }
    }
</script>
