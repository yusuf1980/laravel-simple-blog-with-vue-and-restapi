<template>
<main class="mb-auto">
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <div class="space-y-2 pt-6 pb-8 md:space-y-5">
            <template v-if="!loading">
            <article>
                <header>
                    <h1 class="text-3xl text-center font-extrabold leading-9 tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl sm:leading-10 md:text-4xl md:leading-14">{{post.title}}</h1>
                    <div class="relative text-center mt-3">
                        <span class="mr-3">{{post.published_date}}</span><span class="mr-3">Comments {{ post.comments_count }}</span><span class="mr-3">Like 4</span><span class="mr-3">Dislike 4</span>
                    </div>
                </header>
                <div class="divide-y divide-gray-200 pb-8 dark:divide-gray-700 xl:divide-y-0">
                    <div class="divide-y divide-gray-200 dark:divide-gray-700 xl:col-span-3 xl:row-span-2 xl:pb-0">
                        <div class="content p-5" v-html="post.content">
                        </div>
                    </div>
                </div>
                <div class="comments">
                    <div>
                        <div class="inline-flex items-center rounded-md shadow-sm">
                            <button @click="like(1)" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                <span><svg :fill="!is_like?'#000000':'green'" height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    viewBox="0 0 512 512" xml:space="preserve">
                                <g>
                                    <path d="M498.323,297.032c0-7.992-1.901-15.683-5.553-22.635c12.034-9.18,19.23-23.438,19.23-38.914
                                        c0-27.037-21.996-49.032-49.032-49.032H330.206c11.434-29.24,17.665-64.728,17.665-101.419c0-23.266-18.928-42.194-42.194-42.194
                                        s-42.193,18.928-42.193,42.194c0,83.161-58.012,145.389-144.355,154.844c-0.592,0.065-1.159,0.197-1.7,0.38
                                        C111.752,235.129,104.235,232,96,232H32c-17.645,0-32,14.355-32,32v152c0,17.645,14.355,32,32,32h64
                                        c9.763,0,18.513-4.4,24.388-11.315c20.473,2.987,33.744,9.534,46.568,15.882c16.484,8.158,33.53,16.595,63.496,16.595h191.484
                                        c27.037,0,49.032-21.996,49.032-49.032c0-7.991-1.901-15.683-5.553-22.635c12.034-9.18,19.23-23.438,19.23-38.914
                                        c0-7.991-1.901-15.683-5.553-22.635C491.126,326.766,498.323,312.507,498.323,297.032z M465.561,325.727H452c-4.418,0-8,3.582-8,8
                                        s3.582,8,8,8h11.958c3.061,5.1,4.687,10.847,4.687,16.854c0,12.106-6.56,23.096-17.163,28.919h-14.548c-4.418,0-8,3.582-8,8
                                        s3.582,8,8,8h13.481c2.973,5.044,4.553,10.71,4.553,16.629c0,18.214-14.818,33.032-33.032,33.032H230.452
                                        c-26.223,0-40.207-6.921-56.398-14.935c-12.358-6.117-26.235-12.961-46.56-16.594c0.326-1.83,0.506-3.71,0.506-5.632V295
                                        c0-4.418-3.582-8-8-8s-8,3.582-8,8v121c0,8.822-7.178,16-16,16H32c-8.822,0-16-7.178-16-16V264c0-8.822,7.178-16,16-16h64
                                        c8.822,0,16,7.178,16,16c0,4.418,3.582,8,8,8s8-3.582,8-8c0-3.105-0.453-6.105-1.282-8.947
                                        c44.778-6.106,82.817-25.325,110.284-55.813c27.395-30.408,42.481-70.967,42.481-114.208c0-14.443,11.75-26.194,26.193-26.194
                                        c14.443,0,26.194,11.75,26.194,26.194c0,39.305-7.464,76.964-21.018,106.04c-1.867,4.004-0.134,8.764,3.871,10.631
                                        c1.304,0.608,2.687,0.828,4.025,0.719c0.201,0.015,0.401,0.031,0.605,0.031h143.613c18.214,0,33.032,14.818,33.032,33.032
                                        c0,11.798-6.228,22.539-16.359,28.469h-14.975c-4.418,0-8,3.582-8,8s3.582,8,8,8h12.835c3.149,5.155,4.822,10.984,4.822,17.079
                                        C482.323,308.985,475.927,319.848,465.561,325.727z"/>
                                    <path d="M422.384,325.727h-8.525c-4.418,0-8,3.582-8,8s3.582,8,8,8h8.525c4.418,0,8-3.582,8-8S426.802,325.727,422.384,325.727z"/>
                                    <path d="M436.934,263.953h-8.525c-4.418,0-8,3.582-8,8s3.582,8,8,8h8.525c4.418,0,8-3.582,8-8S441.352,263.953,436.934,263.953z"/>
                                    <path d="M407.833,387.5h-8.525c-4.418,0-8,3.582-8,8s3.582,8,8,8h8.525c4.418,0,8-3.582,8-8S412.252,387.5,407.833,387.5z"/>
                                    <path d="M80,264c-8.822,0-16,7.178-16,16s7.178,16,16,16s16-7.178,16-16S88.822,264,80,264z"/>
                                </g>
                                </svg>
                                </span>
                                <span class="text-2xl" :style="{color: is_like==1?'green':'#000000'}">{{post.like_true_count}}</span>
                            </button>
                            <button @click="like(0)" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                <span>
                                    <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        width="30px" height="30px" viewBox="0 0 72 72" enable-background="new 0 0 72 72" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M68.94,34.504c0,3.828-3.104,6.932-6.932,6.932h-9.137c-3.828,0-6.932-3.104-6.932-6.932V12.367
                                                c0-3.828,3.104-6.932,6.932-6.932h9.137c3.828,0,6.932,3.104,6.932,6.932V34.504z M64.94,12.367c0-1.619-1.313-2.932-2.932-2.932
                                                h-9.137c-1.619,0-2.932,1.313-2.932,2.932v22.137c0,1.619,1.313,2.932,2.932,2.932h9.137c1.619,0,2.932-1.313,2.932-2.932V12.367z
                                                "/>
                                        </g>
                                        <path d="M59.94,14.686c0,0.967-0.783,1.75-1.75,1.75h-0.5c-0.967,0-1.75-0.783-1.75-1.75v-0.5c0-0.967,0.783-1.75,1.75-1.75h0.5
                                            c0.967,0,1.75,0.783,1.75,1.75V14.686z"/>
                                        <g>
                                            <path d="M28.634,66.564c-1.252,0-2.407-0.347-3.434-1.029c-2.781-1.85-5.896-4.739-5.283-10.716
                                                c0.191-1.885,0.98-3.653,1.742-5.363c0.502-1.124,0.975-2.187,1.24-3.19c0.054-0.204,0.06-0.758,0.063-1.222
                                                c-2.181-0.188-4.376-0.354-6.351-0.354c-1.245,0-2.258,0.01-3.076,0.019c-1.058,0.011-1.794,0.018-2.31-0.002
                                                c-0.397-0.002-0.728-0.021-1.057-0.063c-2.168-0.289-4.095-1.406-5.424-3.144c-1.329-1.738-1.901-3.89-1.612-6.059
                                                c0.28-2.11,1.379-4.027,3.041-5.341c-0.732-1.347-1.023-2.897-0.819-4.426c0.239-1.778,1.094-3.36,2.429-4.52
                                                c-0.001-0.026-0.002-0.051-0.004-0.073c-0.454-1.056-0.613-2.21-0.462-3.351c0.222-1.664,1.062-3.13,2.349-4.147
                                                c-0.367-0.867-0.499-1.824-0.373-2.763c0.268-2,1.641-3.674,3.526-4.322c1.171-0.595,2.618-0.719,4.537-0.719
                                                c0.646,0,1.366,0.014,2.173,0.029c0.994,0.019,2.123,0.04,3.403,0.04c1.594,0,3.079-0.049,4.517-0.097
                                                c1.272-0.041,2.466-0.08,3.579-0.08c4.844,0,10.104,0.632,11.916,8.175c0.037,0.152-0.004,0.31-0.004,0.467v25.278
                                                c0,0.059,0.057,0.117,0.052,0.175l-0.058,1c-0.012,0.135-0.022,0.267-0.061,0.396c-0.548,1.84-2.565,5.132-4.708,8.616
                                                c-1.698,2.763-3.45,5.62-4.026,7.074c-0.976,2.468-0.977,5.793-0.896,6.865c0.058,0.754-0.314,1.476-0.962,1.865
                                                C32.115,65.685,30.597,66.564,28.634,66.564z M16.611,40.689c2.542,0,5.313,0.246,7.994,0.483l0.608,0.054
                                                c0.536,0.047,1.03,0.309,1.372,0.725c0.341,0.417,0.499,0.953,0.439,1.488c-0.056,0.505-0.06,1.05-0.063,1.577
                                                c-0.006,0.808-0.011,1.569-0.196,2.271c-0.348,1.316-0.91,2.578-1.454,3.798c-0.663,1.487-1.289,2.894-1.417,4.142
                                                c-0.41,4.007,1.514,5.645,3.52,6.979c0.525,0.35,1.212,0.416,1.803,0.3c0.013-1.716,0.207-4.596,1.207-7.123
                                                c0.704-1.78,2.471-4.654,4.342-7.697c1.664-2.707,3.66-6.051,4.173-7.494l0.001-0.687V14.558c-1-4.2-3.218-4.886-7.972-4.886
                                                c-1.072,0-2.192,0.038-3.419,0.078c-1.469,0.049-2.972,0.099-4.632,0.099c-1.31,0-2.456-0.021-3.473-0.041
                                                c-0.778-0.015-1.47-0.028-2.093-0.028c-0.61,0-2.229,0-2.755,0.302c-0.135,0.077-0.277,0.139-0.426,0.183
                                                c-0.494,0.146-0.844,0.563-0.914,1.087c-0.05,0.374,0.068,0.664,0.178,0.842c0.433,0.704,0.552,1.662,0.319,2.56
                                                c-0.203,0.778-0.656,1.399-1.279,1.749c-0.659,0.37-1.094,1.011-1.193,1.758c-0.058,0.437,0.007,0.88,0.188,1.279
                                                c0.456,1.002,0.573,3.421-0.836,4.455c-0.729,0.533-1.194,1.317-1.314,2.211c-0.104,0.772,0.077,1.562,0.509,2.219
                                                c0.878,1.345,0.396,3.729-0.938,4.642c-0.984,0.671-1.637,1.729-1.793,2.904c-0.148,1.11,0.145,2.211,0.825,3.101
                                                c0.68,0.889,1.666,1.324,2.776,1.473c0.18,0.024,0.357-0.106,0.533-0.106c0.024,0,0.117,0,0.142,0
                                                c0.468,0,1.162,0.146,2.121,0.137C14.323,40.564,15.35,40.689,16.611,40.689z"/>
                                        </g>
                                        <g>
                                            <path d="M22.919,14.342c-0.326,0-1.317,0-1.337-0.982c-0.003-0.142,0.029-0.277,0.09-0.4c0.146-0.384,0.529-0.616,0.953-0.645
                                                c0.114,0.002,0.217,0.012,0.311,0.027c0.545,0.009,0.983,0.453,0.983,1C23.919,13.895,23.472,14.342,22.919,14.342z"/>
                                        </g>
                                        <g>
                                            <path d="M35.599,16.378c-0.279,0-0.558-0.116-0.755-0.345c-1.975-2.273-3.978-2.134-7.613-1.879
                                                c-0.461,0.032-0.94,0.065-1.442,0.095c-0.54,0.038-1.024-0.389-1.057-0.939c-0.033-0.551,0.388-1.024,0.939-1.057
                                                c0.493-0.029,0.966-0.063,1.42-0.094c3.708-0.26,6.634-0.465,9.263,2.563c0.362,0.417,0.317,1.048-0.1,1.41
                                                C36.065,16.298,35.831,16.378,35.599,16.378z"/>
                                        </g>
                                    </g>
                                    </svg>                     
                                </span>
                                <span class="text-2xl">{{post.dislike_count}}</span>
                            </button>
                        </div>
                    </div>
                    <h1 class="text-center text-3xl font-bold mb-5">Comments</h1>
                    <div>
                        <div class="input-comments p-4" v-if="store.getters.loggedIn">
                            <textarea v-model="comment" placeholder="Comment Here...." class="italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" name="" id="" rows="10"></textarea>
                            <p v-if="load" class="p-4">Loading...</p>
                            <button @click="submitComment" class="my-5 rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Primary</button>
                        </div>
                        <div v-else class="p-4 text-center">
                            <p><i>You must logged in to comments</i></p>
                        </div>
                        
                        <template v-for="(data,i) in comments" :key="i">
                        <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
                            
                            <div class="relative flex gap-4">
                                <!-- <img src="https://icons.iconarchive.com/icons/diversity-avatars/avatars/256/charlie-chaplin-icon.png" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy"> -->
                                <div class="flex flex-col w-full">
                                    <div class="flex flex-row justify-between">
                                        <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{data.user.name}}</p>
                                        <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ data.created_at }}</p>
                                </div>
                            </div>
                            <p class="-mt-4 text-gray-500">{{data.comment}}</p>
                        </div>
                        </template>
                    </div>
                </div>
            </article>
            </template>
            <template v-else>
                <p class="text-center">Loding...</p>
            </template>
        </div>
    </div>

