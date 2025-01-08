import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
    state: {
        tasks: [],
    },
    mutations: {
        SET_TASKS(state, tasks) {
            state.tasks = tasks;
        },
    },
    actions: {
        async fetchTasks({ commit }) {
            const response = await axios.get('/api/tasks');
            commit('SET_TASKS', response.data);
        },
    },
});
