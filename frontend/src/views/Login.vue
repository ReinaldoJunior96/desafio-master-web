<template>
  <section class="bg-gradient-to-r from-cyan-500 to-blue-500 animate__backInLeft">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <i class="fa-solid fa-code w-8 mr-2"></i>
        Desafio - Master Web
      </a>
      <div
          class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Acesse sua conta para gerar o token JWT
          </h1>
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
            <input v-model="this.usuario" type="email" name="email" id="email"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required="">
          </div>
          <div>
            <label for="password"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
            <input v-model="this.senha" type="password" name="password" id="password" placeholder="••••••••"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required="">
          </div>

          <button @click="realizarLogin"
                  class="w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-800 hover:to-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Entrar
          </button>
          <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
            Copyright 2023 - Master da Web

          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import 'animate.css';

export default {
  data() {
    return {
      usuario: 'admin@gmail.com',
      senha: '123'
    }
  },
  methods: {
    realizarLogin() {
      axios.post('http://127.0.0.1:8000/api/auth/login', {
        'email': this.usuario,
        'password': this.senha
      }).then((response) => {
        if (response.data.access_token) {
          localStorage.setItem('jwt', response.data.access_token)
          this.$router.push({name: 'realizar-pedido', query: {redirect: '/realizar-pedido'}});
        }
      })
    }
  }
}
</script>