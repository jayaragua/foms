<template>

<div class="container-fluid">
      <v-app>
       <br>
       <div class="text-left">
       <v-btn text onclick="history.back()"
                    color="primary">
                    <v-icon center>mdi-chevron-left</v-icon>
                    Back
                </v-btn><br></div>
       <!-- v-if="isprint===false" -->
       <div v-if="isprint===false" id="non-printable1">
           <h3 class="title text-center">TES Fund Disbursements</h3>
            
       <!-- <v-row>
           <v-col> -->
                <!-- <h3 class="title text-center">OFFICIALLY ENROLLED STUDENTS</h3> -->
                <!-- <h5 class="subtitle text-center">AY: {{data.ActiveTermDesc}}</h5> -->
                                              
                        <v-row class="container-fluid" style="margin-top:-20px;">
                            <v-col>

                         
                        <v-card
                            class="mx-auto"
                            
                            outlined
                        >
                            <v-list-item >
                            <v-list-item-content>
                                 <div class="text-overline mb-0">
                                    <v-chip v-if="Status===0"
                                        class="ma-2"
                                        color="pink"
                                        label
                                        small
                                        text-color="white"
                                        >
                                        <v-icon small left>mdi-lock-alert</v-icon>
                                     
                                        CANCELLED
                                        </v-chip>

                                    <v-chip v-if="Status===1"
                                        class="ma-2"
                                        color="success"
                                        small
                                        label
                                        text-color="white"
                                        >
                                     <v-icon small left>mdi-lock-open-variant</v-icon>
                                        ACTIVE
                                        </v-chip>


                                     <v-chip v-if="Status===2"
                                        class="ma-2"
                                        color="primary"
                                        small
                                        label
                                        text-color="white"
                                        >
                                     
                                       <v-icon small left>mdi-lock</v-icon> Disbursed
                                        </v-chip>
                                </div>
                                <div class="text-overline mb-0">
                                    CHECK Number/ADA
                                </div>
                                <v-list-item-title class="text-h5 mb-2">
                                {{chckADANum}} - {{chckParticular}}
                                </v-list-item-title>
                                <v-list-item-subtitle class="title">Amount: {{formatPrice(TESAmnt)}}</v-list-item-subtitle>
                                <v-list-item-subtitle >Admin Cost: {{formatPrice(admCost)}}</v-list-item-subtitle>
                                <v-list-item-subtitle >TES Subsidy: {{formatPrice(tesSubAmt)}}</v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                 <div class="text-overline mb-0">
                                   &nbsp;
                                </div>
                                <div class=" mb-0 text-right">
                                    Date Received: {{new Date(dateRcvd).toLocaleDateString()}}
                                </div>
                                <v-list-item-title class="text-h5 mb-6">
                                     &nbsp;
                                </v-list-item-title>
                                <v-list-item-subtitle class="title text-right">Remaining Balance: {{formatPrice(bal)}}</v-list-item-subtitle>
                                <v-list-item-subtitle v-if="adminCostBal == ''" class=" text-right">Admin Cost Balance: {{formatPrice(admCost)}}</v-list-item-subtitle>
                                <v-list-item-subtitle v-if="adminCostBal != ''" class=" text-right">Admin Cost Balance: {{formatPrice(adminCostBal)}}</v-list-item-subtitle>
                                
                                <v-list-item-subtitle v-if="tesSubBal == ''" class=" text-right">TES Subsidy Balance: {{formatPrice(tesSubAmt)}}</v-list-item-subtitle>
                                <v-list-item-subtitle v-if="tesSubBal != ''" class=" text-right">TES Subsidy Balance: {{formatPrice(tesSubBal)}}</v-list-item-subtitle>
                            </v-list-item-content>

                            </v-list-item>

                            <v-card-actions>
                                                <v-btn
                                                    
                                                    tile
                                                    dark
                                                    small
                                                    dense
                                                    
                                                    color="pink"
                                                    > 
                                                     <downloadExcel
                                                     :header="ExportHeader()"
                                                     :footer="ExportFooter()"
                                                    :data="selectedlist"
                                                    :fields="json_fields"
                                                    :name="ExportSelName()"
                                                    >
                                                    <v-icon left>
                                                        mdi-download
                                                    </v-icon>
                                                    Export</downloadExcel>
                                                   
                                            </v-btn>
                            </v-card-actions>
                        </v-card>
                       </v-col>
                    </v-row>

                    <v-row class="container-fluid" style="margin-top:-20px;">
                            <v-col>
        	         <v-card
                            class="mx-auto"
                            
                            outlined
                        >
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
                                                        :disabled="Status==0 || Status==2"
                                                        color="light-blue darken-1"
                                                        > <v-icon left>mdi-plus</v-icon> 
                                                        ADD NEW
                                                    
                                                        </v-btn> 
                                                        
                                                        
                                        </template>
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Add New Disbursement
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                         <!-- <v-row bordered style="margin-top:-20px; border:5px gray !important;"> -->
                                             <!-- <v-col> -->
                                               <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                                <v-radio-group
                                                       
                                                        row
                                                        
                                                        v-model="TESDisburse.disburseType"
                                                        >
                                                         <template v-slot:label>
                                                            <div class="subtitle">Disbursement Type</div>
                                                        </template>
                                                        
                                                        <v-radio
                                                            label="Admin Cost"
                                                            value="Admin"
                                                        ></v-radio>
                                                        <v-radio
                                                            label="TES Subsidy"
                                                            value="Subsidy"
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
                                                    :disabled="!TESDisburse.disburseType"
                                                    label="Training Design No."
                                                    v-model="TESDisburse.TDACNum"
                                                    outlined
                                                    dense
                                                    required
                                                ></v-text-field> 
                                            </v-col>
                                            <v-col>
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
                                                            :disabled="!TESDisburse.TDACNum"
                                                            v-model="TESDisburse.dateForwarded"
                                                            outlined
                                                            label="Date Forwarded"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="TESDisburse.dateForwarded"
                                                        
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
                                         </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="12"
                                            >
                                                <v-textarea auto-grow
                                                    :disabled="!TESDisburse.dateForwarded"
                                                    outlined
                                                    clearable
                                                    dense
                                                    rows="1"
                                                    row-height="15"
                                                    clear-icon="mdi-close-circle"
                                                    label="Payee"
                                                    v-model="TESDisburse.payeeName"
                                               
                                                    >
                                                </v-textarea>
                                            </v-col>

                                        </v-row>
                                         <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="7"
                                            md="7"
                                            >
                                                 <v-text-field
                                                    label="Check No. (Optional)"
                                                    v-model="TESDisburse.chckNum"
                                                    
                                                    dense
                                                    outlined
                                                   
                                                    ></v-text-field>
                                                 
                                            </v-col>
                                            <v-col  cols="12"
                                            sm="5"
                                            md="5">
                                               <v-text-field
                                                    label="DV/Payroll No. (Optional)"
                                                    v-model="TESDisburse.DVPayrolNum"
                                                    dense
                                                    outlined
                                                   
                                                    ></v-text-field>
                                            </v-col>

                                        </v-row>

                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="7"
                                            md="7"
                                            >
                                                 <v-text-field
                                                    label="Nature/Type of Payment"
                                                    v-model="TESDisburse.typePayment"
                                                    :disabled="!TESDisburse.payeeName"
                                                   
                                                    dense
                                                    outlined
                                                   
                                                    ></v-text-field>
                                                 
                                            </v-col>
                                            <v-col  cols="12"
                                            sm="5"
                                            md="5">
                                               <!-- <v-text-field
                                                    label="Amount"
                                                    v-model="TESDisburse.Amount"
                                                    :disabled="!TESDisburse.typePayment"
                                                    prefix="P "
                                                    type="number"   
                                                    step="any"
                                                    min="1"
                                                    ref="input"
                                                    dense
                                                    outlined
                                                    :rules="[numberRule]"
                                                   
                                                    ></v-text-field> -->


                                                    <vuetify-money
                                                        v-model="TESDisburse.Amount"
                                                        label="Amount"
                                                        :disabled="!TESDisburse.typePayment"
                                                        dense
                                                        outlined
                                                        min="1"
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />
                                            </v-col>

                                        </v-row>
                                        <v-row style="margin-top:-30px;">
                                             <v-col
                                                        class="d-flex"
                                                        cols="12"
                                                        sm="12"
                                                        >
                                                            <v-file-input accept=".pdf,.docx,.doc,.jpg,.jpeg,.png"
                                                                v-model="TESDisburse.tdFile"
                                                                color="deep-purple accent-4"
                                                                label="Attach File"
                                                                placeholder="Select your files"
                                                                :disabled="!TESDisburse.Amount"
                                                                prepend-icon="mdi-attachment"
                                                                outlined
                                                               
                                                                required
                                                                dense
                                                            >
                                                                <template v-slot:selection="{ index, text }">
                                                                <v-chip
                                                                    v-if="index < 2"
                                                                    color="deep-purple accent-4"
                                                                    dark
                                                                    label
                                                                    small
                                                                >
                                                                    {{ text }}
                                                                </v-chip>

                                                                <span
                                                                    v-else-if="index === 2"
                                                                    class="overline grey--text text--darken-3 mx-2"
                                                                >
                                                                    +{{ files.length - 2 }} File(s)
                                                                </span>
                                                                </template>
                                                            </v-file-input>
                                                           
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
                                                @click="closeaddModal"
                                            >
                                                Close
                                            </v-btn>
                                            <v-btn
                                                color="primary"
                                                text
                                                @click="SaveFund"
                                                :disabled="!TESDisburse.payeeName || !TESDisburse.dateForwarded || !TESDisburse.TDACNum
                                                 || !TESDisburse.Amount || !TESDisburse.typePayment || !TESDisburse.disburseType || !TESDisburse.tdFile "
                                            >
                                                Save
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        </v-dialog>
                                   
                                    </v-col>
                                </v-row>
                              


                                
                             

                                <v-data-table 
                                            
                                           
                                            :headers="headers"
                                            :items="FundUtilListDis"
                                            :loading="loading"
                                            scrollable
                                            dense
                                            :search="search"
                                            class="elevation-1 pa-2"
                                          
                                          
                                            >

                                            <template v-slot:item.dateRcvd="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{new Date(item.dateRcvd).toLocaleDateString()}} </span> 
                                                      
                                            </template>

                                             <template v-slot:item.dateForwarded="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{new Date(item.dateForwarded).toLocaleDateString()}}</span> 
                                                      
                                            </template>

                                            <template v-slot:item.dateApproved="{ item }"> 
                                                         <span v-if="item.dateApproved !=Null "   style="text-align:left !important; vertical-align: middle !important;">{{new Date(item.dateApproved).toLocaleDateString()}}</span> 
                                                         
                                            </template>
                                             <!-- <template v-slot:item.chckType="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;font-weight:bold;">{{formatPrice(item.chckType)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.tesSubAmt="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.tesSubAmt)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.tesSubBal="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.tesSubBal)}} </span> 
                                                      
                                            </template>
                                             <template v-slot:item.admCost="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.admCost)}} </span> 
                                                      
                                            </template>-->
                                              <template v-slot:item.Amount="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{formatPrice(item.Amount)}} </span> 
                                                      
                                            </template> 

                                             <template v-slot:item.status="{ item }">
                                                <v-chip
                                                small
                                                    :color="getColor(item.status)"
                                                    dark
                                                >
                                                    <span v-if="item.status  === 1">Active</span>
                                                    <span v-if="item.status  === 0">Cancelled</span>
                                                
                                                </v-chip>
                                            </template>
                                            
                                            <template v-slot:item.action="{ item }">
                                                     <v-btn
                                                        v-if="Status===1"
                                                        icon
                                                        small
                                                        class="mr-2"
                                                        color="gray"
                                                         @click="showEditModalView(item.id,item.payeeName,item.dateForwarded,item.TDACNum,
                                                                                                            item.Amount,item.typePayment,item.DVPayrolNum,item.chckNum,item.disburseType, item.dateApproved, item.file)"
                                                        >
                                                        <v-icon small>mdi-pencil</v-icon>
                                                    </v-btn>
                                                      <v-btn
                                                        v-if="Status===1"
                                                        icon
                                                        small
                                                        @click="showDeletingModal(item.id)"
                                                        class="mr-2"
                                                        color="gray"
                                                        >
                                                        <v-icon small>mdi-delete</v-icon>
                                                    </v-btn>

                                                      <v-btn
                                                        v-if="Status===1 || Status===2"
                                                        icon
                                                        small
                                                       @click="getfront(item.file)"
                                                        class="mr-2"
                                                        color="gray"
                                                        >
                                                        <v-icon small>mdi-eye</v-icon>
                                                    </v-btn>


                                                 
                                                    

                                            </template>

                                            

                                             


                                            
                                            
                                            
                                            

                                         


                                </v-data-table>
                                <br>

                                 <Modal v-model="showDeleteModal" width="360">
                                                <p slot="header" style="color:#f60;text-align:center">
                                                    <Icon type="ios-information-circle"></Icon>
                                                    <span>Delete confirmation</span>
                                                </p>
                                                <div style="text-align:center">
                                                    <p>Are you sure you want to delete this Item?</p>
                                                
                                                </div>
                                                <div slot="footer">
                                                    <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="DeleteFundDis()">Delete</Button>
                                                </div>
                                            </Modal>
                                <span>Total: <b>{{formatPrice(totalDis)}}</b></span>

                               



                                  <v-dialog
                                        v-model="showEditModal"
                                        width="650"
                                        >
                                     
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Edit TES Disbursement
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                         <!-- <v-row bordered style="margin-top:-20px; border:5px gray !important;"> -->
                                             <!-- <v-col> -->
                                               <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                                <v-radio-group
                                                       
                                                        row
                                                        
                                                        v-model="TESDisburseEdit.disburseType"
                                                        >
                                                         <template v-slot:label>
                                                            <div class="subtitle">Disbursement Type</div>
                                                        </template>
                                                        
                                                        <v-radio
                                                            label="Admin Cost"
                                                            value="Admin"
                                                        ></v-radio>
                                                        <v-radio
                                                            label="TES Subsidy"
                                                            value="Subsidy"
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
                                                    :disabled="!TESDisburseEdit.disburseType"
                                                    label="Training Design No."
                                                    v-model="TESDisburseEdit.TDACNum"
                                                    outlined
                                                    dense
                                                    required
                                                ></v-text-field> 
                                            </v-col>
                                            <v-col>
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
                                                            :disabled="!TESDisburseEdit.TDACNum"
                                                            v-model="TESDisburseEdit.dateForwarded"
                                                            outlined
                                                            label="Date Forwarded"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="TESDisburseEdit.dateForwarded"
                                                        
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
                                         </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="12"
                                            >
                                                <v-textarea auto-grow
                                                    :disabled="!TESDisburseEdit.dateForwarded"
                                                    outlined
                                                    clearable
                                                    dense
                                                    rows="1"
                                                    row-height="15"
                                                    clear-icon="mdi-close-circle"
                                                    label="Payee"
                                                    v-model="TESDisburseEdit.payeeName"
                                               
                                                    >
                                                </v-textarea>
                                            </v-col>

                                        </v-row>
                                         <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="7"
                                            md="7"
                                            >
                                                 <v-text-field
                                                    label="Check No. (Optional)"
                                                    v-model="TESDisburseEdit.chckNum"
                                                    
                                                    dense
                                                    outlined
                                                   
                                                    ></v-text-field>
                                                 
                                            </v-col>
                                            <v-col  cols="12"
                                            sm="5"
                                            md="5">
                                               <v-text-field
                                                    label="DV/Payroll No. (Optional)"
                                                    v-model="TESDisburseEdit.DVPayrolNum"
                                                    dense
                                                    outlined
                                                   
                                                    ></v-text-field>
                                            </v-col>

                                        </v-row>

                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="7"
                                            md="7"
                                            >
                                                 <v-text-field
                                                    label="Nature/Type of Payment"
                                                    v-model="TESDisburseEdit.typePayment"
                                                    :disabled="!TESDisburseEdit.payeeName"
                                                   
                                                    dense
                                                    outlined
                                                   
                                                    ></v-text-field>
                                                 
                                            </v-col>
                                            <v-col  cols="12"
                                            sm="5"
                                            md="5">
                                               <!-- <v-text-field
                                                    label="Amount"
                                                    v-model="TESDisburseEdit.Amount"
                                                    :disabled="!TESDisburseEdit.typePayment"
                                                    prefix="P "
                                                    type="number"   
                                                    step="any"
                                                    min="1"
                                                    ref="input"
                                                    dense
                                                    outlined
                                                    :rules="[numberRule]"
                                                   
                                                    ></v-text-field> -->
                                                     <vuetify-money
                                                        v-model="TESDisburseEdit.Amount"
                                                        label="Amount"
                                                        :disabled="!TESDisburseEdit.typePayment"
                                                        dense
                                                        outlined
                                                   
                                                       
                                                        :rules="[numberRule]"
                                                        v-bind:options="options"
                                                        />
                                            </v-col>

                                        </v-row>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                             class="d-flex"
                                                        cols="12"
                                                        sm="6">
                                                 <v-menu
                                                        ref="menueditApp"
                                                        v-model="menueditApp"
                                                        :close-on-content-click="false"
                                                        
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="auto"
                                                    >
                                                        <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field
                                                           
                                                            v-model="TESDisburseEdit.dateApproved"
                                                            outlined
                                                            label="Date Forwarded"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                             @click:clear="date = null"
                                                                 clearable
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="TESDisburseEdit.dateApproved"
                                                        
                                                        no-title
                                                        scrollable
                                                        >
                                                        <v-spacer></v-spacer>
                                                        <v-btn
                                                            text
                                                            color="primary"
                                                            @click="menueditApp = false"
                                                        >
                                                            Cancel
                                                        </v-btn>
                                                        <v-btn
                                                            text
                                                            color="primary"
                                                            @click="$refs.menueditApp.save(date)"
                                                        >
                                                            OK
                                                        </v-btn>
                                                        </v-date-picker>
                                                    </v-menu>
                                            </v-col>
                                             <v-col
                                                        class="d-flex"
                                                        cols="12"
                                                        sm="6"
                                                        >
                                                            <v-file-input accept=".pdf,.docx,.doc,jpg,.jpeg,.png"
                                                                v-model="TESDisburseEdit.tdFile"
                                                                color="deep-purple accent-4"
                                                                label="Attach File"
                                                                placeholder="Select your files"
                                                              
                                                                
                                                                prepend-icon="mdi-attachment"
                                                                outlined
                                                               
                                                                required
                                                                dense
                                                            >
                                                                <template v-slot:selection="{ index, text }">
                                                                <v-chip
                                                                    v-if="index < 2"
                                                                    color="deep-purple accent-4"
                                                                    dark
                                                                    label
                                                                    small
                                                                >
                                                                    {{ TESDisburseEdit.tdFile }}
                                                                </v-chip>

                                                                <span
                                                                    v-else-if="index === 2"
                                                                    class="overline grey--text text--darken-3 mx-2"
                                                                >
                                                                    +{{ files.length - 2 }} File(s)
                                                                </span>
                                                                </template>
                                                            </v-file-input>
                                                           
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
                                                :disabled="!TESDisburseEdit.payeeName || !TESDisburseEdit.dateForwarded || !TESDisburseEdit.TDACNum
                                                 || !TESDisburseEdit.Amount || !TESDisburseEdit.typePayment || !TESDisburseEdit.disburseType || !TESDisburseEdit.tdFile"
                                            >
                                                Save
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        </v-dialog>

                        </v-banner>

                     </v-card>
                  </v-col>
                </v-row>
       
            </div>
           
            
      </v-app>
