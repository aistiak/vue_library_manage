<template>

   <div>
   	 <navigation></navigation>
   	 <br>
   	 <b-button @click='see_list'>see book list</b-button>
   	 <b-button @click='add_book'>add book</b-button>


   	 <div class="book-list" v-if="see_book_list">
	   	 <ul>
	   	 	<li v-for="name in names"><book v-bind:name="name"></book></li>
	   	 	</br>
	   	 </ul>
   	 </div>	
 	 <div class='add-book' v-if="add_new_book">
          <h4>fill out the below information : </h4>

			  <div class="form-group">
			    
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Book name." v-model="book_name">			 
			  </div>
			  <div class="form-group">
			    
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Authors Name" v-model="authors_name">			 
			  </div>
			  <div class="form-group">
			    
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Edition no. " v-model="edition_no">			 
			  </div>
			  <div class="form-group">
		
			    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Number of Copy. " v-model="copy">			 
			  </div>	
			  <button @click='submit'>submit</button>
			  <p>{{msg}}</p>		  


      </div>	

   </div>
</template>
<style>
.add-book{
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
import book from './book.vue'

Vue.component('book',book)

export default{
	
	data(){
		return {
		  see_book_list : true ,
		  add_new_book : false ,
		  msg : '',
          names : [],
          book_name : '',
          authors_name : '',
          edition_no : '',
          copy : ''
		}
	},

	methods:{


		see_list : function(){
        	
  			this.see_book_list = true ;
        	this.add_new_book  = false ;

            let params = {
               token : $cookies.get('lib_token')
            }

            let endpoint = 'http://localhost/apu/library/manage_book/getall_books.php';

        	this.$http.get(endpoint,{params:params}).then( response =>{
     
               return response.json();

        	}).then( result =>{

        		this.names = result ;
        		console.log(result);
        	});
        	

		},

		add_book : function(){
        	this.see_book_list = false 
        	this.add_new_book  = true 


		},

		submit : function(){
                this.msg = 'wait...'
			    let params = {
        		token : $cookies.get('lib_token'),
        		name: this.book_name,
        		author : this.authors_name,
        		copy : this.copy,
        		edition : this.edition_no 
        	} 
			
			let endpoint = 'http://localhost/apu/library/manage_book/addBook.php'

			this.$http.get(endpoint,{params:params}).then(response => {
				
				return response.json()
			}).then( result => {
				console.log(result)
				if(result.code == 200){
					console.log(result) ;
			          this.book_name = ''
			          this.authors_name = ''
			          this.edition_no = ''
			          this.copy = '' 


			          this.msg = 'book added'
				}else{
					console.log(result);
				}
			});
		},
       


		chnage : function(){
			//console.log('change pressed');
			this.names.push('new names')
			//this.names = ['three' , 'foure' , 'five'];
			//console.log(this.names)

			// get the data from server then and update the book 
		}

	}
}

</script>