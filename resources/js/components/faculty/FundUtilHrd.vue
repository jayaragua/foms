<template>

<div class="container-fluid">
      <v-app>
       <br>
       <!-- v-if="isprint===false" -->
       <div v-if="isprint===false" id="non-printable1">
           <h3 class="title text-center">TES Fund Monitoring</h3>
            
       <!-- <v-row>
           <v-col> -->
                <!-- <h3 class="title text-center">OFFICIALLY ENROLLED STUDENTS</h3> -->
                <!-- <h5 class="subtitle text-center">AY: {{data.ActiveTermDesc}}</h5> -->
        	
                     <v-banner
                           >


                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="search"
                                            append-icon="mdi-magnify"
                                            label="Search"
                                            single-line
                                        
                                            hide-details
                                            ></v-text-field>
                                    </v-col>
                             
                                <v-col cols="12" sm="6" class="text-right">
                                     <!-- <v-btn
                                                    v-show="checkBox1"
                                                    tile
                                                    dark
                                                    small
                                                    
                                                    color="pink"
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
                                                   
                                            </v-btn> -->
                                     <v-dialog
                                        v-model="dialogAdd"
                                        width="650"
                                        >
                                        <template v-slot:activator="{ on, attrs }">
                                            
                                        
                                            <v-btn
                                                  
                                                        tile
                                                        dark
                                                        small
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        color="light-blue darken-1"
                                                        > <v-icon left>mdi-plus</v-icon> 
                                                        ADD NEW
                                                    
                                                        </v-btn> 

                                            
                                                        
                                        </template>
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Add New Check
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                         <!-- <v-row bordered style="margin-top:-20px; border:5px gray !important;"> -->
                                             <!-- <v-col> -->
                                               <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                                <v-radio-group
                                                       
                                                        row
                                                        
                                                        v-model="TESFund.chckType"
                                                        >
                                                         <template v-slot:label>
                                                            <div class="subtitle">Type</div>
                                                        </template>
                                                        
                                                        <v-radio
                                                            label="Check"
                                                            value="Check"
                                                        ></v-radio>
                                                        <v-radio
                                                            label="ADA"
                                                            value="ADA"
                                                        ></v-radio>
                                                        </v-radio-group>
                                                        </div>
                                                        <!-- <hr> -->
                                         <!-- </v-row> -->
                                         <!-- <v-divider></v-divider> -->
                                         <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                         <v-row style="margin-top:10px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="6"
                                            >
                                                <v-text-field
                                                    :disabled="!TESFund.chckType"
                                                    label="ADA/Check Number"
                                                    v-model="TESFund.chckADANum"
                                                    outlined
                                                    dense
                                                    required
                                                ></v-text-field> 
                                            </v-col>
                                         </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="12"
                                            >
                                                <v-textarea auto-grow
                                                    :disabled="!TESFund.chckADANum"
                                                    outlined
                                                    clearable
                                                    dense
                                                    rows="1"
                                                    row-height="15"
                                                    clear-icon="mdi-close-circle"
                                                    label="Particulars"
                                                    v-model="TESFund.chckParticular"
                                               
                                                    >
                                                </v-textarea>
                                            </v-col>

                                        </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="5"
                                            md="5"
                                            >
                                                 <v-menu
                                                        ref="menuadd"
                                                        v-model="menuadd"
                                                        :close-on-content-click="false"
                                                        
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="auto"
                                                    >
                                                        <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field
                                                            :disabled="!TESFund.chckParticular"
                                                            v-model="TESFund.dateRcvd"
                                                            outlined
                                                            label="Date Recieved"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="TESFund.dateRcvd"
                                                        
                                                        no-title
                                                        scrollable
                                                        >
                                                        <v-spacer></v-spacer>
                                                        <v-btn
                                                            text
                                                            color="primary"
                                                            @click="menuadd = false"
                                                        >
                                                            Cancel
                                                        </v-btn>
                                                        <v-btn
                                                            text
                                                            color="primary"
                                                            @click="$refs.menuadd.save(date)"
                                                        >
                                                            OK
                                                        </v-btn>
                                                        </v-date-picker>
                                                    </v-menu>
                                            </v-col>
                                            <v-col  cols="12"
                                            sm="7"
                                            md="7">
                                               <!-- <v-text-field
                                                    label="Amount"
                                                    v-model="TESFund.TESAmnt"
                                                    :disabled="!TESFund.dateRcvd"
                                                    prefix="P "
                                                    type="number"   
                                                    step="any"
                                                    min="0"
                                                    ref="input"
                                                    dense
                                                    outlined
                                                    :rules="[numberRule]"
                                                   
                                                    ></v-text-field> -->


                                                     <vuetify-money
                                                        
                                                        label="Amount"
                                                         v-model="TESFund.TESAmnt"
                                                        :disabled="!TESFund.dateRcvd"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                             <v-col  cols="12"
                                            sm="6"
                                            md="6">
                                               <!-- <v-text-field
                                                    label="Admin Cost"
                                                    v-model="TESFund.admCost"
                                                    :disabled="!TESFund.TESAmnt"
                                                    prefix="P "
                                                    type="number"   
                                                    step="any"
                                                    min="0"
                                                    ref="input"
                                                    dense
                                                    outlined
                                                    :rules="[numberRule]"
                                                   
                                                    ></v-text-field> -->

                                                      <vuetify-money
                                                        
                                                        label="Admin Cost"
                                                        v-model="TESFund.admCost"
                                                        :disabled="!TESFund.TESAmnt"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />
                                            </v-col>

                                             <v-col  cols="12"
                                                sm="6"
                                                md="6">
                                                <!-- <v-text-field
                                                        label="TES Subsidy"
                                                        v-model="TESFund.tesSubAmt"
                                                        :disabled="!TESFund.admCost"
                                                        prefix="P "
                                                        type="number"   
                                                        step="any"
                                                        min="0"
                                                        ref="input"
                                                        dense
                                                        outlined
                                                        :rules="[numberRule]"
                                                       
                                                        ></v-text-field> -->

                                                        <vuetify-money
                                                        
                                                         label="TES Subsidy"
                                                        v-model="TESFund.tesSubAmt"
                                                        :disabled="!TESFund.admCost"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />
                                            </v-col>
                                        </v-row>
                                         </div>
                                        </div>

                                            <v-divider></v-divider>

                                            <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                color="blue darken-1"
                                                text
                                                @click="dialogAdd = false"
                                            >
                                                Close
                                            </v-btn>
                                            <v-btn
                                                color="primary"
                                                text
                                                @click="SaveFund"
                                                :disabled="!TESFund.chckType || !TESFund.chckADANum || !TESFund.chckParticular
                                                 || !TESFund.TESAmnt || !TESFund.admCost || !TESFund.dateRcvd || !TESFund.tesSubAmt"
                                            >
                                                Save
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        </v-dialog>
                                   
                                    </v-col>
                                </v-row>
                              


                                
