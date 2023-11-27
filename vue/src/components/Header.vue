<template>
<div class="header-container">
    <span class="header-title">Equilibrium Web - Lista de Tarefas</span>
    &nbsp;&nbsp;&nbsp;
    <h3 class="header-user">
        Olá, {{ userName }}
    </h3>
</div>
</template>

<script>
export default {
    name: 'HeaderVue',
    props: {
        userName: String
    }
}
</script>

<style scoped>
.header-container {
  background-color: #feca57;
  color: #636e72;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  padding: 1.5em
}

.header-title {
    font-size: 30px;
    /* font-weight: bold; */
}
.header-user {
    color: #cd6133;
}
</style>