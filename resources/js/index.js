require('./bootstrap');
window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
import VueRouter from "vue-router";

//import main components
import App from "./App";
import todoList from './components/todoList';
import vueTitle from './components/vueTitle';
import todoSave from './components/todoSave';


//window. to avoid injecting
// axios sending get intead of post
const pending = 0;
const done = 1;
const titleprefix = 'Todo | ';

Vue.use(BootstrapVue);
Vue.use(VueRouter);

var routes = [{
        path: '/tasks/:id',
        name: 'tasks',
        components: {
            title: vueTitle,
            save: todoSave
        },
        props: {
            save: true,
            title: {
                title: titleprefix + 'Tasks'
            },
        },
    },
    {
        path: '/',
        name: "home",
        components: {
            title: vueTitle,
            list: todoList,
            save: todoSave
        },
        props: {
            title: {
                title: titleprefix + 'Home'
            },
            save: true
        }
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

//Vue.config.productionTip = false

window.vm = new Vue({
    pending,
    done,
    router,
    el: '#app',
    template: '<App/>',
    components: {
        App
    }
});
