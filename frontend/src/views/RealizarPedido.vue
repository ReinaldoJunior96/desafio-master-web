<script>
import axios from 'axios';
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      produtos: [],
      inputBusca: '',
      produtosEscolhidos: [],
      carrinho: [],
      usuarioNome: '',
      emailUsuario: ''
    }
  },
  created() {
    axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("jwt");

    const self = this;

    axios.get('http://127.0.0.1:8000/api/all').then(function (response) {
      self.produtos = self.produtos.concat(response.data)
    })
    axios.post('http://127.0.0.1:8000/api/auth/me').then(function (response) {
      self.usuarioNome = response.data.name
      self.emailUsuario = response.data.email
    })


  },
  methods: {
    adicionarProdutoAoCheckOut(produto) {
      this.produtosEscolhidos.push(produto)
    },
    fecharPedido() {
      self = this
      axios.post('http://127.0.0.1:8000/api/cadastrar', {
        data: {
          user_id: 1,
          produtos: this.carrinho
        },
      }).then(function (response) {
        self.produtosEscolhidos = []
        Swal.fire({
          title: 'Sucesso!',
          text: 'Seu pedido foi processado com sucesso',
          icon: 'success',
          confirmButtonText: 'Fechar'
        })
      })


    },
    logout() {
      axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("jwt");
      axios.post('http://127.0.0.1:8000/api/auth/logout').then((response) => {
        this.$router.push({name: 'login', query: {redirect: '/'}});
      })
    },
    excluirPedido(produto) {
      const index = this.produtosEscolhidos.indexOf(produto)
      if (index > -1) {
        this.produtosEscolhidos.splice(index, 1);
      }
    },

  },
  computed: {
    buscarProdutos() {
      return this.produtos.filter((produto) => {
        return this.inputBusca.toLowerCase().split(' ').every(v => produto.produto.toLowerCase().includes(v));
      });
    },
    produtosChekcout() {
      const ocorrencias = this.produtosEscolhidos.reduce((acc, curr) => {
        return acc[curr] ? ++acc[curr] : acc[curr] = 1, acc
      }, {});
      this.carrinho  =  ocorrencias
      return ocorrencias
    },


  }
}
</script>

<template>
  <div class="flex flex-col items-center justify-start bg-gradient-to-r from-cyan-500 to-blue-500 h-screen pt-10 ">


    <div class="">
      <a href="#"
         class="logo flex flex-col sm:flex-row text-center  items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <i class="fa-solid fa-code w-8 mr-2"></i>
        Desafio - Master Web / Realizar pedido
      </a>
    </div>

    <div
        class="flex items-center justify-start gap-5  w-full sm:w-1/2  p-3  dark:bg-gray-800 dark:border-gray-700 rounded shadow py-8">
      <div class="">
        <img width="100"
             src="https://api.dicebear.com/5.x/open-peeps/svg?seed=Mimi"
             alt="avatar" class="rounded-full shadow bg-white"/>
      </div>
      <div class="text-white flex flex-col gap-1 ">
        <p><span class="font-medium text-lg">Usuário:</span> {{ this.usuarioNome }}</p>
        <p><span class="font-medium text-lg">E-mail:</span> {{ this.emailUsuario }}</p>
        <hr>
        <p class="cursor-pointer pt-2" @click="logout()"><i class="fa-solid fa-power-off"></i> Sair </p>

      </div>


    </div>

    <section class="bg-white w-full sm:w-1/2 rounded mt-5">
      <div class="relative ">
        <form class="  px-8 pt-6  mb-4 ">
          <div class="mb-4">
            <label class="block text-gray-500 text-xl font-bold mb-2" for="searchProduto">
              Buscar produto
            </label>
            <input v-model="inputBusca"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="searchProduto" type="text" placeholder="Informe o nome do produto...">
          </div>
          <div class="absolute z-50 top-[95px] bg-white shadow w-11/12 rounded px-3 border-t-0 bg-gray-100 ">
            <div v-if="this.inputBusca !== '' " v-for="p in this.buscarProdutos" :key="p.id">
              <div class="flex items-center justify-between gap-3 py-1 border-b-2">
                <p>{{ p.produto }}</p>
                <i @click="this.adicionarProdutoAoCheckOut(p.produto)"
                   class="fa-solid fa-square-plus text-emerald-400 cursor-pointer"></i>

              </div>


            </div>

          </div>
        </form>

        <div class="flex justify-between  center px-8 ">

          <div class="">
            <h2 class="text-gray-500 font-bold mb-3">Confirme os produtos selecinados</h2>
            <small v-if="this.produtosEscolhidos.length === 0 " class="opacity-60">Nenhum produto adicionado ao carrinho*</small>
            <ul>
              <li class="flex items-center justify-between gap-5 text-gray-600 py-2"
                  v-for="(e, index) in this.produtosChekcout">
                <span
                    class=" font-bold text-lgbg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-purple-400 border border-purple-400">{{ `${e}x` }}</span>
                <span class="text-lg font-medium bg-gray-100 text-white text-xs font-medium mr-2 px-4 py-1 rounded dark:bg-gray-700  border border-gray-500 ">{{ `${index} ` }}</span>

                <i @click="excluirPedido(index)" class="fa-solid fa-trash text-red-500 cursor-pointer"></i>
              </li>
            </ul>
          </div>

        </div>
      </div>
      <div class="flex justify-center py-5">
        <button @click="fecharPedido()"
                class="xl:w-3/12 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-800 hover:to-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          <i class="fa-solid fa-cart-shopping"></i>
          Fechar pedido
        </button>
      </div>

    </section>
  </div>

</template>

<style>

</style>
