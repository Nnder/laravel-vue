<script setup>
import { computed } from 'vue'
import store from '../store/store'
import Image from '../components/Forms/Image.vue'

const isAuthenticated = computed(() => store.getters.isAuthenticated)
const user = computed(() => store.getters.user)
</script>

<template>
  <main
    v-if="isAuthenticated && user"
    style="display: flex; align-items: center; flex-direction: column"
  >
    <h1>{{ user?.name || 'Имя не задано' }}</h1>
    <h1>{{ user?.email || 'Почта не задана' }}</h1>
    <Image />
  </main>
  <main v-else>
    <h1>Вы не авторизованы</h1>
  </main>
</template>
