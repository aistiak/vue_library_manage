<template>

<div class='main'>
    <p class='input'>{{warn}}</p>
    <b-form-input class='input' v-model="name" placeholder=" name"></b-form-input>
    <b-form-input class='input' v-model="password" placeholder="password" type="password"></b-form-input>
    <b-button id="login" class="button" @click="login">login</b-button>
</div>

</template>



<style>

	.input{
	 position:relative;
	 margin-bottom:20px;
	 width:1400px;
	}

	.main{
		position:relative;
		left:35%;
		margin-top:200px;
	}

	#login{
    position: relative;
    margin-left: -664px;
	}


</style>

<script>

export default {
	
	data(){
		return{
        warn : ''
		}
	},

	methods:{
       login : function (){
       		console.log(this.name);
       		console.log(this.password);
          this.warn = "wait...."   
             
       		// 
       		let endpoint = 'http://localhost/apu/library/login.php';
       		let prams = {
       		 	name : this.name,
       		 	password : this.password
       		}
       		this.$http.get(endpoint,{ params :prams}).then(response =>{
       			// if 200 ok
       			console.log(response.status)
            return response.json();

       		}, esponse => {
       		 	// if 401 
            console.log(response.status)
       		 	return response.json();
       		}).then(result => {
            
       		 	 if(result.code == 200){

                  // save the token in cookie
                   this.warn = 'login success'  
                   $cookies.set('lib_token',result.token)
                   console.log($cookies.get('lib_token'))
                   window.location.href = '/home'

             }else{
                console.log(result.error)
                this.warn = result.error
             }

       		});

    
       }
	}
}

</script>

