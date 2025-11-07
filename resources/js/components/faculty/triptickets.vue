<template>

<!-- <div class="container-fluid"> -->
      <v-app>
       <br>
      
       <div>
           <h3 class="title text-center">Trip Tickets</h3>
            
                     <v-banner
                           >
                            <div class="row">
                                        <div class="col-md-4">
                                                <div style="text-align:Left !important;">
                                                         
                                                             <v-btn
                                                                    @click="ShowAddTripTicket=true"
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



                                <v-data-table
                                            :headers="headers"
                                            :items="TripTicketlist"
                                            :search="search"
                                            :items-per-page="20" 
                                            class="elevation-1 pa-2"
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
                                                                @click="showEditingModal(item.TripT_id,item.Trip_Date,item.Product,item.VehType,item.VehPlateNum,
                                                                item.VehModel,item.DriversName,item.VehOffice,item.AuthPassName,item.PlaceVisit,
                                                                item.Purpose,item.TimeDeparture,item.TimeArr,item.DepartTime,item.ArrivalTime,
                                                                item.DisTravel,item.BalTank,item.IssuedOffice,item.GearOil,item.LubriOil,
                                                                item.Greased,item.Brake_fluid,item.SpeedoBTrip,item.SpeedoETrip,item.DistanceTraveled,item.Remarks
                                                                ,item.Prod_id,item.Driver_id,item.Equip_id, item.AddPurchase)"

                                                                class="mr-2"
                                                                color="blue"
                                                                >
                                                                <v-icon small>mdi-pencil</v-icon>
                                                        </v-btn>

                                                         <v-btn
                                                       
                                                                icon
                                                                small
                                                                @click="showDeletingModal(item.TripT_id)"
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



             <Modal v-model="ShowAddTripTicket" width="1200">

                                    <div>
                                        <p class="subtitle" style="text-align:center"><span><b>  Add Trip Ticket</b></span></p>
                                    </div>
                                      <br>
                                        <br>
                                         <div class="container-fluid" > 
                                      
                                                <v-card  outlined > 

                                                         <v-card-text>
                                                                   
                                                                    <v-row>
                                                                        <v-col  cols="12"
                                                                            sm="4"
                                                                            md="4">
                                                                            <p class="text-md-left">
                                                                            To be filled by the Administrative Official
                                                                            </p> <hr>
                                                                                
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
                                                                                    
                                                                                        v-model="TripTicket.Trip_Date"

                                                                                        outlined
                                                                                        label="Date"
                                                                                        prepend-icon="mdi-calendar"
                                                                                        @click="getProduct()"
                                                                                        readonly
                                                                                        dense
                                                                                        v-bind="attrs"
                                                                                        v-on="on"
                                                                                    ></v-text-field>
                                                                                    </template>
                                                                                    <v-date-picker
                                                                                    v-model="TripTicket.Trip_Date"
                                                                                    
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

                                                                        <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                                <p class="text-md-left">
                                                                                    To be filled by the Driver
                                                                                </p> <hr>

                                                                                    <v-dialog
                                                                                        ref="dialogTimeDept"
                                                                                        v-model="modalDept"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                         
                                                                                            v-model="TripTicket.TimeDeparture"
                                                                                            label="1. Time of Departure"
                                                                                            :disabled = "!TripTicket.Purpose"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                       
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripTicket.TimeDeparture"
                                                                                        
                                                                                        full-width
                                                                                       
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalDept = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeDept.save(TripTicket.TimeDeparture)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>

                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                    <br>
                                                                                    <p class="text-md-left">
                                                                                   
                                                                                </p> <hr>
                                                                                        
                                                                                        <v-text-field
                                                                
                                                                                                label="9. Greased"
                                                                                                v-model="TripTicket.Greased"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>


                                                                             
                                                                   
                                                                    </v-row>

                                                                     <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                                <v-select
                                                                                        v-model="TripTicket.Prod_id"
                                                                                        :items="ProductList"
                                                                                        @click="getDriver()"
                                                                                        color="pink"
                                                                                        :disabled="!TripTicket.Trip_Date"
                                                                                        dense
                                                                                        outlined
                                                                                        item-value = "Prod_id"
                                                                                        item-text = "Product"
                                                                                        label="Product"
                                                                                        required>
                                                                                </v-select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                               
                                                                                    <v-dialog
                                                                                        ref="dialogTimeArr"
                                                                                        v-model="modalArr"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                            :disabled = "!TripTicket.TimeDeparture"
                                                                                            v-model="TripTicket.TimeArr"
                                                                                            label="2. Time of Arrival"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                       
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripTicket.TimeArr"
                                                                                        full-width
                                                                                        :min="TripTicket.TimeDeparture"
                                                                                        
                                                                                       
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalArr = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeArr.save(TripTicket.TimeArr)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>

                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        
                                                                                        <v-text-field
                                                                
                                                                                                label="10. Brake Fluid"
                                                                                                v-model="TripTicket.Brake_fluid"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                            

                                                                      
                                                                    </v-row>
                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                                <v-select
                                                                                        v-model="TripTicket.Driver_id"
                                                                                        :items="DriverList"
                                                                                        :disabled="!TripTicket.Prod_id"
                                                                                        color="pink"
                                                                                        dense
                                                                                        @click="getVehicle()"
                                                                                        item-value = "Driver_id"
                                                                                        item-text = "DriversName"
                                                                                        outlined
                                                                                        label="Driver's Name"
                                                                                        required>
                                                                                </v-select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                               
                                                                                    <v-dialog
                                                                                        ref="dialogTimeDeptBack"
                                                                                        v-model="modalDeptBack"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                            :disabled = "!TripTicket.TimeArr"
                                                                                            v-model="TripTicket.DepartTime"
                                                                                            label="3. Time of Depart"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                        
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripTicket.DepartTime"
                                                                                        full-width
                                                                                        :min="TripTicket.TimeArr"
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalDeptBack = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeDeptBack.save(TripTicket.DepartTime)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>


                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        
                                                                                        <span>11. Speedometer Readings, if any</span>
                                                                                </v-col>
                                                                      
                                                                    </v-row>
                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                                <!-- <v-select
                                                                                        v-model="TripTicket.Equip_id"
                                                                                        :items="VechicleList"
                                                                                        color="pink"
                                                                                        dense
                                                                                        outlined
                                                                                        item-value = "Veh_id"
                                                                                        item-text = `VehType, VehPlateNum `
                                                                                        label="Equipment"
                                                                                        required>
                                                                                        <template slot="selection" slot-scope="data">
                                                                                            {{ data.item.Veh_id }} {{ data.item.VehType }}
                                                                                        </template>
                                                                                </v-select> -->

                                                                                    <Select @input="getPlaceVisited()"  clearable  v-model="TripTicket.Equip_id" filterable size="large" placeholder="Select Vehicle">
                                                                                            <Option  v-for="veclist in VechicleList" :value="veclist.Veh_id" :key="veclist.Veh_id">{{veclist.VehFuelCap}}Liters - {{ veclist.VehPlateNum }} - {{ veclist.VehModel }} - {{ veclist.VehType }} - {{ veclist.VehOffice }}  </Option>
                                                                                    </Select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                               
                                                                                    <v-dialog
                                                                                        ref="dialogTimeArrBack"
                                                                                        v-model="modalArrBack"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                            :disabled = "!TripTicket.DepartTime"
                                                                                            v-model="TripTicket.ArrivalTime"
                                                                                            label="4. Time of Arrival Back"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                       
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripTicket.ArrivalTime"
                                                                                        full-width
                                                                                        :min="TripTicket.DepartTime"
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalArrBack = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeArrBack.save(TripTicket.ArrivalTime)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>

                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                        <v-text-field
                                                                
                                                                                                label="Beginning Trip"
                                                                                                v-model="TripTicket.SpeedoBTrip"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                      
                                                                    </v-row>

                                                                     <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-text-field
                                                                                    v-model="TripTicket.AuthPassName"
                                                                                    :disabled="!TripTicket.Equip_id"
                                                                                    
                                                                                    label="Name(s) of Authorized Passengers"
                                                                                    outlined
                                                                                    clearable
                                                                                    dense
                                                                                ></v-text-field>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-text-field class="subtitle"
                                                                                    v-model="TripTicket.DisTravel"
                                                                                    label="5. Approximate Distance Travel (km)"
                                                                                    disabled
                                                                                    clearable
                                                                                    right
                                                                                    dense
                                                                                ></v-text-field>
                                                                            </v-col>


                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                        <v-text-field
                                                                
                                                                                                label="End Trip"
                                                                                                v-model="TripTicket.SpeedoETrip"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                      
                                                                    </v-row>

                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <Select   clearable  :disabled="!TripTicket.AuthPassName" v-model="TripTicket.PlaceVisit" filterable size="large" placeholder="Place(s) to be Visited/Inspected">
                                                                                        <Option  v-for="semlist in VisitedList" :value="semlist.PlaceName" :key="semlist.PlaceName">{{ semlist.PlaceName}}</Option>
                                                                                </Select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-text-field
                                                                                   
                                                                                    label="6. Gas Issued, Purchase & Consumed (L)"
                                                                                    disabled
                                                                                    clearable
                                                                                    right
                                                                                    dense
                                                                                ></v-text-field>
                                                                            </v-col>

                                                                             <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                        <v-text-field
                                                                
                                                                                                label="Distance Traveled"
                                                                                                v-model="TripTicket.DistanceTraveled"
                                                                                                @value = "DistTravel"  
                                                                                                disabled = true
                                                                                                outlined
                                                                                                dense
                                                                                              
                                                                                                v-bind:options="optionDistTravel"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                      
                                                                    </v-row>

                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-textarea
                                                                                         v-model="TripTicket.Purpose"
                                                                                        label="Purposes"
                                                                                        auto-grow
                                                                                        outlined
                                                                                        :disabled="!TripTicket.PlaceVisit"
                                                                                        dense
                                                                                        rows="1"
                                                                                       
                                                                                        >
                                                                                </v-textarea>
                                                                            </v-col>
                                                                       
                                                                            <v-col
                                                                                        cols="12"
                                                                                        sm="4"
                                                                                        md="4"
                                                                                        >
                                                                                   
                                                                                    <v-text-field
                                                                                            
                                                                                             v-model="TripTicket.BalTank"
                                                                                            label="a. Balance in Tank"
                                                                                            disabled
                                                                                            clearable
                                                                                            outlined
                                                                                            right
                                                                                            dense
                                                                                        ></v-text-field>
                                                                            </v-col>


                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                       <v-textarea
                                                                                                v-model="TripTicket.Remarks"
                                                                                                label="Remarks"
                                                                                                auto-grow
                                                                                                outlined
                                                                                                rows="3"
                                                                                              
                                                                                                >
                                                                                        </v-textarea>
                                                                                </v-col>
                                                                     
                                                                    </v-row>
                                                                      
                                                                    <v-row style="margin-top:-80px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col 
                                                                                  
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        <span style="color:RED; !important"><b> *{{timesPerVeh}}</b></span>
                                                                                        <v-text-field 
                                                                                                label="b. Issued by Office"
                                                                                                v-model="TripTicket.IssuedOffice" 
                                                                                                :disabled="!TripTicket.ArrivalTime"
                                                                                                @input="getAppTTravel()" 
                                                                                                outlined
                                                                                                type="number"
                                                                                                required
                                                                                                :rules="[numberRule]">
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                    </v-row>

                                                                    <v-row style="margin-top:-40px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        <span style="color:RED; !important"><b> *{{timesPerVeh}}</b></span>
                                                                                        <v-text-field
                                                                
                                                                                                label="c. Add Purchase *"
                                                                                                v-model="TripTicket.AddPurchase"  
                                                                                                :disabled="!TripTicket.IssuedOffice"
                                                                                                outlined
                                                                                                @input="getAppTTravel()"
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                    </v-row>

                                                                    <v-row style="margin-top:-40px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        <span><b> TOTAL </b></span>
                                                                                        <v-text-field class="title"
                                                                                              
                                                                                                :value="totalTrip"
                                                                                                disabled
                                                                                                
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                    </v-row>

                                                                    <v-row style="margin-top:-10px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                     <v-text-field
                                                                                            
                                                                                            v-model="TripTicket.IssuedOffice"  
                                                                                            label="d. Deduct"
                                                                                            disabled
                                                                                            outlined
                                                                                            right
                                                                                            dense
                                                                                        ></v-text-field>
                                                                                       
                                                                                </v-col>
                                                                    </v-row>
                                                                    <v-row style="margin-top:-40px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                     <v-text-field
                                                                                            v-model="TripTicket.BalTank"
                                                                                            label="e. Balance"
                                                                                            disabled
                                                                                            outlined
                                                                                            right
                                                                                            dense
                                                                                        ></v-text-field>
                                                                                       
                                                                                </v-col>
                                                                    </v-row>
                                                                  

                                                                    
                                                         </v-card-text>
                                                    
                                                </v-card>



                                        </div>
                                      
                                
                                        <div slot="footer" class="text-right">
                                                <b-button @click="cancelItems" type="is-danger">CANCEL</b-button>
                                                 <b-button :disabled="disabledSavedBtn" @click="SaveTripTicket"
                                                     type="is-info">SAVE </b-button>
                                        </div>
             
            </Modal>


             <Modal v-model="ShowEditTripTicket" width="1200">

                                    <div>
                                        <p class="subtitle" style="text-align:center"><span><b>  Edit Trip Ticket</b></span></p>
                                    </div>
                                      <br>
                                        <br>
                                         <div class="container-fluid" > 
                                      
                                                <v-card  outlined > 

                                                         <v-card-text>
                                                                   
                                                                    <v-row>
                                                                        <v-col  cols="12"
                                                                            sm="4"
                                                                            md="4">
                                                                            <p class="text-md-left">
                                                                            To be filled by the Administrative Official
                                                                            </p> <hr>
                                                                                
                                                                                <v-menu
                                                                                    ref="menuEdit"
                                                                                    v-model="menuEdit"   
                                                                                    :close-on-content-click="false"
                                                                                    
                                                                                    transition="scale-transition"
                                                                                    offset-y
                                                                                    min-width="auto"
                                                                                >
                                                                                    <template v-slot:activator="{ on, attrs }">
                                                                                    <v-text-field
                                                                                    
                                                                                        v-model="TripEditTicket.Trip_Date"

                                                                                        outlined
                                                                                        label="Date"
                                                                                        prepend-icon="mdi-calendar"
                                                                                        @click="getProduct()"
                                                                                        readonly
                                                                                        dense
                                                                                        v-bind="attrs"
                                                                                        v-on="on"
                                                                                    ></v-text-field>
                                                                                    </template>
                                                                                    <v-date-picker
                                                                                    v-model="TripEditTicket.Trip_Date"
                                                                                    
                                                                                    no-title
                                                                                    scrollable
                                                                                    >
                                                                                    <v-spacer></v-spacer>
                                                                                    <v-btn
                                                                                        text
                                                                                        color="primary"
                                                                                        @click="menuEdit = false"
                                                                                    >
                                                                                        Cancel
                                                                                    </v-btn>
                                                                                    <v-btn
                                                                                        text
                                                                                        color="primary"
                                                                                        @click="$refs.menuEdit.save(date)"
                                                                                    >
                                                                                        OK
                                                                                    </v-btn>
                                                                                    </v-date-picker>
                                                                                </v-menu>
                                                                        </v-col>

                                                                        <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                                <p class="text-md-left">
                                                                                    To be filled by the Driver
                                                                                </p> <hr>

                                                                                    <v-dialog
                                                                                        ref="dialogTimeDept"
                                                                                        v-model="modalDept"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                         
                                                                                            v-model="TripEditTicket.TimeDeparture"
                                                                                            label="1. Time of Departure"
                                                                                            :disabled = "!TripEditTicket.Purpose"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                       
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripEditTicket.TimeDeparture"
                                                                                        
                                                                                        full-width
                                                                                       
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalDept = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeDept.save(TripEditTicket.TimeDeparture)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>

                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                    
                                                                                    <p class="text-md-right title">
                                                                                            <b> Ticket #: {{TripEditTicket.TripT_id}}</b>
                                                                                </p> <hr>
                                                                                        
                                                                                        <v-text-field
                                                                
                                                                                                label="9. Greased"
                                                                                                v-model="TripEditTicket.Greased"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>


                                                                             
                                                                   
                                                                    </v-row>

                                                                     <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                                <v-select
                                                                                        v-model="TripEditTicket.Prod_id"
                                                                                        :items="ProductList"
                                                                                        @click="getDriver()"
                                                                                        color="pink"
                                                                                        :disabled="!TripEditTicket.Trip_Date"
                                                                                        dense
                                                                                        outlined
                                                                                        item-value = "Prod_id"
                                                                                        item-text = "Product"
                                                                                        label="Product"
                                                                                        required>
                                                                                </v-select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                               
                                                                                    <v-dialog
                                                                                        ref="dialogTimeArr"
                                                                                        v-model="modalArr"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                            :disabled = "!TripEditTicket.TimeDeparture"
                                                                                            v-model="TripEditTicket.TimeArr"
                                                                                            label="2. Time of Arrival"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                       
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripEditTicket.TimeArr"
                                                                                        full-width
                                                                                        :min="TripEditTicket.TimeDeparture"
                                                                                        
                                                                                       
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalArr = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeArr.save(TripEditTicket.TimeArr)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>

                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        
                                                                                        <v-text-field
                                                                
                                                                                                label="10. Brake Fluid"
                                                                                                v-model="TripEditTicket.Brake_fluid"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                            

                                                                      
                                                                    </v-row>
                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                                <v-select
                                                                                        v-model="TripEditTicket.Driver_id"
                                                                                        :items="DriverList"
                                                                                        :disabled="!TripEditTicket.Prod_id"
                                                                                        color="pink"
                                                                                        dense
                                                                                        @click="getVehicle()"
                                                                                        item-value = "Driver_id"
                                                                                        item-text = "DriversName"
                                                                                        outlined
                                                                                        label="Driver's Name"
                                                                                        required>
                                                                                </v-select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                               
                                                                                    <v-dialog
                                                                                        ref="dialogTimeDeptBack"
                                                                                        v-model="modalDeptBack"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                            :disabled = "!TripEditTicket.TimeArr"
                                                                                            v-model="TripEditTicket.DepartTime"
                                                                                            label="3. Time of Depart"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                        
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripEditTicket.DepartTime"
                                                                                        full-width
                                                                                        :min="TripEditTicket.TimeArr"
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalDeptBack = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeDeptBack.save(TripEditTicket.DepartTime)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>


                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        
                                                                                        <span>11. Speedometer Readings, if any</span>
                                                                                </v-col>
                                                                      
                                                                    </v-row>
                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                                <!-- <v-select
                                                                                        v-model="TripTicket.Equip_id"
                                                                                        :items="VechicleList"
                                                                                        color="pink"
                                                                                        dense
                                                                                        outlined
                                                                                        item-value = "Veh_id"
                                                                                        item-text = `VehType, VehPlateNum `
                                                                                        label="Equipment"
                                                                                        required>
                                                                                        <template slot="selection" slot-scope="data">
                                                                                            {{ data.item.Veh_id }} {{ data.item.VehType }}
                                                                                        </template>
                                                                                </v-select> -->

                                                                                    <Select @input="getPlaceVisited()"  clearable  v-model="TripEditTicket.Equip_id" filterable size="large" placeholder="Select Vehicle">
                                                                                            <Option  v-for="veclist in VechicleList" :value="veclist.Veh_id" :key="veclist.Veh_id">{{veclist.VehFuelCap}}Liters - {{ veclist.VehPlateNum }} - {{ veclist.VehModel }} - {{ veclist.VehType }} - {{ veclist.VehOffice }}  </Option>
                                                                                    </Select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                               
                                                                                    <v-dialog
                                                                                        ref="dialogTimeArrBack"
                                                                                        v-model="modalArrBack"
                                                                                        :return-value.sync="time"
                                                                                        persistent
                                                                                        width="290px"
                                                                                    >
                                                                                        <template v-slot:activator="{ on, attrs }">
                                                                                        <v-text-field
                                                                                            :disabled = "!TripEditTicket.DepartTime"
                                                                                            v-model="TripEditTicket.ArrivalTime"
                                                                                            label="4. Time of Arrival Back"
                                                                                            prepend-icon="mdi-clock-time-four-outline"
                                                                                            readonly
                                                                                            v-bind="attrs"
                                                                                            outlined
                                                                                            dense
                                                                                            v-on="on"
                                                                                            type="time"
                                                                                        ></v-text-field>
                                                                                        </template>
                                                                                       
                                                                                        <v-time-picker
                                                                                        ampm-in-title
                                                                                        v-model="TripEditTicket.ArrivalTime"
                                                                                        full-width
                                                                                        :min="TripEditTicket.DepartTime"
                                                                                        >
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="modalArrBack = false"
                                                                                        >
                                                                                            Cancel
                                                                                        </v-btn>
                                                                                        <v-btn
                                                                                            text
                                                                                            color="primary"
                                                                                            @click="$refs.dialogTimeArrBack.save(TripEditTicket.ArrivalTime)"
                                                                                        >
                                                                                            OK
                                                                                        </v-btn>
                                                                                        </v-time-picker>
                                                                                    </v-dialog>
                                                                         
                                                                            </v-col>

                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                        <v-text-field
                                                                
                                                                                                label="Beginning Trip"
                                                                                                v-model="TripEditTicket.SpeedoBTrip"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                      
                                                                    </v-row>

                                                                     <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-text-field
                                                                                    v-model="TripEditTicket.AuthPassName"
                                                                                    :disabled="!TripEditTicket.Equip_id"
                                                                                    
                                                                                    label="Name(s) of Authorized Passengers"
                                                                                    outlined
                                                                                    clearable
                                                                                    dense
                                                                                ></v-text-field>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-text-field class="subtitle"
                                                                                    v-model="TripEditTicket.DisTravel"
                                                                                    label="5. Approximate Distance Travel (km)"
                                                                                    disabled
                                                                                    clearable
                                                                                    right
                                                                                    dense
                                                                                ></v-text-field>
                                                                            </v-col>


                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                        <v-text-field
                                                                
                                                                                                label="End Trip"
                                                                                                v-model="TripEditTicket.SpeedoETrip"  
                                                                                                outlined
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                      
                                                                    </v-row>

                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <Select   clearable  :disabled="!TripEditTicket.AuthPassName" v-model="TripEditTicket.PlaceVisit" filterable size="large" placeholder="Place(s) to be Visited/Inspected">
                                                                                        <Option  v-for="semlist in VisitedList" :value="semlist.PlaceName" :key="semlist.PlaceName">{{ semlist.PlaceName}}</Option>
                                                                                </Select>
                                                                            </v-col>


                                                                             <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-text-field
                                                                                   
                                                                                    label="6. Gas Issued, Purchase & Consumed (L)"
                                                                                    disabled
                                                                                    clearable
                                                                                    right
                                                                                    dense
                                                                                ></v-text-field>
                                                                            </v-col>

                                                                             <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                        <v-text-field
                                                                
                                                                                                label="Distance Traveled"
                                                                                                v-model="TripEditTicket.DistanceTraveled"
                                                                                                @value = "DistTravel"  
                                                                                                disabled = true
                                                                                                outlined
                                                                                                dense
                                                                                              
                                                                                                v-bind:options="optionDistTravel"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                      
                                                                    </v-row>

                                                                    <v-row style="margin-top:-30px;">
                                                                            <v-col
                                                                                cols="12"
                                                                                sm="4"
                                                                                md="4"
                                                                                >
                                                                              
                                                                               <v-textarea
                                                                                         v-model="TripEditTicket.Purpose"
                                                                                        label="Purposes"
                                                                                        auto-grow
                                                                                        outlined
                                                                                        :disabled="!TripEditTicket.PlaceVisit"
                                                                                        dense
                                                                                        rows="1"
                                                                                       
                                                                                        >
                                                                                </v-textarea>
                                                                            </v-col>
                                                                       
                                                                            <v-col
                                                                                        cols="12"
                                                                                        sm="4"
                                                                                        md="4"
                                                                                        >
                                                                                   
                                                                                    <v-text-field
                                                                                            
                                                                                             v-model="TripEditTicket.BalTank"
                                                                                            label="a. Balance in Tank"
                                                                                            disabled
                                                                                            clearable
                                                                                            outlined
                                                                                            right
                                                                                            dense
                                                                                        ></v-text-field>
                                                                            </v-col>


                                                                            <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                  
                                                                                       <v-textarea
                                                                                                v-model="TripEditTicket.Remarks"
                                                                                                label="Remarks"
                                                                                                auto-grow
                                                                                                outlined
                                                                                                rows="3"
                                                                                              
                                                                                                >
                                                                                        </v-textarea>
                                                                                </v-col>
                                                                     
                                                                    </v-row>
                                                                      
                                                                    <v-row style="margin-top:-80px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col 
                                                                                  
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        <span style="color:RED; !important"><b> *{{timesPerVeh}}</b></span>
                                                                                        <v-text-field 
                                                                                                label="b. Issued by Office"
                                                                                                v-model="TripEditTicket.IssuedOffice" 
                                                                                                :disabled="!TripEditTicket.ArrivalTime"
                                                                                                @input="getAppTTravel()" 
                                                                                                outlined
                                                                                                type="number"
                                                                                                required
                                                                                                :rules="[numberRule]">
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                    </v-row>

                                                                    <v-row style="margin-top:-40px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        <span style="color:RED; !important"><b> *{{timesPerVeh}}</b></span>
                                                                                        <v-text-field
                                                                
                                                                                                label="c. Add Purchase *"
                                                                                                v-model="TripEditTicket.AddPurchase"  
                                                                                                :disabled="!TripEditTicket.IssuedOffice"
                                                                                                outlined
                                                                                                @input="getAppTTravel()"
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                    </v-row>

                                                                    <v-row style="margin-top:-40px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                        <span><b> TOTAL </b></span>
                                                                                        <v-text-field class="title"
                                                                                              
                                                                                                :value="totalTrip"
                                                                                                disabled
                                                                                                
                                                                                                dense
                                                                                                type="number"
                                                                                                >
                                                                                                
                                                                                        </v-text-field>
                                                                                </v-col>
                                                                    </v-row>

                                                                    <v-row style="margin-top:-10px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                     <v-text-field
                                                                                            
                                                                                            v-model="TripEditTicket.IssuedOffice"  
                                                                                            label="d. Deduct"
                                                                                            disabled
                                                                                            outlined
                                                                                            right
                                                                                            dense
                                                                                        ></v-text-field>
                                                                                       
                                                                                </v-col>
                                                                    </v-row>
                                                                    <v-row style="margin-top:-40px;">

                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                
                                                                                
                                                                                </v-col>
                                                                                <v-col
                                                                                    cols="12"
                                                                                    sm="4"
                                                                                    md="4"
                                                                                    >
                                                                                     <v-text-field
                                                                                            v-model="TripEditTicket.BalTank"
                                                                                            label="e. Balance"
                                                                                            disabled
                                                                                            outlined
                                                                                            right
                                                                                            dense
                                                                                        ></v-text-field>
                                                                                       
                                                                                </v-col>
                                                                    </v-row>
                                                                  

                                                                    
                                                         </v-card-text>
                                                    
                                                </v-card>



                                        </div>
                                      
                                
                                        <div slot="footer" class="text-right">
                                                <b-button @click="cancelItems" type="is-danger">CANCEL</b-button>
                                                 <b-button :disabled="disabledSavedBtn" @click="SaveTripEditTicket"
                                                     type="is-info">SAVE </b-button>
                                        </div>
             
            </Modal>
            


          


           
            <Modal v-model="showDeleteModal" width="360">
                            <p slot="header" style="color:#f60;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Delete confirmation</span>
                            </p>
                            <div style="text-align:center">
                                <p>Are you sure you want to delete this Trip Ticket?</p>
                            
                            </div>
                            <div slot="footer">
                                <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="DeleteTripTicket()">Delete</Button>
                            </div>
            </Modal>


          
               
      </v-app>
