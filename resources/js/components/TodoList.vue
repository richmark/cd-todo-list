<template>
  <div class="left-identation">
    <label for="count">Total Count: {{ this.useTodo.count }}</label>
    <button
      :disabled="this.useTodo.count === 0"
      style="float: right"
      type="button"
      class="btn btn-warning"
      @click="deleteTodo"
    >
      <i class="bi bi-trash"></i> Delete
    </button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="this.useTodo.count === 0" class="center">
            <td colspan="5">No records found.</td>
        </tr>
        <tr v-for="(item, index) in this.useTodo.list" :key="item.id">
          <th scope="row">
            <input
              type="checkbox"
              :value="item.todo_id"
              v-model="this.useTodo.checkedTodos"
            />
          </th>
          <th scope="row">{{ index + 1 }}</th>
          <td class="title" @click="openModal(item)">{{ item.title }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.status }}</td>
        </tr>
      </tbody>
    </table>
    <v-app>
        <v-pagination
        v-model="this.useTodo.page"
        :length="this.useTodo.total_page"
        :total-visible="5"
        prev-icon="bi bi-arrow-left"
        next-icon="bi bi-arrow-right"
        @update:modelValue="handlePageSelect"
        ></v-pagination>
    </v-app>
    <TodoDetail v-if="this.useTodo.showDetail"/>
  </div>
</template>

<script>
import { useTodoStore } from "../stores/TodoStore";
import TodoDetail from "./TodoDetail.vue";

export default {
  name: "Index",
  components: { TodoDetail },
  data() {
    return {
      useTodo: useTodoStore(),
    };
  },
  mounted() {
    this.useTodo.getTodo();
    this.useTodo.getTodoCount();
  },
  methods: {
    handlePageSelect() {
      this.useTodo.getTodo();
    },
    deleteTodo() {
      this.useTodo.deleteTodo();
    },
    openModal(oDetail) {
      this.useTodo.detail = {...oDetail};
      this.useTodo.showDetail = true;
    }
  },
};
</script>

<style scoped>
.left-indentation {
  padding-left: 9% !important;
}
a {
  cursor: pointer;
}
.center {
    text-align: center;
}
.title {
    cursor: pointer;
    text-decoration: underline;
}
</style>