<template>
  <div>
    <form>
      <div class="row mb-3">
        <label for="title" class="col-sm-2 col-form-label left-indentation"
          >Title:
        </label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="title" v-model="useTodo.title"/>
        </div>
      </div>
      <div class="row mb-3">
        <label
          for="description"
          class="col-sm-2 col-form-label left-indentation"
          >Description:
        </label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="description" v-model="useTodo.description"/>
        </div>
      </div>
      <button style="color:white" type="submit" class="btn btn-primary left-button-margin" @click.prevent="useTodo.createTodo">
        Submit
      </button>
    </form>
    <div class="text-center ma-2">
    <v-snackbar
      v-model="useTodo.snackbar"
    >
      {{ useTodo.text }}

      <template v-slot:actions>
        <v-btn
          color="green"
          variant="text"
          @click="useTodo.snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </div>
  </div>
</template>

<script>
import { useTodoStore } from "../stores/TodoStore";

export default {
  name: "Index",
  data() {
    return {
      useTodo: useTodoStore(),
    };
  },
};
</script>

<style scoped>
.left-indentation {
  padding-left: 9% !important;
}
.left-button-margin {
  margin-left: 8%;
}
</style>