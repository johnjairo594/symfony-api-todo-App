<template>
  <navbar/>
  <router-link :to="{path:'create-todo'}" class="btn btn-info w-10 m-3">Create Todo</router-link>
  <div class="container-fluid justify-content-center m-0 p-0 vw-100 row">
    <div v-for="todo in todos" :key="todo.id" class="card border-dark p-0 m-3" style="max-width: 18rem;">
      <div class="card-header card-title bg-primary text-white">{{todo.name}}</div>
      <div class="card-body text-dark">
        <p class="card-text">{{todo.description}}</p>
        <div class="text-center">
          <button v-on:click="complete(todo.id, todo.done)" v-if="todo.done" class="btn btn-success"><p class="d-inline">Done</p></button>
          <button v-on:click="complete(todo.id, todo.done)" v-else class="btn btn-warning"><p class="d-inline">Pending</p></button>
          <router-link :to="{path:'edit-todo/'+todo.id}" class="mx-1 btn btn-warning border"><i class="fa-regular fa-pen-to-square"></i></router-link>
          <button v-on:click="this.delete(todo.id)" class="btn btn-danger border"><i class="fa-solid fa-trash"></i></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import navbar from "@/components/navbar.vue";
import jwtDecode from "jwt-decode";
import {deleteConfirm, showAlert} from "@/utils";

export default {
  name:'home',
  components:{
    navbar
  },
  data(){
    return{todos:null, user:null, name:'', description:'', completed:'', userId:''}
  },
  mounted() {
    this.getUserTodos();
  },
  methods:{
    getUserTodos(){
      let jwt = localStorage.jwt
      let id = jwtDecode(jwt)['id'];
      axios.get('http://localhost:250/api/v1/users/'+id,
        {headers:{Authorization: 'Bearer '+jwt}})
          .then(response => {
            let array = response.data.toDos
            this.todos = []
            for (let item of array) {
              axios.get('http://localhost:250'+item,
                  {headers:{Authorization: 'Bearer '+jwt}})
                  .then(response => {
                    this.todos.push(response.data)
                  })
            }
          })
    },
    delete(id){
      deleteConfirm(id);
    },
    complete(id, completed){
      axios.put('http://localhost:250/api/v1/to_dos/'+id,
          {done:!completed},
          {headers:{Authorization: 'Bearer '+localStorage.jwt}})
          .then(
              response => {
                this.getUserTodos();
                console.log(response.data);
                // window.setTimeout(function (){
                //   window.location.href = '/home'
                // }, 1000)
              }
          )
    }
  }
  }

</script>
