<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Task extends Model
{
    use HasFactory;

    const STATE_ACTIVE = 1;
    const STATE_NO_ACTIVE = 0;

    protected $fillable = [
        'title', 'description', 'category_id', 
        'score_id', 'done', 'active'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function score(): HasOne
    {
        return $this->hasOne(Score::class, 'id', 'score_id');
    }

    /**
     * Get all of the tags for the task.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function doneLabel()
    {
        return $this->done ? "Solved": "Unsolved";
    }
}
