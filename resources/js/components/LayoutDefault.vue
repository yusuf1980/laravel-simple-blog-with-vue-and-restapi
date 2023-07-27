<template>
<div class="mx-auto max-w-3xl px-4 sm:px-6 xl:max-w-5xl xl:px-0">
    <div class="flex h-screen flex-col justify-between">
        <Header></Header>
            <router-view></router-view>
        <Footer></Footer>
    </div>
</div>
</template>

<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
</script>