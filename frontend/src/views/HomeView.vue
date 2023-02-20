<template>
  <navbar/>
  <button class="btn btn-info w-10 d-block m-3">Create Todo</button>
  <div class="container-fluid justify-content-center m-0 p-0 vw-100 row">
    <div v-for="todo in todos" :key="todo.id" class="card border-dark m-3" style="max-width: 18rem;">
      <div class="card-body text-dark">
        <h5 class="card-title w-100">{{todo.name}}</h5>
        <p class="card-text">{{todo.description}}</p>
        <div class="text-center">
          <button v-if="todos.done" class="btn btn-success"><p class="d-inline">Done</p></button>
          <button v-else class="btn btn-warning mx-1"><p class="d-inline">Pending</p></button>
          <button class="btn btn-success border"><i class="fa-solid fa-eye"></i></button>
          <button v-on:click="editTodo(todo.name, todo.description)" class="mx-1 btn btn-warning border"><i class="fa-regular fa-pen-to-square"></i></button>
          <button class="btn btn-danger border"><i class="fa-solid fa-trash"></i></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import navbar from "@/components/navbar.vue";
import jwtDecode from "jwt-decode";
import {editTodo} from "@/utils";

export default {
  name:'home',
  components:{
    navbar
  },
  data(){
    return{todos:null, user:null, name:'', description:'', completed:false, userId:''}
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

  }
  }

</script>
