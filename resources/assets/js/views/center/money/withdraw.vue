<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>金额</th>
                <th>实际到账金额</th>
                <th>状态</th>
                <th>创建时间</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in records">
                <td>{{ item.id }}</td>
                <td>{{ item.money }}</td>
                <td>{{ item.real_money }}</td>
                <td>{{ item.status }}</td>
                <td>{{ item.created_at }}</td>
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
            this.changePage(this.current);
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
                this.$root.$refs.spinner.show();
                this.$http.get('record/withdraw?page='+page).then(response=>{
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
            }
        },
        components:{
            vPagination
        }
    }
</script>
