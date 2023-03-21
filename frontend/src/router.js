import {createRouter, createWebHistory} from 'vue-router'
import Login from './views/Login.vue'
import RealizarPedido from './views/RealizarPedido.vue'

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/realizar-pedido',
        name: 'realizar-pedido',
        component: RealizarPedido
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router