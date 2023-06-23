<?php

namespace App\Repositories;

use App\Models\TodoModel;

class TodoRepository
{
    /**
     * @var TodoModel
     */
    private TodoModel $oTodoModel;

    public function __construct(TodoModel $oTodoModel)
    {
        $this->oTodoModel = $oTodoModel;
    }

    public function saveTodo(array $aData)
    {
        return $this->oTodoModel->create($aData);
    }

    public function updateTodo(int $iTodoId, array $aData)
    {
        return $this->oTodoModel
            ->where('todo_id', $iTodoId)
            ->update($aData);
    }

    public function getTodoList(array $aQueryParam)
    {
        $oQuery = $this->oTodoModel;

        if (key_exists('start_date', $aQueryParam) && key_exists('end_date', $aQueryParam)) {
            $oQuery = $oQuery->whereBetween('created_at', [$aQueryParam['start_date'], $aQueryParam['end_date']]);
        }
        
        return $oQuery->paginate($aQueryParam['limit']);
    }

    public function getTodoListCount(array $aQueryParam = [])
    {
        $oQuery = $this->oTodoModel;

        if (key_exists('start_date', $aQueryParam) && key_exists('end_date', $aQueryParam)) {
            $oQuery = $oQuery->whereBetween('created_at', [$aQueryParam['start_date'], $aQueryParam['end_date']]);
        }

        return $oQuery->count();
    }

    public function deleteTodo(array $aData)
    {
        return $this->oTodoModel
            ->whereIn('todo_id', $aData['todo_ids'])
            ->delete();
    }
}