<template>
<main class="mb-auto">
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <div class="space-y-2 pt-6 pb-8 md:space-y-5">
            <h1 class="text-3xl text-center font-extrabold leading-9 tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl sm:leading-10 md:text-5xl md:leading-14">All Posts</h1>
            <div class="relative max-w-lg mx-auto flex items-center">
                <input placeholder="Search Post" type="text" class="block w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-900 dark:bg-gray-800 dark:text-gray-100">
                <svg class="absolute right-3 top-3 h-5 w-5 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
        <ul>
            <template v-for="(data, i) in data.posts" v-if="!loading">
            <li class="py-4">
                <article class="space-y-2 xl:grid xl:grid-cols-4 xl:items-baseline xl:space-y-0">
                    <dl>
                        <dt class="sr-only">Published on</dt>
                        <dd class="text-base font-medium leading-6 text-gray-500 dark:text-gray-400">
                            <time datetime="2019-10-11T00:00:00.000Z">{{data.published_date.split(' ')[0]}}</time>
                        </dd>
                    </dl>
                    <div class="space-y-3 xl:col-span-3">
                        <div>
                            <h3 class="text-2xl font-bold leading-8 tracking-tight">
                                <router-link :to="`/post/${data.id}`" class="text-gray-900 dark:text-gray-100">{{ data.title }}</router-link>
                            </h3>
                            <div class="flex flex-wrap">
                                <span class="mr-3 text-sm font-medium uppercase text-primary-500 hover:text-primary-600 dark:hover:text-primary-400">Comments {{ data.comments_count }}</span>
                                <span class="mr-3 text-sm font-medium uppercase text-primary-500 hover:text-primary-600 dark:hover:text-primary-400">Like 40</span>
                                <span class="mr-3 text-sm font-medium uppercase text-primary-500 hover:text-primary-600 dark:hover:text-primary-400">Unlike 40</span>
                            </div>
                        </div>
                        <div class="prose max-w-none text-gray-500 dark:text-gray-400" v-html="data.content">
                            
                        </div>
                    </div>
                    
                </article>
            </li>
        </template>
        <template v-else>
            <p class="text-center">Loading...</p>
        </template>
        </ul>
    </div>
    <div class="space-y-2 pt-6 pb-8 md:space-y-5">
        <nav class="flex justify-between">
            
            <button @click="previousPage">Previous</button>
            
            <span>10 of {{ data.page }}</span>
            <button @click="nextPage">Next</button>
        </nav>
    </div>
</main>
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'
const store = useStore()
let data = computed(()=>store.getters.getPostsData)

store.dispatch('getPosts', {page: data.value.page})

let loading = computed(()=>store.getters.getLoading)

const previousPage = () => {
    if(data.value.page != 1 ) {
        scrollToTop()
        return store.dispatch('getPosts', {page: data.value.page - 1})
    } 
    return
}
const nextPage = () => {
    if(data.value.page != data.value.last_page) {
        scrollToTop()
        return store.dispatch('getPosts', {page: data.value.page + 1})
    } 
    return
}
function scrollToTop () {
    window.scrollTo(0,0);
}

</script>

<style>
.text-primary-500 {
    --tw-text-opacity: 1;
    color: rgb(20 184 166/var(--tw-text-opacity));
}
</style>