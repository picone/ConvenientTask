import Vue from 'vue'
import App from './containers/App.vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import ConfigRouter from './router.js'

require('jquery');

Vue.use(VueResource);
Vue.http.options.root='/';
Vue.http.options.xhr={
    withCredentials:true
};
Vue.http.options.emulateHTTP=true;
Vue.http.interceptors.push((req,next)=>{
    req.credentials=true;
    next();
});
Vue.use(VueRouter);
let router=new VueRouter();
ConfigRouter(router);
router.start(App,'#app');
