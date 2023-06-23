import { defineStore } from "pinia";

let oInitial = {
    setInitialData: function () {
        return {
            list: {},
            pagination: {},
            count: 0,
            total_page: 0,
            page: 1,
            limit: 10,
            checkedTodos: [],
            showDetail: false,
            detail: {},
            snackbar: false,
            text: "Todo created successfully"
        }
    }
}
export const useTodoStore = defineStore('TodoStore', {
    state: () => {
        return oInitial.setInitialData();
    },
    actions: {
        createTodo() {
            let oTodo = {
                'title' : this.title,
                'description' : this.description
            };

            axios.post(`/rest/todos`, oTodo)
                .then(oResponse => {
                    this.snackbar = true;
                })
                .catch(oError => {
                    console.log(oError);
                });
        },
        getTodo() {
            axios.get(`/rest/todos?limit=${this.limit}&page=${this.page}`)
            .then(oResponse => {
                this.list = oResponse.data.data.data;
                this.pagination = oResponse.data.data;
            })
            .catch(oError => {
                console.log(oError);
            });
        },
        getTodoCount() {
            axios.get('/rest/todos/count')
            .then(oResponse => {
                this.count = oResponse.data.data.count;
                this.total_page = Math.ceil(this.count / this.limit);
            })
            .catch(oError => {
                console.log(oError);
            });
        },
        deleteTodo() {
            axios.delete('/rest/todos', {
                data: { todo_ids: this.checkedTodos }
            })
            .then(oResponse => {
                this.getTodo();
                this.getTodoCount();
            })
            .catch(oError => {
                console.log(oError);
            });
        },
        updateTodo() {
            axios.put(`/rest/todos/${this.detail.todo_id}`, this.detail)
            .then(oResponse => {
                this.getTodo();
            })
            .catch(oError => {
                console.log(oError);
            });
        }
    }
});