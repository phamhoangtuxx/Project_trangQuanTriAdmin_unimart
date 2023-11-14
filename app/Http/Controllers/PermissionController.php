<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Permission;


use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    function add()
    {
        // $permissions = Permission::all();
        $permissions = Permission::all()->groupBy(function ($permissions) {
            return explode('.', $permissions->slug)[0];
        });

        return view('admin.permission.add', compact('permissions'));
    }
    function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
        ]);

        Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);
        return redirect('admin/permission/add')->with('message', 'Bạn đã thêm thanh công');
    }


    function edit($id)
    {
        // $permissions = Permission::all();
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permissions', 'permission'));
    }

    function update(Request $request, $id)

    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
        ]);
        Permission::where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        return redirect('admin/permission/add')->with('message', 'Đã chỉnh sửa thành công');
    }
    function delete($id)
    {
        Permission::where('id', $id)->delete();
        return redirect('admin/permission/add')->with('message', 'Bạn đã xóa thành công');
    }
}
