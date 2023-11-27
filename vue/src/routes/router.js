import { createRouter, createWebHistory } from 'vue-router';
import LoginComponent from "../components/Login.vue";
import HomeComponent from "../components/Home.vue";


const routes = [
  {path: '/', component: LoginComponent},
  {path: '/home', component: HomeComponent}
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;