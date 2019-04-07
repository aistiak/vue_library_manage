<template>

   <div>
			<div  v-if="show_main" class="card" style="width: 18rem;">
			  <div class="card-body">
			  	<p>{{msg}}</p>
			    <h5 class="card-title">{{book.book_name}}</h5>
			    <h6 class="card-subtitle mb-2 text-muted">taken by : {{book.name}}	</h6>
			    <p class="card-subtitle mb-2 text-muted">taken by : {{book.mobile}}</p>
			    <p class="card-subtitle mb-2 text-muted">address : {{book.address}}</p>

			    <p class="card-text"></p>
			
			    <b-button @click='return_book'>delete</b-button>
			    
			  </div>
			</div>
   </div>

</template>


<script>

export default {
props:['book'],	
	data(){
		return{
			msg : '',
			show_main: true,
		}
	},

	methods : {

		return_book : function(){

				this.msg = 'returning...'

				let params = {
					token: $cookies.get('lib_token'),
					id : this.book.id
				}

				let endpoint = 'http://localhost/apu/library/lend/return.php'

				this.$http.get(endpoint,{params:params}).then(response => {

						return response.json()
				}).then(result => {
						console.log(result)

						if(result.code == 200){
							this.msg = ''
							this.show_main = false
						}
				});
		}
	}
}


</script>