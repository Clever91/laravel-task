<?php

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/task/{id}', function (string $id) {
    return new TaskResource(Task::findOrFail($id));
});

Route::get('/tasks', function () {
    return TaskResource::collection(Task::all());
});

Route::get('/pagination/tasks', function () {
    return new TaskCollection(Task::paginate());
});