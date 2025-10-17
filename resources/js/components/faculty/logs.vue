
<template>
		  <v-app>
                     <div class="container-fluid">
                         <p class="title">System Logs</p>
                       <div style="border:1px solid lightgray; text-align:center !important;">

                     

                                    <v-data-table 
                                                        
                                                        dense
                                                        :headers="headers"
                                                        :items="loglist"
                                                        :loading="loading"
                                                        scrollable
                                                        :search="search"
                                                        class="elevation-1 pa-2"
                                                        
                                                        v-model="selectedlist"

                                                    
                                                        :options.sync="pagination"
                                                        :server-items-length="total"
                                                    :page.sync="page"
                                                        :items-per-page="itemsPerPage"
                                                        hide-default-footer
                                                    
                                                        @page-count="pageCount = $event"
                                                
                                                    
                                                    
                                                        >

                                    </v-data-table>

                                    <v-pagination
                                        v-model="page"
                                        :length="pageCount"
                                        :total-visible="7"
                                    ></v-pagination>

                          </div>

                    </div>

          
			</v-app>	

</template>

<script>

    export default {

       
    	data(){
    		
    		return {

                 pagination: {},
                       
                rowsPerPageItems: [5, 10, 20, 50, 100],

                page: 1,
                pageCount: 0,
                itemsPerPage: 50,

                

                isPaginated: true,
                isPaginationSimple: false,
                isPaginationRounded: false,
                paginationPosition: 'bottom',
                defaultSortDirection: 'asc',
                sortIcon: 'arrow-up',
                sortIconSize: 'is-small',
                currentPage: 1,
                perPage:20,


              

                loglist: [],
                institute_list:'',
                institute_lists:[],

                addModal:false,
                editModal:false,
              	isAdding:false,


              	data:{
            				name:'',
            				email:'',
            				password:'',
            				userType:'',
            				username:'',
            				role:'',
    			       },
                	dataedit:{
                        id:'',
            				name:'',
            				email:'',
            				password:'',
            				userType:'',
            				username:'',
            				role:'',
    			       },

                        isDeleting: false,
                showDeleteModal : false,
                showEditModal:false,
                deleteItem: {},
                deletingIndex : -1,

                   headers: [
                        
                        { text: 'ID', value: 'id' ,align: 'center', width: 70},
                        { text: 'Action', value: 'action', align: 'center' },
                        { text: 'Event', value: 'actionDtl' ,align: 'center'},
                        { text: 'Event Details', value: 'details', align: 'center' },
                        { text: 'User', value: 'user', align: 'center' },
                       
                        { text: 'Date Created', value: 'created_at' , align: 'center'},
                     
                        
                      ],

                      total:0,

                    
                
    		}
    	},
    	mounted(){

    		// this.getlogs();
    	
      	},

         watch: {

                 pagination() {
                        this.getlogs();
                    },
               
        },

    	methods: {

            	


	        getlogs(){
	        	this.token = window.Laravel.csrfToken
	            // axios.get('/api/getlogs')
	            //     .then(function (res){
	            //         return res.data;
	            //     })
	            //     .catch(function (error){
	            //         console.log(error.response);
	            //     })
	            //     .then(res=>{
	            //         this.loglist = res;
	            //     })

                   axios.get(`/getlogs?page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                        //  this.disabledSearch=false
                        this.loglist = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
	        },


	     

        

        }
    
    }

   
</script>

<style scoped>
      .space2{
	    margin-bottom: 10px;
	    margin-top: 0px;
	}  
    
    
      .v-data-table ::v-deep th{
        font-size: 12px !important;
        vertical-align: middle !important;
        /* text-align: center !important; */
        
        }
    .v-data-table ::v-deep td{
        font-size: 12px !important;
        vertical-align: middle !important;
        /* text-align: left !important; */
        }


        .border {
        border: 2px dashed orange;
        }

</style>


