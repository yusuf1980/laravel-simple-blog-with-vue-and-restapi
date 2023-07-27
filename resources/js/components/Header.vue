<template>
<div>
    <nav class="w-full py-4 mt-5 bg-green-500 shadow rounded-full">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
            <nav-header-left>
                <li><router-link class="hover:text-gray-200 hover:underline px-4" to="/">Home</router-link></li>
                <li><router-link class="hover:text-gray-200 hover:underline px-4" to="/about">About</router-link></li>
                <li v-if="store.getters.loggedIn"><router-link class="hover:text-gray-200 hover:underline px-4" to="/admin">Dashboard</router-link></li>
            </nav-header-left>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <router-link to="/login" v-if="!store.getters.loggedIn" class="pl-6">Sign In</router-link>
                <router-link to="/register" v-if="!store.getters.loggedIn" class="pl-6">Sign Up</router-link>
            </div>
        </div>

    </nav>

    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <router-link class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" to="/">
                PandaiSuite Blog
            </router-link>
            <!-- <p class="text-lg text-gray-600">
                Lorem Ipsum Dolor Sit Amet
            </p> -->
        </div>
    </header>

    <nav class="w-full py-0 border-t border-b bg-gray-100" x-data="{ open: false }">
        <!-- <div class="block sm:hidden">
            <a
                href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open"
            >
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div> -->
        <!-- <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Technology</a>
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Automotive</a>
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Finance</a>
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Politics</a>
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Culture</a>
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Sports</a>
            </div>
        </div> -->
    </nav>
</div>
        
</template>

<script setup>
import {ref} from 'vue'
import NavHeaderLeft from './NavHeaderLeft.vue';
import { useStore } from 'vuex';

const store = useStore()
const open = ref(false)
</script>