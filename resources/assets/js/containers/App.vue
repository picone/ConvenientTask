<template>
    <div>
        <v-header :uid="uid" :username="username"></v-header>
        <div class="container">
            <router-view></router-view>
        </div>
        <spinner v-ref:spinner size="lg" fixed text="亲等一下哦~"></spinner>
        <v-alert></v-alert>
    </div>
</template>

<script>
    import vHeader from '../components/vHeader.vue'
    import vAlert from '../components/vAlert.vue'
    import { spinner } from  'vue-strap'

    export default{
        data(){
            return{
                uid:parseInt(window.user.uid||0),
                username:window.user.username||''
            }
        },
        components:{
            vHeader,
            vAlert,
            spinner
        }
    }
</script>

<style scoped>
    .container{
        margin-top:10px;
    }
</style>
