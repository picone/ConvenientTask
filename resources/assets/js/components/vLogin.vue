<template>
    <modal title="登录" backdrop="false" effect="fade" :show.sync="show">
        <div slot="modal-body" class="modal-body">
            <form-group :valid.sync="valid" icon>
                <bs-input :value.sync="username" label="用户名:" error="请输入用户名" help="梦殇国际论坛账号名称" placeholder="用户名" icon required></bs-input>
                <bs-input :value.sync="password" label="密码:" error="请输入密码" placeholder="密码" type="password" @keyup.enter="login" icon required></bs-input>
                <div class="row">
                    <div class="col-xs-7">
                        <bs-input :value.sync="captcha" label="验证码:" error="请输入验证码" placeholder="验证码" icon required></bs-input>
                    </div>
                    <div class="col-xs-5">
                        <img :src="captcha_url" @click="refresh_captcha">
                    </div>
                </div>
                <checkbox :checked.sync="remember" type="success">记住登录</checkbox>
            </form-group>
        </div>
        <div slot="modal-footer" class="modal-footer">
            <button type="button" class="btn btn-default" @click="show=false">关闭</button>
            <a href="http://www.714.hk/member.php?mod=register" class="btn btn-success" target="_blank">注册</a>
            <button type="button" class="btn btn-primary" @click="login" :disabled="!valid">登录</button>
        </div>
    </modal>
</template>

<script>
    import { modal,input,formGroup,checkbox } from 'vue-strap'
    const CAPTCHA_URL='/common/captcha';

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
                username:'',
                password:'',
                captcha:'',
                remember:true,
                valid:false,
                captcha_url:CAPTCHA_URL
            }
        },
        methods:{
            login(){
                this.$root.$refs.spinner.show();
                this.$http.post('user/login',{username:this.username,password:this.password,captcha:this.captcha,remember:this.remember}).then(response=>{
                    if(response.data.code==1){
                        sessionStorage.setItem('uid',response.data.data.uid);
                        sessionStorage.setItem('username',response.data.data.username);
                        window.location.reload();
                    }else{
                        this.$root.$broadcast('alert',response.data.msg);
                    }
                }).then(()=>{
                    this.$root.$refs.spinner.hide();
                });
            },
            refresh_captcha(){
                this.captcha_url=CAPTCHA_URL+'?'+Math.random()
            }
        },
        components:{
            modal,
            'bs-input':input,
            formGroup,
            checkbox
        }
    }
</script>
