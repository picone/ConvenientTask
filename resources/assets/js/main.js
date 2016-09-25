import Vue from 'vue'
import App from './containers/App.vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import ConfigRouter from './router.js'

window.$=window.jQuery=require('jquery');

Vue.use(VueResource);
Vue.http.options.xhr={
    withCredentials:true
};
Vue.http.options.emulateHTTP=true;
const CSRF_TOKEN=$('meta[name="_token"]').attr('content');
Vue.http.interceptors.push((req,next)=>{
    req.credentials=true;
    req.headers['X-CSRF-TOKEN']=CSRF_TOKEN;
    next();
});
Vue.use(VueRouter);
let router=new VueRouter();
ConfigRouter(router);
router.start(App,'#app');
