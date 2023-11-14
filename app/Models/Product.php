<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'thumbnail',
        'name',
        'price',
        'quantity',
        'categories',
        'cat_id',
        'status',
        'deleted_at',
        'user_id'

    ];
}
