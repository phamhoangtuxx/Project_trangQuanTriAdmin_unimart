<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class AdminPageController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
    }

    public function list(Request $request)
    {



        //name checkbox 
        $checkbox = $request->input('check_box');

        //name option
        $check_option = $request->input('check_option');

        $options = [
            'Temporary_delete' => 'Xóa tạm thời',
            'restore' => 'khôi phục',
            'deleted' => 'Xóa vĩnh viễn'
        ];

        $Temporary_delete = DB::table('pages')->whereNull('deleted_at')->count();
        $restore = Page::onlyTrashed()->count();

        if ($request['status'] == 'active') {
            $page =  DB::table('pages')->whereNull('deleted_at')->paginate(3);
        } else if ($request['status'] == 'restore') {
            $page = Page::onlyTrashed()->paginate(2);
        } else {

            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $page = Page::where('title', 'LIKE', '%' . $keyword . '%')->paginate(2);
        }

        if ($checkbox) {
            if ($options['Temporary_delete'] == $check_option) {
                Page::destroy($checkbox);
                return redirect('admin/page/list')->with('message', 'Xóa tạm thời trang thành công');
            }
            if ($options['restore'] == $check_option) {
                $page = Page::withTrashed()->whereIn('id', $checkbox)->restore();
                return redirect('admin/page/list')->with('message', 'Khôi phục trang thành công');
            }

            if ($options['deleted'] == $check_option) {
                $page = DB::table('pages')->whereIn('id', $checkbox)->delete();
                return redirect('admin/page/list')->with('message', 'Đã xóa trang ra khỏi hệ thống ');
            }
        }

        return view('admin.page.list', compact('page', 'options', 'Temporary_delete', 'restore'));
    }

    //THêm dữ liệu
    public function store(Request $request)
    {
        //Xác định hình ảnh 
        $page = new Page();
        if ($request->has('images')) {
            $file = $request->images;
            $file_name = $file->getClientoriginalName();
            $get_image = $file->move(public_path('uploads'), $file_name);
        }
        // $upload = me
        $input = $request->all();
        $page->thumbnail = $file_name;
        $page->title    = $input['title'];
        $page->categories = $input['categories'];

        $page->save();
        return redirect('admin/page/list')->with('message', 'Danh mục được thêm thành công');
    }

    public function add(Request $request)
    {
        return view('admin.page.add');
    }

    //Sửa  lại thông tin danh mục 
    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }
    //CẬp nhật thông tin khi đã edit
    public function update(Request $request, $id)
    {

        if ($request->has('images')) {
            $file = $request->images;
            $file_name = $file->getClientoriginalName();
            $get_image = $file->move(public_path('uploads'), $file_name);
        }

        if ($request->input('btn-danhmuc')) {
            $update = DB::table('pages')
                ->where('id', $id)
                ->update([
                    'thumbnail' => $file_name,
                    'title' => $request->input('title'),
                    'categories' => $request->input('categories')
                ]);
            return redirect('admin/page/list')->with('message', 'Cập nhật danh mục thành công');
        } else {
            echo "Bạn đã làm sai";
        }
    }

    //Xóa 1 dòng 
    public function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect('admin/page/list')->with('message', 'Bạn đã xóa danh mục thành công');
    }
}
