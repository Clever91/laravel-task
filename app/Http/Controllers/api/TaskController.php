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
        $tasks = Task::select('tasks.id', 'tasks.title', 'tasks.description', 'tasks.category_id', 'tasks.score_id', 'tasks.done')
            ->where('active', Task::STATE_ACTIVE);

        if ($request->filled("category_id")) {
            $tasks->where('category_id', $request->input('category_id'));
        }

        if ($request->filled("score_id")) {
            $tasks->where('score_id', $request->input('score_id'));
        }

        if ($request->filled("done")) {
            $tasks->where('done', $request->input('done'));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $tasks->where(function($query) use ($q, $request) {
                if ($request) {
                    $query->where('tasks.title', 'LIKE', "%{$q}%");
                    $query->orWhere('tasks.description', 'LIKE', "%{$q}%");
                }
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort', 'category');
            $order = $request->input('order', 'asc');
            if ($sort == "category") {
                $tasks->join('categories', 'tasks.category_id', '=', 'categories.id')
                    ->orderBy('categories.title', $order);
            } else if ($sort == "score") {
                $tasks->join('scores', 'scores.id', '=', 'tasks.score_id')
                    ->orderBy('scores.name', $order);
            } else if ($sort == "done") {
                $tasks->orderBy("done", $order);
            }
        }

        return TaskResource::collection($tasks->get());
    }

    public function paginate(Request $request)
    {
        $tasks = Task::select('tasks.id', 'tasks.title', 'tasks.description', 'tasks.category_id', 'tasks.score_id', 'tasks.done')
            ->where('active', Task::STATE_ACTIVE);

        if ($request->filled("category_id")) {
            $tasks->where('category_id', $request->input('category_id'));
        }

        if ($request->filled("score_id")) {
            $tasks->where('score_id', $request->input('score_id'));
        }

        if ($request->filled("done")) {
            $tasks->where('done', $request->input('done'));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $tasks->where(function($query) use ($q, $request) {
                if ($request) {
                    $query->where('tasks.title', 'LIKE', "%{$q}%");
                    $query->orWhere('tasks.description', 'LIKE', "%{$q}%");
                }
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort', 'category');
            $order = $request->input('order', 'asc');
            if ($sort == "category") {
                $tasks->join('categories', 'tasks.category_id', '=', 'categories.id')
                    ->orderBy('categories.title', $order);
            } else if ($sort == "score") {
                $tasks->join('scores', 'scores.id', '=', 'tasks.score_id')
                    ->orderBy('scores.name', $order);
            } else if ($sort == "done") {
                $tasks->orderBy("done", $order);
            }
        }

        return new TaskCollection($tasks->paginate());
    }

    public function one(Request $request, $id) 
    {
        return new TaskResource(Task::findOrFail($id));
    }
}
