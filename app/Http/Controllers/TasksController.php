<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated($request->all());
        $task = Task::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

        return $this->isNotAuthorized($task) ?? new TaskResource($task);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return response()->json(['error' => 'Not Found'], 401);
        }
        $task->update($request->all());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        return $this->isNotAuthorized($task) ? $task->delete() : \response()->json(['error' => 'Not Found'], 401);
    }

    private function isNotAuthorized(Task $task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return response()->json(['error' => 'Not Found'], 401);
        }
    }
}