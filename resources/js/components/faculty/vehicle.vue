<template>

<div class="container-fluid">
      <v-app>
       <br>
      
       <div >
           <h3 class="title text-center">Vehicle</h3>
            
                     <v-banner
                           >
                            <div class="row">
                                        <div class="col-md-4">
                                                <div style="text-align:Left !important;">
                                                         
                                                             <v-btn
                                                                    @click="ShowAddVehicle=true"
                                                                      depressed
                                                                      color="primary"
                                                                        > 
                                                                    New Vehicle
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
                                            :items="Vehiclelist"
                                            :loading="loading"
                                            :search="search"
                                            class="elevation-1 pa-2"
                                          
                                            >

                                            <!-- <template v-slot:item.EquipStatus="{ item }"> 
                                                        <span class="text-center" v-if="item.EquipStatus === 1">
                                                           
                                                               <v-icon color="green" large>
                                                                   mdi-check-circle-outline
                                                               </v-icon>
                                                              
                                                        </span>
                                                        <span v-if="item.EquipStatus === 0" ><v-icon color="pink" large>
                                                                   mdi-close-circle-outline
                                                               </v-icon></span>

                                            </template> -->

                                            <template v-slot:item.action="{ item }">
                                                      <v-btn
                                                      
                                                                icon
                                                                small
                                                                @click="showEditingModal(item.Veh_id,item.VehType,item.VehModel,item.VehPlateNum,item.VehFuelCap)"
                                                                class="mr-2"
                                                                color="blue"
                                                                >
                                                                <v-icon small>mdi-pencil</v-icon>
                                                        </v-btn>

                                                         <v-btn
                                                       
                                                                icon
                                                                small
                                                                @click="showDeletingModal(item.Veh_id)"
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
            


            <Modal v-model="ShowAddVehicle" width="1200">

                                    <div>
                                        <p class="subtitle" style="text-align:center"><span><b>  Add Vehicle</b></span></p>
                                    </div>
                                      <br>
                                        <br>
                                         <div class="container-fluid" > 
                                      
                                                <v-card  outlined > 

                                                         <v-card-text>

                                                            <v-row>
                                                                        <v-col  cols="12"
                                                                            sm="6"
                                                                            md="6">
                                                                                
                                                                                  <v-select
                                                                                        v-model="Vehicle.VehOffice"
                                                                                        :items="equipmentlist"
                                                                                        color="pink"
                                                                                        dense
                                                                                        outlined
                                                                                        item-value = "EquipType"
                                                                                        item-text = "EquipType"
                                                                                        label="Office"
                                                                                        required>
                                                                                </v-select>
                                                                        </v-col>
                                                            </v-row>
                                                                   
                                                                    <v-row style="margin-top:-30px;">
                                                                        <v-col  cols="12"
                                                                            sm="3"
                                                                            md="3">
                                                                                
                                                                                  <v-select
                                                                                        v-model="Vehicle.VehType"
                                                                                        :items="equipmentlist"
                                                                                        color="pink"
                                                                                        dense
                                                                                        outlined
                                                                                        item-value = "EquipType"
                                                                                        item-text = "EquipType"
                                                                                        label="Vehicle Type"
                                                                                        required>
                                                                                </v-select>
                                                                        </v-col>
                                                                   
                                                                        <v-col
                                                                            cols="12"
                                                                            sm="4"
                                                                            md="4"
                                                                            >
                                                                            <v-text-field
                                                                                outlined
                                                                               
                                                                                dense
                                                                                 v-model="Vehicle.VehModel"
                                                                               
                                                                                clear-icon="mdi-close-circle"
                                                                                label="Model"
                                                                                >
                                                                            </v-text-field>
                                                                        </v-col>

                                                                        <v-col
                                                                            cols="12"
                                                                            sm="3"
                                                                            md="3"
                                                                            >
                                                                            <v-text-field
                                                                                outlined
                                                                                
                                                                                dense
                                                                                 v-model="Vehicle.VehPlateNum"
                                                                               
                                                                                clear-icon="mdi-close-circle"
                                                                                label="Plate #"
                                                                                >
                                                                            </v-text-field>
                                                                        </v-col>

                                                                        <v-col
                                                                            cols="12"
                                                                            sm="2"
                                                                            md="2"
                                                                            >
                                                                            <v-text-field
                                                                                outlined
                                                                                :rules="[numberRule]"
                                                                                v-bind:options="options"
                                                                                dense
                                                                                type="number"
                                                                                v-model="Vehicle.VehFuelCap"
                                                                               
                                                                                clear-icon="mdi-close-circle"
                                                                                label="Fuel Capacity"
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
                                                                                     v-model="Vehicle.VehPlateNum"  
                                                                                    
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
                                                 <b-button :disabled="disabledSavedBtn" @click="SaveVehicle"
                                                     type="is-info">SAVE </b-button>
                                        </div>
             
                        
                         
                        
            </Modal>


            <Modal v-model="ShowEditVehicle" width="600">

                                    <div>
                                        <p class="subtitle" style="text-align:center"><span><b>  Edit Vehicle</b></span></p>
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
                                                                                    label="Vehicle Type"
                                                                                    v-model="VehicleEdit.VehType"
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
                                                                                 v-model="VehicleEdit.VehModel"
                                                                               
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
                                                                                     v-model="VehicleEdit.VehPlateNum"  
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
                                                 <b-button :disabled="disabledSavedBtn" @click="SaveEditVehicle"
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
                                <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="DeleteVehicle()">Delete</Button>
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
                    
                    { text: 'Actions', value: 'action' ,align: 'center',width: 150,},
                    { text: 'Vechicle #', value: 'Veh_id' ,align: 'center',width: 50,},
                    { text: 'Type', value: 'VehType' ,align: 'center',},
                    { text: 'Model', value: 'VehModel', align: 'left' , },
                    
                    { text: 'Plate #', value: 'VehPlateNum' ,align: 'center',},
                    { text: 'Fuel Cap', value: 'VehFuelCap', align: 'left' , },
                    { text: 'Office', value: 'VehOffice', align: 'left' , },
                    { text: '*', value: 'VehTimes', align: 'left' , },
                    { text: 'Balance in Tank', value: 'VehBalTank' ,align: 'center',},
                    { text: 'Sticker', value: 'VehConductSticker', align: 'left' , },
                    { text: 'Engine #', value: 'VehEngineNum', align: 'left' , },
                    { text: 'Chassis #', value: 'VehChassisNum' ,align: 'center',},
                    { text: 'Date Acquired', value: 'VehDateAcquired', align: 'left' , },
                    { text: 'Qty', value: 'VehQty', align: 'left' , },
                    { text: 'Cost', value: 'VehCost' ,align: 'center',},
                    { text: 'Color', value: 'VehColor', align: 'left' , },
                    { text: 'Use', value: 'VehUse', align: 'left' , },
                    { text: '# of Cly', value: 'VehNoCyl' ,align: 'center',},
                    { text: 'Fuel Type', value: 'VehFuelType', align: 'left' , },
                    { text: 'Eng Disp', value: 'VehEngDisp', align: 'left' , },

                   
                    { text: 'Mod Unit', value: 'VehModUnit', align: 'left' ,},
                    { text: 'Driver', value: 'VehDriver', align: 'left' , },
                    { text: 'GSIS Date Renew', value: 'VehGSISDateRenew', align: 'left' ,},
                    { text: 'GSIS Per Cover', value: 'VehGSISPerCovered', align: 'left' , },

                    { text: 'GSIS OR #', value: 'VehGSISORNum', align: 'left' , },
                    { text: 'GSIS Amount', value: 'VehGSISRenewAmout' ,align: 'center',},
                    { text: 'LTO Date Renew', value: 'VehLTODateRenew', align: 'left' , },
                    { text: 'LTO Renew', value: 'VehLTODueRenew' ,align: 'center',},
                    { text: 'LTO OR #', value: 'VehLTOORNum', align: 'left' , },
                    { text: 'LTO Amount Renew', value: 'VehLTOAmtRenew' ,align: 'center',},
                    { text: 'LTO Date Emission', value: 'VehLTODateEmission', align: 'left' ,},
                    { text: 'LTO Emis Amount', value: 'VehLTOEmissionAmt' ,align: 'center',},
                    { text: 'LTO Remarks', value: 'VehLTORemark', align: 'left' ,},
                    { text: 'Equip Id', value: 'VecEquipId', align: 'left' , },
                     { text: 'Status', value: 'VehStatus', align: 'left' ,},
                    { text: 'Remarks', value: 'Remarks' ,align: 'center',},
                   
                    // {value: 'Prod_id' ,align: ' d-none' },
                    // {value: 'Driver_id' ,align: ' d-none' },
                    // {value: 'Equip_id' ,align: ' d-none' },


                ],

                Vehiclelist:[],
                ShowAddVehicle:false,
                ShowEditVehicle:false,

                Vehicle:{
                    
                    VehType:'',
                    VehModel:'',
                    VehPlateNum:'',
                    VehFuelCap:'',
                    VehOffice:'',
                    VehTimes:'',
                    VehBalTank:'',
                    VehConductSticker:'',
                    VehEngineNum:'',
                    VehChassisNum:'',
                    VehDateAcquired:'',
                    VehQty:'',
                    VehCost:'',
                    VehColor:'',
                    VehUse:'',
                    VehNoCyl:'',
                    VehFuelType:'',
                    VehEngDisp:'',
                    VehStatus:'',
                    VehModUnit:'',
                    VehEndUser:'',
                    VehDriver:'',
                    VehGSISDateRenew:'',
                    VehGSISPerCovered:'',
                    VehGSISORNum:'',
                    VehGSISRenewAmout:'',
                    VehLTODateRenew:'',
                    VehLTODueRenew:'',
                    VehLTOORNum:'',
                    VehLTOAmtRenew:'',
                    VehLTODateEmission:'',
                    VehLTOEmissionAmt:'',
                    VehLTORemark:'',
                    VecEquipId:'',

                },

                VehicleEdit:{
                   VehType:'',
                    VehModel:'',
                    VehPlateNum:'',
                    VehFuelCap:'',
                    VehOffice:'',
                    VehTimes:'',
                    VehBalTank:'',
                    VehConductSticker:'',
                    VehEngineNum:'',
                    VehChassisNum:'',
                    VehDateAcquired:'',
                    VehQty:'',
                    VehCost:'',
                    VehColor:'',
                    VehUse:'',
                    VehNoCyl:'',
                    VehFuelType:'',
                    VehEngDisp:'',
                    VehStatus:'',
                    VehModUnit:'',
                    VehEndUser:'',
                    VehDriver:'',
                    VehGSISDateRenew:'',
                    VehGSISPerCovered:'',
                    VehGSISORNum:'',
                    VehGSISRenewAmout:'',
                    VehLTODateRenew:'',
                    VehLTODueRenew:'',
                    VehLTOORNum:'',
                    VehLTOAmtRenew:'',
                    VehLTODateEmission:'',
                    VehLTOEmissionAmt:'',
                    VehLTORemark:'',
                    VecEquipId:'',
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


                 equipmentlist:[],

            }
        },

       

        watch: {

              
        },

        mounted(){
           this.getVecList()   
           this.getEquipList()
        },

         computed: {

                     disabledSavedBtn(){
                        
                            if(this.ShowAddVehicle ===true){

                                // if (!this.equip.EquipType || 
                                //                 !this.equip.EquipTime ||
                                //                 !this.equip.EquipBal ){
                                //                         return true;

                                //                 }else{
                                //                     return false
                                //     }
                                        
                                          
                            }

                            if(this.ShowEditVehicle ===true){

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




        async getVecList(){
            const res = await  axios.get('/api/getVecList')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.Vehiclelist = res.data;
                }else{
                    this.Vehiclelist = res.data;
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },





          showEditingModal(Equip_id,EquipType,EquipTimes,EquipBalTank,EquipStatus){
                let obj = {
                    Equip_id : Equip_id ,
                    EquipType : EquipType,
                    EquipTime: EquipTimes,
                    EquipBal: EquipBalTank,
                    EquipStatus: EquipStatus,
            }
                this.equipEdit=obj  
                this.ShowEditVehicle = true       

               
        },



        async DeleteVehicle(){
               const res = await this.callApi('post', 'app/DeleteVehicle/' + this.deleteItem)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('Vehicle successfully deleted!') 
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



        async SaveVehicle(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/SaveVehicle' , this.equip)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.ShowAddVehicle=false
                    this.success2('Vehicle successfully saved!') 
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

        async SaveEditVehicle(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/SaveEditVehicle' , this.equipEdit)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.ShowEditVehicle=false
                    this.success2('Vehicle successfully Edited!') 
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

