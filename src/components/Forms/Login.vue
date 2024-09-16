<script setup>
import { ref, computed, watch } from 'vue'
import store from '../../store/store'
import router from '../../router'
import { useToast } from 'vue-toast-notification'

const isAuthenticated = computed(() => store.getters.isAuthenticated)
watch(isAuthenticated, (Authenticated) => {
  if (Authenticated) {
    router.push('/')
  }
})

const $toast = useToast()
const login = ref('')
const password = ref('')

const signIn = () => {
  if (login.value && password.value) {
    store.dispatch('login', { email: login.value, password: password.value })
  } else {
    $toast.warning('Ошибка')
  }
}
</script>

<template>
  <form>
    <v-text-field label="Email" variant="solo" v-model="login"></v-text-field>
    <v-text-field label="Пароль" type="password" variant="solo" v-model="password"></v-text-field>
    <v-btn @click="signIn">Войти</v-btn>
  </form>
</template>
