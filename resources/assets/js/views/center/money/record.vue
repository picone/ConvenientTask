<template>
    <div>
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>金额</th>
                <th>类型</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in records">
                <td>{{ item.id }}</td>
                <td>{{ item.money }}</td>
                <td>{{ item.way }}</td>
                <td v-if="item.type==0"><a v-link="{name:''}" href="#" class="btn btn-primary">详情</a></td>
            </tr>
        </tbody>
        </table>
        <v-pagination :total="total" :per_page="per_page" :current.sync="current" :callback="changePage"></v-pagination>
    </div>
</template>
<script>
    import vPagination from '../../../components/vPagination.vue'

    export default{
        ready(){
            this.$root.$refs.spinner.show();
            this.$http.get('record/consume').then(response=>{
                if(response.data.code==1){
                    let data=response.data.data;
                    this.records=data.data;
                    this.total=data.total;
                    this.per_page=data.per_page;
                }else{
                    this.$root.$broadcast('alert',response.data.msg);
                }
            }).then(()=>{
                this.$root.$refs.spinner.hide();
            });
        },
        data(){
            return{
                records:[],
                total:0,
                per_page:10,
                current:1
            }
        },
        methods:{
            changePage(page){
                console.log(page);
            }
        },
        components:{
            vPagination
        }
    }
</script>

<style scoped>
    .table thead th:last-child{
        width:40px;
    }
</style>
