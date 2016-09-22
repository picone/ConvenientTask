<template>
    <modal title="登录" backdrop="false" effect="fade" :show.sync="show">
        <div slot="modal-body" class="modal-body">
            <bs-input label="用户名:" error="请输入用户名" help="梦殇国际论坛账号名称" placeholder="用户名" icon="true" required="true"></bs-input>
            <bs-input label="密码:" error="请输入密码" placeholder="密码" type="password" icon="true" required="true"></bs-input>
        </div>
        <div slot="modal-footer" class="modal-footer">
            <button type="button" class="btn btn-default" @click="show=false">关闭</button>
            <a href="http://www.714.hk/member.php?mod=register" class="btn btn-success" target="_blank">注册</a>
            <button type="button" class="btn btn-primary" @click="login">登录</button>
        </div>
    </modal>
</template>

<script>
    import { modal,input } from 'vue-strap'

    export default{
        props:{
            show: {
                required:true,
                type:Boolean,
                twoWay:true
            },
        },
        data(){
            return{

            }
        },
        methods:{
            login(){

            }
        },
        components:{
            modal,
            'bs-input':input
        }
    }
</script>
