<template>
    <div>
        <ul class="nav nav-tabs">
            <li v-link="{name:'center.money.record',activeClass:'active'}"><a href="#" data-toggle="tab">消费记录</a></li>
            <li v-link="{name:'center.money.deposit',activeClass:'active'}"><a href="#" data-toggle="tab">充值记录</a></li>
            <li v-link="{name:'center.money.withdraw',activeClass:'active'}"><a href="#" data-toggle="tab">提现记录</a></li>
        </ul>
        <router-view></router-view>
    </div>
</template>
<script>

    export default{
        data(){
            return{
            }
        },
        components:{
        }
    }
</script>
