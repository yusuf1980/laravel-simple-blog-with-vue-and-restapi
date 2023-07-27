<template>
<div class="bg-white-800 font-sans leading-normal tracking-normal mt-12 ">
    <HeaderAdmin />
    <main>
    <div class="container items-center justify-between mx-auto max-w-5xl">
    <div class="flex flex-col">
        <!-- <AdminNav /> -->
        <router-view></router-view>
    </div>
    </div>
    </main>
</div>
</template>

<script setup>
import HeaderAdmin from './HeaderAdmin.vue'    
import AdminNav from './AdminNav.vue' 
</script>