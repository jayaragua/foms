<template>

<div class="container-fluid">
      <v-app>
       <br>
      
       <div v-if="isprint===false" id="non-printable1">
           <h3 class="title text-center">Trip Tickets</h3>
            
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
                                                                        <v-icon
                                                                                left
                                                                                dark
                                                                                
                                                                            >
                                                                                mdi-plus
                                                                        </v-icon>
                                                                    Trip Ticket
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


                                
                             

                                <!-- <v-data-table 
                                            
                                             v-model="selected"
                                            :headers="headers"
                                            :items="TripTicketlist"
                                           
                                            :search="search"
                                            class="elevation-1 pa-2"
                                            item-key="Equip_id"
                                            > -->

                                <v-data-table
                                            :headers="headers"
                                            :items="TripTicketlist"
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
                                                                small
                                                                @click="showEditingModal(item.Equip_id,item.EquipType,item.EquipTimes,item.EquipBalTank,item.EquipStatus)"
                                                                class="mr-2"
                                                                color="blue"
                                                                >
                                                                <v-icon small>mdi-pencil</v-icon>
                                                        </v-btn>

                                                         <v-btn
                                                       
                                                                icon
                                                                small
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
                    
                    { text: 'Actions', value: 'action' ,align: 'center',width: 150,},
                    { text: 'Id', value: 'TripT_id' ,align: 'center',width: 50,},
                    { text: 'Date', value: 'Trip_Date' ,align: 'center',width: 150,},
                    { text: 'Product', value: 'Product', align: 'left' , width: 150,},
                    
                    { text: 'Type', value: 'VehType' ,align: 'center',width: 150,},
                    { text: 'Plate#', value: 'VehPlateNum', align: 'left' , width: 150,},
                    { text: 'Model', value: 'VehModel', align: 'left' , width: 150,},
                    { text: 'Driver', value: 'DriversName', align: 'left' , width: 150,},
                    { text: 'Office', value: 'VehOffice' ,align: 'center',width: 150,},
                    { text: 'Auto Passengers', value: 'AuthPassName', align: 'left' , width: 150,},
                    { text: 'Place to Visit', value: 'PlaceVisit', align: 'left' , width: 150,},
                    { text: 'Purpose', value: 'Purpose' ,align: 'center',width: 150,},
                    { text: 'Departure Time', value: 'TimeDeparture', align: 'left' , width: 150,},
                    { text: 'Arr Time at Destinatiion', value: 'TimeArr', align: 'left' , width: 150,},
                    { text: 'Dept. Time from Dist.', value: 'DepartTime' ,align: 'center',width: 150,},
                    { text: 'Arrival Time Back', value: 'ArrivalTime', align: 'left' , width: 150,},
                    { text: 'Distance Traveled', value: 'DisTravel', align: 'left' , width: 150,},
                    { text: 'Balance in Tank', value: 'BalTank' ,align: 'center',width: 150,},
                    { text: 'IssuedbyOffice', value: 'IssuedOffice', align: 'left' , width: 150,},
                    { text: 'Distance Travel', value: 'DistanceTraveled', align: 'left' , width: 150,},
                    { text: 'Remarks', value: 'Remarks' ,align: 'center',width: 150,},
                    
                ],


                
                TripTicketlist:[],
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                



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


                loading: false,

                selected: [],
                search: '',

              






                nameTES2:"TES-2 FORM" + "(" + this.TermNum + ")" + ".xls",

                json_fields: {
                    "Student ID": "StudID",
                    "TES Award #": "tesAwardNo",
                    "LastName": "StudLName",
                    "Firstname": "StudFName",
                    "Middle Name": "MI",
                    "Sex": "sexI",
                    "Birthdate": "StudBDate",
                    "Degree Program": "CDesc",
                    "Year Level": "EnrYear",
                    "Total Units": "EnrTUnits",
                    "ZIP Code": "StudPZip",
                    "E-mail Address": "email",
                    "Phone Number": "StudCNum",


                    },

                 json_fields_payroll: {
                    "TES Award #": "tesAwardNo",
                    "Student ID": "StudID",
                    "LastName": "StudLName",
                    "Firstname": "StudFName",
                    "Middle Name": "MI",
                    "Degree Program": "CDesc",
                     "Year Level": "EnrYear",
                    // "Sex": "sexI",
                    // "Birthdate": "StudBDate",
                    
                   
                    // "Total Units": "EnrTUnits",
                    // "ZIP Code": "StudPZip",
                    // "E-mail Address": "email",
                    // "Phone Number": "StudCNum",


                    },


             
                 


                 singleExpand: true,
                 expanded: [],

                semlists:[],

                showviewModal:false,
                showCORModal:false,
                showGradeModal:false,

                size: '',
                type: null,
                passiveType: null,
                isRounded: false,
                isOutlined: true,
                leftLabel: true,

                TermNum:'',
                TermDesc:'',

                studInfo:[],
                idnum:null,
                studname:null,
                crse:null,
                section:null,
                yr:0,
                dEnrol:'',

                 AssLecTot:0,
                AssLabTot:0,
                OtherSchFee:0,
                AssOldBal:0,
                AssOthTot:0,
                AssMiscTot:0,
                AssTotDue:0,

                gradelists: [],
                gradelists1:[],
                TotUnits:0,


                
                showForwardIndiModal:false,
                 showForwardModal:false,
                 
                 

                 isprint:false,

                 data:{
                        ActiveTerm:'',
                        ActiveTermDesc:'',
                        Institute:'',
                    },

                forwardStud:'',
                student:{
                        StudID:'',
                        TESGrant:'',
                        StudLName:'',
                        StudFName:'',
                        EnrCourse:'',
                        EnrYear:'',


                },

                GWA:0,
                GWAFinal:0,
                showValue1: false,

                index:'',



              
                

                      studentList:[],

                        categories: [],
                        
                        total: 0,
                        
                        pagination: {},
                       
                        rowsPerPageItems: [5, 10, 20, 50, 100],

                        allowForward:0,

                        grant:0,

                        studDtls:[],
                    

            }
        },

       

        watch: {

                //  pagination() {
                //         this.getCategoriesByPagination();
                //     },
                // search() {
                //         this.getCategoriesByPagination();
                //     }
        },

        mounted(){
           this.getTripTicketList()   
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


                    params(nv) {
                        return {
                            ...this.pagination,
                            query: this.search
                        };
                    },

                    checkForwardonly(){
                        if (this.allowForward==1){
                           return false;
                        }else{
                            return true;
                        }

                    },


                    checkBox1(){
                        if (this.selected.length ===0){
                            return true;
                        }else{
                            return false;
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



        async getTripTicketList(){
            const res = await  axios.get('/api/getTripTicketList')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.TripTicketlist = res.data;
                }else{
                    this.TripTicketlist = res.data;
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },














         TES2form(){
             return ("TES-2 FORM(" + this.TermNum + ")" + ".xls");
         },
          TES3aform(){
             return ("TES-3a FORM(" + this.TermNum + "-PWD)" + ".xls");
         },

        TES3bform(){
             return ("TES-3b FORM(" + this.TermNum + ")" + ".xls");
         },


         
        

          getImgUrl(path){
                        this.index = path
                        
                            if (!this.index){
                                return   '/images/nobody.jpg'
                            }else{
                                return ("http://mygadtc.gadtc.edu.ph/" + this.index);
                            }

                            
                        
                    },


          getStudTotUnits(){
              
                 axios('/api/getStudTotUnits2/' + this.TermNum + '/' + this.student.StudID)
                    .then(res=> {
                        if(res.data.length===0){
                            this.AssLecTot= 0
                            this.AssLabTot= 0
                            
                            this.AssOldBal= 0
                            this.OtherSchFee= 0
                            this.AssTotDue=0
                             this.showCORModal = true
                        }else{
                            this.TotUnits = res.data[0].EnrTUnits
                            this.section= res.data[0].EnrSec

                            this.AssLecTot= new Intl.NumberFormat().format(res.data[0].AssLecTot)
                            this.AssLabTot= new Intl.NumberFormat().format(res.data[0].AssLabTot)
                        
                            this.AssOldBal= new Intl.NumberFormat().format(res.data[0].AssOldBal)

                            this.AssOthTot= res.data[0].AssOthTot
                            this.AssMiscTot=res.data[0].AssMiscTot

                            this.OtherSchFee= (Number(this.AssMiscTot)+Number(this.AssOthTot));

                           this.OtherSchFee= new Intl.NumberFormat().format(this.OtherSchFee);
                           this.AssTotDue=new Intl.NumberFormat().format(res.data[0].AssTotDue)
                            // this.showCORModal = false
                            // this.showGradeModal=false;

                       // this.GWA= this.TotUnits

                        // console.log(this.TotUnits);
                    }
                },(error)=>{
                        console.log(error);
                 })


            },



        async gettesStud(){
            const res = await  axios.get('/api/getTesStudents/' + this.TermNum)
            if(res.status==200){
                if(res.data.length===0){
                    // console.log('sdsd')
                    this.$Loading.error();
                    this.danger('No Records found!')
                    
                    this.studentList = res.data;
                    // this.gradelists = res.data;
                }else{
                    // console.log(res.data)
                    this.studentList = res.data;
                    this.TermDesc=res.data[0].TermDesc;
                    // this.gradelists = res.data;
                    this.$Loading.finish();
                }
                
    
            }else{
                    console.log(res.data)
            }
        },


        getSem(){
            // this.token = window.Laravel.csrfToken
            axios.get('/api/getSem2')
                .then(function (res){
                    return res.data;
                })
                .catch(function (error){
                    console.log(error.response);
                })
                .then(res=>{
                    this.semlists = res;
                    // this.getStudGrade();
                })
        },

        showForwardModalView(){
                
                this.showForwardModal = true
                
        },

        showForwardIndiModalView(StudID,TESGrant,StudLName,StudFName,EnrCourse,EnrYear){
                 let obj = {
                    StudID : StudID ,
                    TESGrant : TESGrant,
                    StudLName: StudLName,
                    StudFName: StudFName,
                    EnrCourse: EnrCourse,
                    EnrYear: EnrYear,

                }
                this.student=obj
                this.forwardStud = StudID
                this.showForwardIndiModal = true
                
        },

         showEditModalViewCOR(StudID,TESGrant,StudLName,StudFName,EnrCourse,EnrYear){
                let obj = {
                    StudID : StudID ,
                    TESGrant : TESGrant,
                    StudLName: StudLName,
                    StudFName: StudFName,
                    EnrCourse: EnrCourse,
                    EnrYear: EnrYear,

            }
                this.student=obj

                this.getStudCOR()
                // this.getStudTotUnits()
               
                
        },


        showEditModalViewGrade(StudID,TESGrant,StudLName,StudFName,EnrCourse,EnrYear){
                let obj = {
                    StudID : StudID ,
                    TESGrant : TESGrant,
                    StudLName: StudLName,
                    StudFName: StudFName,
                    EnrCourse: EnrCourse,
                    EnrYear: EnrYear,

            }
                this.student=obj

                this.getStudGrade()
                // this.getStudTotUnits()
               
                
        },

        view(){

            this.isprint= true;
            this.showCORModal=false;
            this.showviewModal=true
        },
        

         printCOR(){
                
                this.showviewModal=false
                this.print_enrolment();
                // window.print('printable'); 
               
            },
        
        print_enrolment(){

                // console.log('ss');
                window.print('printable'); 
                this.isprint= false;

                
        },

        //  printCOR(){    
                    
        //             this.isprint= true;
        //             // this.$htmlToPaper('printable');  
        //             window.print('printable');
        //             this.isprint= false;
                
        //         },




        async removeGrantee(StudID){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/removeGrantee/' + StudID + '/' + this.TermNum)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.success2('TES Grantee successfully removed from this semester!') 
                    // this.showForwardModal=false
                    this.gettesStud()
                    this.isDeleting= false
                
                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },

            //forward indi grantee
        async forwardIndiGrantee(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/forwardIndiGrantee/' + this.forwardStud)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.success2('TES Grantee has been forwarded successfully!') 
                    this.showForwardIndiModal=false
                    this.isDeleting= false
                    this.student.StudID=''
                    this.student.StudLName=''
                    this.student.TESGrant=''
                    this.student.StudFName=''
                    this.student.EnrCourse=''
                    this.student.EnrYear=''
                   

                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },

       

        async EditGrantees(){
          this.isDeleting= true

            if(this.showValue1===true){
                this.grant = 1
            }else{
                this.grant = 0
            }
               
            const res = await this.callApi('post', 'app/EditGrantees/' + this.student.StudID + '/'  + this.grant)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.showEditModal=false
                    this.success2('TES Grantee has been edited successfully!') 
                    this.getCategoriesByPagination()
                    
                    this.isDeleting= false

                    this.student.StudID=''
                    this.student.StudLName=''
                    this.student.TESGrant=''
                    this.student.StudFName=''
                    this.student.EnrCourse=''
                    this.student.EnrYear=''
                    this.grant=''
                
                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },

        

        // getCategoriesByPagination() {
        //     this.loading = true;
        //     if (this.search) {
        //         axios.get(`/student-filter?query=${this.search}&page=${this.pagination.page}&per_page=${this.pagination.rowsPerPage}`)
        //             .then(res => {
        //                 this.categories = res.data.data;
        //                 this.total = res.data.meta.total;
        //             })
        //             .catch(err => console.log(err.response.data))
        //             .finally(() => this.loading = false);
        //     }
           
        //     if(!this.search) {
        //         axios.get(`/getTesStudents?page=${this.pagination.page}&per_page=${this.pagination.rowsPerPage}&term=${this.TermNum}`)
        //             .then(res => {
        //                 this.categories = res.data.data;
        //                 this.total = res.data.meta.total;
        //             })
        //             .catch(err => console.log(err.response.data))
        //             .finally(() => this.loading = false);
        //     }
        // },

          getActiveTerm(){
                this.token = window.Laravel.csrfToken
                axios('/api/getActiveTerm')
                    .then(res=> {
                        this.data.ActiveTerm = res.data[0].TermNum
                        this.data.ActiveTermDesc =res.data[0].TermDesc
                       
                        
                    },(error)=>{
                        console.log(error);
                 })
            },

        checkForward(){
                this.token = window.Laravel.csrfToken
                axios('/api/checkForward')
                    .then(res=> {
                        this.allowForward = res.data[0].forwardOpen
                       
                       
                        
                    },(error)=>{
                        console.log(error);
                 })
            },





        //     getStudents(){
        //     // const res = await  axios.get('/api/getStudents')
        //  axios.get('/api/getStudents')
        //           .then(function (res){
        //               return res.data;
        //           })
        //           .catch(function (error){
        //               console.log(error.response);
        //           })
        //           .then(res=>{
                      
            
        //               this.datalist = res;
                      
        //           })
        // },


        
        async getStudInfo({item}){
                const res = await  axios.get('/api/getStudInfoDtls/'  + item.StudID)
                if(res.status==200){
                    if(res.data.length===0){
                    
                        this.$Loading.error();
                        this.danger('No Records found!')
                        this.studDtls = res.data;
                        
                    }else{
                        // console.log(res.data)
                        this.studDtls = res.data;
                       
                       
                        this.$Loading.finish();
                        this.ishidden=true;
                
                    }
                    
        
                }else{
                        console.log(res.data)
                }
            },


        async getStudCOR(){
                const res = await  axios.get('/api/getStudCOR/' + this.TermNum + '/' + this.student.StudID)
                if(res.status==200){
                    if(res.data.length===0){
                        // console.log('sdsd')
                        this.$Loading.error();
                        this.danger('No Records found!')
                        this.gradelists = res.data;
                        
                        
                        this.getStudTotUnits();
                    }else{
                        // console.log(res.data)
                        this.gradelists = res.data;
                        this.showCORModal = true
                        this.showGradeModal=false
                        

                        // this.TermDesc=res.data[0].TermDesc;
                        this.$Loading.finish();
                        this.ishidden=true;
                
                        this.getStudTotUnits();
                       
                    }
                    
        
                }else{
                        console.log(res.data)
                }
            },


            
             async getStudGrade(){
                const res = await  axios.get('/api/getStudGrade/' + this.TermNum + '/' + this.student.StudID)
                if(res.status==200){
                    if(res.data.length===0){
                        // console.log('sdsd')
                        this.$Loading.error();
                        this.danger('No Records found!')
                        this.gradelists1 = res.data;
                        this.getStudTotUnits();
                        this.GWAFinal="0.00"
                    }else{
                        this.gradelists1 = res.data;
                        this.$Loading.finish();
                  

                        this.getStudTotUnits();
                        this.getStudGWA();
                    }
                    
        
                }else{
                        console.log(res.data)
                }
            },


             getStudGWA(){
                  this.GWAFinal="0.00"
                 axios('/api/getStudGWA/' + this.TermNum + '/' + this.student.StudID)
                    .then(res=> {
                        if(res.data===0){
                            this.GWA = 0
                            this.showGradeModal=true
                        }else{
                            this.GWA = res.data[0].gwa;
                            this.showCORModal=false;
                            this.showGradeModal=true
                           // this.GWA=

                           this.GWAFinal = parseFloat(this.GWA).toFixed(2)
                
                            // this.GetGWA()
                        }
                        

                       // this.GWA= this.TotUnits

                        // console.log(this.TotUnits);
                    },(error)=>{
                        console.log(error);
                 })

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

