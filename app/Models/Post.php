<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'thumbnail',
        'title',
        'content',
        'categories',
        'deleted_at'
    ];
}
