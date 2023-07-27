<template>
<div class="grid place-items-center mx-2 my-20 sm:my-auto py-10" x-data="{ showPass: true }">
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <div v-if="errors" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{errors}}</span>
              </div>
              <form class="space-y-4 md:space-y-6" @submit.prevent="login">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input type="email" v-model="form.username" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" v-model="form.password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <!-- <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" >
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                          </div>
                      </div>
                      <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                  </div> -->
                  <button type="submit" class="my-5 rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Sign In</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Don’t have an account yet? <router-link to="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</router-link>
                  </p>
              </form>
          </div>
      </div>
    </div>
</template>

<script setup>
import {reactive, ref} from 'vue'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
const store = useStore()
let form = reactive({
    username: 'test@example.com',
    password: 'password'
})
let errors = ref(null)
const router = useRouter()

const login = () => {
			store.dispatch('login', {
				username: form.username,
				password: form.password
			})
			.then((response) => {
                router.push('/admin')
				// this.getUser()
				// $axios.get('/login-log')
			    // .then(response=>{
			    // 	console.log('Berhasil Login');
			    // 	// location.reload()
			    // })
			    // .catch(error=>{
			    // 	// console.log(error)
			    // 	console.log(error.response.data)
			    // })
				// this.$router.push({ name: 'dashboard' })
				// // this.getUser()
				// this.$toast.success({
                //       title: 'Log-In',
                //       message: 'Selamat! Anda berhasil masuk.',
                //       position: 'bottom center',
                // })
			})
			.catch((error) => {
				errors = error.response.data
				// this.password = ''
			})
}
</script>