<template>

<div class="container-fluid">
      <v-app>
       <br>
      
       <div >
           <h3 class="title text-center">Equipments</h3>
            
                     <v-banner
                           >
                            <div class="row">
                                        <div class="col-md-4">
                                                <div style="text-align:Left !important;">
                                                         
                                                             <v-btn
                                                                    @click="ShowAddEquipment=true"
                                                                      depressed
                                                                      color="primary"
                                                                        > 
                                                                    NEW EQUIPMENT
                                                            </v-btn>
                                                        </div>
                                        </div>
                                        
                            </div>
                          

                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="search"
                                            append-icon="mdi-magnify"
                                            label="Search"
                                            single-line
                                           
                                            hide-details
                                            ></v-text-field>
                                    </v-col>
                                   
                                </v-row>


                                
                             

                                <v-data-table 
                                            
                                            
                                            :headers="headers"
                                            :items="equipmentlist"
                                            :loading="loading"
                                            :search="search"
                                            class="elevation-1 pa-2"
                                            item-key="Equip_id"
                                            >

                                            <template v-slot:item.EquipStatus="{ item }"> 
                                                        <span class="text-center" v-if="item.EquipStatus === 1">
                                                           
                                                               <v-icon color="green" large>
                                                                   mdi-check-circle-outline
                                                               </v-icon>
                                                              
                                                        </span>
                                                        <span v-if="item.EquipStatus === 0" ><v-icon color="pink" large>
                                                                   mdi-close-circle-outline
                                                               </v-icon></span>

                                            </template>

                                            <template v-slot:item.action="{ item }">
                                                      <v-btn
                                                      
                                                                icon
                                                                large
                                                                @click="showEditingModal(item.Equip_id,item.EquipType,item.EquipTimes,item.EquipBalTank,item.EquipStatus)"
                                                                class="mr-2"
                                                                color="blue"
                                                                >
                                                                <v-icon small>mdi-pencil</v-icon>
                                                        </v-btn>

                                                         <v-btn
                                                       
                                                                icon
                                                                large
                                                                @click="showDeletingModal(item.Equip_id)"
                                                                class="mr-2"
                                                                color="pink"
                                                                >
                                                                <v-icon small>mdi-delete</v-icon>
                                                            </v-btn>
                                            </template>

                                </v-data-table>

                        </v-banner>
                    <!-- </v-col>
            </v-row> -->
 
            </div>
            


            <Modal v-model="ShowAddEquipment" width="600">

                                    <div>
                                        <p class="subtitle" style="text-align:center"><span><b>  Add Equipment</b></span></p>
                                    </div>
                                      <br>
                                        <br>
                                         <div class="container-fluid" > 
                                      
                                                <v-card  outlined > 

                                                         <v-card-text>
                                                                   
                                                                    <v-row>
                                                                        <v-col  cols="12"
                                                                            sm="8"
                                                                            md="8">
                                                                                
                                                                                <v-text-field
                                                                                    label="Equipment Type"
                                                                                    v-model="equip.EquipType"
                                                                                    outlined
                                                                                    dense
                                                                                    required
                                                                                ></v-text-field> 
                                                                        </v-col>
                                                                   
                                                                        <v-col
                                                                            cols="12"
                                                                            sm="4"
                                                                            md="4"
                                                                            >
                                                                            <v-text-field
                                                                                outlined
                                                                                type="number"
                                                                                dense
                                                                                 v-model="equip.EquipTime"
                                                                               
                                                                                clear-icon="mdi-close-circle"
                                                                                label="Times"
                                                                                >
                                                                            </v-text-field>
                                                                        </v-col>

                                                                    </v-row>

                                                                     <v-row style="margin-top:-30px;">
                                                                        <v-col
                                                                            cols="12"
                                                                            sm="12"
                                                                            md="12"
                                                                            >
                                                                            <!-- <v-text-field
                                                                                type="number"
                                                                                label="Balance in Tank" 
                                                                                 v-model="EquipBal"  
                                                                                 suffix="L"                                                                                 
                                                                                outlined
                                                                                dense
                                                                                required
                                                                            ></v-text-field>  -->

                                                                            <vuetify-money
                                                        
                                                                                    label="Balance in Tank"
                                                                                     v-model="equip.EquipBal"  
                                                                                    
                                                                                    dense
                                                                                    outlined
                                                                            
                                                                                
                                                                                    :rules="[numberRule]"
                                                                                    v-bind:options="options"
                                                                                    />
                                                                        </v-col>
                                                                    </v-row>
                                                         </v-card-text>
                                                    
                                                </v-card>



                                        </div>
                                      
                                
                                        <div slot="footer" class="text-right">
                                                <b-button @click="cancelItems" type="is-danger">CANCEL</b-button>
                                                 <b-button :disabled="disabledSavedBtn" @click="SaveEquipment"
                                                     type="is-info">SAVE </b-button>
                                        </div>
             
                        
                         
                        
            </Modal>


            <Modal v-model="ShowEditEquipment" width="600">

                                    <div>
                                        <p class="subtitle" style="text-align:center"><span><b>  Edit Equipment</b></span></p>
                                    </div>
                                      <br>
                                        <br>
                                         <div class="container-fluid" > 
                                      
                                                <v-card  outlined > 

                                                         <v-card-text>
                                                                   
                                                                    <v-row>
                                                                        <v-col  cols="12"
                                                                            sm="8"
                                                                            md="8">
                                                                                
                                                                                <v-text-field
                                                                                    label="Equipment Type"
                                                                                    v-model="equipEdit.EquipType"
                                                                                    outlined
                                                                                    dense
                                                                                    required
                                                                                ></v-text-field> 
                                                                        </v-col>
                                                                   
                                                                        <v-col
                                                                            cols="12"
                                                                            sm="4"
                                                                            md="4"
                                                                            >
                                                                            <v-text-field
                                                                                outlined
                                                                                type="number"
                                                                                dense
                                                                                 v-model="equipEdit.EquipTime"
                                                                               
                                                                                clear-icon="mdi-close-circle"
                                                                                label="Times"
                                                                                >
                                                                            </v-text-field>
                                                                        </v-col>

                                                                    </v-row>

                                                                     <v-row style="margin-top:-30px;">
                                                                        <v-col
                                                                            cols="12"
                                                                            sm="12"
                                                                            md="12"
                                                                            >
                                                                       
                                                                            <vuetify-money
                                                        
                                                                                    label="Balance in Tank"
                                                                                     v-model="equipEdit.EquipBal"  
                                                                                    
                                                                                    dense
                                                                                    outlined
                                                                            
                                                                                
                                                                                    :rules="[numberRule]"
                                                                                    v-bind:options="options"
                                                                                    />
                                                                        </v-col>
                                                                    </v-row>
                                                         </v-card-text>
                                                    
                                                </v-card>



                                        </div>
                                      
                                
                                        <div slot="footer" class="text-right">
                                                <b-button @click="cancelItems" type="is-danger">CANCEL</b-button>
                                                 <b-button :disabled="disabledSavedBtn" @click="SaveEditEquipment"
                                                     type="is-info">UPDATE </b-button>
                                        </div>
             
                        
                         
                        
            </Modal>



           
            <Modal v-model="showDeleteModal" width="360">
                            <p slot="header" style="color:#f60;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Delete confirmation</span>
                            </p>
                            <div style="text-align:center">
                                <p>Are you sure you want to delete this Item?</p>
                            
                            </div>
                            <div slot="footer">
                                <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="DeleteEquipment()">Delete</Button>
                            </div>
            </Modal>


          
               
      </v-app>
