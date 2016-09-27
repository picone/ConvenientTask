<template>
    <div id="pagination">
        <ul class="pagination" v-show="page_count>1">
            <li v-show="page_count>3&&current>1"><a @click="change(1)">&lt;&lt;</a></li>
            <li v-show="current>1"><a @click="change(current-1)">&lt;</a></li>
            <li v-for="i in pages" :class="current==i?'active':''"><a @click="change(i)">{{ i }}</a></li>
            <li v-show="page_count>5&&page_count-current>2"><a>...</a></li>
            <li v-show="current<page_count"><a @click="change(current+1)">&gt;</a></li>
            <li v-show="page_count>5&&page_count-current>2"><a @click="change(page_count)">&gt;&gt;</a></li>
        </ul>
    </div>
</template>

<script>
    export default{
        props:{
            total:{
                type:Number,
                require:true
            },
            per_page:{
                type:Number,
                default:10
            },
            current:{
                type:Number,
                twoway:true,
                default:1
            },
            callback:{
                type:Function,
                require:true
            }
        },
        computed:{
            page_count(){
                return Math.max(1,Math.ceil(this.total/this.per_page));
            },
            pages(){
                let min_page,max_page,arr=[];
                if(this.page_count<=5){//总页数少于5
                    min_page=1;
                    max_page=5;
                }else if(this.current<=2){//前两页时
                    min_page=1;
                    max_page=Math.min(this.page_count,5);
                }else if(this.current>=this.page_count-2){//后两页时
                    min_page=this.page_count-4;
                    max_page=this.page_count;
                }else{
                    min_page=this.current-2;
                    max_page=this.current+2;
                }
                for(let i=min_page;i<=max_page;i++){
                    arr.push(i);
                }
                return arr;
            }
        },
        methods:{
            change(page){
                this.current=page;
                this.callback(page);
            }
        }
    }
</script>

<style scoped>
    #pagination{
        width:100%;
        text-align:center;
    }
    .pagination li{
        cursor:pointer;
    }
</style>
