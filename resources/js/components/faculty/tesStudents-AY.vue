<template>

<div class="container-fluid">
      <v-app>
       <br>
       <!-- v-if="isprint===false" -->
       <div v-if="isprint===false" id="non-printable1">
           <h3 class="title text-center">TES STUDENTS-Academic Year</h3>
            
       <!-- <v-row>
           <v-col> -->
                <!-- <h3 class="title text-center">OFFICIALLY ENROLLED STUDENTS</h3> -->
                <!-- <h5 class="subtitle text-center">AY: {{data.ActiveTermDesc}}</h5> -->
        	
                     <v-banner
                           >

                            <div class="row">
                                        <div class="col-md-4">
                                                <div style="text-align:Left !important;">
                                                            <!-- <p><b>SEMESTER</b></p> -->
                                                            <!-- <b-select @input="gettesStud"   v-model="TermNum" expanded placeholder="Select Semester">
                                                                <option v-for="semlist in semlists" :value="semlist.TermNum" :key="semlist.TermNum">{{ semlist.TermNum }} - {{ semlist.TermDesc }}</option>
                                                            </b-select> -->
                                                            <!-- <Select @input="gettesStud"  clearable  v-model="TermNum" filterable size="large" placeholder="Select Semester">
                                                                    <Option  v-for="semlist in semlists" :value="semlist.TermNum" :key="semlist.TermNum">{{ semlist.TermNum }} - {{ semlist.TermDesc }}</Option>
                                                            </Select> -->


                                                                <v-select
                                                                        v-model="ExternalTESYear"
                                                                      
                                                                         @input="gettesStud"
                                                                        
                                                                        :items="years"
                                                                        color="pink"
                                                                        label="AY Approved"
                                                                        required>
                                                                </v-select>
                                                        </div>
                                        </div>
                                        
                            </div>


                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="search"
                                            append-icon="mdi-magnify"
                                            label="Search"
                                            single-line
                                            :disabled="!TermNum"
                                            hide-details
                                            ></v-text-field>
                                    </v-col>
                                </v-row>
                            

                                <v-data-table :headers="headers"
                                            :items="studentList"
                                            :loading="loading"
                                            scrollable
                                            :search="search"
                                            class="elevation-1 pa-2"
                                            :single-expand="singleExpand"
                                            :expanded.sync="expanded"
                                            item-key="StudID"
                                            show-expand

                                            @item-expanded="getStudInfo"
                                            >

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
                                             <template v-slot:item.action="{ item }"> 
                                                 
                                                    <v-tooltip top color="primary">
                                                        <template v-slot:activator="{ on, attrs }">
                                                                    <v-btn
                                                                        color="primary"
                                                                        
                                                                        @click="showEditModalViewCOR(item.StudID,item.TESGrant,item.StudLName,item.StudFName,item.EnrCourse,item.EnrYear)"
                                                                        small
                                                                        outlined
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                        dark>
                                                                        <v-icon >mdi-eye</v-icon>
                                                                    </v-btn>
                                                                </template>
                                                                <span>View COR</span>
                                                    </v-tooltip> &nbsp;
                                                    <v-tooltip top color="pink">
                                                        <template v-slot:activator="{ on, attrs }">
                                                                    <v-btn
                                                                        color="pink"
                                                                        outlined
                                                                        @click="showEditModalViewGrade(item.StudID,item.TESGrant,item.StudLName,item.StudFName,item.EnrCourse,item.EnrYear)"
                                                                        small
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                        dark>
                                                                        <v-icon >mdi-eye</v-icon>
                                                                    </v-btn>
                                                                </template>
                                                                <span>View Grades</span>
                                                    </v-tooltip> &nbsp;
                                                
                                        </template>


                                         <template  v-slot:expanded-item="{ headers, item }">
                                                <td :colspan="headers.length"  >
                                                     <v-banner >
                                                    
                                                                    <v-row>
                                                                        <v-col cols="12" sm="3"></v-col>
                                                                       <v-col cols="12" sm="6" class="text-center">
                                                                            <p class="subtitle">Additional Student's Info</p>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="3"></v-col>
                                                                    </v-row>
                                                                    <v-row v-for="(item, i) in studDtls"
                                                                                                :key="i">
                                                                        <v-col  cols="12" sm="12" class="text-center">
                                                                             <div class="box-body ">
                                                                                        
                                                                                        <img class=" img-responsive " style="max-height:200px;"  :src="getImgUrl(item.profPic)" alt="User profile picture">
                                                                                        
                                                                                </div>
                                                                        </v-col>
                                                                    </v-row>
                                                                     <v-divider></v-divider> 
                                                                    
                                                                    <v-row>
                                                                        <v-col cols="12" sm="2"></v-col>
                                                                       <v-col cols="12" sm="2" class="text-center">
                                                                             <v-spacer></v-spacer>
                                                                                <h5 class="caption text-right">Complete Address: </h5>
                                                                        </v-col>
                                                                         <v-col cols="12" sm="6" class="text-center">
                                                                             <v-spacer></v-spacer>
                                                                                <div  v-for="(item, i) in studDtls"
                                                                                                :key="i" >
                                                                                        <h5  class="caption text-left">{{item.StudPStr}}, {{item.Bgry_Name}}, {{item.City_Name}}, {{item.Prov_Name}} - {{item.ZipCode}}</h5>
                                                                                </div>
                                                                          
                                                                        </v-col>
                                                                        <v-col cols="12" sm="2"></v-col>
                                                                      
                                                                    </v-row>
                                                                       
                                                                     <v-row>
                                                                        <v-col cols="12" sm="2"></v-col>
                                                                       <v-col cols="12" sm="2" class="text-center">
                                                                             <v-spacer></v-spacer>
                                                                                <h5 class="caption text-right">Parent's Info: </h5>
                                                                        </v-col>
                                                                         <v-col cols="12" sm="8" class="text-center">
                                                                             <v-spacer></v-spacer>
                                                                                <div  v-for="(item, i) in studDtls"
                                                                                                :key="i" >
                                                                                        <h5  class="caption text-left">Father's Name:  {{item.StudPFLName}}, {{item.StudPFFName}} {{item.StudPFMName}} - {{item.StudPFAge}} ({{item.StudPFOcc}}) </h5>
                                                                                        <h5  class="caption text-left">Mother's Maiden Name:  {{item.StudPMMaidLName}}, {{item.StudPMMaidFName}} {{item.StudPMMaidMName}}- {{item.StudPMAge}} ({{item.StudPMOcc}})</h5>
                                                                                        <h5  class="caption text-left">Household per capita Income: P  {{item.StudPMIncome}}</h5>
                                                                                </div>
                                                                          
                                                                        </v-col>
                                                                        <!-- <v-col cols="12" sm="2"></v-col> -->
                                                                      
                                                                    </v-row>
                                                                    <v-divider></v-divider>  
                                                                     <v-row>
                                                                        <v-col cols="12" sm="2"></v-col>
                                                                       <v-col cols="12" sm="2" class="text-center">
                                                                             <v-spacer></v-spacer>
                                                                                <h5 class="caption text-right">Guardian's Info: </h5>
                                                                        </v-col>
                                                                         <v-col cols="12" sm="8" class="text-center">
                                                                             <v-spacer></v-spacer>
                                                                                <div  v-for="(item, i) in studDtls"
                                                                                                :key="i" >
                                                                                        <h5  class="caption text-left">Guardian's Name:  {{item.StudGName}}</h5>
                                                                                        <h5  class="caption text-left">Address:  {{item.StudGTown}}</h5>
                                                                                        <h5  class="caption text-left">Contact #:  {{item.StudGCNum}}</h5>
                                                                                        <h5  class="caption text-left">Relation:  {{item.StudGRelation}}</h5>
                                                                                </div>
                                                                          
                                                                        </v-col>
                                                                        <!-- <v-col cols="12" sm="2"></v-col> -->
                                                                      
                                                                    </v-row>


                                                                   
                                                                    
                                                    </v-banner>
                                        
                                                </td>
                                                </template>
                                          
                                </v-data-table>

                        </v-banner>
                    <!-- </v-col>
            </v-row> -->


                 
            </div>
            <Modal v-model="showCORModal" width="1200">
            <div  id="printable" >
                 <!-- id="printable" -->
                        <div>
                            <p class="subtitle" style="text-align:center"><span><img style="width:5%" src="/images/logo2.png"/>Gov. Alfonso D. Tan College</span></p>
                            <span><h5 class="title" style="text-align:center; margin-top:-30px; margin-left:50px;font-size:15px">(Certificate of Registration)</h5></span>
                            <span><p class="title" style="text-align:center;  margin-left:50px; font-size:12px;">{{TermDesc}}</p></span>
                        </div><br>
                         <div class="container is-fluid">
                            <div class="columns">
                            
                                    <div class="column is-9">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p style="font-size:12px">Id No: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <span><b>{{student.StudID}}</b></span> </p> 
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p style="font-size:12px; margin-top:-25px;">Name: &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; <span><b>{{student.StudLName}}, {{student.StudFName}} {{student.StudMName}} </b></span></p> 
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <p style="font-size:12px; margin-top:-27px;">Course/Year:&nbsp;&nbsp;  <span><b> {{student.EnrCourse}}-{{student.EnrYear}}</b></span></p> 
                                                                </div>

                                                                <!-- <div class="col-md-4">
                                                                    <p style="font-size:12px">Section:&nbsp;&nbsp;  <span></span><b> {{section}}</b></span></p> 
                                                                </div> -->
                                                                
                                                            </div>

                                    </div>
                                                                    
                                    <div class="column is-3" style="text-align:right; border: .5px solid gray; padding-bottom:-20px; height:100px;">

                                     
                                                  <!--   <div style="text-align:right">
                                                       
                                                        Tuition Fee:<h5> {{AssLecTot}}</h5>
                                                        Lab Fee:<h5> {{AssLabTot}}</h5>
                                                         Other School Fees:<h5> {{OtherSchFee}}</h5>
                                                         Prev Balance:<h5> {{AssOldBal}}</h5>
                                                         <h3> Grand Total: {{AssTotDue}}</h3>
                                                    </div>
                                                        -->

                                                    
                                                            <div class="row">
                                                                <div class="col-md-9 text-right">
                                                                   <p style="font-size:10px;font-family: Verdana, sans-serif;"> Tuition Fee:</p>
                                                                </div>
                                                                 <div class="col-md-3 text-right">
                                                                   <p style="font-size:10px;font-family: Verdana, sans-serif;">{{AssLecTot}}</p>
                                                                </div>
                                                                <!-- style="font-size:12px; margin-top:-25px;" -->
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="col-md-12">
                                                                    <p style="font-size:10px;margin-top:-25px;font-family: Verdana, sans-serif;">Lab Fee: {{AssLabTot}}</p>
                                                                </div> -->

                                                                 <div class="col-md-9 text-right">
                                                                   <p style="font-size:10px;margin-top:-25px;font-family: Verdana, sans-serif;"> Lab Fee:</p>
                                                                </div>
                                                                 <div class="col-md-3 text-right">
                                                                   <p style="font-size:10px;margin-top:-25px;font-family: Verdana, sans-serif;">{{AssLabTot}}</p>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">

                                                                 <div class="col-md-9 text-right">
                                                                   <p style="font-size:10px;margin-top:-35px;font-family: Verdana, sans-serif;"> Other School Fees:</p>
                                                                </div>
                                                                 <div class="col-md-3 text-right">
                                                                   <p style="font-size:10px;margin-top:-35px;font-family: Verdana, sans-serif;">{{OtherSchFee}}</p>
                                                                </div>

                                                                <!-- <div class="col-md-12">
                                                                <p style="font-size:10px;margin-top:-35px;font-family: Verdana, sans-serif;">    Other School Fees: {{OtherSchFee}}</p>
                                                                </div> -->
                                                            </div>
                                                            <div class="row">
                                                                 <div class="col-md-9 text-right">
                                                                   <p style="font-size:10px;margin-top:-45px;font-family: Verdana, sans-serif;"> Prev Balance:</p>
                                                                </div>
                                                                 <div class="col-md-3 text-right">
                                                                   
                                                                   <p style="font-size:10px;margin-top:-45px;font-family: Verdana, sans-serif;">{{AssOldBal}}</p>
                                                                    <hr style="height:1px;border-width:0;color:gray;background-color:gray;margin-top:-2px;">
                                                                </div>
