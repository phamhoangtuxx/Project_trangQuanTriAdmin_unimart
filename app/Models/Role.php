<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    //Tạo liên kết vs bảng permission  thông qua foreign key bảng role_permission_
    public function permission()
    {

        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
