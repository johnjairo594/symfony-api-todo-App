<template>
  <navbar/>
  <form v-on:submit="createTodo(this.todoName, this.todoDescription)" class="row card border-dark m-auto mt-5" style="max-width: 18rem;">
      <div class="card-header card-title bg-primary text-white text-center">Create todo</div>
      <div class="card-body text-dark">
        <p class="card-text m-0"><label for="todoName">Name</label></p>
        <input v-model="todoName" class="input-group" type="text" id="todoName">
        <p class="card-text m-0 mt-2"><label for="todoDescription">Description</label></p>
        <input v-model="todoDescription" class="input-group mb-2" type="text" id="todoDescription">
        <div class="row justify-content-center gap-2 mt-2">
          <router-link :to="{path:'/'}" class="btn btn-danger col-auto"><p class="d-inline">Cancel</p></router-link>
          <button class="btn btn-success col-auto"><p class="d-inline">Save</p></button>
        </div>
      </div>
    </form>
<!--  </div>-->
</template>

<script>
import Navbar from "@/components/navbar.vue";
import axios from "axios";
import {showAlert} from "@/utils";
export default {
  name: "CreateTodoView",
  components: {Navbar},
  data(){
    return {todoName:'', todoDescription:''}
  },
  methods:{
    createTodo(name, description){
      event.preventDefault();
      if (this.todoName.trim() === ''){
        showAlert('Name cannot be blank', 'warning')
      }
      else if (this.todoDescription.trim() === ''){
        showAlert('Description cannot be blank', 'warning')
      } else {
        axios.post('http://localhost:250/api/v1/user/add-todo',
            {name: name, description: description},
            {headers: {Authorization: 'Bearer ' + localStorage.jwt}})
            .then(response => {
              showAlert('Todo created', 'success');
              window.setTimeout(function (){
                window.location.href = '/'
              }, 1000)
            })
      }
    }
  }

}
</script>

<style scoped>

</style>