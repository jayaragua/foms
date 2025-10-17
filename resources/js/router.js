import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import fundutildtl from './components/faculty/FundUtildtl'
import tesfund from './components/faculty/FundUtilHrd'
import logs from './components/faculty/logs'



export default new Router({
	mode: 'history',
	
	routes:[
		
		{
			path:'/tes-fund-disbursement/:id',
			component: fundutildtl,
		
		},

		{
			path:'/tes-fund',
			component: tesfund,
		
		},

		{
			path:'/logs',
			component: logs,
		
		},



		//admin
		// {
		// 	path:'/grade-lvl-admin',
		// 	component: grdlvl,
			
			
		// },
		// {
		// 	path:'/week-qtr-admin/:grade/:qtr',
		// 	component: week,
		
		// },

		// {
		// 	path:'/slm-admin/:id',
		// 	component: slm,
		
		// },

		// {
		// 	path:'/school-admin',
		// 	component: school,
		
		// },


		// {
		// 	path:'/grade-level',
		// 	component: grd,
		
		// },

		// {
		// 	path:'/module-type',
		// 	component: modtype,
		
		// },

		// {
		// 	path:'/subject',
		// 	component: subj,
		
		// },

		// {
		// 	path:'/module',
		// 	component: module,
		
		// },


		




		



		
		
	],
});