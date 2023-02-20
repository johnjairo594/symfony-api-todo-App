<template>
  <nav class="navbar navbar-expand bg-primary">
    <a class="navbar-brand mx-2" href="/home">Symfony Todo App</a>
    <div class="container-fluid">

      <div class='collapse navbar-collapse flex justify-content-between'>
        <ul class="navbar-nav mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Create Todo</a>
          </li>
          <li class="nav-item dropdown">
          </li>
        </ul>
        <div>
          <i class="fa-solid fa-user mx-2"></i>
          <a class="mx-2 nav-link d-inline" href="#">Log out</a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "navbar"
}
</script>

<style scoped>

</style>