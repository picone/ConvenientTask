<template>
    <navbar placement="top" type="inverse">
        <a slot="brand" href="#" v-link="{name:'index',activeClass:'active'}" title="放心接" class="navbar-brand"><i class="glyphicon glyphicon-home"></i>放心接</a>
        <li><a href="#"><i class="glyphicon glyphicon-edit"></i>&nbsp;发任务</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-bullhorn"></i>&nbsp;接任务</a></li>
        <li slot="right">
            <a href="#" v-if="!uid" @click.prevent="show_login=true"><i class="glyphicon glyphicon-user"></i>&nbsp;注册/登录</a>
            <a href="#" v-link="{name:'center',activeClass:'active'}" v-if="uid&&uid>0"><img id="head_img" :src="'http://www.714.hk/uc_server/avatar.php?size=small&uid='+uid">&nbsp;{{ username }}</a>
        </li>
    </navbar>
    <v-login v-if="!uid" :show.sync="show_login"></v-login>
</template>

<script>
    import { navbar } from 'vue-strap'
    import vLogin from './vLogin.vue'

    export default{
        props:{
            uid:{
                type:Number,
                default:0
            },
            username:{
                type:String,
                default:null
            }
        },
        data(){
            return {
                show_login:false
            }
        },
        components:{
            navbar,
            vLogin
        }
    };
</script>

<style type="" scoped>
    #head_img{
        max-height:20px;
    }
</style>
