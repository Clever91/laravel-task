<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Score;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request  $request): View
    {
        $tasks = Task::where('active', Task::STATE_ACTIVE);

        if ($request->filled("category_id")) {
            $tasks->where('category_id', $request->input('category_id'));
        }

        if ($request->filled("score_id")) {
            $tasks->where('score_id', $request->input('score_id'));
        }

        if ($request->filled("done")) {
            $tasks->where('done', $request->input('done') == "solved");
        }

        if ($request->filled('q')) {
            $q = trim($request->input('q'));
            $tasks->where(function($query) use ($q, $request) {
                if ($request) {
                    $query->where('tasks.title', 'LIKE', "%{$q}%");
                    $query->orWhere('tasks.description', 'LIKE', "%{$q}%");
                }
            });
        }

        if ($request->filled('sort')) {
            $sorting = explode('_', $request->input('sort'));
            $sort = $sorting[0] ?? "category";
            $order = $sorting[1] ?? "asc";
            if ($sort == "category") {
                $tasks->join('categories', 'tasks.category_id', '=', 'categories.id')
                    ->orderBy('categories.title', $order);
            } else if ($sort == "score") {
                $tasks->join('scores', 'scores.id', '=', 'tasks.score_id')
                    ->orderBy('scores.ball', $order);
            } else if ($sort == "done") {
                $tasks->orderBy("done", $order);
            }
        }
        

        $tasks = $tasks->paginate(12);

        $categories = Category::where(['state' => Category::STATE_ACTIVE])->get();
        $scores = Score::all();
        $sorting = [
            'category_desc' => "Category Down",
            'category_asc' => "Category Up",
            'score_desc' => "Score Down",
            'score_asc' => "Score Up",
            'done_desc' => "Solving Down",
            'done_asc' => "Solving Up",
        ];

        return view('page.tasks', compact('tasks', 'categories', 'scores', 'sorting'));
    }
}
