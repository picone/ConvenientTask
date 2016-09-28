<template>
    <accordion type="primary" one-at-time>
        <panel header="个人资料" type="primary" is-open>
            <img :src="'http://www.714.hk/uc_server/avatar.php?size=small&uid='+uid"><span>{{ username }}</span>
            <button class="btn btn-danger pull-right" @click="logout">退出</button>
        </panel>
        <panel header="资金明细" type="primary" is-open>
            <ul class="list-inline">
                <li><span>余额:{{ money }}</span></li>
                <li><a v-link="{name:'center.deposit'}" class="btn btn-primary">充值</a></li>
                <li><a v-link="{name:'center.withdraw'}" class="btn btn-success">提现</a></li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item col-xs-6 col-sm-4 col-md-3"><a v-link="{name:'center.money.record'}" href="#">消费记录</a></li>
                <li class="list-group-item col-xs-6 col-sm-4 col-md-3"><a v-link="{name:'center.money.deposit'}" href="#">充值记录</a></li>
                <li class="list-group-item col-xs-6 col-sm-4 col-md-3"><a v-link="{name:'center.money.withdraw'}" href="#">提现记录</a></li>
            </ul>
        </panel>
        <panel header="发任务" is-open="false">
            <ul class="list-grup row">
                <li class="list-group-item col-xs-6 col-sm-4 col-md-3"><i class="glyphicon glyphicon-tasks"></i>&nbsp;我的任务</li>
            </ul>
        </panel>
        <panel header="接任务">
            <ul class="list-grup row">
                <li class="list-group-item col-xs-6 col-sm-4 col-md-3"><i class="glyphicon glyphicon-tasks"></i>&nbsp;我的任务</li>
            </ul>
        </panel>
    </accordion>
</template>

<script>
    import { accordion,panel } from 'vue-strap'

    export default{
        data(){
            return{
                uid:0,
                username:'',
                money:'0.00'
            }
        },
        ready(){
            this.$root.$refs.spinner.show();
            this.$http.get('user/profile').then(response=>{
                if(response.data.code==1){
                    let data=response.data.data;
                    this.uid=data.uid;
                    this.username=data.username;
                    this.money=data.money;
                }else{
                    this.$root.$broadcast('alert',response.data.msg);
                }
            }).then(()=>{
                this.$root.$refs.spinner.hide();
            });
        },
        methods:{
            logout(){
                this.$http.post('user/logout').then(response=>{
                    if(response.data.code==1){
                        window.location='/';
                    }else{
                        this.$root.$broadcast('alert',response.data.msg);
                    }
                });
            }
        },
        components:{
            accordion,
            panel
        }
    }
</script>

<style scoped>
    .list-inline >li{
        margin-right:5px;
    }
    .list-group-item>a{
        display: block;
        width: 100%;
    }
</style>
