<template>
        <section>
            <div id="main" class="main-content bg-white-100 mt-12 md:mt-2 pb-24 md:pb-5">
                <!-- <div class="grid grid-cols-3 gap-x-3 items-stretch mt-10 m-auto border border-gray-900" style="width:800px">
                    <div class="bg-blue-200 py-2">
                        <label class="block">Label 1</label>
                        <input type="text" class="rounded-lg border border-gray-400 py-2 w-full" placeholder="266px">
                    </div>
                    <div class="bg-blue-200 py-2">
                        <label class="block">Label 2</label>
                        <input type="text" class="rounded-lg border border-gray-400 py-2 w-full" placeholder="254px">
                    </div>
                    <div class="bg-blue-200 py-2">
                        <label class="block">Label 3</label>
                        <input type="text" class="rounded-lg border border-gray-400 py-2 w-full" placeholder="254px">
                    </div>
                </div> -->
                <!-- <div class="bg-white-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-green-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Analytics</h1>
                    </div>
                </div> -->

                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Total Posts</h2>
                                   <p class="font-bold text-3xl">{{ data.totalPost }} <span class="text-green-500"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Total Users</h2>
                                    <p class="font-bold text-3xl">{{ data.totalUsers }} <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Total Comments</h2>
                                    <p class="font-bold text-3xl">{{ data.totalComments }} <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>


                <div class="flex flex-row flex-wrap flex-grow mt-2">
                    <div class="w-full p-6">
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
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <template v-for="(data, i) in posts">
                                    <tr>
                                        <td>{{data.title}}</td>
                                        <td>{{data.user.name}}</td>
                                        <td>{{data.status}}</td>
                                        <td>{{data.comments_count}}</td>
                                        <td>{{data.published_date}}</td>
                                    </tr>
                                    </template>
                                    </tbody>
                                </table>

                                <p class="py-2"><router-link to="/admin/posts" >See More Posts...</router-link></p>

                            </div>
                        </div>
                    </div>

                <!-- <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h2 class="font-bold uppercase text-gray-600">Advert</h2>
                        </div>
                        <div class="p-5 text-center">


                        </div>
                    </div>
                </div> -->

                </div>
            </div>
        </section>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useStore } from 'vuex';
const store = useStore()
const posts = ref([])
const data = reactive({
    totalPost: 0,
    totalUsers: 0,
    totalComments: 0,
})
store.dispatch('getDashboard')
.then(res => {
    posts.value = res.posts
    data.totalPost = res.posts_count;
    data.totalUsers = res.user_count
    data.totalComments = res.comment_count
})
</script>

<style>
@media(min-width: 768px) {
    .main-content {
        height: 100%;
        min-width: 110px;
    }
}

</style>