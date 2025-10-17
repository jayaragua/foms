
<template>
		  
                     <div class="">
                        <p class="_title0"> 
                        	
            				    <button class="button is-info is-focused" @click="addModal=true" >
							    <span class="icon is-small">
							      <i class="fas fa-plus"></i>
							    </span>
							    <span>Add User</span>
							  </button></p>

                        <!-- <div class="tab_border"> -->
                     	
                            <b-table 
                                    :data="userlists"
                                    :paginated="isPaginated"
                                    :per-page="perPage"
                                    :current-page.sync="currentPage"
                                    :pagination-simple="isPaginationSimple"
                                    :pagination-position="paginationPosition"
                                    :pagination-rounded="isPaginationRounded"
                                    :sort-icon="sortIcon"
                                    :sort-icon-size="sortIconSize"
                                    default-sort="user.first_name"
                                    aria-next-label="Next page"
                                    aria-previous-label="Previous page"
                                    aria-page-label="Page"
                                    aria-current-label="Current page">


                                    <b-table-column centered field="id"  label="ID" width="100" sortable numeric v-slot="props">
                                        {{ props.row.id }}
                                    </b-table-column>

                                    <b-table-column searchable left  field="name"  label="Name" sortable  placeholder="Search..." icon="magnify" size="is-small" v-slot="props">
                                        {{ props.row.name }}
                                    </b-table-column>
                                    <b-table-column searchable left  field="username"  label="Username" sortable  placeholder="Search..." icon="magnify" size="is-small" v-slot="props">
                                        {{ props.row.username }}
                                    </b-table-column>
                                    <b-table-column searchable left  field="email" label="Email" sortable  placeholder="Search..." icon="magnify" size="is-small" v-slot="props">
                                        {{ props.row.email }}
                                    </b-table-column>

                                    <b-table-column searchable field="userType" width="150" label="User Type" sortable placeholder="Search..." icon="magnify" size="is-small" centered v-slot="props">
                                        {{ props.row.userType }}
                                    </b-table-column>

                                     <!-- <b-table-column searchable field="insCode"  label="Office" sortable placeholder="Search..." icon="magnify" size="is-small" centered v-slot="props">
                                        {{ props.row.DeptCode }}
                                    </b-table-column> -->

                                    <b-table-column searchable field="created_at" class="demo-table-info-row" label="Created at" sortable placeholder="Search..." icon="magnify" size="is-small" v-slot="props">             
                                            {{ props.row.created_at }}
                                    </b-table-column>

                                     <b-table-column  label="Action" centered  v-slot="props" width="200">
                                        <span>
                                             <b-button type="is-info" size="is-small"  @click="showEditModal1(props.row.id, props.row.name, props.row.username, props.row.email, props.row.userType)" >Edit</b-button>
                                             <b-button type="is-danger" size="is-small" @click="showDeletingModal(props.row.id)" :loading="props.index.isDeleting" >Delete</b-button>
                                        </span>
                                    </b-table-column>
                                     

                                    
                                </b-table>


                        <!-- </div> -->

                        <!-- add modal-->
					 <Modal
				        v-model="addModal"
				        title="Add User"
				        :mask-closable="false"
				        :closable="false"
				        >
                        <label>Name</label>
                        <div class="space2">
                            <Input v-model="data.name" type="textarea" :autosize="true" placeholder="Full Name"  />
                        </div>
                          <label>UserName</label>
                         <div class="space2">
                            <Input v-model="data.username" type="textarea" :autosize="true" placeholder="UserName"  />
                        </div>
				        <label>Email</label>
					    <div class="space2">
					     	<Input v-model="data.email" type="text" :autosize="true" placeholder="Email"  />
					    </div>
					    <label>Password</label>
					    <div class="space2">
					     	<Input v-model="data.password" type="password" :autosize="true" placeholder="Password"  />
					    </div>
					   	<label>Role</label>
                        <div class="space2">
                            <Select v-model="data.role"
                                placeholder="Select User">
                                <Option  value="Admin" >ADMINISTRATOR</Option>
                                <Option value="User" >USER</Option>
                                <Option value="Acctg" >ACCOUNTING</Option>
                            </Select>
                        </div>

                  


				        <div slot="footer">
				        	<Button type="default" @click="addModal=false">Close</Button>
				        	<Button type="primary" @click="addUser" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add User'}}</Button>
				        </div>
				    </Modal>


                      <!-- add modal-->
					 <Modal
				        v-model="editModal"
				        title="Edit User"
				        :mask-closable="false"
				        :closable="false"
				        >
                        <label>Name</label>
                        <div class="space2">
                            <Input v-model="dataedit.name" type="textarea" :autosize="true" placeholder="Full Name"  />
                        </div>
                        <label>UserName</label>
                         <div class="space2">
                            <Input v-model="dataedit.username" type="textarea" :autosize="true" placeholder="UserName"  />
                        </div>
				        <label>Email</label>
					    <div class="space2">
					     	<Input v-model="dataedit.email" type="text" :autosize="true" placeholder="Email"  />
					    </div>
					    <label>Password</label>
					    <div class="space2">
					     	<Input v-model="dataedit.password" type="password" :autosize="true" placeholder="Password"  />
					    </div>
					   	<label>Role</label>
                        <div class="space2">
                            <Select v-model="dataedit.userType"
                                placeholder="Select User">
                                <Option  value="Admin" >ADMINISTRATOR</Option>
                                <Option value="User" >USER</Option>
                                <Option value="Acctg" >ACCOUNTING</Option>
                            </Select>
                        </div>

                  


				        <div slot="footer">
				        	<Button type="default" @click="editModal=false">Close</Button>
				        	<Button type="primary" @click="edituser" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing...' : 'Edit User'}}</Button>
				        </div>
				    </Modal>



                    	<!--delete modal-->
						<Modal v-model="showDeleteModal" width="360">
							<p slot="header" style="color:#f60;text-align:center">
								<Icon type="ios-information-circle"></Icon>
								<span>Delete confirmation</span>
							</p>
							<div style="text-align:center">
								<p>Are you sure you want to delete this User?</p>
							
							</div>
							<div slot="footer">
								<Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteItems()">Delete</Button>
							</div>
						</Modal>




                    </div>

          
				

