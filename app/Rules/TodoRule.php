<?php

namespace App\Rules;

class TodoRule
{
    /**
     * @return array
     */
    public function getTodoListRule(): array
    {
        return [
            'start_date' => 'sometimes|required|date:Y-m-d H:i:s',
            'end_date' => 'sometimes|required|date:Y-m-d H:i:s',
            'limit' => 'sometimes|required|int',
            'page' => 'sometimes|required|int',
            'status' => 'sometimes|required|string'
        ];
    }

    public function saveTodoRule(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'in:todo,done'
        ];
    }

    public function updateTodoRule(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'in:todo,done'
        ];
    }

    public function deleteTodosRule(): array
    {
        return [
            'Todo_ids' => 'sometimes|required|array',
            'Todo_ids.*' => 'int'
        ];
    }
}
