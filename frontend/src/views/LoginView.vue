<template>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-primary text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <form v-on:submit="loginCheck" class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Todo App</h2>
                <p class="text-white-50 mb-5">Please enter your email and password!<br>
                  <span class="text-danger" id="incorrectCombination"></span>
                </p>


                <div class="form-outline form-white mb-4">
                  <input type="email" id="email" v-model="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" id="password" v-model="password" class="form-control form-control-lg" />
                  <label class="form-label" for="password">Password</label>
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                <button class="btn btn-outline-light btn-lg px-5">Login</button>

              </form>

              <div>
                <p class="mb-0">Don't have an account? <a href="/create-user" class="text-white-50 fw-bold">Sign Up</a>
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

  export default {
    name:'Login',
    data(){
      return {user:'', email:'', password:'', jwt:''}
    },
    mounted() {

    },
    methods:{
      loginCheck(){
        event.preventDefault();
        axios.post('http://localhost:250/api/v1/users/login_check', {"username":this.email, "password":this.password})
            .then((response => {
              event.preventDefault();
              this.jwt = response.data['token'];
              localStorage.jwt = this.jwt;
              this.$router.push('home');
            })).catch( error => {
              let alertMessage = document.getElementById('incorrectCombination');
              alertMessage.innerText = 'Incorrect email and password combination, please try again.';
            }
        )
      }
    }

  }
</script>
