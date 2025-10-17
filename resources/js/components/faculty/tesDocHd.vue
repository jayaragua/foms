<template>

<div class="container-fluid">
      <v-app>
       <br>
   
       <div v-if="isprint===false" id="non-printable1">
           <h3 class="title text-center">Scholarship Documents</h3>
            
  
                     <v-banner
                           >
                                <v-row>
                                    <v-col cols="12" sm="10">

                                    </v-col>
                                    <v-col cols="12" class="text-right"  sm="2">

                                    
                                    
                                       
                                    </v-col>

                                </v-row>

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
                                                        color="light-blue darken-1"
                                                        > <v-icon left>mdi-plus</v-icon> 
                                                        ADD NEW
                                                    
                                                        </v-btn> 

                                                             <v-btn 
                                                    class="ma-2"
                                                    outlined
                                                    @click="showsettingModal1"
                                                    fab
                                                    x-small
                                                    color="teal"
                                                    >
                                                    <v-icon>mdi-cog-outline</v-icon>
                                            </v-btn>

                                            
                                                        
                                        </template>
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Add New Document
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                     
                                               <!-- <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
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
                                                        </div> -->
                                    
                                         <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                         <v-row style="margin-top:10px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="6"
                                            >
                                                <!-- <v-text-field
                                                    :disabled="!TESFund.chckType"
                                                    label="ADA/Check Number"
                                                    v-model="TESFund.chckADANum"
                                                    outlined
                                                    dense
                                                    required
                                                ></v-text-field>  -->

                                                   <div class="row">
                                                                <div class="col-md-12">
                                                                        <div style="text-align:Left !important;">
                                                                                    <b>Document Type</b>
                                                                                    <!-- <b-select @input="gettesStud"   v-model="TermNum" expanded placeholder="Select Semester">
                                                                                        <option v-for="semlist in semlists" :value="semlist.TermNum" :key="semlist.TermNum">{{ semlist.TermNum }} - {{ semlist.TermDesc }}</option>
                                                                                    </b-select> -->
                                                                                    <Select   clearable  v-model="docs.DocType" filterable size="large" placeholder="Select Document Type">
                                                                                            <Option  v-for="doclist in doclists" :value="doclist.docName" :key="doclist.docType">{{ doclist.docName}}</Option>
                                                                                    </Select>
                                                                                </div>
                                                                </div>
                                                                
                                                    </div>
                                            </v-col>
                                         </v-row> <br>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="12"
                                            >
                                               <v-textarea
                                                        outlined
                                                        v-model="docs.docdtls"
                                                        name="input-7-4"
                                                        :disabled="!docs.DocType"
                                                        label="Details"
                                                        
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
                                                            :disabled="!docs.docdtls"
                                                            v-model="docs.dateissued"
                                                            outlined
                                                            label="Date Issued"
                                                            prepend-icon="mdi-calendar"
                                                            hint="YYYY/MM/DD format"
                                                             persistent-hint
                                                            readonly
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="docs.dateissued"
                                                        
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
                                            


                                                     <v-text-field
                                                            :disabled="!docs.dateissued"
                                                            label="Used for"
                                                            v-model="docs.userfor"
                                                            outlined
                                                            dense
                                                            required
                                                    ></v-text-field> 
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                             <v-col  cols="12"
                                            sm="12"
                                            md="12">
                                             
                                                    <v-file-input accept=".pdf,.docx,.doc,.jpg,.jpeg,.png"
                                                                v-model="docs.filedocs"
                                                                color="deep-purple accent-4"
                                                                
                                                                placeholder="Select your files"
                                                                prepend-icon="mdi-paperclip"
                                                                :disabled="!docs.userfor"
                                                                outlined
                                                                label="Select your files"
                                                                dense

                                                            >
                                                                <template v-slot:selection="{ index, text }">
                                                                <v-chip
                                                                    v-if="index < 2"
                                                                    color="deep-purple accent-4"
                                                                    dark
                                                                    label
                                                                    dense
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
                                                @click="clearfields"
                                            >
                                                Close
                                            </v-btn>
                                            <v-btn
                                                color="primary"
                                                text
                                                @click="SaveDocs"
                                                :disabled="!docs.DocType || !docs.docdtls || !docs.dateissued
                                                 || !docs.userfor  || !docs.filedocs"
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
                                            :items="FundUtilList"
                                            :loading="loading"
                                            scrollable
                                            :search="search"
                                            class="elevation-1 pa-2"
                                            
                                            v-model="selectedlist"
                                          
                                          
                                            >

                                            <template v-slot:item.dateIssued="{ item }"> 
                                                         <span  style="text-align:left !important; vertical-align: middle !important;">{{new Date(item.dateIssued).toLocaleDateString()}} </span> 
                                                      
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
                                                                                       @click="showEditModalView(item.id,item.docType,item.docDtls,item.useFor,
                                                                                                            item.dateIssued, item.docLoc)"
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
                                                                    active="false">
                                                                    <template v-slot:activator>
                                                                        <v-list-item-content class="text-left align-self-start" >
                                                                        <v-list-item-title >
                                                                           
                                                                            <v-btn
                                                                                  
                                                                                       @click="showDeletingModal(item.id)"
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
                                                                            <!-- :href="`/tes-fund-disbursement/${item.chckId}`" -->
                                                                            <v-btn
                                                                                        
                                                                                        @click="getfront(item.docLoc)"
                                                                                        dark
                                                                                        text
                                                                                        small
                                                                                        color="pink"
                                                                                    > View File
                                                                                        
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
                                                    <p>Are you sure you want to delete this document?</p>
                                                
                                                </div>
                                                <div slot="footer">
                                                    <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="DeleteFund()">Delete</Button>
                                                </div>
                                </Modal>


                                 <Modal v-model="showDeletesetModal" width="360">
                                                <p slot="header" style="color:#f60;text-align:center">
                                                    <Icon type="ios-information-circle"></Icon>
                                                    <span>Delete confirmation</span>
                                                </p>
                                                <div style="text-align:center">
                                                    <p>Are you sure you want to delete this document type?</p>
                                                
                                                </div>
                                                <div slot="footer">
                                                    <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="Deletedoctype()">Delete</Button>
                                                </div>
                                </Modal>









                                  <v-dialog
                                        v-model="showEditModal"
                                        width="650"
                                        >