</div>
  
</template>

<script>

    export default {
       
        data() {

        
            return {
                token: '',


                headers: [
                    
                    { text: 'Actions', value: 'action' ,align: 'center',width: 50,},
                    { text: 'Type', value: 'EquipType' ,align: 'center',width: 150,},
                    { text: 'Times', value: 'EquipTimes', align: 'left' , width: 150,},
                    { text: 'Balance in Tank', value: 'EquipBalTank', align: 'left' , width: 150,},
                    
                    // { text: 'Status', value: 'EquipStatus', align: 'left' , width: 100,},

                ],

                equipmentlist:[],
                ShowAddEquipment:false,
                ShowEditEquipment:false,

                equip:{
                    EquipType:'',
                    EquipTime:'',
                    EquipBal:''
                },

                equipEdit:{
                    EquipType:'',
                    EquipTime:'',
                    EquipBal:'',
                    Equip_id:'',
                    EquipStatus:''
                },

                 options: {
                    suffix: "L",
                    length: 11,
                    precision: 2
                    },
                    
                numberRule: val => {
                if(val < 0) return 'Please enter a positive number'
                return true
                },

                deleteItem:'',
                showDeleteModal:false,
                isDeleting:false,
                showEditModal:false,


                 search: '',
                 loading: false,

            }
        },

       

        watch: {

              
        },

        mounted(){
           this.getEquipList()   
        },

         computed: {

                     disabledSavedBtn(){
                        
                            if(this.ShowAddEquipment ===true){

                                if (!this.equip.EquipType || 
                                                !this.equip.EquipTime ||
                                                !this.equip.EquipBal ){
                                                        return true;

                                                }else{
                                                    return false
                                    }
                                        
                                          
                            }

                            if(this.ShowEditEquipment ===true){

                                if (!this.equipEdit.EquipType || 
                                                !this.equipEdit.EquipTime ||
                                                !this.equipEdit.EquipBal ){
                                                        return true;

                                                }else{
                                                    return false
                                    }
                                        
                                          
                            }

                    },


                 
                    
    
                },

     methods:{


          showEditingModal(Equip_id,EquipType,EquipTimes,EquipBalTank,EquipStatus){
                let obj = {
                    Equip_id : Equip_id ,
                    EquipType : EquipType,
                    EquipTime: EquipTimes,
                    EquipBal: EquipBalTank,
                    EquipStatus: EquipStatus,
            }
                this.equipEdit=obj  
                this.ShowEditEquipment = true       

               
        },



        async DeleteEquipment(){
               const res = await this.callApi('post', 'app/DeleteEquipment/' + this.deleteItem)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('Equipment successfully deleted!') 
                         this.getEquipList()
                        this.showDeleteModal = false
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },


        showDeletingModal(Equip_id){
          this.deleteItem = Equip_id
          this.showDeleteModal = true
        },



        async SaveEquipment(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/SaveEquipment' , this.equip)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.ShowAddEquipment=false
                    this.success2('Equipment successfully saved!') 
                    this.getEquipList()
                    this.isDeleting= false
                    this.equip.EquipBal=''
                    this.equip.EquipTime=''
                    this.equip.EquipType=''
                   
                   

                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },

        async SaveEditEquipment(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/SaveEditEquipment' , this.equipEdit)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.ShowEditEquipment=false
                    this.success2('Equipment successfully Edited!') 
                    this.getEquipList()
                    this.isDeleting= false
                    this.equipEdit.EquipBal=''
                    this.equipEdit.EquipTime=''
                    this.equipEdit.EquipType=''
                   
                   

                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },



        cancelItems(){
            this.equip.EquipType=''
            this.equip.EquipTime=''
            this.equip.EquipBal=''


            this.equipEdit.EquipType=''
            this.equipEdit.EquipTime=''
            this.equipEdit.EquipBal=''
        },



        async getEquipList(){
            const res = await  axios.get('/api/getEquipList')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.equipmentlist = res.data;
                }else{
                    this.equipmentlist = res.data;
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },

        
  
        },
    }
</script>


<style scoped>

 .active{
        background-color: #31c831;
        color:white;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 5px;
      
    }

    .Inactive{
        background-color: #ff0000;
        color:white;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 5px;
      
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

        
    /* #printable { display: none; } */

    @media print
    {   
         table {transform: scale(1);font-size:9px !important;zoom:100%;}
         
        table {page-break-inside: avoid;}
        #non-printable { display: none; }
         #non-printable1 { display: none; }
        #printable { display: block; }
    }




</style>

