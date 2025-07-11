<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Auth::user()->todos()->latest()->simplePaginate(3);
        return TodoResource::collection($todos);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $todo = Todo::create($validated)->fresh();
        return response()->json([
            'status' => true,
            'message' => 'ToDo created',
            'data' => new TodoResource($todo),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currentUser = Auth::user();
        $todo = $currentUser->todos()->find($id);
        if(!$todo)
        return response()->json([
        'status' => false,
        'message' => 'ToDo was not found'
        ], 404);
        return response()->json([
        'status' => true,
        'message' => 'ToDo was found',
        'data' => new TodoResource($todo),
        ], 200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        $currentUser = Auth::user();
        $todo = $currentUser->todos()->find($id);
        if(!$todo)
        return response()->json([
        'status' => false,
        'message' => 'ToDo was not found'
        ], 404);
        $todo->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully',
            'data' => new TodoResource($todo)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currentUser = Auth::user();
        $todo = $currentUser->todos()->find($id);
        if(!$todo)
        return response()->json([
        'status' => false,
        'message' => 'ToDo was not found'
        ], 404); 
        $todo->delete();
        return response()->json([
            'status' => true,
            'message' => 'Todo deleted',
            'data' => null
        ], 200);
    }
}
