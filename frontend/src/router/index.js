import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from "@/views/LoginView.vue";
import CreateTodoView from "@/views/CreateTodoView.vue";
import EditTodoView from "@/views/EditTodoView.vue";
import UserCreateView from "@/views/UserCreateView.vue";

const routes = [
  {
    path: '/home',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
    },
  {
    path: '/create-todo',
    name: 'create-todo',
    component: CreateTodoView
  },
  {
    path: '/edit-todo',
    name: 'edit-todo',
    component: EditTodoView
  },{
    path: '/create-user',
    name: 'create-use',
    component: UserCreateView
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
