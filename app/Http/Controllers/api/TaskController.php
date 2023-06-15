<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function all(Request $request)
    {
        $tasks = Task::where('active', Task::STATE_ACTIVE);

        if ($request->has("category_id")) {
            $tasks->where('category_id', $request->input('category_id'));
        }

        if ($request->has("score_id")) {
            $tasks->where('category_id', $request->input('score_id'));
        }

        return TaskResource::collection($tasks->get());
    }

    public function paginate(Request $request)
    {
        $tasks = Task::where('active', Task::STATE_ACTIVE);

        if ($request->has("category_id")) {
            $tasks->where('category_id', $request->input('category_id'));
        }

        if ($request->has("score_id")) {
            $tasks->where('category_id', $request->input('score_id'));
        }

        return new TaskCollection($tasks->paginate());
    }

    public function one(Request $request, $id) 
    {
        return new TaskResource(Task::findOrFail($id));
    }
}
