<script setup>
defineProps({
  name: String
})
</script>

<template>
  <div class="container mt-5 text-center">
    <h1 class="text-primary">Hello, {{ name }} 🎉</h1>
  </div>
</template>
