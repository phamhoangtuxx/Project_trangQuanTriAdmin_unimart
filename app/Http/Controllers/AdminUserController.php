<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    //Hàm chạy đầu tiên dùng làm module active khi người dùng click vào
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
    }

    //HIển thị danh sách admin trong hệ thống
    public function list(Request $request)
    {
        $status = $request->input('status');
        //Lọc option xóa tạm thời vs vĩnh viễn 
        $list_act  = [
            'delete' => 'Xóa tạm thời',
            'force_delete' => 'Xóa vĩnh viễn'
        ];
        if ($status == 'trash') {
            $list_act  = [
                'force_delete' => 'Xóa vĩnh viễn'
            ];
            $users = User::onlyTrashed()->paginate(5);
        } else {
            $list_act  = [
                'delete' => 'Xóa tạm thời'
            ];
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            //Chức năng tìm kiếm theo keyword người dùng nhập
            $users = User::where('name', 'LIKE', '%' . $keyword . '%')->paginate(5);
        }

        //Count user active
        $count_user_active = User::count();

        //Count user trash 
        $count_user_trash = User::onlyTrashed()->count();

        $count = [$count_user_active, $count_user_trash];
        // return $users;
        return view('admin.user.list', compact('users', 'count', 'list_act'));
    }


    //Ghép giao diện thêm user vào hệ thống 
    public function add(Request $request)
    {

        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'regex:/^0\d{9}$/'],

            'password' => ['required', 'string', 'min:8'],
        ]);

        $category = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        return redirect('admin/user/list')->with('status', "User đã được thêm thành công ");
    }


    //Xóa 1 user vs không xoa chính mính
    public function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user/list')->with('message', 'Bạn đã xoa user thành công');
        } else {
            return redirect('admin/user/list')->with('not_delete_admin', 'Bạn không thể xóa user Admin ra khỏi hệ thống');
        }
    }

    //Xử lí xóa nhìu bản ghi 1 lúc vs không xóa chính mình admin
    public function action(Request $request)
    {
        //$checklist khi người dùng Nhấn vào ô list check 
        $checklist = $request->input('list_check');

        //$active khi người dùng chọn tác vụ xử lí (xóa,khôi phục,)
        $active = $request->input('act');

        if ($checklist) {
            //Danh sách các option (xóa và khôi phục)
            foreach ($checklist as $key => $id) {
                if (Auth::id() == $id) {
                    unset($checklist[$key]);
                    return redirect('admin/user/list')->with('message', 'Bạn Không có quyền xóa user này');
                }
            }

            //nếu input act == delete thì người dùng check vào ô và xóa
            if (!empty($checklist)) {
                if ($active == 'delete') {
                    User::destroy($checklist);
                    return redirect('admin/user/list')->with('message', 'Bạn đã xóa user thành công');
                }

                if ($active == 'restore') {
                    User::withTrashed()->whereIn('id', $checklist)->restore();
                    return redirect('admin/user/list')->with('message', 'Bạn đã khôi phục user thành công');
                }

                if ($active == 'force_delete') {
                    User::withTrashed()->whereIn('id', $checklist)->forceDelete();
                    return redirect('admin/user/list')->with('message', 'Bạn đã xóa vĩnh viễn  User ');
                }
            }
            return redirect('admin/user/list')->with('message', 'Bạn không thể thao tác xóa trên tai khoản của bạn');
        } else {
            return redirect('admin/user/list')->with('message', 'Bạn cần check vào ô vuống để thực thi');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    //Cập nhật thông tin người dùng 
    public function update(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'password' => $request->input('password'),
            ]);
        return redirect('admin/user/list')->with('message', 'Bạn đã cập nhật thông tin thành công');
    }
}
