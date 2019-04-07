import login from './login.vue'
import home from './home.vue'
import lend from './lend.vue'
import mbooks from './mbooks.vue'
export default[
	 {path: '/' , component: login},		
     {path: '/login',component: login},
     {path: '/home', component: home},
     {path: '/lend-book', component: lend},
     {path: '/manage-book', component: mbooks},

]