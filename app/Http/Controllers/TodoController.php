<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Http\Resources\Todo as TodoResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display all todos.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->paginate(5);
        return TodoResource::collection($todos);
    }

    /**
     * Store todo.
     *
     * @param  \Illuminate\Http\Request $request
     * @return TodoResource
     */
    public function store(Request $request)
    {
		$reqTodo = $request->input();
		if(!$reqTodo['completed']){
			$reqTodo['completed'] = null;
		}
        $todo = Todo::create($reqTodo);
        return new TodoResource($todo);
    }

    /**
     * Display todo.
     *
     * @param Todo $todo
     * @return TodoResource
     */
    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    /**
     * Update todo
     *
     * @param  \Illuminate\Http\Request $request
     * @param Todo $todo
     * @return TodoResource
     */
    public function update(Request $request, Todo $todo)
    {
		$reqTodo = $request->input();
		if(!$reqTodo['completed']){
			$reqTodo['completed'] = null;
		}
        $todo->update($reqTodo);
        return new TodoResource($todo);
    }

    /**
     * Remove todo.
     *
     * @param Todo $todo
     * @return TodoResource
     * @throws \Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
            return new TodoResource($todo);
    }

    public function markComplete(Request $request, Todo $todo){
        $isComplete = $request->input('is_complete', false);
        if($isComplete){
            $todo->completed = Carbon::now();
        }else{
            $todo->completed = null;
        }
        $todo->save();
        return new TodoResource($todo);
    }
}
