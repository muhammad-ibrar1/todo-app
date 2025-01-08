<template>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Todo List</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="addTask" class="card p-4 shadow-sm">
                    <h4 class="card-title text-center">Add New Task</h4>
                    <div class="mb-3">
                        <label for="task" class="form-label">Task</label>
                        <input 
                            v-model="newTask.task" 
                            id="task" 
                            type="text" 
                            class="form-control" 
                            placeholder="Enter task name" 
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input 
                            v-model="newTask.description" 
                            id="description" 
                            type="text" 
                            class="form-control" 
                            placeholder="Enter task description" 
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Task</button>
                </form>
            </div>
        </div>

       
        <div class="mt-4">
            <h3 class="text-center">Task List</h3>
            <div class="list-group">
                <ul class="list-group">
                    <li v-for="task in tasks" :key="task.id" class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ task.task }}</strong>: {{ task.description }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { mapState, mapActions } from 'vuex';

export default {
    data() {
        return {
            newTask: {
                task: '',
                description: '',
            },
        };
    },
    computed: {
        ...mapState(['tasks']), 
    },
    methods: {
        ...mapActions(['fetchTasks']), 
        async addTask() {
            if (this.newTask.task && this.newTask.description) {
                try {
                   
                    const response = await axios.post('/api/tasks', this.newTask);
                    this.fetchTasks();
                    
                    this.newTask = { task: '', description: '' };
                } catch (error) {
                    console.error('Error adding task:', error);
                }
            } else {
                alert('Both task and description are required.');
            }
        },
    },
    mounted() {
        this.fetchTasks();
    },
};
</script>

<style scoped>
/* Custom styles */
.container {
    max-width: 800px;
}

h1, h3 {
    color: #5A5A5A;
}

.card {
    background-color: #f8f9fa;
}

.card-title {
    font-size: 1.25rem;
}

.list-group-item {
    background-color: #f9f9f9;
    border-radius: 5px;
    margin-bottom: 10px;
}

.list-group-item button {
    font-size: 0.9rem;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}
</style>
