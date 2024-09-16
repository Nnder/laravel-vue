<script setup>
import store from '../../store/store'
import axios from 'axios'
import { ref, computed } from 'vue'

const img = ref()
const imageUrl = computed(() => {
  const url = import.meta.env.VITE_BACKEND_URL
  return `${url}/${store.getters.user?.avatar || 'images/default.svg'}`
})

const uploadImage = () => {
  const formData = new FormData()
  formData.append('avatar', img.value)
  formData.append('email', store.getters.user.email)

  axios
    .post('/api/vue/avatar', formData)
    .then((response) => {
      console.log(response)
      store.commit('setAvatar', response.data.url)
    })
    .catch((error) => {
      console.error(error)
    })
}
</script>

<template>
  <form style="display: flex; align-items: center; flex-direction: column; width: 300px">
    <img :src="imageUrl" alt="Картинка" width="150px" />
    <v-file-input
      label="Выбрать картинку"
      variant="solo"
      style="width: 100%; margin-top: 8px"
      v-model="img"
    ></v-file-input>
    <v-btn @click.prevent="uploadImage">Обновить картинку</v-btn>
  </form>
</template>
