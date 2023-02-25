<template>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-primary text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <form v-on:submit="createUser()" class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Create account</h2>
                <p class="text-white-50 mb-5">Please enter your name, email and password!</p>

                <div class="form-outline form-white mb-4">
                  <input type="text" id="name" v-model="name" class="form-control form-control-lg" />
                  <label class="form-label" for="name">Name</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="email" id="email" v-model="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" id="password" v-model="password" class="form-control form-control-lg" />
                  <label class="form-label" for="password">Password</label>
                </div>
                <button class="btn btn-outline-light btn-lg px-5">Sign up</button>

              </form>

              <div>
                <p class="mb-0">Do you have an account? <a href="/login" class="text-white-50 fw-bold">Sign In</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import {showAlert} from "@/utils";
export default {
  name: "UserCreateView",
  data(){
    return {
      name:'', email:'', password:''
    }
  },
  methods:{
    createUser(){
      event.preventDefault();
      if (this.name.trim() === ''){
        showAlert('Name cannot be blank', 'error')
      } else if (this.password.trim() === ''){
        showAlert('Password cannot be blank', 'error')
      } else if (this.password.length < 6) {
        showAlert('Password must contain more than 6 characters')
      } else {
        axios.post('http://localhost:250/api/v1/users/register',
            {name: this.name, email: this.email, password: this.password})
            .then(function () {
              showAlert('Account created successfully', 'success')
              window.setTimeout(function (){
                window.location.href = '/login'
              }, 1000)})
      }
    }
  }
}
</script>

<style scoped>

</style>