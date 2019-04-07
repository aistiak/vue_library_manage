<template>

   <div>
     
      <navigation></navigation>
      <h3>add discription</h3>
      <b-button @click="see_list">see list of lent books</b-button>
      <b-button @click="add_new">lend a new book</b-button>

      <div class="book-list" v-if="book_list_status">
      		 <ul>

      		 	<li v-for="book in list_of_lent_books"><lent_book v-bind:book="book"></lent_book></li>

      		 </ul>
      </div>

      <div class='lend-book' v-if="lend_new_book">
          <h4>fill out the below information : </h4>

			  <div class="form-group">
			    
			    <b-form-select v-model="selected" :options="list_of_books" placeholder="Enter Name"></b-form-select>		 
			  </div>
			  <div class="form-group">
			    
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" v-model="name">			 
			  </div>
			  <div class="form-group">
			    
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter mobile no. " v-model="mobile">			 
			  </div>
			  <div class="form-group">
		
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address. " v-model="address">			 
			  </div>	
			  <button @click='submit'>submit</button>	
			  {{msg}}	  


      </div>

   </div>
</template>
<style>

.lend-book{
	width:400px;
	posotion:relative ;
	margin-top:50px;
	margin-left:500px;
}


.book-list{
	margin-top:40px;
}

</style>

<script>

import Vue from 'vue'
import lent_book from './lent_book.vue'
Vue.component('lent_book',lent_book)
export default{


	data(){
		return {
		  msg : '',	
          book_list_status: true,
          lend_new_book : false,
          selected : '',
          selected_book_id : '0',
          name : '',
          mobile : '',
          address : '',
          list_of_books : '',
          list_of_books_obj : '',
          list_of_lent_books : '',

     	  	
		}
	},

	methods:{

		add_new : function(){
			console.log('add new ')
			this.book_list_status = false ;
			this.lend_new_book = true;
         	
         	// todo 
         	// populate list of books
         	let params = {
         		token:$cookies.get('lib_token')
         	}

         	let endpoint = 'http://localhost/apu/library/manage_book/getall_books.php';

        	this.$http.get(endpoint,{params:params}).then( response =>{
     
               return response.json();

        	}).then( result =>{

        	
        		this.list_of_books = result.map(obj => obj.name)
        		let idx = result.map(obj => obj.name).indexOf(this.selected);
        		this.list_of_books_obj = result 
         		console.log("idx :" + idx)
        	});         	 

		},

		see_list : function(){
			console.log('see list')
			this.book_list_status = true ;
			this.lend_new_book = false;

			let endpoint = 'http://localhost/apu/library/lend/get_all_lent.php';
			let params = {
				token : $cookies.get('lib_token') ,
			}	
			// populate the book list list_of_lent_books

			this.$http.get(endpoint,{params:params}).then(response => {
				return response.json()
			}).then(result =>{
			   console.log(result)
			   this.list_of_lent_books = result ;
			})


		},
		submit : function(){
				console.log(this.mobile == "")
				try{

						this.msg = 'wait....'


						// if empty
						if(this.name == "" || this.mobile == "" || this.address == ""){
							this.msg = 'fill up everything first'
							return 
						}

						// get the id of selected book
						console.log(this.selected)	
						console.log(this.list_of_books_obj.map(obj => obj.name))
			 			let idx = this.list_of_books_obj.map(obj => obj.name).indexOf(this.selected)
						let book_id = this.list_of_books_obj[idx].id;
			            

						let params = {
							token: $cookies.get('lib_token'),
							name : this.name ,
							mobile : this.mobile ,
							address : this.address ,
							book_id : book_id,
						}

						let endpoint = 'http://localhost/apu/library/lend/lend.php'

						this.$http.get(endpoint,{params:params}).then(response => {

							return response.text()		
						}).then(result => {
							console.log(result)
							console.log(params	)
							this.msg = ''
							this.selected = ''
							this.name = ''
							this.mobile = ''
							this.address = ''
						});
				}catch(err){
					  this.msg = 'fill up all the fields properly'
				}
            

		}

	}
}

</script>