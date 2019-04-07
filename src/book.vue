<template>
	<div >
	      
      		

			<div v-if="show_main" class="card" style="width: 18rem;">
			  <div class="card-body">
			  	<p>{{msg}}</p>
			    <h5 class="card-title">{{name.name}}</h5>
			    <h6 class="card-subtitle mb-2 text-muted">by- {{name.author}} , Edition {{name.edition}} </h6>
			    
			    <p class="card-text"> {{name.copy}} copy of this book available</p>
			
			    <b-button @click='delete_book'>delete</b-button>
			    
			  </div>
			</div>


	</div>
</template>
<style scoped>

.card{
	padding: 10px;
}
</style>
<script>
export default{
	
props:['name'],
	data(){
		return{
			show_main: true,
			msg : ''
		}
	},

	methods : {

		delete_book : function(){
		        this.msg = 'removing....'
				console.log(this.name.id)

				let endpoint = 'http://localhost/apu/library/manage_book/delBook.php';
				let params = {
					token: $cookies.get('lib_token'),
					id : this.name.id
				}

				this.$http.get(endpoint,{params:params}).then(response => {

						return response.json();	
				}).then(result =>{
					console.log(result)
					if(result.code == 200){
						// delete card 
						this.msg = ''
						this.show_main = false 

					}
				});
		}
	}
}


</script>