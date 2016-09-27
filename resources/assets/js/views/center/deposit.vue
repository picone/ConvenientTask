<template>
    <panel header="充值" type="primary" is-open>
        <form action="/user/deposit" method="post">
            <input type="hidden" name="_token" :value="token">
            <form-group :valid.sync="valid" icon>
                <div class="row">
                    <bs-input :value.sync="money" label="金额(元):" name="money" type="number" min="1" error="请输入正确的充值金额" help="请输入整数金额" placeholder="金额" class="col-xs-12 col-sm-6" required></bs-input>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label class="control-label">实际到账:</label>
                        <input class="form-control" type="text" :value="money*0.985 | currency '¥'" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6">
                        <label class="control-label">充值渠道:</label>
                        <v-select :value.sync="type" :options="deposit_way" name="type" close-on-select></v-select>
                    </div>
                </div>
            </form-group>
            <div class="col-xs-12">
                <button class="btn btn-primary pull-right" :disabled="!valid">充值</button>
            </div>
        </form>
    </panel>
</template>

<script>
    import { panel,input,formGroup,select } from 'vue-strap'

    export default{
        data(){
            return {
                token:window._token,
                money:'10',
                type:1,
                valid:true,
                deposit_way:[
                    {value:1,label:'通道1'}
                ]
            }
        },
        components:{
            panel,
            'bs-input':input,
            formGroup,
            'v-select':select
        }
    }
</script>

<style scoped>
    .fee{
        color:red;
        font-size:16px;
        font-weight:400;
    }
</style>
