<template>

<div class="container-fluid">
      <v-app>
       <br>
       <div>
           
       <!-- <v-row>
           <v-col> -->
                <h3 class="title text-center">OFFICIALLY ENROLLED STUDENTS</h3>
                <h5 class="subtitle text-center">AY: {{data.ActiveTermDesc}}</h5>
        	           
                            <v-row>
                <v-col class="text-right">
                        <v-btn
                            v-if="usertype==='Admin'"
                            medium
                            
                            tile
                            dark
                            color="#4CAF50"
                            @click="showForwardModalView"
                            >
                            <v-icon left large> mdi-account-arrow-right-outline</v-icon>
                            Forward All Grantees
                        </v-btn>

                         <v-btn
                            v-if="usertype==='User'"
                            medium
                            :disabled="checkForwardonly"
                            tile
                            dark
                            color="#4CAF50"
                            @click="showForwardModalView"
                            >
                            <v-icon left large> mdi-account-arrow-right-outline</v-icon>
                            Forward All Grantees
                        </v-btn>
                       
                    

                                        <v-btn
                                            v-if="!checkBox1"
                                            tile
                                            dark
                                            medium
                                            color="light-blue darken-1"
                                            > 
                                            <downloadExcel
                                             :data="selectedlist"
                                             :fields="json_fields"
                                             :name="ExportSelName()"
                                             >
                                            <v-icon left>
                                                mdi-download
                                            </v-icon>
                                            Export</downloadExcel>
                                            </v-btn>

                                        <v-btn
                                            v-if="checkBox1"
                                            tile
                                            @click="exportAll"
                                            dark
                                            medium
                                            color="primary"
                                            >  <v-icon left>
                                                mdi-download
                                            </v-icon> EXport All
                                          
                                            </v-btn>

                                            <v-btn v-if="usertype==='Admin'"
                                                    class="ma-2"
                                                    outlined
                                                    @click="showTesSettingsMM"
                                                    fab
                                                    small
                                                    color="teal"
                                                    >
                                                    <v-icon>mdi-cog-outline</v-icon>
                                            </v-btn>
                                                           

                                           
                                             
                </v-col>
            </v-row>

                     <v-banner
                           >
                           <br>
                          
                         
                                <v-row>
                                    <v-col cols="12" sm="3">
                                    <v-combobox
                                        v-model="chips"
                                        :items="items"
                                        chips
                                        clearable
                                        outlined
                                        dense
                                        label="Program"
                                        multiple
                                        prepend-icon="mdi-filter-variant"
                                        solo
                                    >
                                        <template v-slot:selection="{ attrs, item, select, selected }">
                                        <v-chip
                                            v-bind="attrs"
                                            :input-value="selected"
                                            close
                                            @click="select"
                                            @click:close="remove(item)"
                                        >
                                            <strong>{{ item }}</strong>&nbsp;
                                            <!-- <span>(Program)</span> -->
                                        </v-chip>
                                        </template>
                                    </v-combobox>

                                    <!-- <v-combobox
                                        v-model="chips"
                                        :items="items"
                                        chips
                                        clearable
                                        outlined
                                        dense
                                        label="Year Level"
                                        multiple
                                        prepend-icon="mdi-filter-variant"
                                        solo
                                    >
                                        <template v-slot:selection="{ attrs, item, select, selected }">
                                        <v-chip
                                            v-bind="attrs"
                                            :input-value="selected"
                                            close
                                            @click="select"
                                            @click:close="remove(item)"
                                        >
                                            <strong>{{ item }}</strong>&nbsp;
                                            <span>(Year Students)</span>
                                        </v-chip>
                                        </template>
                                    </v-combobox> -->
                                    
                                    </v-col>
                                    <v-col cols="12" sm="1">
                                         <v-btn :disabled="disableFilterStat" @click="filterYear" tile dark medium color="secondary">
                                            
                                            <v-icon left>
                                                mdi-filter
                                            </v-icon>filter
                                        </v-btn>

                                       
                                    </v-col>
                                     <v-col cols="12" sm="1">
                                        <v-checkbox
                                                v-model="chktesStud"
                                                hide-details
                                                @click="getCategoriesByPagination"
                                                dense
                                                class="shrink mr-2 mt-0"
                                                label="Exclude TES Grantees"
                                                >
                                        </v-checkbox>
                                       
                                    </v-col>
                                    
                                    <v-col cols="12" sm="4">
                                        <v-text-field v-model="search"
                                            append-icon="mdi-magnify"
                                            label="(StudID, FirstName, LastName, MiddleName)"
                                            outlined
                                            dense
                                            :disabled="disabledSearch"
                                            
                                            hide-details
                                            ></v-text-field>
                                    </v-col>
                                </v-row>
                            

                                <v-data-table :headers="headers"
                                            :items="categories"
                                            :options.sync="pagination"
                                            :server-items-length="total"
                                           :page.sync="page"
                                            :items-per-page="itemsPerPage"
                                            hide-default-footer
                                            show-select
                                            item-key="StudID"
                                             v-model="selectedlist"
                                              ref="table"
                                            
                                           
                                            @page-count="pageCount = $event"
                                       

                                            :loading="loading"
                                            class="elevation-1 pa-2"
                                            >


                                           

                                           

                                            <template v-slot:item.TESGrant="{ item }"> 
                                                       <td>
                                                <v-checkbox
                                                    v-model="props.selected"
                                                    primary
                                                    hide-details
                                                ></v-checkbox></td>

                                            </template>

                                            <template v-slot:item.TESGrant="{ item }"> 
                                                        <span class="text-center" v-if="item.TESGrant === 1">
                                                           
                                                               <v-icon color="green" large>
                                                                   mdi-check-circle-outline
                                                               </v-icon>
                                                              
                                                        </span>
                                                        <span v-if="item.TESGrant === 0" ><v-icon color="pink" large>
                                                                   mdi-close-circle-outline
                                                               </v-icon></span>

                                            </template>
                                             <template v-slot:item.EnrCourse="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{item.EnrCourse}}</span>   
                                            </template>
                                             <template v-slot:item.EnrYear="{ item }"> 
                                                         <span class="text-center" style="vertical-align: middle !important;">{{item.EnrYear}}</span>   
                                            </template>
                                             <template v-slot:item.EnrClass="{ item }"> 
                                                         <span class="text-center" style="vertical-align: middle !important;">{{item.EnrClass}}</span>   
                                            </template>
                                             <template v-slot:item.StudCStatus="{ item }"> 
                                                         <span class="text-center" style="vertical-align: middle !important;">{{item.StudCStatus}}</span>   
                                            </template>
                                            <template v-slot:item.StudBDate="{ item }"> 
                                                         <span class="text-center" style="vertical-align: middle !important;">{{item.StudBDate}}</span>   
                                            </template>
                                            <template  v-slot:item.StudLName="{ item }"> 
                                                         <span style=" vertical-align: middle !important;">{{item.StudLName}}</span>   
                                            </template>
                                            <template v-slot:item.StudFName="{ item }"> 
                                                         <span class="text-left" style="vertical-align: middle !important;">{{item.StudFName}}</span>   
                                            </template>
                                             <template v-slot:item.StudMName="{ item }"> 
                                                         <span class="text-left" style="vertical-align: middle !important;">{{item.StudMName}}</span>   
                                            </template>

                                            <!-- <template v-slot:item.TESGAY="{ item }"> 
                                                         <span  class="text-left" style="vertical-align: middle !important;">{{item.TESGAY}}</span>   
                                            </template>
                                             <template v-slot:item.tesAwardNo="{ item }"> 
                                                         <span class="text-left" style="vertical-align: middle !important;">{{item.tesAwardNo}}</span>   
                                            </template> -->





                                             <template v-slot:item.action="{ item }"> 
                                                 
                                                    <v-tooltip top color="primary">
                                                        <template v-slot:activator="{ on, attrs }">
                                                                    <v-btn
                                                                        color="primary"
                                                                        fab
                                                                        @click="showEditModalView(item.StudID,item.TESGrant,item.StudLName,item.StudFName,item.EnrCourse,item.EnrYear,item.TESGAY,item.tesAwardNo)"
                                                                        small
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                        dark>
                                                                        <v-icon>mdi-pencil</v-icon>
                                                                    </v-btn>
                                                                </template>
                                                                <span>Edit Student</span>
                                                    </v-tooltip> &nbsp;
                                                  <span v-if="item.TESGrant ===1 && usertype==='Admin'">
                                                     <v-tooltip top color="success" >
                                                        <template v-slot:activator="{ on, attrs }" >
                                                                    <v-btn
                                                                         
                                                                         @click="showForwardIndiModalView(item.StudID,item.TESGrant,item.StudLName,item.StudFName,item.EnrCourse,item.EnrYear)"
                                                                        color="success"
                                                                        fab
                                                                        small
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                        dark>
                                                                        <v-icon>mdi-account-arrow-right</v-icon>
                                                                    </v-btn>
                                                                </template>
                                                                <span>Forward Student</span>
                                                    </v-tooltip>
                                                 </span>

                                                 <span v-if="allowForward === 1 && item.TESGrant ===1 && usertype==='User'">
                                                     <v-tooltip top color="success" >
                                                        <template v-slot:activator="{ on, attrs }" >
                                                                    <v-btn
                                                                         
                                                                         @click="showForwardIndiModalView(item.StudID,item.TESGrant,item.StudLName,item.StudFName,item.EnrCourse,item.EnrYear)"
                                                                        color="success"
                                                                        fab
                                                                        small
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                        dark>
                                                                        <v-icon>mdi-account-arrow-right</v-icon>
                                                                    </v-btn>
                                                                </template>
                                                                <span>Forward Student</span>
                                                    </v-tooltip>
                                                 </span>
                                        </template>
                                          
                                </v-data-table>
                                 <div class="text-center pt-2">
                                <v-pagination
                                    v-model="page"
                                    :length="pageCount"
                                    :total-visible="7"
                                ></v-pagination>


                               
                                </div>

                        </v-banner>
                    <!-- </v-col>
            </v-row> -->


                    <!--forward Grantees-->
                        <Modal v-model="showForwardModal" width="360">
                            <p slot="header" style="color:#4CAF50;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Forward confirmation</span>
                            </p>
                            <div style="text-align:center">
                                <p>Are you sure you want to forward all Grandtees?</p>
                            
                            </div>
                            <div slot="footer">
                                <Button type="success" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="forwardGrantees" >FORWARD</Button>
                            </div>
                        </Modal>
                <!-- </section> -->


                  <!--forward Individual Grantees-->
                        <Modal v-model="showForwardIndiModal" width="360">
                            <p slot="header" style="color:#4CAF50;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Forward confirmation</span>
                            </p>
                            <p class="subtitle text-center">{{student.StudID}} - {{student.StudLName}}, {{student.StudFName}}                {{student.EnrCourse}} - {{student.EnrYear}}</p>
                            <div style="text-align:center">
                                <p>Are you sure you want to forward this Grandtee?</p>
                            
                            </div>
                            <div slot="footer">
                                <Button type="success" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="forwardIndiGrantee" >FORWARD</Button>
                            </div>
                        </Modal>
                <!-- </section> -->


                <!--forward Grantees-->
                        <Modal v-model="showEditModal" width="650">
                            <p slot="header" style="color:#1E88E5;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Edit Student's Info</span>
                            </p>
                            <p class="subtitle text-center">{{student.StudID}} - {{student.StudLName}}, {{student.StudFName}}                {{student.EnrCourse}} - {{student.EnrYear}}</p>
                            <!-- <p class="subtitle text-center"></p> -->
                            <v-divider></v-divider>
                                  
                                     <div style="text-align:Left !important;">
                                                            <p><b>Academic Year</b></p>
                                                          
                                                            <Select  clearable   v-model="student.TESGAY" filterable size="large" placeholder="Select Academic Year">
                                                                    <Option  v-for="year in years" :value="year" :key="year">{{year}}</Option>
                                                            </Select>
                                    </div>
                                    <br>

                                    <v-text-field
                                            v-model="student.tesAwardNo"  
                                            :rules="[rules.required, rules.awardNo]"
                                            label="TES-##-##-#####-####-#####"
                                            outlined
                                            
                                            v-mask="'TES-##-##-#####-####-#####'"
                                            >  
                                    </v-text-field>
                            <div style="text-align:center">
                             
                                                <v-sheet class="pa-5">
                                                    <b-switch
                                                        :rounded="isRounded"
                                                        :outlined="isOutlined"
                                                        size="is-large"
                                                        v-model="showValue1"
                                                        :type="type"
                                                        :left-label='leftLabel'
                                                        :passive-type='passiveType'>Grant
                                                    </b-switch>
                                                   
                                                </v-sheet>
                              
                            </div>
                            <div slot="footer" class="text-center">
                                <Button type="primary" size="large"  :loading="isDeleting" :disabled="isDeleting" @click="EditGrantees" >Continue</Button>
                            </div>
                        </Modal>


                        <Modal v-model="showExportAllModal" width="650">
                            <p slot="header" style="color:#1E88E5;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Export Confirmation</span>
                            </p>
                           <p class="text-center">Are you sure you want to Export?</p><br>
                            <!-- <v-divider></v-divider> -->
                            <div style="text-align:center">
                                    <v-btn  tile
                                          
                                            dark
                                            medium
                                            color="primary" @click="showExportAllModal=false">
                                         <downloadExcel
                                             :data="exportAllList"
                                             :fields="json_fields"
                                             :name="ExportAllName()"
                                             
                                             >
                                            <v-icon left>
                                                mdi-download
                                            </v-icon>
                                            Export</downloadExcel>

                                    </v-btn>
                                         
                                             
                              
                            </div>
                            <div slot="footer" class="text-center">
                                <!-- <Button type="primary" size="large"  :loading="isDeleting" :disabled="isDeleting" @click="EditGrantees" >Continue</Button> -->
                            </div>
                        </Modal>
                <!-- </section> -->
                        <v-app>
                         <Modal v-model="showTesSettings" width="650">
                            <p slot="header" style="color:#1E88E5;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>TES Settings</span>
                            </p>
                            
                            <!-- <v-divider></v-divider> -->
                                  
                                     
                            <div style="text-align:left">
                             
                                                <v-sheet class="pa-5">
                                                    <b-switch
                                                        :rounded="isRounded"
                                                        :outlined="isOutlined"
                                                        size="is-medium"
                                                        v-model="showValueForwardStat"
                                                        type="is-info"
                                                        :left-label='leftLabel'
                                                        :passive-type='passiveType'  @input="OnAction">Forward Status:
                                                       
                                                    </b-switch>
                                                   
                                                </v-sheet>
                              
                            </div>
                            <v-divider></v-divider>

                             <div >
                                 <p class="subtitle text-center">Current-TES School Term Configuration</p>
                             
                                                <v-data-table 
                                                dense
                                                :headers="headersSettings"
                                                :items="shcterm"
                                                
                                            
                                            >

                                              <template v-slot:item.termTES="{ item }">
                                                           

                                                             <span v-if="item.termTES === 1" class="active">Active</span>
                                                            <span v-if="item.termTES === 0" class="Inactive">Inactive</span>
                                                </template>

                                                 <template v-slot:item.action="{ item }"> 
                                                   
                                                          <span v-if="item.termTES  === 0">
                                                            <v-btn  @click="changeStaLock(item.TermNum)"
                                                                fab
                                                                dark
                                                                small
                                                                color="green"
                                                                >
                                                                <v-icon >
                                                                     mdi-check
                                                                    </v-icon>
                                                                
                                                            </v-btn>
                                                           
                                                            </span>

                                                            <span v-if="item.termTES  === 1">
                                                            <v-btn  @click="changeStaUnLock(item.TermNum)"
                                                                fab
                                                                small
                                                                
                                                                color="pink"
                                                                >
                                                                <v-icon >
                                                                    mdi-close
                                                                    </v-icon>
                                                                
                                                            </v-btn></span>

                                            </template>
                                            </v-data-table>


                              
                            </div>
                            <v-divider></v-divider>
                            <v-spacer></v-spacer>

                            <div >
                                 <p class="subtitle text-center">Prev-TES School Term Configuration</p>
                             
                                                <v-data-table 
                                                dense
                                                :headers="headersSettingsPrev"
                                                :items="shcterm"
                                                
                                            
                                            >

                                              <template v-slot:item.termPrevTES="{ item }">
                                                           

                                                             <span v-if="item.termPrevTES === 1" class="active">Active</span>
                                                            <span v-if="item.termPrevTES === 0" class="Inactive">Inactive</span>
                                                </template>

                                                 <template v-slot:item.action="{ item }"> 
                                                   
                                                          <span v-if="item.termPrevTES  === 0">
                                                            <v-btn  @click="changeStaLockPrev(item.TermNum)"
                                                                fab
                                                                dark
                                                                small
                                                                color="green"
                                                                >
                                                                <v-icon >
                                                                     mdi-check
                                                                    </v-icon>
                                                                
                                                            </v-btn>
                                                           
                                                            </span>

                                                            <span v-if="item.termPrevTES  === 1">
                                                            <v-btn  @click="changeStaUnLockPrev(item.TermNum)"
                                                                fab
                                                                small
                                                                
                                                                color="pink"
                                                                >
                                                                <v-icon >
                                                                    mdi-close
                                                                    </v-icon>
                                                                
                                                            </v-btn></span>

                                            </template>
                                            </v-data-table>


                              
                            </div>


                            <div slot="footer" class="text-right">
                                <!-- <Button type="primary" size="large"  :loading="isDeleting" :disabled="isDeleting" @click="EditGrantees" >Continue</Button> -->
                            </div>
                        </Modal></v-app>


            </div>
      </v-app>
