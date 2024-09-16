import { createStore } from 'vuex'
import axios from 'axios'

const store = createStore({
  state() {
    return {
      isAuthenticated: false,
      token: null,
      user: null
    }
  },
  mutations: {
    clearState(state) {
      state.isAuthenticated = false
      state.token = null
      state.user = null
    },
    setAvatar(state, url) {
      if (state.user?.avatar) {
        state.user.avatar = url
      }
    },
    SET_USER(state, user) {
      state.user = user
    },
    SET_TOKEN(state, token) {
      state.token = token
      state.isAuthenticated = !!token
    }
  },
  actions: {
    async login({ commit }, { email, password }) {
      console.log(email, password)
      try {
        const response = await axios.post(
          '/api/vue/login',
          {
            email,
            password
          },
          {
            withCredentials: true
          }
        )

        const { token, user } = response.data

        console.log(token, user)

        commit('SET_TOKEN', token)
        commit('SET_USER', user)

        localStorage.setItem('token', token)

        return true
      } catch (error) {
        console.error('Ошибка при входе:', error)
        return false
      }
    },
    async register({ commit }, { email, name, password }) {
      try {
        const response = await axios.post('/api/vue/register', {
          email,
          name,
          password
        })

        const { token, user } = response.data
        console.log(token, user)
        commit('SET_TOKEN', token)
        commit('SET_USER', user)

        localStorage.setItem('token', token)

        return true
      } catch (error) {
        console.error('Ошибка при регистрации:', error)
        return false
      }
    },
    logout({ commit }) {
      commit('clearState')
      localStorage.removeItem('token')
    },
    async fetchUser({ commit }, { token }) {
      try {
        const response = await axios.get('/api/vue/user', {
          headers: {
            Authorization: `Bearer ${token}`
          },
          withCredentials: true
        })

        const user = response.data
        console.log(user)
        commit('SET_USER', user)
        commit('SET_TOKEN', token)

        return true
      } catch (error) {
        console.error('Ошибка при получении пользователя:', error)
        return false
      }
    }
  },
  getters: {
    isAuthenticated: (state) => state.isAuthenticated,
    user: (state) => state.user,
    token: (state) => state.token
  }
})

export default store
