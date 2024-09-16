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
const name = ref('')
const password = ref('')
const passwordRepeat = ref('')

const signUp = () => {
  if (
    login.value &&
    name.value &&
    password.value &&
    passwordRepeat.value &&
    password.value == passwordRepeat.value
  ) {
    store.dispatch('register', { email: login.value, name: name.value, password: password.value })
  } else {
    $toast.warning('Ошибка')
  }
}
</script>

<template>
  <form>
    <v-text-field label="Email" variant="solo" v-model="login"></v-text-field>
    <v-text-field label="Имя" variant="solo" v-model="name"></v-text-field>
    <v-text-field label="Пароль" type="password" variant="solo" v-model="password"></v-text-field>
    <v-text-field
      label="Повторите пароль"
      type="password"
      variant="solo"
      v-model="passwordRepeat"
    ></v-text-field>
    <v-btn @click="signUp">Зарегистрироваться</v-btn>
  </form>
</template>
