<script setup>
import Register from '../components/Forms/Register.vue'
import store from '../store/store'
</script>

<template>
  <Register />
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
