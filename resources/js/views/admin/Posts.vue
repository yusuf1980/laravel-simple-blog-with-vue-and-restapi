<template>
<section>
    <div id="main" class="main-content bg-white-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="flex flex-row flex-wrap flex-grow mt-2">
                    <div class="w-full p-6">
                        <router-link to="posts/create" class="my-5 rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">New Post</router-link>

                        <div class="bg-white border-transparent rounded-lg shadow-xl">
                            <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                <h2 class="font-bold uppercase text-gray-600">Posts</h2>
                            </div>
                            <div class="p-5">
                                <table class="w-full p-5 text-gray-700">
                                    <thead>
                                    <tr>
                                        <th class="text-left text-blue-900">Title</th>
                                        <th class="text-left text-blue-900">Author</th>
                                        <th class="text-left text-blue-900">Status</th>
                                        <th class="text-left text-blue-900">Comments</th>
                                        <th class="text-left text-blue-900">Published Date</th>
                                        <th class="text-left text-red-900">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <template v-for="(data, i) in posts" :key="i">
                                    <tr>
                                        <td>{{data.title}}</td>
                                        <td>{{data.user.name}}</td>
                                        <td>{{data.status}}</td>
                                        <td>{{data.comments_count}}</td>
                                        <td>{{data.published_date}}</td>
                                        <td>
                                            <button @click="toEdit(data.id)" class="inline-flex items-center px-2 py-1 mr-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="20px" height="20px">    <path d="M 22.828125 3 C 22.316375 3 21.804562 3.1954375 21.414062 3.5859375 L 19 6 L 24 11 L 26.414062 8.5859375 C 27.195062 7.8049375 27.195062 6.5388125 26.414062 5.7578125 L 24.242188 3.5859375 C 23.851688 3.1954375 23.339875 3 22.828125 3 z M 17 8 L 5.2597656 19.740234 C 5.2597656 19.740234 6.1775313 19.658 6.5195312 20 C 6.8615312 20.342 6.58 22.58 7 23 C 7.42 23.42 9.6438906 23.124359 9.9628906 23.443359 C 10.281891 23.762359 10.259766 24.740234 10.259766 24.740234 L 22 13 L 17 8 z M 4 23 L 3.0566406 25.671875 A 1 1 0 0 0 3 26 A 1 1 0 0 0 4 27 A 1 1 0 0 0 4.328125 26.943359 A 1 1 0 0 0 4.3378906 26.939453 L 4.3632812 26.931641 A 1 1 0 0 0 4.3691406 26.927734 L 7 26 L 5.5 24.5 L 4 23 z"/></svg>
                                            </button>

                                            <!-- <button class="inline-flex items-center px-2 py-1 mr-1 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                                <svg width="20px" height="20px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" >

                                                <path d="M0 0h48v48H0z" fill="none"/>
                                                <g id="Shopicon">
                                                    <circle cx="24" cy="24" r="4"/>
                                                    <path d="M24,38c12,0,20-14,20-14s-8-14-20-14S4,24,4,24S12,38,24,38z M24,16c4.418,0,8,3.582,8,8s-3.582,8-8,8s-8-3.582-8-8
                                                        S19.582,16,24,16z"/>
                                                </g>
                                                </svg>
                                            </button> -->

                                            <button @click="deletePost(data.id)" class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    </template>
                                    </tbody>
                                </table>
                                
                            </div>
                            
                            <div class="p-4 text-center">
                                <TailwindPagination
                                    :data="laravelData"
                                    @pagination-change-page="getPage"
                                    :limit="2" 
                                    :align="'center'"
                                />
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</section>
</template>

<script setup>
import { ref, onBeforeMount, reactive } from 'vue';
import $axios from '../../axios'
import { TailwindPagination } from 'laravel-vue-pagination';
import { useRouter } from 'vue-router';

const router = useRouter()
let data = ref({})
let posts = ref([])
let load = ref(false)
let payload = reactive({})
let page = 1;
let laravelData = ref({})

const init = (page) => {
    return new Promise((resolve, reject) => {
		$axios.get('/admin/posts?page='+page, payload)
			.then((response) => {
                console.log(response.data)
                data.value = response.data
                laravelData.value = response.data;
                posts.value = response.data.data
                load.value = !load.value
				resolve(response)
			})
			.catch((error) => {
                console.log('error ', error)
                load.value = !load.value
				reject(error.response)
			})
	})
}

async function getPage(page = 1) {
    await init(page)
}

const toEdit = (id) => {
    return router.push('/admin/posts/'+id+'/edit')
}

const deletePost = (id) => {
    let text = "Are you sure to delete this!";
    if (confirm(text) === false) return

    return new Promise((resolve, reject) => {
			$axios.delete('/admin/posts/'+id)
			.then((response) => {
                init(page)
			})
            .catch((error) => {
                console.log(error.response.data)
                reject(error)
            })
	})
}

onBeforeMount(async()=>{
    await init(page)
})

</script>