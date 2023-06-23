<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\TodoRule;
use App\Repositories\TodoRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\ValidationException;
use Exception;

class RestController extends Controller
{
    use ValidatesRequests;

    /**
     * @var TodoRepository
     */
    private TodoRepository $oTodoRepository;

    /**
     * @var TodoRule
     */
    private TodoRule $oTodoRule;

    public function __construct(TodoRepository $oTodoRepository, TodoRule $oTodoRule)
    {
        $this->oTodoRepository = $oTodoRepository;
        $this->oTodoRule = $oTodoRule;
    }

    public function saveTodo(Request $oRequest)
    {
        try {
            $oSaveTodoRule = $this->oTodoRule->saveTodoRule();
            $this->validate($oRequest, $oSaveTodoRule);
            $aResult = $this->oTodoRepository->saveTodo($oRequest->all());

            return Response::json(['data' => $aResult]);
        } catch (ValidationException $oException) {
            return Response::json(['errors' => $oException->errors()], 422);
        } catch (Exception $oException) {
            return Response::json(['error' => $oException->getMessage()], 422);
        }
    }

    public function updateTodo(Request $oRequest, int $iTodoId)
    {
        try {
            $oUpdateTodoRule = $this->oTodoRule->updateTodoRule();
            $this->validate($oRequest, $oUpdateTodoRule);
            $bResult = $this->oTodoRepository->updateTodo($iTodoId, $oRequest->only(['title', 'description', 'status']));
            return Response::json(['data' => ['message' => $bResult === 0 ? 'No record found in the system.' : 'Todo updated successfully.']]);
        } catch (ValidationException | Exception $oException) {
            return Response::json($oException->getMessage(), 422);
        }
    }

    public function getTodoList(Request $oRequest)
    {
        try {
            $aGetTodoListRule = $this->oTodoRule->getTodoListRule();
            $this->validate($oRequest, $aGetTodoListRule);
            $aQueryParam = $this->prepareQuery($oRequest->only(['limit', 'page', 'start_date', 'end_date']));
            $aTodoList = $this->oTodoRepository->getTodoList($aQueryParam);
            return Response::json(['data' => $aTodoList]);
        } catch (ValidationException | Exception $oException) {
            return Response::json($oException->getMessage(), 422);
        }
    }

    public function getTodoListCount(Request $oRequest)
    {
        try {
            $iCount = $this->oTodoRepository->getTodoListCount($oRequest->only(['start_date', 'end_date']));
            return Response::json(['data' => ['count' => $iCount]]);
        } catch (ValidationException | Exception $oException) {
            return Response::json($oException->getMessage(), 422);
        }
    }

    public function deleteTodos(Request $oRequest)
    {
        try {
            $oDeleteTodoRule = $this->oTodoRule->deleteTodosRule();
            $this->validate($oRequest, $oDeleteTodoRule);
            $bResult = $this->oTodoRepository->deleteTodo($oRequest->only(['todo_ids']));

            return Response::json(['data' => ['message' => $bResult === 0 ? 'No records found in the system.' : 'Todo deleted successfully.']]);
        } catch (ValidationException | Exception $oException) {

            return Response::json($oException->getMessage(), 422);
        }
    }

    private function prepareQuery(array $aData = [])
    {
        $aQueryParam = [
            'limit' => 10,
            'offset' => 0
        ];

        if (key_exists('limit', $aData) && key_exists('page', $aData)) {
            $aQueryParam['limit'] = $aData['limit'];
            $aQueryParam['offset'] = ($aData['page'] * $aData['limit']) - $aData['limit'];
        }

        if (key_exists('start_date', $aData) && key_exists('end_date', $aData)) {
            $aQueryParam['start_date'] = $aData['start_date'];
            $aQueryParam['end_date'] = $aData['end_date'];
        }

        return $aQueryParam;
    }
}