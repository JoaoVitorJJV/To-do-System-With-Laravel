<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('is_finished', 0)->get();

        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::create($data);

        return response()->json([
            'error' => false,
            'data' => new TaskResource($task)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        return new TaskResource($task);
    }

    public function showByUserId(string $userID)
    {
        $task = Task::where('created_user_id', $userID)->orderBy('created_at', 'desc')->get();

        if(count($task) > 0){
            return response()->json([
                'error' => false,
                'data' => TaskResource::collection($task)
            ]);
        }else{
            return response()->json([
                'error' => true,
                'data' => []
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $task = Task::find($id);

        if(!empty($task)){
            $data = $request->validated();
            $task->update($data);

            return response()->json([
                'error' => false,
                'data' => new TaskResource($task)
            ]);
        }else{
            
            return response()->json([
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function changeFinished(string $id)
    {
        $task = Task::find($id);

        if(!empty($task)){
            $task->update([
                'is_finished' => $task->is_finished == 1 ? 0 : 1
            ]);

            return response()->json([
                'error' => false,
            ]);
        }else{
            return response()->json([
                'error' => true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if(!empty($task)){
            $task->delete();

            return response()->json([
                'error' => false
            ]);
        }else{
            return response()->json([
                'error' => true
            ]);
        }
    }
}
