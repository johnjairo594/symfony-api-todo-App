import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from "@/views/LoginView.vue";
import CreateTodoView from "@/views/CreateTodoView.vue";
import EditTodoView from "@/views/EditTodoView.vue";
import UserCreateView from "@/views/UserCreateView.vue";

const routes = [
  {
    path: '/',
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
    path: '/edit-todo/:id',
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

router.beforeEach(async(to)=>{
  const publicPages = ['/login', '/create-user'];
  const authRequired = !publicPages.includes(to.path);

  if (authRequired && !localStorage.jwt){
    to.fullPath
    return '/login'
  }

  if (!authRequired && localStorage.jwt){
    to.fullPath
    return '/'
  }
})

export default router
