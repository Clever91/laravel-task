<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATE_ACTIVE = 1;
    const STATE_NO_ACTIVE = 0;

    protected $fillable = [
        'title', 'description', 'category_id', 
        'score_id', 'done', 'active'
    ];
}