</div>
  
</template>

<script>

    export default {
       
        data() {

        
            return {

                // headerExcel:[],


                 json_fields: {
                     "Transaction ID": "id",
                    "Date Forwarded":"dateForwarded",
                    "Date Approved": "dateApproved",

                    "TD Num": "TDACNum",
                    "Type of Disbursement": "disburseType",
                    "Check No.":"chckNum",
                    "DVPayrolNum": "DVPayrolNum",
                    "payeeName": "payeeName",
                    "Type of Payment": "typePayment",
                    "Amount": "Amount",
                    // "EXT. NAME":"N/A",
                    // "Middle Name": "StudMName",
                    // "Sex": "StudSex",
                    // "Birthdate": "StudBDate",
                    // "Degree Program": "CDesc",
                    // "Year Level": "EnrYear",

                   

                    },

                options: {
                    
                    prefix: "P",
                    suffix: "",
                    length: 11,
                    precision: 2
                    },
                token: '',
                dialogAdd:false,
                totalDis:0,

                dialogDelete: false,


                checkId:this.$route.params.id,
               
                number: 0,
                numberRule: val => {
                if(val < 1) return 'Please enter numbers not less than 1'
                return true
                },

                fab:'', 
                dialog:false,

                tesAmnt: [],
                row:'',

                date: null,
                menuadd: false,
                menuedit: false,
                menueditApp:false,
                pickerDate: '1995-1-1',

                 showDeleteModal:false,

             
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

                 statusFund:'',



                TESDisburse:{
                    chckId:'',
                    chckType:'',
                    chckADANum:'',
                    chckParticular:'',
                    payeeName:'',
                    dateForwarded:'',
                    dateApproved:'',
                    TDACNum:'',
                    Amount:'',
                    typePayment:'',
                    status:'',
                    DVPayrolNum:'',
                    chckNum:'',
                    disburseType:'',
                    tdFile:'',
                },

                 TESDisburseEdit:{
                     id:'',
                    chckId:'',
                    chckType:'',
                    chckADANum:'',
                    chckParticular:'',
                    payeeName:'',
                    dateForwarded:'',
                    dateApproved:'',
                    TDACNum:'',
                    Amount:'',
                    typePayment:'',
                    status:'',
                    DVPayrolNum:'',
                    chckNum:'',
                    disburseType:'',
                    tdFile:'',
                },
                
                TESFund:{
                    chckId:'',
                    chckType:'',
                    chckADANum:'',
                    chckParticular:'',
                    TESAmnt:'',
                    dateRcvd:'',
                    admCost:'',
                    tesSubAmt:'',
                    Status:'',
                    tdFile:'',
                   

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
                    tdFile:'',
                },

                tempDisAmount:0,

                selectedlist:[],

                chckADANum:'',
                chckType:'',
                chckADANum:'',
                chckParticular:'',
                TESAmnt:'',
                dateRcvd:'',
                admCost:'',
                tesSubAmt:'',
                Status:'',
                bal:'',

                adminCostBal:'',
                tesSubBal:'',
                filePic:'',
                editFile:0,
                baseUrl:'',



              
                 headers: [
                        
                        { text: 'ID', value: 'id' ,align: 'center'},
                        { text: 'Date Forwarded', value: 'dateForwarded', align: 'center' },
                        { text: 'Date Approved', value: 'dateApproved', align: 'center' },
                         { text: 'TD No.', value: 'TDACNum', align: 'center' },
                        { text: 'Type', value: 'disburseType' ,align: 'center'},
                        { text: 'Check No.', value: 'chckNum', align: 'center' },
                        { text: 'DV/Payroll No.', value: 'DVPayrolNum', align: 'center' },
                       
                       
                        
                        
                        { text: 'Payee', value: 'payeeName' , align: 'left'},
                        { text: 'Type Payment', value: 'typePayment' , align: 'center'},
                        { text: 'Amount', value: 'Amount' , align: 'right'},
                        {value: 'file' ,align: ' d-none' },
                        // { text: 'Amount', value: 'TESAmnt' , align: 'Left'},
                        // { text: 'Balance', value: 'bal', align: 'center'},
                        // { text: 'Status', value: 'status', align: 'center'},
                        { text: 'Action', value: 'action',align: 'center', },
                        
                      ],

                  
                        search: '',
                        total: 0,
                        loading: false,
                        pagination: {},
                       
                        rowsPerPageItems: [5, 10, 20, 50, 100],

                        FundUtilList:[],

                        FundUtilListDis:[],
                        deleteItem:'',
                        

                    

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
           this.getTESFundExport()
           this.getTESFundDisburse()
           this.getTESFundAdminCost()
           this.getTESFundDisTESCost()
           this.geturl()

        },

         computed: {
                  

                    
    
                },

     methods:{

         async getfront(path){
                        this.index = path
                        if(!this.index){
                          
                            const notif = this.$buefy.notification.open({
                                duration: 5000,
                                message: `File not available`,
                                position: 'is-bottom-right',
                                type: 'is-danger',
                                hasIcon: true
                            })
                        }else{
                            // this.postDownloads()
                            window.open(""+ this.baseUrl +'/'+ this.index, "_blank");
                        }
            },


         ExportHeader(){
            return ("CHECK NUM/ADA: " + this.chckADANum + "-" + this.chckParticular + " (" +  "AMOUNT: " + this.TESAmnt + ") - " + "ADMIN COST: " + this.admCost 
             + " | " + "TES SUBSIDY: " + this.tesSubAmt);
         },
         ExportFooter(){
            return (" Admin Cost Bal: " + this.adminCostBal + " | " + "TES Subsidy Bal: " + this.tesSubBal + " | " + "BALANCE: " + this.bal);
         },

         

           ExportSelName(){
             return ("TES-Fund(" + this.selectedlist.chckId + ")" + ".xls");
         },


         
         showDeletingModal(id){
          this.deleteItem = id
  
        //   this.deletingIndex = id
        
          this.showDeleteModal = true
          
        },

         async DeleteFundDis(){
               const res = await this.callApi('post', 'app/DeleteFundDis/' + this.deleteItem)
                if(res.status===200){

                    // if(res.data.length ==0){
                    //     this.getTESFund()
                    // }else{
                        this.$Loading.finish();
                        this.success2('TES disbursement successfully deleted!') 
                        // this.showForwardModal=false

                        this.getTESFund()
                        this.getTESFundDisburse()
                        this.getTESFundAdminCost()
                        this.getTESFundDisTESCost()
                        this.showDeleteModal=false
                        this.isDeleting= false
                    // }
                
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },

         getColor (status) {
              if (status === 1) return 'green'
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

            

        async geturl(){
            const res = await  axios.get('/api/geturl')
            if(res.status==200){
                    this.baseUrl = res.data
            }else{
                    console.log(res.data)
            }
        },


         
        async getTESFund(){
            const res = await  axios.get('/api/getTESFund/'+ this.checkId)
            if(res.status==200){
                if(res.data.length===0){
                  
                    this.$Loading.error();
                    // this.danger('No Records found!')
                    this.FundUtilList = res.data;
                    
                }else{
                    this.FundUtilList = res.data;
                    this.chckADANum=this.FundUtilList[0].chckADANum
                    this.chckType=this.FundUtilList[0].chckType
                    this.chckParticular=this.FundUtilList[0].chckParticular
                    this.TESAmnt=this.FundUtilList[0].TESAmnt
                    this.dateRcvd=this.FundUtilList[0].dateRcvd
                    this.admCost=this.FundUtilList[0].admCost
                    this.tesSubAmt=this.FundUtilList[0].tesSubAmt
                    this.Status=this.FundUtilList[0].status
                    this.bal=this.FundUtilList[0].bal

                    this.totalDis=this.FundUtilList[0].Total

               
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
            }
        },

        async getTESFundExport(){
            const res = await  axios.get('/api/getTESFundExport/'+ this.checkId)
            if(res.status==200){
                if(res.data.length===0){
                  
                    this.$Loading.error();
                    // this.danger('No Records found!')
                    this.selectedlist = res.data;
                    
                }else{
                    this.selectedlist = res.data;
                 
                  
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
            }
        },

         async getTESFundAdminCost(){
            const res = await  axios.get('/api/getTESFundAdminCost/'+ this.checkId)
            if(res.status==200){
                if(res.data.length===0){
                  
                    this.$Loading.error();
                    // this.danger('No Records found!')
                    this.FundUtilList = res.data;
                     if(this.adminCostBal.length == 0){
                        this.adminCostBal = this.admCost
                        // console.log("sdf")
                     }
                
                    
                }else{
                   this.adminCostBal=res.data[0].Adminbal
                  

               
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
            }
        },

        async getTESFundDisTESCost(){
            const res = await  axios.get('/api/getTESFundDisTESCost/'+ this.checkId)
            if(res.status==200){
                if(res.data.length==0){
                  
                    this.$Loading.error();
                    this.tesSubBal = this.tesSubAmt
                    // this.danger('No Records found!')
                    this.FundUtilList = res.data;

                    if(this.tesSubBal.length == 0){
                        this.tesSubBal = this.tesSubAmt
                        // console.log("sdf")
                     }
                    
                }else{
                   this.tesSubBal = 0
                   this.tesSubBal = res.data[0].TESSubbal
               
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
            }
        },



        




        


        async getTESFundDisburse(){
            const res = await  axios.get('/api/getTESFundDisburse/'+ this.checkId)
            if(res.status==200){
                if(res.data.length===0){
                  
                    this.$Loading.error();
                    // this.danger('No Records found!')
                    this.FundUtilListDis = res.data;
                    
                }else{
                    this.FundUtilListDis = res.data;
                   

               
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
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

        
         showEditModalView(id,payeeName,dateForwarded,TDACNum,Amount,typePayment,DVPayrolNum,chckNum,disburseType,dateApproved,file){
                let obj = {
                    id : id ,
                    payeeName : payeeName,
                    dateForwarded: dateForwarded,
                    TDACNum: TDACNum,
                    Amount: Amount,
                    typePayment: typePayment,
                    DVPayrolNum: DVPayrolNum,
                    chckNum: chckNum,
                    disburseType: disburseType,
                    dateApproved:dateApproved,
                    tdFile:file,
            }

          
                this.TESDisburseEdit=obj
                this.tempDisAmount =  this.TESDisburseEdit.Amount
                this.filePic= this.TESDisburseEdit.tdFile
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
          this.TESDisburse.chckADANum = this.chckADANum
          this.TESDisburse.chckId = this.checkId


           let formData = new FormData();
            formData.append('payeeName', this.TESDisburse.payeeName);
            formData.append('dateForwarded', this.TESDisburse.dateForwarded);
            formData.append('TDACNum', this.TESDisburse.TDACNum);
            formData.append('Amount', this.TESDisburse.Amount);
            formData.append('typePayment', this.TESDisburse.typePayment);
            formData.append('disburseType', this.TESDisburse.disburseType);
            formData.append('chckNum', this.TESDisburse.chckNum);
            formData.append('DVPayrolNum', this.TESDisburse.DVPayrolNum);
            formData.append('tdFile', this.TESDisburse.tdFile);
            formData.append('chckADANum', this.TESDisburse.chckADANum);
            formData.append('chckId', this.TESDisburse.chckId);
            


          if(this.TESDisburse.Amount <= 0){
             return this.danger('Invalid Disbursement Amount')
          }


          if(parseInt(this.bal) < parseInt(this.TESDisburse.Amount)){
            this.danger('Disbursement amount is greater than the remaining balance!')
          }else{

                 if(this.TESDisburse.disburseType == 'Admin'){

                     if(parseInt(this.adminCostBal) < parseInt(this.TESDisburse.Amount)){
                          this.danger('Admin Cost amount is greater than the Admin cost remaining balance!')
                     }else{

                         if(this.TESDisburse.Amount < 1){
                                this.danger('Disbursement amount must equal or greater than 1')
                            }else{
               
                                    const res = await this.callApi('post', 'app/SaveFundDis', formData)
                                    if(res.status===200){
                                    
                                    
                                            this.$Loading.finish();
                                            this.success2('TES disbursement has been save successfully!') 
                                            this.getTESFund()
                                            this.getTESFundDisburse()
                                            this.getTESFundAdminCost()
                                            this.getTESFundDisTESCost()
                                            this.dialogAdd=false
                                            this.isDeleting= false
                                            this.TESDisburse.payeeName=''
                                            this.TESDisburse.dateForwarded=''
                                            this.TESDisburse.TDACNum=''
                                            this.TESDisburse.Amount=''
                                            this.TESDisburse.typePayment=''
                                            this.TESDisburse.disburseType=''
                                            this.TESDisburse.chckNum=''
                                            this.TESDisburse.DVPayrolNum=''
                                            this.TESDisburse.tdFile=''
                                        
                                            
                                        }else{
                                            if(res.status==422){
                                                if(res.data.errors.TDACNum){
                                                    this.danger(res.data.errors.TDACNum[0])
                                                    this.$Loading.error();
                                                }
                                                
                                            }else{
                                            this.$Loading.error();
                                                this.danger()
                                                this.isDeleting= false
                                    
                                        }
                                    }
                            }
                        }


                 }
                 

                 if(this.TESDisburse.disburseType == 'Subsidy'){

                     if(parseInt(this.tesSubBal) < parseInt(this.TESDisburse.Amount)){
                          this.danger('TES subsidy amount is greater than the Subsidy remaining balance!')
                     }else{

                            if(this.TESDisburse.Amount < 1){
                                this.danger('Disbursement amount must equal or greater than 1')
                            }else{
                                 const res = await this.callApi('post', 'app/SaveFundDis', formData)
                                if(res.status===200){
                                
                                
                                        this.$Loading.finish();
                                        this.success2('TES disbursement has been save successfully!') 
                                        this.getTESFund()
                                        this.getTESFundDisburse()
                                        this.getTESFundAdminCost()
                                        this.getTESFundDisTESCost()
                                        this.dialogAdd=false
                                        this.isDeleting= false
                                        this.TESDisburse.payeeName=''
                                        this.TESDisburse.dateForwarded=''
                                        this.TESDisburse.TDACNum=''
                                        this.TESDisburse.Amount=''
                                        this.TESDisburse.typePayment=''
                                        this.TESDisburse.disburseType=''
                                        this.TESDisburse.chckNum=''
                                        this.TESDisburse.DVPayrolNum=''
                                    
                                        
                                    }else{
                                        if(res.status==422){
                                            if(res.data.errors.TDACNum){
                                                this.danger(res.data.errors.TDACNum[0])
                                                this.$Loading.error();
                                            }
                                            
                                        }else{
                                        this.$Loading.error();
                                            this.danger()
                                            this.isDeleting= false
                                
                                    }
                                }
                            }
               
                           
                        }


                 }
          }
     
        },


        closeaddModal(){
                    this.TESDisburse.payeeName=''
                    this.TESDisburse.dateForwarded=''
                    this.TESDisburse.TDACNum=''
                    this.TESDisburse.Amount=''
                    this.TESDisburse.typePayment=''
                    this.TESDisburse.disburseType=''
                     this.TESDisburse.chckNum=''
                    this.TESDisburse.DVPayrolNum=''
                    this.dialogAdd=false
        },


        async SaveEditFund(){
          this.isDeleting= true

           if (this.filePic===this.TESDisburseEdit.tdFile){
                    this.editFile=1
                }else{
                    this.editFile=0
                }

           this.TESDisburseEdit.chckADANum = this.chckADANum
          this.TESDisburseEdit.chckId = this.checkId


           let formData = new FormData();
            formData.append('payeeName', this.TESDisburseEdit.payeeName);
            formData.append('dateForwarded', this.TESDisburseEdit.dateForwarded);
            formData.append('dateApproved', this.TESDisburseEdit.dateApproved);
            formData.append('TDACNum', this.TESDisburseEdit.TDACNum);
            formData.append('Amount', this.TESDisburseEdit.Amount);
            formData.append('typePayment', this.TESDisburseEdit.typePayment);
            formData.append('disburseType', this.TESDisburseEdit.disburseType);
            formData.append('chckNum', this.TESDisburseEdit.chckNum);
            formData.append('DVPayrolNum', this.TESDisburseEdit.DVPayrolNum);
            formData.append('tdFile', this.TESDisburseEdit.tdFile);
            formData.append('chckADANum', this.TESDisburseEdit.chckADANum);
            formData.append('chckId', this.TESDisburseEdit.chckId);
            formData.append('id', this.TESDisburseEdit.id);
            formData.append('editFile', this.editFile);




          if(this.TESDisburseEdit.Amount <= 0){
             return this.danger('Invalid Disbursement Amount')
          }

          if (this.tempDisAmount == this.TESDisburseEdit.Amount){
               if(this.TESDisburseEdit.disburseType === 'Admin' && this.adminCostBal < this.TESDisburseEdit.Amount){
                    return this.danger('Admin Cost amount is greater than the Admin cost remaining balance!')
                }
                 if(this.TESDisburseEdit.disburseType === 'Subsidy' && this.tesSubBal < this.TESDisburseEdit.Amount){
                    return this.danger('Admin Cost amount is greater than the Admin cost remaining balance!')
                }
              const res = await this.callApi('post', 'app/SaveEditFundDis', formData)
                if(res.status===200){
            
               
                    this.$Loading.finish();
                    this.success2('TES disbursement has been successfully edited!') 
                    // this.getTESFund()
                    this.getTESFund()
                    this.getTESFundDisburse()
                     this.getTESFundAdminCost()
                    this.getTESFundDisTESCost()
                    this.showEditModal=false
                    this.isDeleting= false
                   
                    this.dialogAdd=false
                    this.isDeleting= false
                    this.TESDisburse.payeeName=''
                    this.TESDisburse.dateForwarded=''
                    this.TESDisburse.TDACNum=''
                    this.TESDisburse.Amount=''
                    this.TESDisburse.typePayment=''
                    this.TESDisburse.disburseType=''
                     this.TESDisburse.chckNum=''
                    this.TESDisburse.DVPayrolNum=''
                    this.TESDisburseEdit.dateApproved=''
                    
                }else{
                    if(res.status==422){
                        if(res.data.errors.TDACNum){
                            this.danger(res.data.errors.TDACNum[0])
                            this.$Loading.error();
                        }
                        
                    }else{
                       this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
              
                }
             }
          }else if(this.TESDisburseEdit.Amount > this.tempDisAmount){
               if(parseInt(this.bal) < ( parseInt(this.TESDisburseEdit.Amount)- parseInt(this.tempDisAmount))){
                    this.danger('Disbursement amount should be greater than the remaining balance!')
                }else{

                     if(this.TESDisburseEdit.disburseType === 'Admin'){

                            
                            if(parseInt(this.adminCostBal) < ( parseInt(this.TESDisburseEdit.Amount)- parseInt(this.tempDisAmount))){
                                this.danger('Admin Cost amount is greater than the Admin cost remaining balance!')
                            }else{
                                
                                if(this.TESDisburseEdit.Amount < 1){
                                    this.danger('Disbursement amount must equal or greater than 1')
                                }else{

                                    const res = await this.callApi('post', 'app/SaveEditFundDis', this.TESDisburseEdit)
                                    if(res.status===200){
                    
                    
                                            this.$Loading.finish();
                                            this.success2('TES disbursement has been successfully edited!') 
                                           
                                            this.showEditModal=false
                                            this.isDeleting= false
                                            this.getTESFund()
                                            this.getTESFundDisburse()
                                            this.getTESFundAdminCost()
                                            this.getTESFundDisTESCost()
                                            this.dialogAdd=false
                                            this.isDeleting= false
                                            this.TESDisburse.payeeName=''
                                            this.TESDisburse.dateForwarded=''
                                            this.TESDisburse.TDACNum=''
                                            this.TESDisburse.Amount=''
                                            this.TESDisburse.typePayment=''
                                            this.TESDisburse.disburseType=''
                                            this.TESDisburse.chckNum=''
                                            this.TESDisburse.DVPayrolNum=''
                                            this.TESDisburseEdit.dateApproved=''
                                            
                                        }else{
                                            if(res.status==422){
                                                if(res.data.errors.TDACNum){
                                                    this.danger(res.data.errors.TDACNum[0])
                                                    this.$Loading.error();
                                                }
                                                
                                            }else{
                                            this.$Loading.error();
                                                this.danger()
                                                this.isDeleting= false
                                    
                                        }
                                    }
                                }
                            }

                     }

                     if(this.TESDisburseEdit.disburseType === 'Subsidy'){

                            if(parseInt(this.tesSubBal) < ( parseInt(this.TESDisburseEdit.Amount)- parseInt(this.tempDisAmount))){
                                this.danger('TES subsidy amount is greater than the Subsidy remaining balance!!')
                            }else{

                                 if(this.TESDisburseEdit.Amount < 1){
                                    this.danger('Disbursement amount must equal or greater than 1')
                                }else{
                                    const res = await this.callApi('post', 'app/SaveEditFundDis', this.TESDisburseEdit)
                                    if(res.status===200){
                    
                    
                                            this.$Loading.finish();
                                            this.success2('TES disbursement has been successfully edited!') 
                                            // this.getTESFund()
                                            this.showEditModal=false
                                            this.isDeleting= false
                                            this.getTESFund()
                                            this.getTESFundDisburse()
                                            this.getTESFundAdminCost()
                                            this.getTESFundDisTESCost()
                                            this.dialogAdd=false
                                            this.isDeleting= false
                                            this.TESDisburse.payeeName=''
                                            this.TESDisburse.dateForwarded=''
                                            this.TESDisburse.TDACNum=''
                                            this.TESDisburse.Amount=''
                                            this.TESDisburse.typePayment=''
                                            this.TESDisburse.disburseType=''
                                            this.TESDisburse.chckNum=''
                                            this.TESDisburse.DVPayrolNum=''
                                            this.TESDisburseEdit.dateApproved=''
                                            
                                        }else{
                                            if(res.status==422){
                                                if(res.data.errors.TDACNum){
                                                    this.danger(res.data.errors.TDACNum[0])
                                                    this.$Loading.error();
                                                }
                                                
                                            }else{
                                            this.$Loading.error();
                                                this.danger()
                                                this.isDeleting= false
                                    
                                        }
                                    }

                                }
                            }

                     }

                    
                }
                    
          }else{
                    
                    const res = await this.callApi('post', 'app/SaveEditFundDis', this.TESDisburseEdit)
                    if(res.status===200){
                    
                    
                            this.$Loading.finish();
                            this.success2('TES disbursement has been successfully edited!') 
                            // this.getTESFund()
                            this.showEditModal=false
                            this.isDeleting= false
                            this.getTESFund()
                            this.getTESFundDisburse()
                            this.getTESFundAdminCost()
                            this.getTESFundDisTESCost()
                            this.dialogAdd=false
                            this.isDeleting= false
                            this.TESDisburse.payeeName=''
                            this.TESDisburse.dateForwarded=''
                            this.TESDisburse.TDACNum=''
                            this.TESDisburse.Amount=''
                            this.TESDisburse.typePayment=''
                            this.TESDisburse.disburseType=''
                            this.TESDisburse.chckNum=''
                            this.TESDisburse.DVPayrolNum=''
                            this.TESDisburseEdit.dateApproved=''
                            
                                }else{
                            if(res.status==422){
                                if(res.data.errors.TDACNum){
                                    this.danger(res.data.errors.TDACNum[0])
                                    this.$Loading.error();
                                }
                                
                            }else{
                            this.$Loading.error();
                                this.danger()
                                this.isDeleting= false
                    
                        }
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

