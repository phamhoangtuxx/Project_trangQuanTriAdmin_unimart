<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;



class RoleController extends Controller
{
    //
    function index()
    {
        $roles = Role::all();

        return view('admin.role.index', compact('roles'));
    }

    public function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        // dd($permissions);

        return view('admin.role.add', compact('permissions'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:roles,name,',
            'description' => 'required',
            //trường permission_id được phép null nó ở 1 dạng mảng array
            'permission_id' => 'nullable|array',

            //Phần tử ở trong phải tổn tại trong bảng permission id
            'permission_id.*' => 'exists:permissions,id',
        ]);
        $role = Role::create([
            'name'       => $request->name,
            'description' => $request->description
        ]);

        //Attach permission for role (Găn quyền cho vai trò)

        //Giả thích 
        //- từ role->truy cập cập đến function permission() trong model role đã được được liên kết
        //2- đi đến attach(lấy id của permission trong bảng permission)
        $role->permission()->attach($request->input('permission_id'));
        return redirect('admin/role/index')->with('message', 'Vai trò được thêm thành công');
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });



        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {

        //Phần validate
        $validated = $request->validate([
            //TRường name là  1 trường băt buộc (required) 
            //unique:role : trường duy nhất trong bảng roles
            //$role->id loại trừ bảng ghi có name  đã có tồn tại ngoại trừ bảng đang edit
            'name' => 'required|unique:roles,name,' . $role->id,

            //trường permission_id được phép null nó ở 1 dạng mảng array
            'permission_id' => 'nullable|array',

            //Phần tử ở trong phải tổn tại trong bảng permission id
            'permission_id.*' => 'exists:permissions,id',
        ]);

        //Phần update
        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        //Từ $role chứa role gọi đến phương thức permission đã kết  nối ở model
        // - Dùng phương sync dùng để cập nhật dữ liệu trong bảng role permission,cập nhât các quyền trong bảng vai trò role
        // trong trường hơp ko có input thì trả về mảng rỗng 
        // $permission_id = $request->input('permission_id');
        // foreach ($permission_id as $ids) {
        // }
        // dd($role->permission()->sync($request->input('permission_id', [])));

        $role->permission()->sync($request->input('permission_id[]', []));

        return redirect('admin/role/index')->with('message', 'Cập nhật vai trò thành công');
    }
    public function delete(Role $role)
    {
    }
}
