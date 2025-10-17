/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');


import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';

import router from './router'

import common from './common'
// import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import vBlur from 'v-blur'
import VueHtmlToPaper from 'vue-html-to-paper';
import VueQrcode from '@chenfengyuan/vue-qrcode';
import VueClock from '@dangvanthanh/vue-clock';
import Vuetify from "../plugins/vuetify";

import JsonExcel from "vue-json-excel";
import VueMask from 'v-mask'
import VueNumeric from 'vue-numeric'


import fundutildtl from './components/faculty/FundUtildtl'

import tesdochdr1 from './components/faculty/tesDocHd'

import tesfund from './components/faculty/FundUtilHrd'
import logs from './components/faculty/logs'

import VuetifyMoney from "vuetify-money";
Vue.use(VuetifyMoney);

// import { AgGridVue } from "ag-grid-vue";
// // import 'ag-grid-enterprise';
// import 'ag-grid-community/dist/styles/ag-grid.css';
// import 'ag-grid-community/dist/styles/ag-theme-alpine.css';

// import {environment} from '../../environment';






Vue.use(VueHtmlToPaper);
Vue.use(vBlur)

Vue.use(Buefy)
Vue.use(VueClock)
Vue.use(ViewUI);
Vue.use(VueMask);
Vue.use(VueNumeric)
// Vue.use(AgGridVue);

// Vue.use(Clock)

// Vue.use(Buefy)




Vue.component("downloadExcel", JsonExcel);
Vue.mixin(common)

Vue.component('equip', require('./components/faculty/equipments.vue').default);
Vue.component('trips', require('./components/faculty/triptickets.vue').default);






Vue.component('Home', require('./components/faculty/Home.vue').default);
Vue.component('userlist', require('./components/faculty/user.vue').default);
// Vue.component('logs', require('./components/faculty/logs.vue').default);

Vue.component('student', require('./components/faculty/students.vue').default);

Vue.component('tesstudentay', require('./components/faculty/tesStudents-AY.vue').default);

Vue.component('tesstudentnotenrolay', require('./components/faculty/tesStudentsNotEnrol-AY.vue').default);

Vue.component('tesstudentpaystat', require('./components/faculty/tesStudentsPayStat.vue').default);


// Vue.component('tesdochdr1', require('./components/faculty/tesDocHdrs.vue').default);



// Vue.component('tesfund', require('./components/faculty/FundUtilHrd.vue').default);
// Vue.component('tesfunddtl', require('./components/faculty/FundUtildtl.vue').default);


Vue.component(VueQrcode.name, VueQrcode);


const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    components:{
        fundutildtl,
        tesfund,
        tesdochdr1,
        logs,

    },
    router,
  
});
