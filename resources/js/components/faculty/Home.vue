<template>
<v-app>
	<div class="container-fluid">
			 <div class="text-center">
				  <div class="row">
				
						<div class="col-md-12 col-sm-12 text-center">
							<br>
							<h2 class="display-1">Tangub City Fuel & Oil Operating and Management System</h2>
						
						</div>
				  </div>

				<div class="row">
				
					
				</div>
				 
						
			</div>



			
		</div>	


		<!-- <div class="container notification outlined">

			 <div class="row">
				
					<div class="col-md-12 col-sm-12 text-center">	
						<p>asdfsdf</p>
					</div>	
			 </div>
		</div> -->

			
	   </div>	
	</div>
	</v-app>
</template>

<script>

    export default {
		 props: {
			isHour: {
			type: Boolean,
			default: true
			},
			isMinute: {
			type: Boolean,
			default: true
			},
			isSecond: {
			type: Boolean,
			default: true
			}
		},
        data() {
        
        	  const data = [];
            return {

					curdate: new Date(),
				  	hours: 0,
					minutes: 0,
					seconds: 0,
					SECOND:0,
					hourtime: '',

					isAddingINAM:false,
					isAddingOUTAM:false,
					isAddingINPM:false,
					isAddingOUTPM:false,


					disabledINAM:false,
					disabledOUTAM:false,
					disabledINPM:false,
					disabledOUTPM:false,
					attendanceList:[],

					dialog2: false,

            }
        },

        mounted(){
			this.dialog2= true
		
		
			
        	
        },


      	created() {
			//    this.currentTime = moment().format("LTS");
    		// 	setInterval(() => this.updateCurrentTime(), 1 * 1000);
        },

        methods: {



			async getDTR(){
               
               const res = await  axios.get('/api/getDTR')
                    if(res.status==200){
                        if(res.data.length===0){
                            this.attendanceList=res.data
							// this.dialog2= false
                        }else{
                           
                            this.attendanceList=res.data
							// this.dialog2= false
                        }
                        
            
                    }else{
                            console.log(res.data)
                    }
          },


			checkAttendanceINAM() {
				
                axios('/api/checkAttendanceINAM')
                    .then(res=> {
                        if(res.data === 1){
							this.disabledINAM=true
							 this.dialog2= false
						}else{
							this.dialog2= false
						}

                    },(error)=>{
                        console.log(error);
                 })
			},

			checkAttendanceOUTAM() {
				
                axios('/api/checkAttendanceOUTAM')
                    .then(res=> {
                        if(res.data === 1){

							this.disabledOUTAM=true
							 this.dialog2= false
						}else{
							this.dialog2= false
						}

                    },(error)=>{
                        console.log(error);
                 })
			},

			checkAttendanceINPM() {
				
                axios('/api/checkAttendanceINPM')
                    .then(res=> {
                        if(res.data === 1){
							this.disabledINPM=true
							 this.dialog2= false
						}else{
							this.dialog2= false
						}

                    },(error)=>{
                        console.log(error);
                 })
			},

			checkAttendanceOUTPM() {
				 
                axios('/api/checkAttendanceOUTPM')
                    .then(res=> {
                        if(res.data === 1){
							this.disabledOUTPM=true
							 this.dialog2= false
						}else{
							this.dialog2= false
						}

                    },(error)=>{
                        console.log(error);
                 })
			},

			updateDateTime() {
					const now = new Date();
					this.hours = now.getHours();
					this.minutes = getZeroPad(now.getMinutes());
					this.seconds = getZeroPad(now.getSeconds());
					this.hourtime = getHourTime(this.hours);
					this.hours = this.hours % HOUR || HOUR;
					this.$options.timer = window.setTimeout(this.updateDateTime, SECOND);
			},


			currentDate() {
				const current = new Date();
				const date = `${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
				return date;
				},


			async submitINAM(){
          		this.isAddingINAM=true;
	                        const res = await this.callApi('post', 'app/SubmitIN_AM')
	                        if(res.status===200){
	                        	if(res.data===0){
					                this.$Message['error']({
					                    background: true,
					                    content: 'You already submitted your Time-In (AM)'
					                });
				                	this.isAddingINAM=false;
				                }else{
		                            this.isAddingINAM=false
									 this.$buefy.dialog.alert({
											type: 'is-success',
											title: 'TIME-IN (AM)',
											message: 'Time-In successfully submitted.',
											confirmText: 'OK'
										})
									this.disabledINAM=true
									this.getDTR()
				                }
	                        }else{
	                             if(res.status==422){
	                                            if(res.data.errors.StudId){
	                                                this.danger(res.data.errors.StudId[0])
	                                                this.$Loading.error();
	                                            } 
	                                        }else{
	                                            this.danger('Something went wrong!')
	                                            this.isAddingINAM=false;
	                                              }
	                              }
          	},


			async submitOUTAM(){
          		this.isAddingOUTAM=true;
	                        const res = await this.callApi('post', 'app/SubmitOUT_AM')
	                        if(res.status===200){
	                        	if(res.data===0){
					                this.$Message['error']({
					                    background: true,
					                    content: 'You already submitted your Time-Out (AM)'
					                });
				                	this.isAddingOUTAM=false;
				                }else{
		                            this.isAddingOUTAM=false
									 this.$buefy.dialog.alert({
											type: 'is-success',
											title: 'TIME-OUT (AM)',
											message: 'Time-Out successfully submitted.',
											confirmText: 'OK'
										})
									this.disabledOUTAM=true
									this.getDTR()
				                }
	                        }else{
	                             if(res.status==422){
	                                            if(res.data.errors.StudId){
	                                                this.danger(res.data.errors.StudId[0])
	                                                this.$Loading.error();
	                                            } 
	                                        }else{
	                                            this.danger('Something went wrong!')
	                                            this.isAddingOUTAM=false;
	                                              }
	                              }
          	},



			async submitINPM(){
          		this.isAddingINPM=true;
	                        const res = await this.callApi('post', 'app/SubmitIN_PM')
	                        if(res.status===200){
	                        	if(res.data===0){
					                this.$Message['error']({
					                    background: true,
					                    content: 'You already submitted your Time-In (PM)'
					                });
				                	this.isAddingINPM=false;
				                }else{
		                            this.isAddingINPM=false
									 this.$buefy.dialog.alert({
											type: 'is-success',
											title: 'TIME-IN (PM)',
											message: 'Time-In successfully submitted.',
											confirmText: 'OK'
										})
									this.disabledINPM=true
									this.getDTR()
				                }
	                        }else{
	                             if(res.status==422){
	                                            if(res.data.errors.StudId){
	                                                this.danger(res.data.errors.StudId[0])
	                                                this.$Loading.error();
	                                            } 
	                                        }else{
	                                            this.danger('Something went wrong!')
	                                            this.isAddingINPM=false;
	                                              }
	                              }
          	},



			async submitOUTPM(){
          		this.isAddingOUTPM=true;
	                        const res = await this.callApi('post', 'app/SubmitOUT_PM')
	                        if(res.status===200){
	                        	if(res.data===0){
					                this.$Message['error']({
					                    background: true,
					                    content: 'You already submitted your Time-Out (PM)'
					                });
				                	this.isAddingOUTPM=false;
				                }else{
		                            this.isAddingOUTPM=false
									 this.$buefy.dialog.alert({
											type: 'is-success',
											title: 'TIME-OUT (PM)',
											message: 'Time-Out successfully submitted.',
											confirmText: 'OK'
										})
									this.disabledOUTPM=true
									this.getDTR()
				                }
	                        }else{
	                             if(res.status==422){
	                                            if(res.data.errors.StudId){
	                                                this.danger(res.data.errors.StudId[0])
	                                                this.$Loading.error();
	                                            } 
	                                        }else{
	                                            this.danger('Something went wrong!')
	                                            this.isAddingOUTPM=false;
	                                              }
	                              }
          	},



        },

        computed: {
        	
        	
        },

    }
</script>

<style scoped>
.clock {
  background: #fff;
  border: 0.3rem solid #fff;
  border-radius: 0.5rem;
  display: inline-block;
  margin-bottom: 1em;
}
.clock__hours,
.clock__minutes,
.clock__seconds {
  background: linear-gradient(to bottom, #26303b 50%, #2c3540 50%);
  display: inline-block;
  color: #fff;
  font-family: 'Nunito', sans-serif;
  font-size: 3rem;
  font-weight: 300;
  padding: 0.5rem 1rem;
  text-align: center;
  position: relative;
}
.clock__hours {
  border-right: 0.15rem solid #fff;
}
.clock__minutes {
  border-right: 0.15rem solid #fff;
}
.clock__hourtime {
  font-size: 1rem;
  position: absolute;
  top: 2px;
  left: 8px;
}
</style>