</div>
  
</template>

<script>

    export default {
        props:['usertype'],
        data() {
        
            return {
                token: '',
                termTES:'',

                showTesSettings:false,

                ExternalTESYear:'',
                tesAwardNum:'',

                 rules: {
                        required: value => !!value || 'Required.',
                        awardNo: value => value.length <= 26 || 'Max 26 characters',
                     },

                chktesStud:false,
                disabledSearch:false,
                showValueForwardStat:false,

                 json_fields: {
                     
                    "LEARNER'S REFERENCE NO.": "StudLRN",
                    "Student ID": "StudID",
                    "LastName": "StudLName",
                    "Firstname": "StudFName",
                    "EXT. NAME":"N/A",
                    "Middle Name": "StudMName",
                    "Sex": "StudSex",
                    "Birthdate": "StudBDate",
                    "Degree Program": "CDesc",
                    "Year Level": "EnrYear",

                    "Father's Lastname": "StudPFLName",
                    "Father's Given Name": "StudPFFName",
                    "Father's Middle Name": "StudPFMName",
                    "Mother's Lastname": "StudPMMaidLName",
                    "Mother's Given Name": "StudPMMaidFName",
                    "Mother's Middle Name": "StudPMMaidMName",
                    "DSWD HOUSEHOLD NO.":"N/A",
                    "Household per Capita Income":"StudPMIncome",
                    "street & Barangay": "StudPStr",
                    "Town/City/Mun": "City_Name",
                    "Province": "Prov_Name",
                    "ZIP Code": "StudPZip",
                    "Total Assessment": "AssTotDue",
                    "DISABILITY (leave blank if NOT Applicable)":"N/A",
                    "Phone Number": "StudCNum",
                    "E-mail Address": "email",


                    },

                 RegInsSortList:[],
                 RegInsSort:'',
                courses:[],
                 selectedlist: [],
                 exportAllList:[],

                 shcterm:[],
                 showExportAllModal:false,
                 dialog: false,

               chips: [],
                items: ['AB POLSCI', 'AB ENGLISH', 'AB COMM', 'BEED','GEN  MID', 'BSBA-MM','BSBA-HRDM', 'BSOA','BSBA-HRM','BSCS','BS CRIM', 
                'BSISM','BSED-FIL','BSED-MAPEH', 'BSED-ENGL','BSED-MATH','BSED-SOCSTUD'],
                filterYearB:false,

                disableFilter:true,

                page: 1,
                pageCount: 0,
                itemsPerPage: 50,

                size: '',
                type: null,
                passiveType: null,
                isRounded: false,
                isOutlined: true,
                leftLabel: true,


                forwardStat:'',




                isDeleting:false,
                showForwardIndiModal:false,
                 showForwardModal:false,
                 showEditModal:false,
                 

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
                        ay:'',
                        tesAwardNo:'',


                },
                showValue1: false,

                disabledCount: 0,



              
                 headers: [
           
                        { text: 'Student ID', value: 'StudID' ,align: 'center',width: 100,},
                         { text: 'LastName', value: 'StudLName', align: 'left' , width: 230,},
                        { text: 'Firstname', value: 'StudFName', align: 'left' , width: 230,},
                       
                        { text: 'Middle Name', value: 'StudMName', align: 'left' , width: 230,},
                        
                      
                        { text: 'Program', value: 'EnrCourse' , align: 'Left', width: 100,},
                        { text: 'Year', value: 'EnrYear', align: 'center', width: 50,},
                          { text: 'Type', value: 'EnrClass' , align: 'center',width: 100,},
                        { text: 'Status', value: 'StudCStatus' , align: 'center', width: 100,},
                        { text: 'Bdate', value: 'StudBDate', align: 'center', },
                        { text: 'TES Grantee', value: 'TESGrant', align: 'center', },

                        { text: '', value: 'TESGAY', align: 'center', align: ' d-none'},
                        { text: '', value: 'tesAwardNo', align: 'center', align: ' d-none'},
                     
                        { text: 'Action', value: 'action',align: 'center', },
                        
                      ],

                  headersSettings: [
           
                        { text: 'Term', value: 'TermNum' ,align: 'center'},
                        { text: 'Description', value: 'TermDesc', align: 'left' },
                        { text: 'TES Status', value: 'termTES', align: 'left' },
                        { text: 'Action', value: 'action',align: 'center', },
                        
                      ],

                   headersSettingsPrev: [
           
                        { text: 'Term', value: 'TermNum' ,align: 'center'},
                        { text: 'Description', value: 'TermDesc', align: 'left' },
                        { text: 'TES Status', value: 'termPrevTES', align: 'left' },
                        { text: 'Action', value: 'action',align: 'center', },
                        
                      ],

                      studentList:[],

                        categories: [],
                        search: '',
                        total: 0,
                        loading: false,
                        pagination: {},
                       
                        rowsPerPageItems: [5, 10, 20, 50, 100],

                        allowForward:0,

                        grant:0,

                         SchlTermStat:{
                               
                                isClose:'',
                                                        
                            },
                    

            }
        },

        watch: {

                 pagination() {
                        this.getCategoriesByPagination();
                    },
                search() {
                        this.getCategoriesByPagination();
                    },

             
        },

        mounted(){
            this.filterYearB = false
            this.getActiveTerm()
            this.checkForward()
            this.getSchTerm()
            this.getprog()
        },

         computed: {
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
                        if (this.selectedlist.length ===0){
                            return true;
                        }else{
                            return false;
                        }
                    },

                    disableFilterStat(){
                        if ((this.chips.length===0 && !this.search) || (this.chips.length===0 && this.search.length > 0) ){
                            this.filterYearB=false
                            this.getCategoriesByPagination()
                            return true
                            
                    }else{
                        return false
                    }
                    },
                     years () {
                            const year = new Date().getFullYear()
                            return Array.from({length: year - 2000}, (value, index) =>  (year - (index+1))  + '-' + (year - index) )
                        },


            },

     methods:{

        async getprog(){
            const res = await  axios.get('/api/getprog')
            if(res.status==200){
                    
                    this.RegInsSortList= res.data
                   
                    
            }else{
                console.log(res.data)
            }
        },

          ExportAllName(){
             return ("TES-Application-ALL(" + this.data.ActiveTerm + ")" + ".xls");
         },

         ExportSelName(){
             return ("TES-Sel-Application(" + this.data.ActiveTerm + ")" + ".xls");
         },

          getColor (isLock) {
        
                if (isLock === 0) return 'green'
                if (isLock === 1) return 'red'
              


            },  
            
           async OnAction(){

               
            if(this.showValueForwardStat===true){
                this.forwardStat = 1
            }else{
                this.forwardStat = 0
            }
               
                const res = await this.callApi('post', 'app/OnAction/' + this.forwardStat)
                            if(res.status===200){
                                            
                                            this.showTesSettings=false

                                             this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Forward status successfully Edited! `,
                                            position: 'is-bottom',
                                            type: 'is-success'
                                        })    
                                        this.filterYearB = false
                                        this.getActiveTerm()
                                        this.checkForward()
                                        this.getSchTerm()
                                        this.getCategoriesByPagination()
                                  

                            }else{
                                if(res.status===422){
                                    this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Something went wrong! `,
                                            position: 'is-bottom',
                                            type: 'is-danger'
                                        })
                                      
                                }

                            } 

           },

           async changeStaLock(item){


             const res = await this.callApi('post', 'app/changeStaLock/' + item)
                            if(res.status===200){
                                            
                                            this.showTesSettings=false
                                            this.categories=[]
                                            this.data=[]
                                            this.pageCount=''
                                             this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `TES School Term successfully open! `,
                                            position: 'is-bottom',
                                            type: 'is-success'
                                        })    
                                        this.filterYearB = false
                                        this.getActiveTerm()
                                        this.checkForward()
                                        this.getSchTerm()
                                        this.getCategoriesByPagination()
                                  

                            }else{
                                if(res.status===422){
                                    this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Something went wrong! `,
                                            position: 'is-bottom',
                                            type: 'is-danger'
                                        })
                                      
                                }

                            } 

        },

        async changeStaUnLock(item){


             const res = await this.callApi('post', 'app/changeStaUnLock/' + item)
                            if(res.status===200){
                                            
                                            this.showTesSettings=false
                                            this.categories=[]
                                            this.data=[]
                                            this.pageCount=''
                                             this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `TES School Term successfully Closed! `,
                                            position: 'is-bottom',
                                            type: 'is-success'
                                        })    
                                        this.filterYearB = false
                                        this.getActiveTerm()
                                        this.checkForward()
                                        this.getSchTerm()
                                        this.getCategoriesByPagination()
                                  

                            }else{
                                if(res.status===422){
                                    this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Something went wrong! `,
                                            position: 'is-bottom',
                                            type: 'is-danger'
                                        })
                                      
                                }

                            } 

        },



         async changeStaLockPrev(item){


             if (this.data.ActiveTerm === item){
                                // this.$buefy.toast.open({
                                //             duration: 5000,
                                //             message: `Previous Term should not be the same with the Current Term! `,
                                //             position: 'is-bottom',
                                //             type: 'is-danger'
                                //         })

                                   this.$buefy.notification.open({
                                            duration: 2000,
                                            message: `Previous Term should not be the same with the Current Term!`,
                                            position: 'is-bottom-right',
                                            type: 'is-danger',
                                            hasIcon: true
                                        })
             }else{

             


             const res = await this.callApi('post', 'app/changeStaLockPrev/' + item)
                            if(res.status===200){

                                
                                            
                                            this.showTesSettings=false
                                            this.categories=[]
                                            this.data=[]
                                            this.pageCount=''
                                             this.$buefy.toast.open({
                                                    duration: 5000,
                                                    message: `Previous TES School Term successfully set! `,
                                                    position: 'is-bottom',
                                                    type: 'is-success'
                                                })    
                                        this.filterYearB = false
                                        this.getActiveTerm()
                                        this.checkForward()
                                        this.getSchTerm()
                                        this.getCategoriesByPagination()
                                  

                            }else{
                                if(res.status===422){
                                    this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Something went wrong! `,
                                            position: 'is-bottom',
                                            type: 'is-danger'
                                        })
                                      
                                }

                            } 
                }

        },

        async changeStaUnLockPrev(item){

            
             if (this.data.ActiveTerm === item){
                                        // this.$buefy.toast.open({
                                        //     duration: 5000,
                                        //     message: `Previous Term should not be the same with the Current Term! `,
                                        //     position: 'is-bottom',
                                        //     type: 'is-danger'
                                        // })
                                        this.$buefy.notification.open({
                                            duration: 2000,
                                            message: `Previous Term should not be the same with the Current Term!`,
                                            position: 'is-bottom-right',
                                            type: 'is-danger',
                                            hasIcon: true
                                        })

             }else{


             const res = await this.callApi('post', 'app/changeStaUnLockPrev/' + item)
                            if(res.status===200){
                                            
                                            this.showTesSettings=false
                                            this.categories=[]
                                            this.data=[]
                                            this.pageCount=''
                                             this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Previous TES School Term successfully closed! `,
                                            position: 'is-bottom',
                                            type: 'is-success'
                                        })    
                                        this.filterYearB = false
                                        this.getActiveTerm()
                                        this.checkForward()
                                        this.getSchTerm()
                                        this.getCategoriesByPagination()
                                  

                            }else{
                                if(res.status===422){
                                    this.$buefy.toast.open({
                                            duration: 5000,
                                            message: `Something went wrong! `,
                                            position: 'is-bottom',
                                            type: 'is-danger'
                                        })
                                      
                                }

                            } 

             }

        },




        exportAll(){
                this.token = window.Laravel.csrfToken

                if(this.filterYearB ==false && !this.search && this.chktesStud===false) {
                        axios.get(`/api/exportall`)
                            .then(res => {
                                this.exportAllList = res.data.data;
                                this.showExportAllModal=true
                                // this.total = res.data.meta.total;
                            })
                            .catch(err => console.log(err.response.data))
                            .finally(() => this.loading = false);
                }

                if(this.filterYearB ==true && !this.search) {
                        axios.get(`/api/exportallFilter?query=${this.chips}`)
                            .then(res => {
                                this.exportAllList = res.data.data;
                                this.showExportAllModal=true
                                // this.total = res.data.meta.total;
                            })
                            .catch(err => console.log(err.response.data))
                            .finally(() => this.loading = false);
                }
                
                if(this.filterYearB ==true && !this.search && this.chktesStud===true) {
                        axios.get(`/api/exportallFiltercheckbox?query=${this.chips}`)
                            .then(res => {
                                this.exportAllList = res.data.data;
                                this.showExportAllModal=true
                                // this.total = res.data.meta.total;
                            })
                            .catch(err => console.log(err.response.data))
                            .finally(() => this.loading = false);
                }


                 if(this.filterYearB ==false && !this.search && this.chktesStud===true) {
                        axios.get(`/api/exportallcheckbox?`)
                            .then(res => {
                                this.exportAllList = res.data.data;
                                this.showExportAllModal=true
                                // this.total = res.data.meta.total;
                            })
                            .catch(err => console.log(err.response.data))
                            .finally(() => this.loading = false);
                }
            
        },

        selectAllToggle(props) {
            if(this.selectedlist.length != this.categories.length - this.disabledCount) {
                this.selectedlist = [];
                const self = this;
                props.items.forEach(item => {
                if(!item.disabled) {
                    self.selectedlist.push(item);
                } 
                });
            } else this.selectedlist = [];
            },

       

        showForwardModalView(){
                
                this.showForwardModal = true
                
        },

        showTesSettingsMM(){
            
            if (this.allowForward===1){
               this.showValueForwardStat= true
            }else{
                this.showValueForwardStat= false
            }
            
            this.showTesSettings=true
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
       
         showEditModalView(StudID,TESGrant,StudLName,StudFName,EnrCourse,EnrYear,TESGAY,tesAwardNo){
                let obj = {
                    StudID : StudID ,
                    TESGrant : TESGrant,
                    StudLName: StudLName,
                    StudFName: StudFName,
                    EnrCourse: EnrCourse,
                    EnrYear: EnrYear,
                    TESGAY:TESGAY,
                    tesAwardNo:tesAwardNo,

            }
                this.student=obj
                if (this.student.TESGrant==1){
                        this.showValue1=true
                    }else{
                        this.showValue1=false
                    }
                this.showEditModal = true
                
        },

        async forwardGrantees(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/forwardGrantees')
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.success2('TES Grantees has been forwarded successfully!') 
                    this.showForwardModal=false
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
                this.student.TESGrant = 1
            }else{
                this.student.TESGrant = 0
            }
               
            const res = await this.callApi('post', 'app/EditGrantees',  this.student)
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
                    this.student.TESGAY=''
                    this.student.tesAwardNo=''
                
                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },

        

        getCategoriesByPagination() {
            this.loading = true;
            if (this.search && this.filterYearB ===false) {
                axios.get(`/student-filter?query=${this.search}&page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                         this.disabledSearch=false
                        this.categories = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
            }
           
            if(this.filterYearB ===false && !this.search && this.chktesStud===false) {
                axios.get(`/getStudents?page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                         this.disabledSearch=false
                        this.categories = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
            }

            if(this.filterYearB ==true && !this.search && this.chktesStud===false) {
           
                this.loading = true;
            
                axios.get(`/student-filterYear?query=${this.chips}&page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                         this.disabledSearch=false
                        this.categories = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
                    // this.filterYearB = false
            
            }

             if(this.filterYearB ==true && this.search && this.chktesStud===false) {
           
                this.loading = true;
            
             


                 axios.get(`/student-filterYearSearch?query=${this.chips}&search=${this.search}&page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                        this.disabledSearch=false
                        this.categories = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
            
            }

            if(this.chktesStud===true && this.filterYearB ===false){
                     axios.get(`/getStudentschk?page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                        this.disabledSearch=true
                        this.categories = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
            }else if(this.filterYearB ===true && !this.search && this.chktesStud===true) {
           
                this.loading = true;
            
                axios.get(`/student-filterYearCheckbox?query=${this.chips}&page=${this.pagination.page}&per_page=${this.pagination.itemsPerPage}`)
                    .then(res => {
                        this.disabledSearch=true
                        this.categories = res.data.data;
                        this.total = res.data.meta.total;
                    })
                    .catch(err => console.log(err.response.data))
                    .finally(() => this.loading = false);
                    // this.filterYearB = false
            
            }

                
        },


        filterYear(){
            this.filterYearB = true
            this.getCategoriesByPagination()

       
        },






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

            getSchTerm(){
                this.token = window.Laravel.csrfToken
                axios('/api/getSchTerm')
                    .then(res=> {
                        this.shcterm = res.data
                        // this.data.ActiveTermDesc =res.data[0].TermDesc
                       
                        
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




</style>

