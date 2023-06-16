<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Taggable extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id', 'taggable_id', 'taggable_type'
    ];

    public $timestamps = false;
}
