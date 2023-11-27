<template>
    <HeaderVue :userName="user.name" />
    <section class="container">
        <div class="form-tasks">
            <h2 class="title-tasks">CRIE SUAS TAREFAS COM A DATA DE PRAZO</h2>
            <input type="text" id="title" v-model="dataTask.title">
            <input type="date" id="due_date" v-model="dataTask.due_date">

            <button @click="handleCreateTask" class="btn-send">CRIAR</button>
        </div>
        <div v-if="isCreateTaskError">
            <span style="color: red">{{ createTaskErrorMessage }}</span>
        </div>
        <TaskItem :data="tasks" @updateTasks="getTasks"/>
    </section>
</template>
  
<script>
import HeaderVue from './Header.vue';
import TaskItem from "./Task.vue";
import { createTask, getTaskByUserId } from "../api/api.js";

const storage = localStorage.getItem('user');
let user;

if (storage) {
    user = JSON.parse(storage);
} else {
    this.$router.push('/home');
}


export default {
    name: 'HomeComponent',
    components: {
        HeaderVue,
        TaskItem,
    },
    data() {
        return {
            tasks: [

            ],
            user,
            dataTask: {
                title: '',
                due_date: '',
                created_user_id: user.id
            },
            isCreateTaskError: false,
            createTaskErrorMessage: ""
        }
    },
    created() {
        this.getTasks();
    },
    methods: {
        async handleCreateTask() {
            this.isCreateTaskError = false;
            if (this.dataTask.due_date && this.dataTask.title) {
                const res = await createTask(this.dataTask);
                if(Object.prototype.hasOwnProperty.call(res, "errors")){
                    this.isCreateTaskError = true;
                    this.createTaskErrorMessage = res.message;
                }else{
                   this.tasks.unshift(res.data);
                }
            }
        },
        async getTasks (){
            const tasks = await getTaskByUserId(this.user.id);

            this.tasks = tasks.data;
        }
    }
}
</script>
  
<style scoped>
.container {
    margin-top: 3rem;
}

.form-tasks {
    width: 900px;
    margin: auto;
    text-align: center;
    padding: 1rem;
}

.title-tasks {
    font-weight: 100;
    font-size: 30px;
}

.title-tasks::after {
    display: block;
    height: 1px;
    background-color: #e58e26;
    content: " ";
    width: 220px;
    margin: 0 auto;
    margin-top: 10px;
    margin-bottom: 20px;
}

input {
    display: inline-block;
    width: 50%;
    margin: 0.6rem 1rem;
    padding: 0.7rem;
    border: 1px solid rgb(163, 160, 160);
    border-radius: 5px;
}

input[type="date"] {
    display: inline-block;
    width: 12rem;
    /* height: 2.5rem; */
    cursor: pointer;
}

.btn-send {
    height: 3rem;
    border: none;
    background-color: #fff;
    cursor: pointer;
    display: inline-block;
    text-decoration: none;
    padding: 0.5rem 20px;
    margin-top: 0.5rem;
    color: #636e72;
    border: 1.5px solid #feca57;
    border-radius: 7px;
    transition: background-color 0.2s, border 0.2s, color 0.2s;
}

.btn-send:hover,
.btn-send:active {
    background-color: #feca57;
    border: 1.5px solid #feca57;
    color: #636e72;
}


.btn-send:hover,
.btn-send:active {
    background-color: #feca57;
    border: 1.5px solid #feca57;
    color: #636e72;
}
</style>
  