<template>
  <v-row justify="center">
    <v-dialog v-model="this.useTodo.showDetail" persistent width="1024">
      <v-card>
        <v-card-title>
          <span class="text-h5">Update Todo</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Title"
                  v-model="this.useTodo.detail.title"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Description"
                  v-model="this.useTodo.detail.description"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-select
                label="Select"
                v-model="this.useTodo.detail.status"
                :items="['done', 'todo']"
                ></v-select>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="this.useTodo.showDetail = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="save"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { useTodoStore } from "../stores/TodoStore";

export default {
  name: "TodoDetail",
  props: {
    detail: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {
      useTodo: useTodoStore(),
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10)
    };
  },
  methods: {
    save() {
        this.useTodo.showDetail = false;
        this.useTodo.updateTodo();
    }
  }
};
</script>
