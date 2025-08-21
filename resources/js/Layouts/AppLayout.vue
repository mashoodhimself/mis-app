<script setup>
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Footer from '@/Components/Footer.vue'
</script>

<template>
  
    <Navbar />
    <Sidebar />

    <main class="content-wrapper">
      <slot /> 
    </main>

    <Footer />

</template>
