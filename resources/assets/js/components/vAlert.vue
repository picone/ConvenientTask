<template>
    <alert :show.sync="show" :type="type" width="300px" placement="top" dismissable>{{ msg }}</alert>
</template>

<script>
    import { alert } from 'vue-strap'

    export default{
        data(){
            return{
                msg:'',
                type:'danger',
                show:false
            }
        },
        methods:{
            show(){
                this.show=true;
            },
            hide(){
                this.show=false;
            }
        },
        components:{
            alert
        },
        events:{
            /**
             * 显示警告内容
             * @param msg
             * @param type
             * @param dismissable
             */
            alert(msg,type){
                this.msg=msg;
                this.type=type||'danger';
                this.show=true;
            }
        }
    }
</script>
