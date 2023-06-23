<?php

namespace Tests\Unit;

use App\Models\TodoModel;
use Tests\TestCase;
use Illuminate\Support\Arr;

class TodoTest extends TestCase
{
    /**
     * Test if the index page has status code 200
     */
    public function test_index_page()
    {
        $oResponse = $this->get('/index');

        $oResponse->assertStatus(200);
    }

    /**
     * Test if the user can create a todo
     */
    public function test_create_todo()
    {
        $oResponse = $this->post('/rest/todos', [
            'title' => 'Test Title',
            'description' => 'Test description',
            'status' => 'done'
        ]);

        $oResponse->assertStatus(200);
    }

    /**
     * Test if the user can delete a todo
     */
    public function test_delete_a_todo()
    {
        $oCreated = TodoModel::factory()->count(1)->create();
        $aData = $oCreated->toArray()[0];

        $oResponse = $this->delete('/rest/todos', [
            'todo_ids' => [$aData['todo_id']]
        ]);

        $oResponse->assertStatus(200);
    }

    /**
     * Test if the user can delete multiple todos
     */
    public function test_delete_multiple_todos()
    {
        $oCreated = TodoModel::factory()->count(3)->create();
        $aData = $oCreated->toArray();
        $aTodoIds = Arr::pluck($aData, 'todo_id');

        $oResponse = $this->delete('/rest/todos', [
            'todo_ids' => $aTodoIds
        ]);

        $oResponse->assertStatus(200);
    }

    /**
     * Test if the user can updated a todo
     */
    public function test_update_a_todo()
    {
        $oCreated = TodoModel::factory()->count(1)->create();
        $aData = $oCreated->toArray()[0];
        $iTodoId = $aData['todo_id'];
        
        $oResponse = $this->put('/rest/todos/' . $iTodoId, [
            'title' => $aData['title'] . '_updated',
            'description' => $aData['description'] . '_updated',
            'status' => 'done'
        ]);

        $oResponse->assertContent(json_encode(['data' => ['message' => 'Todo updated successfully.']]));
    }

    /**
     * Test if the user can get todo list
     */
    public function test_get_todo_list()
    {
        $oResponse = $this->get('rest/todos');

        $oResponse->assertStatus(200);
    }

    /**
     * Test if the user can get count of todo list
     */
    public function test_get_count_of_todo_list()
    {
        $oResponse = $this->get('rest/todos/count');

        $oResponse->assertStatus(200);
    }
}
