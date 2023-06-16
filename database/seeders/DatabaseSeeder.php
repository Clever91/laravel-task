<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tag::factory(10)->create();
        Category::factory(25)->create();

        foreach([5, 10, 15, 20, 25, 30] as $score) {
            DB::table('scores')->insert([
                'name' => "{$score} points",
                'ball' => $score,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }

        Task::factory(150)->create();
        
        foreach(Task::all() as $task) {
            for ($i=0; $i < random_int(1,4); $i++) {
                $tag = Tag::find(random_int(1, 10));
                $model = Taggable::where(['tag_id' => $tag->id, 'taggable_id' => $task->id, 'taggable_type' => Task::class])->get();
                if ($model->count() || empty($tag)) {
                    continue;
                }
                DB::table('taggables')->insert([
                    'tag_id' => $tag->id,
                    'taggable_id' => $task->id,
                    'taggable_type' => Task::class,
                ]);
            }
        }
    }
}
