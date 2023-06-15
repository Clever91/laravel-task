<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Query\Builder;
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

        if ($request->has("done")) {
            $tasks->where('done', $request->input('done'));
        }

        if ($request->has('q')) {
            $q = $request->input('q');
            $tasks->where(function($query) use ($q, $request) {
                if ($request) {
                    $query->where('title', 'LIKE', "%{$q}%");
                    $query->orWhere('description', 'LIKE', "%{$q}%");
                }
            });
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
            $tasks->where('score_id', $request->input('score_id'));
        }

        if ($request->has("done")) {
            $tasks->where('done', $request->input('done'));
        }

        if ($request->has('q')) {
            $q = $request->input('q');
            $tasks->where(function($query) use ($q, $request) {
                if ($request) {
                    $query->where('title', 'LIKE', "%{$q}%");
                    $query->orWhere('description', 'LIKE', "%{$q}%");
                }
            });
        }

        return new TaskCollection($tasks->paginate());
    }

    public function one(Request $request, $id) 
    {
        return new TaskResource(Task::findOrFail($id));
    }
}