<!--                              
show-select
                                            item-key="chckId"
                                            single-select -->
                                <v-data-table 
                                            
                                           
                                            :headers="headers"
                                            :items="FundUtilList"
                                            :loading="loading"
                                            scrollable
                                            :search="search"
                                            class="elevation-1 pa-2"
                                            
                                            v-model="selectedlist"
                                          
                                          
                                            >

                                            <template v-slot:item.dateRcvd="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{new Date(item.dateRcvd).toLocaleDateString()}} </span> 
                                                      
                                            </template>

                                             <template v-slot:item.TESAmnt="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important; font-weight:bold;">{{formatPrice(item.TESAmnt)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.bal="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;font-weight:bold;">{{formatPrice(item.bal)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.tesSubAmt="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.tesSubAmt)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.tesSubBal="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.tesSubBal)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.admCost="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.admCost)}} </span> 
                                                      
                                            </template>
                                              <template v-slot:item.admCostBal="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.admCostBal)}} </span> 
                                                      
                                            </template>

                                             <template v-slot:item.status="{ item }">
                                                <v-chip
                                                small
                                                    :color="getColor(item.status)"
                                                    dark
                                                >
                                                    <span v-if="item.status  === 1">Active</span>
                                                    <span v-if="item.status  === 0">Cancelled</span>
                                                    <span v-if="item.status  === 2">Disbursed</span>
                                                
                                                </v-chip>
                                            </template>
                                            
                                            
                                            

                                          <template v-slot:item.action="{ item }"> 
                                    
                                                    <v-dialog
                                                        v-model="dialog"
                                                        persistent
                                                        max-width="600px"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                            

                                                        
                                                        <v-list>
                                                            
                                                                <v-list-group
                                                                
                                                                >
                                                                    <template v-slot:activator>
                                                                        <v-list-item-title>
                                                                                <v-btn
                                                                                v-model="fab"
                                                                                small
                                                                                color="blue darken-2"
                                                                                dark
                                                                                text
                                                                                >
                                                                                <v-icon v-if="fab">
                                                                                    mdi-close
                                                                                </v-icon>
                                                                                <v-icon v-else>
                                                                                    mdi-cursor-default-click
                                                                                </v-icon> 
                                                                                </v-btn>
                                                                            </v-list-item-title>
                                                                    </template>

                                                                    <v-list-group
                                                                    active="false"
                                                            
                                                                    >
                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start">
                                                                        <v-list-item-title>
                                                                            
                                                                            <v-btn
                                                                                       @click="showEditModalView(item.chckId,item.chckType,item.chckADANum,item.chckParticular,
                                                                                                            item.TESAmnt,item.dateRcvd,item.admCost,item.tesSubAmt,item.Status)"
                                                                                        dark
                                                                                        small
                                                                                        text
                                                                                        color="primary"
                                                                                    > Edit
                                                                                        
                                                                            </v-btn>
                                                                    </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>
                                                                    </v-list-group>

                                                                    <v-list-group right
                                                                     v-if="item.status===1"
                                                                    active="false">

                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start">
                                                                        <v-list-item-title>
                                                                            
                                                                            <v-btn
                                                                                        @click="Utilized(item.chckId)"
                                                                                        dark
                                                                                        small
                                                                                        text
                                                                                        color="green"
                                                                                    > Disbursed
                                                                                        
                                                                            </v-btn>
                                                                    </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>
                                                                    </v-list-group>

                                                                    <v-list-group right
                                                                     v-if="item.status===2"
                                                                    active="false">

                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start">
                                                                        <v-list-item-title>
                                                                            
                                                                            <v-btn
                                                                                        @click="Unutilized(item.chckId)"
                                                                                        dark
                                                                                        small
                                                                                        text
                                                                                        color="green"
                                                                                    > Active
                                                                                        
                                                                            </v-btn>
                                                                    </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>
                                                                    </v-list-group>



                                                                    <v-list-group right
                                                                    v-if="item.status===1"
                                                                    active="false">
                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start" >
                                                                        <v-list-item-title >
                                                                           
                                                                            <v-btn
                                                                                      
                                                                                       @click="cancelFund(item.chckId)"
                                                                                        dark
                                                                                        text
                                                                                        small
                                                                                        color="orange"
                                                                                    > Cancel
                                                                                        
                                                                            </v-btn>
                                                                        </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>

                                                                
                                                                    </v-list-group>


                                                                     <v-list-group right
                                                                      v-if="item.status===0"
                                                                    active="false">
                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start" >
                                                                        <v-list-item-title >
                                                                           
                                                                            <v-btn
                                                                                       @click="UncancelFund(item.chckId)"
                                                                                        dark
                                                                                        text
                                                                                        small
                                                                                        color="orange"
                                                                                    > Restore
                                                                                        
                                                                            </v-btn>
                                                                        </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>

                                                                
                                                                    </v-list-group>


                                                                    <v-list-group right
                                                                    active="false">
                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start" >
                                                                        <v-list-item-title >
                                                                           
                                                                            <v-btn
                                                                                  
                                                                                       @click="showDeletingModal(item.chckId)"
                                                                                        dark
                                                                                        text
                                                                                        small
                                                                                        color="red"
                                                                                    > Delete
                                                                                        
                                                                            </v-btn>
                                                                        </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>

                                                                
                                                                    </v-list-group>




                                                                    <v-list-group
                                                                    active="false"
                                                            
                                                                    >
                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start">
                                                                        <v-list-item-title>
                                                                            <v-btn
                                                                                        :href="`/tes-fund-disbursement/${item.chckId}`"
                                                                                        dark
                                                                                        text
                                                                                        small
                                                                                        color="pink"
                                                                                    > View Disbursement
                                                                                        
                                                                            </v-btn>
                                                                    </v-list-item-title>
                                                                        </v-list-item-content>
                                                                    </template>

                                                                
                                                                    </v-list-group>

                                                                </v-list-group>
                                                                </v-list>
                                                    
                                                        </template>
                                        
                                                    <v-card>
                                                    
                                                    </v-card>
                                                    </v-dialog> 
                                            </template>


                                </v-data-table>

                                 <Modal v-model="showDeleteModal" width="360">
                                                <p slot="header" style="color:#f60;text-align:center">
                                                    <Icon type="ios-information-circle"></Icon>
                                                    <span>Delete confirmation</span>
                                                </p>
                                                <div style="text-align:center">
                                                    <p>Are you sure you want to delete this Item?</p>
                                                
                                                </div>
                                                <div slot="footer">
                                                    <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="DeleteFund()">Delete</Button>
                                                </div>
                                            </Modal>



                                  <v-dialog
                                        v-model="showEditModal"
                                        width="650"
                                        >
                                     
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Edit TES Fund
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                         <!-- <v-row bordered style="margin-top:-20px; border:5px gray !important;"> -->
                                             <!-- <v-col> -->
                                               <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                                <v-radio-group
                                                       
                                                        row
                                                        
                                                        v-model="TESFundEdit.chckType"
                                                        >
                                                         <template v-slot:label>
                                                            <div class="subtitle">Type</div>
                                                        </template>
                                                        
                                                        <v-radio
                                                            label="Check"
                                                            value="Check"
                                                        ></v-radio>
                                                        <v-radio
                                                            label="ADA"
                                                            value="ADA"
                                                        ></v-radio>
                                                        </v-radio-group>
                                                        </div>
                                                        <!-- <hr> -->
                                         <!-- </v-row> -->
                                         <!-- <v-divider></v-divider> -->
                                         <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                         <v-row style="margin-top:10px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="6"
                                            >
                                                <v-text-field
                                                    :disabled="!TESFundEdit.chckType"
                                                    label="ADA/Check Number"
                                                    v-model="TESFundEdit.chckADANum"
                                                    outlined
                                                    dense
                                                    required
                                                ></v-text-field> 
                                            </v-col>
                                         </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="12"
                                            >
                                                <v-textarea auto-grow
                                                    :disabled="!TESFundEdit.chckADANum"
                                                    outlined
                                                    clearable
                                                    dense
                                                    rows="1"
                                                    row-height="15"
                                                    clear-icon="mdi-close-circle"
                                                    label="Particulars"
                                                    v-model="TESFundEdit.chckParticular"
                                               
                                                    >
                                                </v-textarea>
                                            </v-col>

                                        </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="5"
                                            md="5"
                                            >
                                                 <v-menu
                                                        ref="menuedit"
                                                        v-model="menuedit"
                                                        :close-on-content-click="false"
                                                        
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="auto"
                                                    >
                                                        <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field
                                                            :disabled="!TESFundEdit.chckParticular"
                                                            v-model="TESFundEdit.dateRcvd"
                                                            outlined
                                                            label="Date Recieved"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="TESFundEdit.dateRcvd"
                                                        
                                                        no-title
                                                        scrollable
                                                        >
                                                        <v-spacer></v-spacer>
                                                        <v-btn
                                                            text
                                                            color="primary"
                                                            @click="menuedit = false"
                                                        >
                                                            Cancel
                                                        </v-btn>
                                                        <v-btn
                                                            text
                                                            color="primary"
                                                            @click="$refs.menuedit.save(date)"
                                                        >
                                                            OK
                                                        </v-btn>
                                                        </v-date-picker>
                                                    </v-menu>
                                            </v-col>
                                            <v-col  cols="12"
                                            sm="7"
                                            md="7">
                                               <!-- <v-text-field
                                                    label="Amount"
                                                    v-model="TESFundEdit.TESAmnt"
                                                    :disabled="!TESFundEdit.dateRcvd"
                                                    prefix="P "
                                                    type="number"   
                                                    step="any"
                                                    min="0"
                                                    ref="input"
                                                    dense
                                                    outlined
                                                    :rules="[numberRule]"
                                                   
                                                    ></v-text-field> -->

                                                    <vuetify-money
                                                        
                                                        label="Amount"
                                                        v-model="TESFundEdit.TESAmnt"
                                                        :disabled="!TESFundEdit.dateRcvd"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />

                                                    
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                             <v-col  cols="12"
                                            sm="6"
                                            md="6">
                                               <!-- <v-text-field
                                                    label="Admin Cost"
                                                    v-model="TESFundEdit.admCost"
                                                    :disabled="!TESFundEdit.TESAmnt"
                                                    prefix="P "
                                                    type="number"   
                                                    step="any"
                                                    min="0"
                                                    ref="input"
                                                    dense
                                                    outlined
                                                    :rules="[numberRule]"
                                                   
                                                    ></v-text-field> -->

                                                     <vuetify-money
                                                        
                                                        label="Admin Cost"
                                                        v-model="TESFundEdit.admCost"
                                                        :disabled="!TESFundEdit.TESAmnt"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />

                                            </v-col>

                                             <v-col  cols="12"
                                                sm="6"
                                                md="6">
                                                <!-- <v-text-field
                                                        label="TES Subsidy"
                                                        v-model="TESFundEdit.tesSubAmt"
                                                        :disabled="!TESFundEdit.admCost"
                                                        prefix="P "
                                                        type="number"   
                                                        step="any"
                                                        min="0"
                                                        ref="input"
                                                        dense
                                                        outlined
                                                        :rules="[numberRule]"
                                                       
                                                        ></v-text-field> -->

                                                         <vuetify-money
                                                        
                                                        label="TES Subsidy"
                                                        v-model="TESFundEdit.tesSubAmt"
                                                        :disabled="!TESFundEdit.admCost"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />
                                            </v-col>
                                        </v-row>
                                         </div>
                                        </div>

                                            <v-divider></v-divider>

                                            <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                color="blue darken-1"
                                                text
                                                @click="showEditModal = false"
                                            >
                                                Close
                                            </v-btn>
                                            <v-btn
                                                color="primary"
                                                text
                                                @click="SaveEditFund"
                                                :disabled="!TESFundEdit.chckType || !TESFundEdit.chckADANum || !TESFundEdit.chckParticular
                                                 || !TESFundEdit.TESAmnt || !TESFundEdit.admCost || !TESFundEdit.dateRcvd || !TESFundEdit.tesSubAmt"
                                            >
                                                Save
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        </v-dialog>

                        </v-banner>
       
            </div>
           
            
      </v-app>
</div>
  
</template>

<script>

    export default {
       
        data() {

        
            return {

                 json_fields: {
                     
                    "Check Num/ADA": "chckADANum",
                    "Particular": "chckParticular",
                    "bal": "bal",
                    // "Firstname": "StudFName",
                    // "EXT. NAME":"N/A",
                    // "Middle Name": "StudMName",
                    // "Sex": "StudSex",
                    // "Birthdate": "StudBDate",
                    // "Degree Program": "CDesc",
                    // "Year Level": "EnrYear",

                    // "Father's Lastname": "StudPFLName",
                    // "Father's Given Name": "StudPFFName",
                    // "Father's Middle Name": "StudPFMName",
                    // "Mother's Lastname": "StudPMMaidLName",
                    // "Mother's Given Name": "StudPMMaidFName",
                    // "Mother's Middle Name": "StudPMMaidMName",
                    // "DSWD HOUSEHOLD NO.":"N/A",
                    // "Household per Capita Income":"StudPMIncome",
                    // "street & Barangay": "StudPStr",
                    // "Town/City/Mun": "City_Name",
                    // "Province": "Prov_Name",
                    // "ZIP Code": "StudPZip",
                    // "Total Assessment": "AssTotDue",
                    // "DISABILITY (leave blank if NOT Applicable)":"N/A",
                    // "Phone Number": "StudCNum",
                    // "E-mail Address": "email",


                    },


                 options: {
                    
                    prefix: "P",
                    suffix: "",
                    length: 11,
                    precision: 2
                    },
                token: '',
                dialogAdd:false,
               
                number: 0,
                numberRule: val => {
                if(val < 0) return 'Please enter a positive number'
                return true
                },

                fab:'',
                dialog:false,

                tesAmnt: [],
                row:'',

                date: null,
                menuadd: false,
                menuedit: false,
            
                pickerDate: '1995-1-1',

             
                showviewModal:false,
                showCORModal:false,
                showGradeModal:false,

                size: '',
                type: null,
                passiveType: null,
                isRounded: false,
                isOutlined: true,
                leftLabel: true,

             
                 showEditModal:false,
                 showAddModal:false,

                 isprint:false,

              
             

                index:'',
                 isDeleting:false,

                
                TESFund:{
                    chckId:'',
                    chckType:'',
                    chckADANum:'',
                    chckParticular:'',
                    TESAmnt:'',
                    dateRcvd:'',
                    admCost:'',
                    tesSubAmt:'',
                },

                TESFundEdit:{
                    chckId:'',
                    chckType:'',
                    chckADANum:'',
                    chckParticular:'',
                    TESAmnt:'',
                    dateRcvd:'',
                    admCost:'',
                    tesSubAmt:'',
                    Status:'',
                },

                deleteItem:'',
                showDeleteModal:false,
                selectedlist: [],



              
                 headers: [
                        
                        { text: 'ID', value: 'chckId' ,align: 'center', width: 70},
                        { text: 'Date', value: 'dateRcvd', align: 'left' },
                        { text: 'Type', value: 'chckType' ,align: 'center'},
                        { text: 'Check Num/ADA', value: 'chckADANum', align: 'left' },
                        { text: 'Particulars', value: 'chckParticular', align: 'left' },
                       
                        
                        
                        { text: 'TES Subsidy', value: 'tesSubAmt' , align: 'center'},
                        { text: 'Subsidy Bal', value: 'tesSubBal' , align: 'center'},
                        { text: 'Adm Cost', value: 'admCost' , align: 'center'},
                        { text: 'Adm Cost Bal', value: 'admCostBal' , align: 'center'},
                        { text: 'Amount', value: 'TESAmnt' , align: 'Left'},
                        { text: 'Balance', value: 'bal', align: 'center'},
                        { text: 'Status', value: 'status', align: 'center'},
                        { text: 'Action', value: 'action',align: 'center', },
                        
                      ],

                  
                        search: '',
                        total: 0,
                        loading: false,
                        pagination: {},
                       
                        rowsPerPageItems: [5, 10, 20, 50, 100],

                        FundUtilList:[],

                    

            }
        },

       

        watch: {
             menu (val) {
                    val && setTimeout(() => (
                        
                        this.$refs.picker.activePicker = 'YEAR',
                        this.pickerDate = null
                    ))
                },
        },

        mounted(){
           this.getTESFund()
        },

         computed: {

               checkBox1(){
                        if (this.selectedlist.length ===0){
                             return false;
                        }else{
                           
                            return true;
                        }
                    },
                  

                    
    
                },

     methods:{

          ExportSelName(){
             return ("TES-Fund(" + this.selectedlist.chckId + ")" + ".xls");
         },

         

         getColor (status) {
              if (status === 1) return 'green'
              else if (status === 2){
                  return 'blue'
              }
                 else return 'red'
            },

          save (date) {
            this.$refs.menu.save(date)
            this.pickerDate = date;
        },

          formatPrice(value) {
                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'PHP',
                    minimumFractionDigits: 2
                });
                return formatter.format(value);
            },

         
        async getTESFund(){
            const res = await  axios.get('/api/getTESFund')
            if(res.status==200){
                if(res.data.length===0){
                  
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.FundUtilList = res.data;
                    
                }else{
                    this.FundUtilList = res.data;
                    this.tesAmnt=this.FundUtilList[0].tesAmnt
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
            }
        },

        

        async Utilized(chckId){
               const res = await this.callApi('post', 'app/Utilized/' + chckId)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('TES Fund successfully Locked & Disbursed!') 
                        // this.showForwardModal=false
                        this.getTESFund()
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },

         async Unutilized(chckId){
               const res = await this.callApi('post', 'app/Unutilized/' + chckId)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('TES Fund successfully UnLocked!') 
                        // this.showForwardModal=false
                        this.getTESFund()
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },

        

        async cancelFund(chckId){
               const res = await this.callApi('post', 'app/cancel/' + chckId)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('TES Fund successfully cancelled!') 
                        // this.showForwardModal=false
                        this.getTESFund()
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },


        async UncancelFund(chckId){
               const res = await this.callApi('post', 'app/UncancelFund/' + chckId)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('TES Fund successfully uncancelled!') 
                        // this.showForwardModal=false
                        this.getTESFund()
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },




        

        showDeletingModal(id){
          this.deleteItem = id
  
        //   this.deletingIndex = id
        
          this.showDeleteModal = true
          
        },

        async DeleteFund(){
               const res = await this.callApi('post', 'app/DeleteFund/' + this.deleteItem)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('TES Fund successfully deleted!') 
                        // this.showForwardModal=false
                        this.getTESFund()
                        this.showDeleteModal = false
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },


        
         showEditModalView(chckId,chckType,chckADANum,chckParticular,TESAmnt,dateRcvd,admCost,tesSubAmt,Status){
                let obj = {
                    chckId : chckId ,
                    chckType : chckType,
                    chckADANum: chckADANum,
                    chckParticular: chckParticular,
                    TESAmnt: TESAmnt,
                    dateRcvd: dateRcvd,
                    admCost: admCost,
                    tesSubAmt: tesSubAmt,
                    Status: Status,
            }
                this.TESFundEdit=obj

               this.showEditModal=true
               
                
        },




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

           
        async SaveFund(){
          this.isDeleting= true
// this.TESFund.admCost > this.TESFund.TESAmnt || 
          if(parseInt(this.TESFund.admCost) > parseInt(this.TESFund.TESAmnt) || parseInt(this.TESFund.tesSubAmt) > parseInt(this.TESFund.TESAmnt)){
              this.danger('Admin Cost/TES Subsidy is greater than the TES FUND!')
          }else{
              const res = await this.callApi('post', 'app/SaveFund', this.TESFund)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('TES fund has been save successfully!') 
                        this.getTESFund()
                        this.dialogAdd=false
                        this.isDeleting= false
                        this.TESFund.chckType=''
                        this.TESFund.chckADANum=''
                        this.TESFund.chckParticular=''
                        this.TESFund.TESAmnt=''
                        this.TESFund.dateRcvd=''
                        this.TESFund.admCost=''
                        this.TESFund.tesSubAmt=''
                        
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
          }
               
            
     
        },


        async SaveEditFund(){
          this.isDeleting= true

           if(parseInt(this.TESFundEdit.admCost) > parseInt(this.TESFundEdit.TESAmnt) || parseInt(this.TESFundEdit.tesSubAmt) > parseInt(this.TESFundEdit.TESAmnt)){
              this.danger('Admin Cost/TES Subsidy is greater than the TES FUND!')
          }else{
               
            const res = await this.callApi('post', 'app/SaveEditFund', this.TESFundEdit)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.success2('TES fund has been successfully edited!') 
                    this.getTESFund()
                    this.showEditModal=false
                    this.isDeleting= false
                    this.TESFundEdit.chckType=''
                    this.TESFundEdit.chckADANum=''
                    this.TESFundEdit.chckParticular=''
                    this.TESFundEdit.TESAmnt=''
                    this.TESFundEdit.dateRcvd=''
                    this.TESFundEdit.admCost=''
                    this.TESFundEdit.tesSubAmt=''
                    
                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
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

