export default {
	data(){
		return {

		}
	},
	methods: {
		async callApi(method, url, dataObj){
			try{
				return await axios({
				  method: method,
				  url: url,
				  data:dataObj
				});
			}catch (e){
				
				return e.response
			}
		},


            // success(desc) {
            //     this.$buefy.notification.open({
            //         message: desc,
            //         position: 'is-bottom-right',
            //         type: 'is-success',
            //         hasIcon: true
            //     })
            // },

            success2(desc) {
              this.$buefy.notification.open({
                  message: desc,
                  position: 'is-bottom-right',
                  type: 'is-success',
                  hasIcon: true
              })
          },

            danger(desc) {
                const notif = this.$buefy.notification.open({
                    duration: 3000,
                    message: desc,
                    position: 'is-bottom-right',
                    type: 'is-danger',
                    hasIcon: true
                })
               
            }




	},
}