</template>

<script>

    export default {

       
    	data(){
    		
    		return {

                

                isPaginated: true,
                isPaginationSimple: false,
                isPaginationRounded: false,
                paginationPosition: 'bottom',
                defaultSortDirection: 'asc',
                sortIcon: 'arrow-up',
                sortIconSize: 'is-small',
                currentPage: 1,
                perPage:20,


              

                userlists: [],
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


                
    		}
    	},
    	mounted(){

    		this.getUsers();
    	
      	},

    	methods: {

            	async deleteItems(){
				this.isDeleting= true
				const res = await this.callApi('post', 'app/delete_user/' + this.deleteItem)
				if(res.status===200){
				
					this.getUsers();
					this.$Loading.finish();
					this.success2('User has been deleted successfully!')
							
				}else{
					this.$Loading.error();
					this.danger()
				}
				this.isDeleting= false
				this.showDeleteModal = false
			

			},

             showDeletingModal(id){
                this.deleteItem = id
        
                this.deletingIndex = id
                this.showDeleteModal = true
                
                },

            showEditModal1(id, name, username, email, userType){
                        let obj ={
                            id:id,
                            name:name,
                            username:username,
                            email:email,
                            userType:userType
                        }
                        this.dataedit=obj
                        this.editModal = true

                        
                
                },



    		async addUser(){
    			if(this.data.name.trim()=='') return this.danger('Fullname is required')
                if(this.data.username.trim()=='') return this.danger('Username is required')
                if(this.data.email.trim()=='') return this.danger('Email is required')
                if(this.data.password.trim()=='') return this.danger('Password is required')
                if(this.data.role.trim()=='') return this.danger('Role is required')

               
    			const res = await this.callApi('post', 'app/create_user', this.data)
    			if(res.status===201){
    				this.userlists.unshift(res.data)
    				this.success2('User has been added successfully!')
    				
    				this.data.name=''
                    this.data.email=''
                     this.data.username=''
                    this.data.password=''
                    this.data.role=''
                    this.getUsers();
                    this.$Loading.finish();
                    this.addModal = false
    			}else{
    				if(res.status==422){
                        if(res.data.errors.name){
                            this.danger(res.data.errors.name[0])
                            this.$Loading.error();
                        }
                         if(res.data.errors.username){
                            this.danger(res.data.errors.username[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.email){
                            this.danger(res.data.errors.email[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.password){
                            this.danger(res.data.errors.password[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.role){
                            this.danger(res.data.errors.userType[0])
                            this.$Loading.error();
                        }
                    }else{
                        this.danger()
                    }
    			}
    		},


            async edituser(){
    			if(this.dataedit.name.trim()=='') return this.danger('Fullname is required')
                if(this.dataedit.username.trim()=='') return this.danger('Username is required')
                if(this.dataedit.email.trim()=='') return this.danger('Email is required')
                if(this.dataedit.userType.trim()=='') return this.danger('Role is required')

               
    			const res = await this.callApi('post', 'app/editUser', this.dataedit)
    			if(res.status===200){
    				this.userlists.unshift(res.data)
    				this.success2('User has been edited successfully!')
    				
    				this.dataedit.name=''
                    this.dataedit.email=''
                     this.dataedit.username=''
                    this.dataedit.password=''
                    this.dataedit.role=''
                    this.getUsers();
                    this.$Loading.finish();
                    this.editModal = false
    			}else{
    				if(res.status==422){
                        if(res.data.errors.name){
                            this.danger(res.data.errors.name[0])
                            this.$Loading.error();
                        }
                         if(res.data.errors.username){
                            this.danger(res.data.errors.username[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.email){
                            this.danger(res.data.errors.email[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.password){
                            this.danger(res.data.errors.password[0])
                            this.$Loading.error();
                        }
                      
                    }else{
                        this.danger()
                    }
    			}
    		},

	        getUsers(){
	        	this.token = window.Laravel.csrfToken
	            axios.get('/api/getUser')
	                .then(function (res){
	                    return res.data;
	                })
	                .catch(function (error){
	                    console.log(error.response);
	                })
	                .then(res=>{
	                    this.userlists = res;
	                })
	        },


	     

        

        }
    
    }

   
</script>

<style scoped>
      .space2{
	    margin-bottom: 10px;
	    margin-top: 0px;
	}   
</style>