</main>
</template>

<script setup>
import { computed, ref, onMounted, watch} from 'vue'
import { useStore } from 'vuex'
import { useRoute } from 'vue-router'
import $axios from '../axios'

let comment = ref('')
const store = useStore()
const route = useRoute()
let loading = computed(()=>store.getters.getLoading)
let load = ref(false)
let post = computed(()=>store.getters.getPost)
let comments = computed(()=>store.getters.getComments)
let is_like = ref(null)

if(loading) scrollToTop()
store.dispatch('getPost', route.params.id)
    .then(res => {
        console.log(post.value)
        store.dispatch('getComments', res)
    })
const submitComment = () => {
    if(comment.value === '' || comment.value.length < 3) {
        alert('You must fill the comment!')
        return
    }
    load.value = true
    let payload = {comment: comment.value, post_id: post.value.id}
    return new Promise((resolve, reject) => {
		$axios.post('/admin/comments', payload)
			.then((response) => {
                store.dispatch('getComments', post.value)
                comment.value = ''
                load.value = !load.value
				resolve(response)
			})
			.catch((error) => {
                console.log('error ', error)
				reject(error.response)
			})
	})
}

const like = (like) => {
    return new Promise((resolve, reject) => {
		$axios.post('/like', {like: like , id:post.value.id})
			.then((response) => {
                store.commit('setLike', like)
                // if(like === 1) {
                //     // post.like_true_count+=1
                // } 
                // console.log(response.data)
                // is_like.value = response.data.
                
                // store.dispatch('getPost', route.params.id)
                // .then(res => {
                //     console.log(post.value)
                //     // store.dispatch('getComments', res)
                // })
				resolve(response)
			})
			.catch((error) => {
                console.log('error ', error.response.data.message)
				reject(error.response)
			})
	})
}

watch(() => post.value, (first, second) => {
});

const init = async () => {
    // console.log(post.value)
    if(store.getters.loggedIn && Object.keys(post.value).length > 0 ) {
        try {
            console.log('login')
            const lik = await $axios('/post/like/'+post.value.id);
            // const k = lik
            console.log(lik.data)
            if(Object.keys(lik).length) {
                console.log('length')
                is_like = true
            }
        }
        catch(e) {
            console.log('error', e)
        }
    }
    else {
        return
    }
}
// init()

function scrollToTop () {
    window.scrollTo(0,0);
}
onMounted(()=>{
    init()
})
</script>