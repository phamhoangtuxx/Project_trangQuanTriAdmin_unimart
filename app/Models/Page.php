<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Page extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    use HasFactory;
    protected $table = 'pages';
    protected $fillable = [
        'id',
        'thumbnail',
        'title',
        'categories',
    ];
}
