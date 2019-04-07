<template>
	
	<div >
		
		<div>
	  		<b-button @click="go_home">home</b-button>
	  		<b-button variant="danger"  @click="manage_book" >manage books</b-button>
	  		<b-button variant="success" @click="lend_book" >lend book</b-button>
	  		<b-button variant="outline-primary" @click="logout" >logout</b-button>
		</div>
	</div>

</template>

<script>


export default {
	
	data(){

		return{

		}
	},
		methods:{

		go_home : function(){
			window.location.href = '/home'
		},

		logout : function(){
			$cookies.set('lib_token','null')
		
			window.location.href = '/login'
		},

		lend_book : function(){
			window.location.href = '/lend-book'
		},

		manage_book : function(){
			window.location.href = '/manage-book'
		}


	},

  	created : function(){

    	console.log($cookies.get('lib_token'))
    	if($cookies.get('lib_token') == 'null'){
     	alert('login first')
     	window.location.href = '/login'

		}
	}			
}


</script>