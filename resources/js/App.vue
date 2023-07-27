<template>
<div>
    <LayoutAdmin v-if="route.meta.layout">
    </LayoutAdmin>
    <LayoutDefault v-else>
    </LayoutDefault>
    
</div>

</template>

<script setup>
import LayoutDefault from './components/LayoutDefault.vue';
import LayoutAdmin from './components/LayoutAdmin.vue';
import {useRoute, useRouter} from 'vue-router';
import { useStore } from 'vuex';
import $axios from './axios';

const route = useRoute();
const router = useRouter();
const store = useStore();

if(store.getters.loggedIn) {}
$axios.interceptors.request.use(
		  config =>
		  {
		  	if (store.getters.loggedIn) config.headers['Authorization'] = 'Bearer ' + store.state.token;
		    return config;
		  }
);
$axios.interceptors.response.use((response) => {
	  return response;
	}, (error) => {
	  return Promise.reject(error);
});
$axios.interceptors.response.use(
		  response => response,
		  error =>
		  {
		  	let originalRequest = error.config

		      	if (error.response.status !== 401) {
		      		if (error.response.status === 400) {
		      			localStorage.removeItem('uuidpandaisuite')
		          		store.commit('setToken', null)
		      			  router.push({ name: 'login' });
		      		}
		      		if(error.response.status === 500 
		      			&& error.response.statusText === 'Internal Server Error' ) {
                  console.log('Internal server error')
		      		}
					if(error.response.status === 422) {
						console.log('error 422')
						return Promise.reject(error)
					}
		      		// if (error.response.status === 403) {
		      		// 	if(error.response.data === 'Suspended') {
		      		// 		if(this.loggedIn) {
		      		// 			return this.$store.dispatch('destroyToken')
							//         .then((response) => {
							//          	this.$toast.error({
							// 			 	title: 'Akun dikunci!',
							// 			 	message: 'Akun ini telah disuspended!',
							//         	})
							//         this.$router.push({ name: 'login' })
			      	// 			})
		      		// 		}
		      	 			
		      		
					else {
		      			router.push({name: 'dashboard'})
		      		}
		      		// }
		      		
		            return Promise.reject(error)
		        }
            console.log('response', error.config.url)
		        if (error.config.url === '/refresh') {
		          localStorage.removeItem('uuidpandaisuite')
		          // this.$store.commit('setToken', null)
		          router.push({ name: 'login' });
		          return Promise.reject(error)
		        }
		        
		        store.dispatch('refreshToken').then(response => {
		        	$axios(originalRequest)
		        	// this.dataDashboard()
		          return Promise.resolve()
		        })
		        .catch((err) => {
		          	Promise.reject(err)
		        })

		        return Promise.reject(error)

		   }
		)

</script>

<style>
html {
  scroll-behavior: smooth;
}
</style>