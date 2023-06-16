<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request  $request): View
    {
        $tasks = Task::where('active', Task::STATE_ACTIVE);

        if ($request->has("category_id")) {
            $tasks->where('category_id', $request->input('category_id'));
        }

        $tasks = $tasks->paginate(12);
        $categories = Category::where(['state' => Category::STATE_ACTIVE])->get();

        return view('page.tasks', compact('tasks', 'categories'));
    }
}