<!-- 
                                                                <div class="col-md-12">
                                                                   <p style="font-size:10px;margin-top:-45px;font-family: Verdana, sans-serif;">  Prev Balance:<u>{{AssOldBal}}</u></p>
                                                                </div> -->
                                                                
                                                            </div>
                                                            <div class="row">

                                                                 <div class="col-md-9 text-right">
                                                                   <p style="font-size:10px;margin-top:-50px;font-family: Verdana, sans-serif;"> <b>Total:</b></p>
                                                                </div>
                                                                 <div class="col-md-3 text-right">
                                                                   <p style="font-size:10px;margin-top:-50px;font-family: Verdana, sans-serif;"><b>{{AssTotDue}}</b></p>
                                                                </div>
                                                                
                                                                <!-- <div class="col-md-12">
                                                                    <h5 style="font-size:10px;margin-top:-50px;font-family: Verdana, sans-serif;"> <b> Total: {{AssTotDue}}</b></h5>
                                                                </div> -->
                                                                
                                                            </div>
                                         
                                    </div>          
                            </div> 

                            <div>
                                <table size="small" style="border-top: 1px solid gray; width:100%;">
                             
                                    <tr>
                                        <th >SchedCode &nbsp;&nbsp;</th>
                                        <th >Subject &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align:center">Title &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th >Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        
                                        <th style="text-align:center">Time &nbsp;&nbsp; &nbsp;&nbsp;</th>

                                        <th style="text-align:center">Day&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                        <th style="text-align:center">Room/MOL &nbsp;&nbsp; &nbsp;&nbsp;</th>
                                        <th >Tut &nbsp;&nbsp; &nbsp;&nbsp;</th>
                                       
                                        <th >Pet&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                        <th >Set&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                    </tr>
                                       
                                    <tr v-for="(subjList, i) in gradelists" :key="i" v-if="gradelists.length">
                                        <td style="width:8%;" class="row-h">{{subjList.SchedCode}}</td>
                                        <td style="width:15%;" class="ellipsis">{{subjList.SubjName}}</td>
                                        <td style="width:20%;" class="ellipsis">{{subjList.SubjDesc}}</td>
                                        <td style="text-align:center;width:9%;">{{subjList.SubjUnits}}</td>
                                    
                                        <td style="width:20%;" class="ellipsis">{{subjList.schedfrom}}-{{subjList.schedTo}}</td>

                                        <td style="text-align:center;width:10%;">{{subjList.SchedDays}}</td>
                                        <td style="text-align:center;width:10%;" class="ellipsis" >{{subjList.SchedRoom}}</td>
                                        <td style="width:10%;">{{subjList.SchedTut}}</td>
                                    
                                        <td style="width:10%;" >{{subjList.SchedPet}}</td>
                                        <td style="width:10%;" >{{subjList.SchedSubjSet}}</td>
                                    
                                    </tr>
                                     
                                </table>
                                    <v-divider></v-divider>
                                <div class="columns">
                                    <div class="column is-12">
                               
                                                <div class="text-right" style="  margin-top:-20px">
                                                    <span style="font-size:12px"> Total Units: {{TotUnits}}</span>
                                                </div>
                                                <span style="font-size:10px"> SET: 0 - Whole Semester   &nbsp;&nbsp;&nbsp; 1 - 1st Half &nbsp;&nbsp;&nbsp;  2 - 2nd Half</span>
                                              
                                    </div>
                                                
                                </div>

                               

                                  <div class="columns">
                                                <div class="column is-6"><div style="text-align:left !important; margin-top:-10px">
                                                                        <span style="font-size:10px">  Student's Signature: _____________________</span>
                                                                    </div><br></div>
                                                <div class="column is-2"></div>
                                                <div class="column is-4">
                                                                    <br>
                                                                    <div style="text-align:left !important; margin-top:-10px">
                                                                            <p>Approved By:</p>
                                                                    </div>
                                                                    <div style="text-align:center !important; margin-top:-10px">
                                                                        
                                                                        <span style="font-size:10px"><b><u>__NIEL C. ENERIO__</u></b></span><br>
                                                                        
                                                                    </div>
                                                                    <div style="text-align:center !important;  margin-top:-12px">
                                                                        <span style="font-size:8px; ">College Registrar</span>
                                                                    </div>
                                                                
                                                </div>
                                                                    
                                  </div>
                                         
                                    

                            </div>
                    </div>
                </div>
                            <div slot="footer" class="text-right">
                                <!-- <Button type="default" size="large"    @click.prevent="view" >Close</Button> -->
                            </div>
            </Modal>



            <!-- //grades -->
            <Modal v-model="showGradeModal" width="1200">
            <div  id="printable" >
                 <!-- id="printable" -->
                        <div>
                            <p class="subtitle" style="text-align:center"><span><img style="width:5%" src="/images/logo2.png"/>Gov. Alfonso D. Tan College</span></p>
                            <span><h5 class="title" style="text-align:center; margin-top:-30px; margin-left:50px;font-size:15px">FINAL-STUDENT'S GRADE SLIP</h5></span>
                            <span><p class="title" style="text-align:center;  margin-left:50px; font-size:12px;">{{TermDesc}}</p></span>
                            
                        </div>
                         <div class="container is-fluid">
                            <div class="columns">
                            
                                    <div class="column is-9">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p style="font-size:12px">Id No: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <span><b>{{student.StudID}}</b></span> </p> 
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p style="font-size:12px; margin-top:-25px;">Name: &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; <span><b>{{student.StudLName}}, {{student.StudFName}} {{student.StudMName}} </b></span></p> 
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <p style="font-size:12px; margin-top:-27px;">Course/Year:&nbsp;&nbsp;  <span><b> {{student.EnrCourse}}-{{student.EnrYear}}</b></span></p> 
                                                                </div>

                                                                <!-- <div class="col-md-4">
                                                                    <p style="font-size:12px">Section:&nbsp;&nbsp;  <span></span><b> {{section}}</b></span></p> 
                                                                </div> -->
                                                                
                                                            </div>

                                    </div>
                                                                    
                                  
                            </div> 

                            <div>
                                <table size="small" style="border-top: 1px solid gray; width:100%;">
                             
                                    <tr>
                                        <th style="text-align:center">SchedCode </th>
                                        <th style="text-align:center">Subject</th>
                                        <th style="text-align:center">Title </th>
                                        <th style="text-align:center">Units</th>
                                        
                                        <th style="text-align:center">Lab/Lec</th>

                                        <th style="text-align:center">Grade</th>
                                        <th style="text-align:center">Equivalent</th>
                                        <th style="text-align:center">RE-Ex</th>
                                       
                                       
                                    </tr>
                                       
                                    <tr v-for="(grdList, i) in gradelists1" :key="i" v-if="gradelists1.length">
                                        <td style="width:8%;text-align:center" class="row-h">{{grdList.SchedCode}}</td>
                                        <td style="width:15%;" class="ellipsis">{{grdList.SubjName}}</td>
                                        <td style="width:32%;" class="ellipsis">{{grdList.SubjDesc}}</td>
                                        <td style="text-align:center;width:9%;">{{grdList.SubjUnits}}</td>
                                    
                                        <td style="width:9%;text-align:center" class="ellipsis">{{grdList.SubjClass}}</td>

                                        <td style="text-align:center;width:5%;">{{grdList.GrdGFin}}</td>
                                        <td style="text-align:center;width:5%;" class="ellipsis" >{{grdList.GrdEFin}}</td>
                                        <td style="width:10%;text-align:center">{{grdList.GrdIncGrd}}</td>
                                    
                                    
                                    </tr>

                                     
                                </table>
                                    <v-divider></v-divider>
                                <!-- <div class="columns">
                                    <div class="column is-12">
                               
                                                <div class="text-right" style="  margin-top:-20px">
                                                    <span style="font-size:12px"> Total Units: {{TotUnits}}</span>
                                                </div>
                                                <span style="font-size:10px"> SET: 0 - Whole Semester   &nbsp;&nbsp;&nbsp; 1 - 1st Half &nbsp;&nbsp;&nbsp;  2 - 2nd Half</span>
                                              
                                    </div>
                                                
                                </div> -->

                                 <div class="columns">
                                        
                                         <div class="column is-6 text-left">
                                              <div style=" margin-top:-10px">
                                                                <span style="font-size:12px"> Total Units: {{TotUnits}}</span>&nbsp;&nbsp;&nbsp;<span style="font-size:12px"> GWA: {{GWAFinal}}</span>
                                                            </div>
                                         </div>
                                         <div class="column is-6 text-right">
                                        
                                                           
                                                        
                                        </div>
                                       
                                        <!-- <div class="column is-3 text-left">
                                        
                                                            <div style="margin-top:-10px">
                                                                
                                                            </div>
                                                        
                                        </div>
                                                             -->
                                    </div>

                                  <div class="columns">
                                                <div class="column is-6"><div style="text-align:left !important; margin-top:-10px">
                                                                    
                                                                    </div><br></div>
                                                <div class="column is-2"></div>
                                                <div class="column is-4">
                                                                    <br>
                                                                    <div style="text-align:left !important; margin-top:-10px">
                                                                            <p>Approved By:</p>
                                                                    </div>
                                                                    <div style="text-align:center !important; margin-top:-10px">
                                                                        
                                                                        <span style="font-size:10px"><b><u>__NIEL C. ENERIO__</u></b></span><br>
                                                                        
                                                                    </div>
                                                                    <div style="text-align:center !important;  margin-top:-12px">
                                                                        <span style="font-size:8px; ">College Registrar</span>
                                                                    </div>
                                                                
                                                </div>
                                                                    
                                  </div>
                                      <!-- <div class="columns">
                                        <div class="column is-6"></div>
                                        <div class="column is-6">
                                                            <br>
                                                            <div style="text-align:right !important; margin-top:-10px">
                                                                <span style="font-size:10px"> Approved By: <b><u>__NIEL C. ENERIO__</u></b></span><br>
                                                                
                                                            </div>
                                                            <div style="text-align:center !important; margin-left:200px;  margin-top:-12px">
                                                            <span style="font-size:8px; ">College Registrar</span></div>
                                                        
                                        </div>
                                                            
                                    </div> -->
                                         
                                    

                            </div>
                    </div>
                </div>
                            <div slot="footer" class="text-right">
                                <!-- <Button type="default" size="large"    @click.prevent="view" >Close</Button> -->
                            </div>
            </Modal>





            <!-- v-if="isprint===true" id="printable" -->
            <Modal id="non-printable1" v-model="showviewModal">
                     <p slot="header" style="color:#1E88E5;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Grantee confirmation</span>
                            </p>
                            <p class="subtitle text-center">{{student.StudID}} - {{student.StudLName}}, {{student.StudFName}}                {{student.EnrCourse}} - {{student.EnrYear}}</p>
                        
                             <p>Are you sure you want to print the Student's COR?</p>
                            <v-divider></v-divider>
                           
                            <div slot="footer" class="text-center">
                                <Button type="default" size="large"   @click.prevent="printCOR" >Print</Button>
                            </div>

            </Modal>


            <div v-if="isprint===true" id="printable" >
               
                 <v-row  >
                     <v-col cols="12" sm="12">
                         <div>
                            <p class="subtitle" style="text-align:center; max-width=600px !important;"><span><img style="width:5%" src="/images/logo2.png"/>Gov. Alfonso D. Tan College</span></p>
                            <span><h5 class="title" style="text-align:center; margin-top:-30px; margin-left:50px;font-size:15px">(Certificate of Registration)</h5></span>
                            <span><p class="title" style="text-align:center;  margin-top:-30px; margin-left:50px; font-size:12px;">{{TermDesc}}</p></span>
                        </div><br>
                     </v-col>
                 </v-row>
                     
                            <div class="columns">
                            
                                    <div class="column is-9">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                   
                                                                    <p style="font-size:12px">Id No: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <span><b>{{student.StudID}}</b></span> </p> 
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p style="font-size:12px; margin-top:-50px;">Name: &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; <span><b>{{student.StudLName}}, {{student.StudFName}} {{student.StudMName}} </b></span></p> 
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <p style="font-size:12px; margin-top:-50px;">Course/Year:&nbsp;&nbsp;  <span><b> {{student.EnrCourse}}-{{student.EnrYear}}</b></span></p> 
                                                                </div>

                                                            </div>

                                    </div>
                                                                    
                                    <div class="column is-3" style="text-align:right; border: .5px solid gray; padding-bottom:-20px; height:100px;">

                                     
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                   <p style="font-size:10px"> Tuition Fee: {{AssLecTot}}</p>
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p style="font-size:10px;margin-top:-25px;font-family: Verdana, sans-serif;">Lab Fee: {{AssLabTot}}</p>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                <p style="font-size:10px;margin-top:-35px;font-family: Verdana, sans-serif;">    Other School Fees: {{OtherSchFee}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                   <p style="font-size:10px;margin-top:-45px;font-family: Verdana, sans-serif;">  Prev Balance:<u>{{AssOldBal}}</u></p>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5 style="font-size:10px;margin-top:-50px;font-family: Verdana, sans-serif;"> <b> Total: {{AssTotDue}}</b></h5>
                                                                </div>
                                                                
                                                            </div>
                                         
                                    </div>          
                            </div> 

                            <div>
                                 <div class="columns">
                            
                                    <div class="column is-12">
                                            <table size="small" style="border-top: 1px solid gray;">
                                            <!-- TABLE TITLE -->
                                                <tr>
                                                    <th >SchedCode &nbsp;&nbsp;</th>
                                                    <th >Subject &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th style="text-align:center">Title &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th >Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <!-- <th>Created at</th> -->
                                                    <th style="text-align:center">Time &nbsp;&nbsp; &nbsp;&nbsp;</th>

                                                    <th style="text-align:center">Day&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                                    <th style="text-align:center">Room/MOL &nbsp;&nbsp; &nbsp;&nbsp;</th>
                                                    <th >Tut &nbsp;&nbsp; &nbsp;&nbsp;</th>
                                                    <!-- <th>Created at</th> -->
                                                    <th >Pet&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                                    <th >Set&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                                </tr>
                                                    <!-- TABLE TITLE -->


                                                    <!-- ITEMS -->
                                                <tr v-for="(subjList, i) in gradelists" :key="i" v-if="gradelists.length">
                                                    <td class="row-h">{{subjList.SchedCode}}</td>
                                                    <td class="ellipsis">{{subjList.SubjName}}</td>
                                                    <td  class="ellipsis">{{subjList.SubjDesc}}</td>
                                                    <td style="text-align:center">{{subjList.SubjUnits}}</td>
                                                
                                                    <td class="ellipsis">{{subjList.schedfrom}}-{{subjList.schedTo}}</td>

                                                    <td style="text-align:center">{{subjList.SchedDays}}</td>
                                                    <td style="text-align:center" class="ellipsis" >{{subjList.SchedRoom}}</td>
                                                    <td >{{subjList.SchedTut}}</td>
                                                
                                                    <td  >{{subjList.SchedPet}}</td>
                                                    <td >{{subjList.SchedSubjSet}}</td>
                                                
                                                </tr>
                                                
                                            </table>
                                    </div>
                                 </div>
                                    <v-divider></v-divider>
                                <div class="columns">
                                    <div class="column is-12">
                               
                                    <!-- margin-left:580px; -->
                                                <div class="text-right" style="  margin-top:-20px">
                                                    <span style="font-size:10px"> Total Units: {{TotUnits}}</span>
                                                </div>
                                                <span style="font-size:10px"> SET: 0 - Whole Semester   &nbsp;&nbsp;&nbsp; 1 - 1st Half &nbsp;&nbsp;&nbsp;  2 - 2nd Half</span>
                                              
                                    </div>
                                                
                                </div>
                                            <!-- <div class="columns">
                                                <div class="column is-6"><div style="text-align:left !important; margin-top:-10px">
                                                                        <span style="font-size:10px">  Student's Signature: _____________________</span>
                                                                    </div><br></div>
                                                <div class="column is-6">
                                                                    <br>
                                                                    <div style="text-align:right !important; margin-top:-10px">
                                                                        <span style="font-size:10px"> Approved By: <b><u>__NIEL C. ENERIO__</u></b></span><br>
                                                                        
                                                                    </div>
                                                                    <div style="text-align:center !important; margin-left:200px;  margin-top:-12px">
                                                                    <span style="font-size:8px; ">College Registrar</span></div>
                                                                
                                                </div>
                                                                    
                                            </div> -->
                                    

                            </div>
                    <!-- </div> -->
                
                            <div slot="footer" class="text-right">
                                <!-- <Button type="default" size="large"    @click="print" >Close</Button> -->
                            </div>
                <!-- </Modal> -->
            </div>
               
      </v-app>
</div>
  
</template>

<script>

    export default {
        data() {
        
            return {
                token: '',

                ExternalTESYear:'',


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


                isDeleting:false,
                showForwardIndiModal:false,
                 showForwardModal:false,
                 showEditModal:false,
                 

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



              
                 headers: [
                        
                        { text: 'Student ID', value: 'StudID' ,align: 'center',width: 80,},
                        { text: 'TES#', value: 'tesAwardNo' ,align: 'center',width: 150,},
                        { text: 'LastName', value: 'StudLName', align: 'left' , width: 150,},
                        { text: 'Firstname', value: 'StudFName', align: 'left' , width: 150,},
                       
                        { text: 'Middle Name', value: 'StudMName', align: 'left' , width: 100,},
                        
                      
                        { text: 'Program', value: 'EnrCourse' , align: 'Left', width: 80,},
                        { text: 'Year', value: 'EnrYear', align: 'center', width: 40,},
                          { text: 'Type', value: 'EnrClass' , align: 'center',width: 80,},
                        { text: 'Status', value: 'StudCStatus' , align: 'center', width: 80,},
                        { text: 'CNum', value: 'StudCNum' , align: 'center', width: 80,},
                        { text: 'Email', value: 'email' , align: 'center', width: 80,},
                        { text: 'Bdate', value: 'StudBDate', align: 'center', },
                        { text: 'TES Grantee', value: 'TESGrant', align: 'center', },
                     
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
            // this.getActiveTerm()
            this.getSem()
            // this.checkForward()
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

              

                    years () {
                        const year = new Date().getFullYear()
                        return Array.from({length: year - 2000}, (value, index) =>  (year - (index+1))  + '-' + (year - index) )
                    },
                    

                },

     methods:{

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
            const res = await  axios.get('/api/getTesStudentsAY/' + this.ExternalTESYear)
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