<!-- </div> -->
  
</template>

<script>

    export default {
       
        data() {

        
            return {
                token: '',


                headers: [
                    
                    { text: 'Actions', value: 'action' ,align: 'center',width: 150,},
                    { text: 'Control #', value: 'TripT_id' ,align: 'center',width: 50,},
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
                    { text: 'AddPurchase', value: 'AddPurchase', align: 'left' , width: 150,},

                    { text: 'GearOil', value: 'GearOil', align: 'left' ,},
                    { text: 'LubriOil', value: 'LubriOil', align: 'left' ,},
                    { text: 'Greased', value: 'Greased', align: 'left' , },
                    { text: 'Brake_fluid', value: 'Brake_fluid', align: 'left' , },
                    { text: 'SpeedoBegTrip', value: 'SpeedoBTrip', align: 'left' ,},
                    { text: 'SpeedoEndTrip', value: 'SpeedoETrip', align: 'left' , },
                  


                    { text: 'Distance Travel', value: 'DistanceTraveled', align: 'left' , width: 150,},
                    { text: 'Remarks', value: 'Remarks' ,align: 'center',width: 150,},


                    {value: 'Prod_id' ,align: ' d-none' },
                    {value: 'Driver_id' ,align: ' d-none' },
                    {value: 'Equip_id' ,align: ' d-none' },


                    
                ],


                
                TripTicketlist:[],
                TripEditTicketlist:[],
                ShowAddTripTicket:false,
                ShowEditTripTicket:false,
                
                TripTicket:{
                    Trip_Date:'',
                    Prod_id:'',
                    Driver_id:'',
                    Equip_id:'',
                    AuthPassName:'',
                    PlaceVisit:'',
                    Purpose:'',
                    TimeDeparture:'',
                    TimeArr:'',
                    DepartTime:'',
                    ArrivalTime:'',
                    DisTravel:'',
                    BalTank:'',
                    IssuedOffice:'',
                    AddPurchase:'',
                    GearOil:0,
                    LubriOil:0,
                    Greased:0,
                    Brake_fluid:0,
                    SpeedoBTrip:0,
                    SpeedoETrip:0,
                    DistanceTraveled:'',
                    Remarks:'',
                    Vec_id:'',

                },
                
                 TripEditTicket:{
                    Trip_Date:'',
                    Prod_id:'',
                    Driver_id:'',
                    Equip_id:'',
                    AuthPassName:'',
                    PlaceVisit:'',
                    Purpose:'',
                    TimeDeparture:'',
                    TimeArr:'',
                    DepartTime:'',
                    ArrivalTime:'',
                    DisTravel:'',
                    BalTank:'',
                    IssuedOffice:'',
                    AddPurchase:'',
                    GearOil:0,
                    LubriOil:0,
                    Greased:0,
                    Brake_fluid:0,
                    SpeedoBTrip:0,
                    SpeedoETrip:0,
                    DistanceTraveled:'',
                    Remarks:'',
                    Vec_id:'',

                },
            

                menuadd: false,

                menuEdit:false,
                pickerDate: '1995-1-1',

                dialogTimeDept:false,
                dialogTimeArr:false,

                dialogTimeDeptBack:false,
                dialogTimeArrBack:false,

                 modalDept: false,
                 modalArr: false,
                 modalDeptBack: false,
                 modalArrBack: false,


                 ProductList:[],
                 DriverList:[],
                 VechicleList:[],
                 VisitedList:[],
                 timesPerVeh:0,
                 fuelCap:'',

                  optionDistTravel: {
                    suffix: "KM",
                    length: 11,
                    precision: 2
                    },
                
                 deleteItem:'',
                showDeleteModal:false,
                isDeleting:false,
                showEditModal:false,


                loading: false,

                    

               


                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                 options: {
                    suffix: "L",
                    length: 11,
                    precision: 2
                    },
                    
                numberRule: val => {
                if(val < 0) return 'Please enter a positive number'
                return true
                },

               
                selected: [],
                search: '',


            }
        },

       

        watch: {

               
        },

        mounted(){
           this.getTripTicketList()   
        },

         computed: {


                     totalTrip() {
                        return parseFloat(this.TripTicket.BalTank) + parseFloat(this.TripTicket.AddPurchase) + parseFloat(this.TripTicket.IssuedOffice);
                        },

                    AppDistanceTravel() {
                        return parseFloat(this.TripTicket.IssuedOffice) * parseFloat(this.TripTicket.ba);
                        },


                    getAppTTravel(){
                        return this.TripTicket.DisTravel = (parseFloat(this.TripTicket.IssuedOffice) * parseFloat(this.timesPerVeh) +  parseFloat(this.TripTicket.AddPurchase) * parseFloat(this.timesPerVeh));
                    },


                    getAppTTravel(){
                        return this.TripTicket.DisTravel = (parseFloat(this.TripTicket.IssuedOffice) * parseFloat(this.timesPerVeh) +  parseFloat(this.TripTicket.AddPurchase) * parseFloat(this.timesPerVeh));
                    },


                    DistTravel(){
                        return this.TripTicket.DistanceTraveled =   parseFloat(this.TripTicket.SpeedoETrip)  - parseFloat(this.TripTicket.SpeedoBTrip);
                    },


                    





                     disabledSavedBtn(){
                        
                        

                            if(this.ShowAddTripTicket ===true){

                                if (!this.TripTicket.Trip_Date ||
                                            !this.TripTicket.Prod_id ||
                                            !this.TripTicket.Driver_id ||
                                            !this.TripTicket.Equip_id ||
                                            !this.TripTicket.AuthPassName ||
                                            !this.TripTicket.PlaceVisit ||
                                            !this.TripTicket.Purpose ||
                                            !this.TripTicket.TimeDeparture ||
                                            !this.TripTicket.TimeArr ||
                                            !this.TripTicket.DepartTime ||
                                            !this.TripTicket.ArrivalTime ||
                                            !this.TripTicket.DisTravel ||
                                            !this.TripTicket.BalTank ||
                                            !this.TripTicket.IssuedOffice ||
                                            !this.TripTicket.AddPurchase ||
                                          
                                            !this.TripTicket.Remarks
                                             ){
                                                        return true;

                                                }else{
                                                    return false
                                    }
                                        
                                          
                            }

                            if(this.ShowEditTripTicket ===true){

                                if (!this.TripEditTicket.Trip_Date ||
                                            !this.TripEditTicket.Prod_id ||
                                            !this.TripEditTicket.Driver_id ||
                                            !this.TripEditTicket.Equip_id ||
                                            !this.TripEditTicket.AuthPassName ||
                                            !this.TripEditTicket.PlaceVisit ||
                                            !this.TripEditTicket.Purpose ||
                                            !this.TripEditTicket.TimeDeparture ||
                                            !this.TripEditTicket.TimeArr ||
                                            !this.TripEditTicket.DepartTime ||
                                            !this.TripEditTicket.ArrivalTime ||
                                            !this.TripEditTicket.DisTravel ||
                                            !this.TripEditTicket.BalTank ||
                                            !this.TripEditTicket.IssuedOffice ||
                                            !this.TripEditTicket.AddPurchase ||
                                          
                                            !this.TripEditTicket.Remarks
                                             ){
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
        

        showEditingModal(TripT_id,Trip_Date,Product,VehType,VehPlateNum,VehModel,DriversName,VehOffice,AuthPassName,PlaceVisit,
                            Purpose,TimeDeparture,TimeArr,DepartTime,ArrivalTime,DisTravel,BalTank,IssuedOffice,GearOil,LubriOil,
                            Greased,Brake_fluid,SpeedoBTrip,SpeedoETrip,DistanceTraveled,Remarks,Prod_id,Driver_id,Equip_id,AddPurchase){
                        let obj = {
                            TripT_id : TripT_id ,
                            Trip_Date : Trip_Date ,
                            Product : Product ,
                            VehType : VehType ,
                            VehPlateNum : VehPlateNum ,
                            VehModel : VehModel ,
                            DriversName : DriversName ,
                            VehOffice : VehOffice ,
                            AuthPassName : AuthPassName ,
                            PlaceVisit : PlaceVisit ,
                            Purpose : Purpose ,
                            TimeDeparture : TimeDeparture ,
                            TimeArr : TimeArr ,
                            DepartTime : DepartTime ,
                            ArrivalTime : ArrivalTime ,
                            DisTravel : DisTravel ,
                            BalTank : BalTank ,
                            IssuedOffice : IssuedOffice ,
                            GearOil : GearOil ,
                            LubriOil : LubriOil ,
                            Greased : Greased ,
                            Brake_fluid : Brake_fluid ,
                            SpeedoBTrip : SpeedoBTrip ,
                            SpeedoETrip : SpeedoETrip ,
                            DistanceTraveled : DistanceTraveled ,
                            Remarks : Remarks ,
                            Prod_id : Prod_id ,
                            Driver_id : Driver_id ,
                            Equip_id : Equip_id ,
                            AddPurchase:AddPurchase,
                    }
                        this.TripEditTicket=obj  
                        this.getProduct()
                        this.getPlaceVisitedEdit()
                        this.getVehicle()
                        this.getDriver()
                        
                        this.ShowEditTripTicket = true       

               
        },


        async SaveTripTicket(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/SaveTripTicket' , this.TripTicket)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    
                    this.success2('Trip Ticket successfully saved!') 
                    this.ShowAddTripTicket=false
                    this.getTripTicketList()
                    this.cancelItems()
                    
                    this.isDeleting= false
                  
                   
                   

                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },


        async SaveTripEditTicket(){
          this.isDeleting= true
               
            const res = await this.callApi('post', 'app/SaveTripEditTicket' , this.TripEditTicket)
            if(res.status===200){
            
               
                    this.$Loading.finish();
                    
                    this.success2('Trip Ticket successfully Edited!') 
                    this.ShowEditTripTicket=false
                    this.getTripTicketList()
                    this.cancelItems()
                    
                    this.isDeleting= false
                  
                   
                   

                }else{
                    this.$Loading.error();
                    this.danger()
                     this.isDeleting= false
                }
     
        },



        

         async getVehicleSpecEdit(){
            const res = await  axios.get('/api/getVehicleSpec/' + this.TripEditTicket.Equip_id)
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                   
                }else{
                    
                    this.timesPerVeh = parseInt(res.data[0].EquipTimes)
                    this.fuelCap =  parseInt(res.data[0].VehFuelCap)
                    this.TripEditTicket.BalTank = res.data[0].EquipBalTank
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },


         async getPlaceVisitedEdit(){
            this.getVehicleSpecEdit()
            const res = await  axios.get('/api/getPlaceVisited')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.VisitedList = res.data;
                }else{
                    this.VisitedList = res.data;
                    
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },


        async getPlaceVisited(){
            this.getVehicleSpec()
            const res = await  axios.get('/api/getPlaceVisited')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.VisitedList = res.data;
                }else{
                    this.VisitedList = res.data;
                    
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },


        async getVehicle(){
            const res = await  axios.get('/api/getVehicle')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.VechicleList = res.data;
                }else{
                    this.VechicleList = res.data;
                   
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },

        async getDriver(){
            const res = await  axios.get('/api/getDriver')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.DriverList = res.data;
                }else{
                    this.DriverList = res.data;
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },

        async getProduct(){
            const res = await  axios.get('/api/getProduct')
            if(res.status==200){
                if(res.data.length===0){
                    this.$Loading.error();
                    this.danger('No Records found!')
                    this.ProductList = res.data;
                }else{
                    this.ProductList = res.data;
                    this.$Loading.finish();
                }
                
            }else{
                    console.log(res.data)
            }
        },



            cancelItems(){

                    this.TripTicket.Trip_Date=''
                    this.TripTicket.Prod_id=''
                    this.TripTicket.Driver_id=''
                    this.TripTicket.Equip_id=''
                    this.TripTicket.AuthPassName=''
                    this.TripTicket.PlaceVisit=''
                    this.TripTicket.Purpose=''
                    this.TripTicket.TimeDeparture=''
                    this.TripTicket.TimeArr=''
                    this.TripTicket.DepartTime=''
                    this.TripTicket.ArrivalTime=''
                    this.TripTicket.DisTravel=''
                    this.TripTicket.BalTank=''
                    this.TripTicket.IssuedOffice=''
                    this.TripTicket.AddPurchase=''
                    this.TripTicket.GearOil=0
                    this.TripTicket.LubriOil=0
                    this.TripTicket.Greased=0
                    this.TripTicket.Brake_fluid=0
                    this.TripTicket.SpeedoBTrip=0
                    this.TripTicket.SpeedoETrip=0
                    this.TripTicket.DistanceTraveled=0
                    this.TripTicket.Remarks=''
                    this.TripTicket.Vec_id=''

                    this.TripEditTicket.Trip_Date=''
                    this.TripEditTicket.Prod_id=''
                    this.TripEditTicket.Driver_id=''
                    this.TripEditTicket.Equip_id=''
                    this.TripEditTicket.AuthPassName=''
                    this.TripEditTicket.PlaceVisit=''
                    this.TripEditTicket.Purpose=''
                    this.TripEditTicket.TimeDeparture=''
                    this.TripEditTicket.TimeArr=''
                    this.TripEditTicket.DepartTime=''
                    this.TripEditTicket.ArrivalTime=''
                    this.TripEditTicket.DisTravel=''
                    this.TripEditTicket.BalTank=''
                    this.TripEditTicket.IssuedOffice=''
                    this.TripEditTicket.AddPurchase=''
                    this.TripEditTicket.GearOil=0
                    this.TripEditTicket.LubriOil=0
                    this.TripEditTicket.Greased=0
                    this.TripEditTicket.Brake_fluid=0
                    this.TripEditTicket.SpeedoBTrip=0
                    this.TripEditTicket.SpeedoETrip=0
                    this.TripEditTicket.DistanceTraveled=0
                    this.TripEditTicket.Remarks=''
                    this.TripEditTicket.Vec_id=''


                    this.ShowEditTripTicket = false
                    this.ShowAddTripTicket = false
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


         async DeleteTripTicket(){
               const res = await this.callApi('post', 'app/DeleteTripTicket/' + this.deleteItem)
                if(res.status===200){
                
                
                        this.$Loading.finish();
                        this.success2('Trip Ticket successfully deleted!') 
                         this.getTripTicketList()
                        this.showDeleteModal = false
                        this.isDeleting= false
                    
                    }else{
                        this.$Loading.error();
                        this.danger()
                        this.isDeleting= false
                    }
                
        },


        showDeletingModal(TripT_id){
          this.deleteItem = TripT_id
          this.showDeleteModal = true
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

