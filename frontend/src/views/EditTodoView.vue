<template>
  <navbar/>
  <form v-on:submit="saveTodo(this.todoName, this.todoDescription)" class="row card border-dark m-auto mt-5" style="max-width: 18rem;">
  <div class="card-header card-title bg-primary text-white text-center" >Edit todo</div>
      <div class="card-body text-dark">
        <p class="card-text m-0"><label for="todoName">Edit Todo name</label></p>
        <input v-model="todoName" class="input-group" type="text" id="todoName">
        <p class="card-text m-0 mt-2"><label for="todoDescription">Edit todo description</label></p>
        <input v-model="todoDescription" class="input-group" type="text" id="todoDescription">
        <div class="row justify-content-center gap-2 mt-2">
          <router-link :to="{path:'/home'}" class="btn btn-danger col-auto"><p class="d-inline">Cancel</p></router-link>
          <button class="btn btn-success col-auto"><p class="d-inline">Save</p></button>
        </div>
      </div>
  </form>
</template>

<script>
import {showAlert} from "@/utils";
import Navbar from "@/components/navbar.vue";
import {useRoute} from "vue-router";
import axios from "axios";
import HomeView from "@/views/HomeView.vue";
export default {
  name: "EditTodoView",
  computed: {
    HomeView() {
      return HomeView
    }
  },
  components: {Navbar},
  data(){
    return{
      todoId:'', todoName:'', todoDescription:'', url:'http://localhost:250/api/v1/to_dos/'
    }
  },
  mounted() {
    const route = useRoute();
    this.todoId = route.params.id;
    this.url = this.url+this.todoId;
    this.getTodo();
  },
  methods:{
    getTodo(){
      axios.get(this.url,
          {headers:{Authorization: 'Bearer '+localStorage.jwt}})
          .then(
          response => {
            this.todoName = response.data['name']
            this.todoDescription = response.data['description']
          }
      )
    },
    saveTodo(todoName, todoDescription){
      event.preventDefault();
      if (this.todoName.trim() === ''){
        showAlert('Name cannot be blank', 'warning')
      }
      else if (this.todoDescription.trim() === ''){
        showAlert('Description cannot be blank', 'warning')
      } else {
        axios.put(this.url,
            {name:todoName, description:todoDescription},
            {headers:{Authorization: 'Bearer '+localStorage.jwt}})
            .then(
                response => {
                  showAlert('Todo edited', 'success');
                  window.setTimeout(function (){
                    window.location.href = '/home'
                  }, 1000)
                }
            )
      }
    }
  }
}
</script>

<style scoped>

</style>