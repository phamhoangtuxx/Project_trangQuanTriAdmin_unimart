<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table = 'dashboard';
    protected $fillable = [
        'username',
        'phone',
        'name',
        'quantity',
        'price',
        'status',
        'order_id'

    ];
}