<!--                                      
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Edit TES Fund
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                       
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
                                        </v-card> -->


                                               <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Edit Document
                                            </v-card-title>

                                            <v-card-text>
                                            </v-card-text>
                                            <div class="container-fluid" >
                                     
                                            
                                         <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                         <v-row style="margin-top:10px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="6"
                                            >
                                               

                                                   <div class="row">
                                                                <div class="col-md-12">
                                                                        <div style="text-align:Left !important;">
                                                                                    <b>Document Type</b>
                                                                                   
                                                                                    <Select   clearable  v-model="docsedit.DocType" filterable size="large" placeholder="Select Document Type">
                                                                                            <Option  v-for="doclist in doclists" :value="doclist.docName" :key="doclist.docType">{{ doclist.docName}}</Option>
                                                                                    </Select>
                                                                                </div>
                                                                </div>
                                                                
                                                    </div>
                                            </v-col>
                                         </v-row> <br>
                                        <v-row style="margin-top:-30px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="12"
                                            >
                                               <v-textarea
                                                        outlined
                                                        v-model="docsedit.docdtls"
                                                        name="input-7-4"
                                                        :disabled="!docsedit.DocType"
                                                        label="Details"
                                                        
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
                                                            :disabled="!docsedit.docdtls"
                                                            v-model="docsedit.dateissued"
                                                            outlined
                                                            label="Date Issued"
                                                            prepend-icon="mdi-calendar"
                                                            hint="YYYY/MM/DD format"
                                                             persistent-hint
                                                            readonly
                                                            dense
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                        v-model="docsedit.dateissued"
                                                        
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
                                            


                                                     <v-text-field
                                                            :disabled="!docsedit.dateissued"
                                                            label="Used for"
                                                            v-model="docsedit.userfor"
                                                            outlined
                                                            dense
                                                            required
                                                    ></v-text-field> 
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                             <v-col  cols="12"
                                            sm="12"
                                            md="12">
                                             
                                                    <v-file-input accept=".pdf,.docx,.doc,.jpg,.jpeg,.png"
                                                                v-model="docsedit.filedocs"
                                                                color="deep-purple accent-4"
                                                                
                                                                placeholder="Select your files"
                                                                prepend-icon="mdi-paperclip"
                                                                :disabled="!docsedit.userfor"
                                                                outlined
                                                                label="Select your files"
                                                                dense

                                                            >
                                                                <template v-slot:selection="{ index, text }">
                                                                <v-chip
                                                                    v-if="index < 2"
                                                                    color="deep-purple accent-4"
                                                                    dark
                                                                    label
                                                                    dense
                                                                >
                                                                    {{ docsedit.filedocs }}
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
                                                @click="clearfields"
                                            >
                                                Close
                                            </v-btn>
                                            <v-btn
                                                color="primary"
                                                text
                                                @click="SaveEditDocs"
                                                :disabled="!docsedit.DocType || !docsedit.docdtls || !docsedit.dateissued
                                                 || !docsedit.userfor  || !docsedit.filedocs"
                                            >
                                                Save
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>





                                        </v-dialog>




                                 <!-- <Modal v-model="showSettingModal" width="850"> -->

                                     <v-dialog
                                        v-model="showSettingModal"
                                        width="850"
                                        >
                                                <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                            Document Settings
                                            </v-card-title>

                                            <div class="container-fluid" >
                                     
                                            
                                                           <div class="container-fluid text-center" style="border:1px solid lightgray; text-align:center !important;">  
                                         <v-row style="margin-top:10px;">
                                            <v-col
                                            cols="12"
                                            sm="6"
                                            md="6"
                                            >
                                               

                                                   
                                            </v-col>
                                         </v-row> <br>
                                        
                                        <v-row style="margin-top:-30px;">
                                           
                                            <v-col  cols="12"
                                            sm="10"
                                            md="10">
                                            


                                                     <v-text-field
                                                            
                                                            label="New Document Type"
                                                            v-model="docsettype"
                                                            outlined
                                                            dense
                                                            required
                                                    ></v-text-field> 
                                            </v-col>
                                             <v-col
                                            cols="12"
                                            sm="2"
                                            md="2"
                                            class="text-left"
                                            >
                                            <v-btn
                                                color="primary"
                                                outlined
                                                large
                                                @click="SaveDocstype"
                                                :disabled="!docsettype"
                                            >
                                                ADD
                                            </v-btn>
                                               
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                             <v-col  cols="12"
                                            sm="12"
                                            md="12">

                                                <v-data-table
                                                 :headers="headersset"
                                                    :items="docttypes"
                                                    :loading="loading"
                                                    scrollable
                                                    :search="search"
                                                    class="elevation-1 pa-2"
                                                    >



                                                     <template v-slot:item.action="{ item }"> 
                                         
                                               <v-tooltip top color="pink">
                                                <template v-slot:activator="{ on, attrs }">
                                                          
                                                            <v-btn
                                                                color="pink"
                                                                fab
                                                                x-small
                                                                 v-bind="attrs"
                                                                v-on="on"
                                                                dark
                                                                @click="showDeletingsettingModal(item.id)"
                                                                >
                                                                <v-icon>mdi-delete</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>Delete Document Type</span>
                                                
                                             </v-tooltip>
                                      

                                   
                                         
                                </template>

                                                </v-data-table>





                                                  
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
                                                @click="showSettingModal = false"
                                            >
                                                Close
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
               
                    },

                    doclists:[],
                    docttypes:[],

                    docs: {
                         DocType:'',
                         docdtls:'',
                         dateissued:'',
                         userfor:'',
                         filedocs:'',

                    }, 

                    docsedit: {
                         DocType:'',
                         docdtls:'',
                         dateissued:'',
                         userfor:'',
                         filedocs:'',

                    }, 

                    fileDocs:'',
                    editFile:0,
                    // index:'',
                   


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

                docsettype:'',

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
                deleteItemset:'',
                showDeleteModal:false,

                showDeletesetModal:false,
                showSettingModal:false,
                selectedlist: [],



              
                 headers: [
                        
                        { text: 'ID', value: 'id' ,align: 'center', },
                        { text: 'Document Type', value: 'docType', align: 'center' },
                        { text: 'Details', value: 'docDtls' ,align: 'center'},
                        { text: 'Docs', value: 'useFor', align: 'left' },
                        { text: 'Date Issued', value: 'dateIssued', align: 'left' },
                       
                        
                        
                        { text: 'Date Created', value: 'created_at' , align: 'center'},
                         { text: '', value: 'docLoc' , align: ' d-none'},
                        // { text: 'Subsidy Bal', value: 'tesSubBal' , align: 'center'},
                        // { text: 'Adm Cost', value: 'admCost' , align: 'center'},
                        // { text: 'Adm Cost Bal', value: 'admCostBal' , align: 'center'},
                        // { text: 'Amount', value: 'TESAmnt' , align: 'Left'},
                        // { text: 'Balance', value: 'bal', align: 'center'},
                        // { text: 'Status', value: 'status', align: 'center'},
                        { text: 'Action', value: 'action',align: 'center', },
                        
                      ],
                 headersset: [
                        
                        { text: 'ID', value: 'id' ,align: 'center', },
                        { text: 'Document Name', value: 'docName', align: 'center' },
                        { text: 'Date Created', value: 'created_at' ,align: 'center'},
                 
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
           this.getdocs()
           this.getdoctypelist()
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
                            window.open(this.index, "_blank");
                        }
            },




         getdoctypelist(){
            // this.token = window.Laravel.csrfToken
            axios.get('/api/getdoctypelist')
                .then(function (res){
                    return res.data;
                })
                .catch(function (error){
                    console.log(error.response);
                })  
                .then(res=>{
                    this.doclists = res;
                    this.docttypes=res;
                    // this.getStudGrade();
                })
        },



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

         
        async getdocs(){
            const res = await  axios.get('/api/getdocs')
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


        async getdocstype(){
            const res = await  axios.get('/api/getdocstype')
            if(res.status==200){
                if(res.data.length===0){
                  
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.docttypes = res.data;
                    
                }else{
                    this.docttypes = res.data;
                    // this.tesAmnt=this.FundUtilList[0].tesAmnt
                    this.$Loading.finish();
                }
            }else{
                    console.log(res.data)
            }
        },


        

 
        clearfields(){
                        this.docsedit.DocType=''
                        this.docsedit.filedocs=''
                        this.docsedit.docdtls=''
                        this.docsedit.dateissued=''
                        this.docsedit.userfor=''

                         this.docs.DocType=''
                        this.docs.filedocs=''
                        this.docs.docdtls=''
                        this.docs.dateissued=''
                        this.docs.userfor=''

                        this.showEditModal=false
                        this.dialogAdd=false



        },


        

        showDeletingModal(id){
          this.deleteItem = id
  
        //   this.deletingIndex = id
        
          this.showDeleteModal = true
          
        },


         showDeletingsettingModal(id){
          this.deleteItemset = id
  
        //   this.deletingIndex = id
        
          this.showDeletesetModal = true
          
        },


        showsettingModal1(){
        //   this.deleteItem = id
  
        //   this.deletingIndex = id
        
          this.showSettingModal = true
          this.getdoctypelist()
          
        },

        async DeleteFund(){
               const res = await this.callApi('post', 'app/Deletedoc/' + this.deleteItem)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('Scholarship document successfully deleted!') 
                        // this.showForwardModal=false
                        this.getdocs()
                        this.showDeleteModal = false
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },

        async Deletedoctype(){
               const res = await this.callApi('post', 'app/Deletedoctype/' + this.deleteItemset)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('Scholarship document type successfully deleted!') 
                        // this.showForwardModal=false
                        this.getdoctypelist()
                        this.showDeletesetModal = false
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },



        


        
         showEditModalView(id,docType,docDtls,useFor,dateIssued,docLoc){

     
                let obj = {
                    id : id ,
                    DocType : docType,
                    docdtls: docDtls,
                    userfor: useFor,
                    dateissued: dateIssued,
                    filedocs:docLoc

                   
            }


                this.docsedit=obj

                 this.fileDocs= this.docsedit.filedocs

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

           
        async SaveDocs(){
          this.isDeleting= true

          let formData = new FormData();
                formData.append('DocType', this.docs.DocType);
                formData.append('docdtls', this.docs.docdtls);
                formData.append('dateissued', this.docs.dateissued);
                formData.append('userfor', this.docs.userfor);
                formData.append('file', this.docs.filedocs);
                
                // formData.append('loa', this.loa);
          
              const res = await this.callApi('post', 'app/SaveDocs', formData)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('Scholarship document has been save successfully!') 
                        this.getdocs()
                        this.dialogAdd=false
                        this.isDeleting= false
                        this.docs.DocType=''
                        this.docs.filedocs=''
                        this.docs.docdtls=''
                        this.docs.dateissued=''
                        this.docs.userfor=''
                    
                        
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
  
               
            
     
        },


        async SaveEditDocs(){
          this.isDeleting= true

              if (this.fileDocs===this.docsedit.filedocs){
                    this.editFile=1
                }else{
                    this.editFile=0
                }

                let formData = new FormData();
                formData.append('DocType', this.docsedit.DocType);
                formData.append('id', this.docsedit.id);
                formData.append('docdtls', this.docsedit.docdtls);
                formData.append('dateissued', this.docsedit.dateissued);
                formData.append('userfor', this.docsedit.userfor);
                formData.append('file', this.docsedit.filedocs);
                formData.append('editFile', this.editFile);

                    
            const res = await this.callApi('post', 'app/SaveEditDocs', formData)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                  
                     this.success2('Scholarship document has been successfully edited!') 
                        this.getdocs()
                        this.showEditModal=false
                        this.isDeleting= false
                        this.docsedit.DocType=''
                        this.docsedit.filedocs=''
                        this.docsedit.docdtls=''
                        this.docsedit.dateissued=''
                        this.docsedit.userfor=''
                    
                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
        
     
        },

        
        async SaveDocstype(){
          this.isDeleting= true

           
                let formData = new FormData();
                formData.append('docsettype', this.docsettype);
              

                    
            const res = await this.callApi('post', 'app/SaveDocstype', formData)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                  
                     this.success2('Document type has been successfully save!') 
                        this.getdoctypelist()
                        // this.showEditModal=false
                        this.isDeleting= false
                        this.docsettype=''
                  
                    
                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
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

