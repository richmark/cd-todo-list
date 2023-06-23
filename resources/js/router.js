import { createRouter, createWebHistory } from "vue-router";

import Index from './components/Index.vue';
import TodoList from './components/TodoList.vue';

const routes = [
    { path: '/index', name: 'Index', component: Index },
    { path: '/list/all', name: 'TodoList', component: TodoList }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
