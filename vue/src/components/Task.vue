<template>
    <div class="list-tasks">
        <div class="items">
            <ul class="tasks">
                <li class="task" v-for="task in data" :key="task.id">
                    <input @change="$e => changeType(task.id)" type="checkbox" class="new-task" :checked="task.is_finished">
                    <span class="task-title" :style="{ 'text-decoration' : task.is_finished ? 'line-through' : 'none'}">
                        {{ task.title }}
                    </span>
                    <button @click="deleteTask(task.id)" class="btn-del">
                        <font-awesome-icon class="icon" icon="fa-solid fa-trash" />
                    </button>
                    <span class="task-due-date">{{ task.due_date }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { changeType, destroyTask } from "../api/api.js";

export default {
    name: 'TaskItem',
    props: {
        data: {
            type: Array,
            required: true
        }
    },
    methods: {
        async changeType(id) {
            const res = await changeType(id);

            if(!res.error){
                this.$emit('updateTasks');
            }
        },
        async deleteTask (id) {
            const res = await destroyTask(id);

            if(!res.error){
                this.$emit('updateTasks');
            }
            
        }
    }
}
</script>

<style scoped>
.list-tasks {
    width: 75%;
    margin: 0rem auto;
    padding: 2rem;
}

.items {
    text-align: left;
    font-size: 22px;
}

.task {
    list-style: none;
    height: 4rem;
    margin-top: 0.5rem;
}

.new-task {
    display: inline;
    width: 15rem;
    height: 1.5rem;
}

.task-title {
    /* float: left; */
    margin-left: 2rem;
    margin-top: 0.5rem;
}

.task-due-date {
    display: inline;
    margin-right: 2rem;
    float: right;
    color: #e58e26;
    margin-top: 0.5rem;
}

.btn-del {
    width: 3rem;
    height: 3rem;
    margin-right: 13rem;
    border: none;
    background-color: #fff;
    float: right;
    cursor: pointer;
}

input[type="checkbox"] {
    appearance: none;
    display: inline-block;
    width: 2rem;
    height: 2rem;
    border: 1px solid #bcbcbc;
    cursor: pointer;
    float: left;
    margin-left: 10rem;
}

input[type="checkbox"]:checked {
  background-color: darkgreen;
}

.icon {
    font-size: 30px;
    margin: 0;
    color: #e58e26;
}</style>