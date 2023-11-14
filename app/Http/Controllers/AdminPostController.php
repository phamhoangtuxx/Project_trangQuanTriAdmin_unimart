<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'post']);
            return $next($request);
        });
    }
    //sách bài viết
    public function list(Request $request)
    {

        //Chức năng xóa tạm thời và khôi phục
        //Name của ô checkbox
        $checkbox = $request->input('list_check');

        //chức năng xóa tạm thời vs show ra danh sách xóa tạm thời

        //Kiểm tra ô select
        $select_option = $request->input('check_option');


        $totalScore = Post::onlyTrashed()->count();
        $post_all = DB::table('posts')->whereNull('deleted_at')->count();

        $option = [
            'key1' => 'Xóa tạm thời',
            'key2' => 'Duyệt bài viết',
            'key3' => 'Xóa vĩnh viễn'

        ];

        if ($checkbox) {
            if ($select_option == $option['key1']) {
                Post::destroy($checkbox);
                return redirect('admin/post/list')->with('message', 'Bài viết hiện đang ở trạng thái chờ duyệt');
            } else if ($select_option == $option['key2']) {
                Post::withTrashed()->whereIn('id', $checkbox)->restore();
                return redirect('admin/post/list')->with('message', 'Bài viết đã được duyệt thành công');
            } else {
                if ($select_option == $option['key3']) {
                    DB::table('posts')->whereIn('id', $checkbox)->delete();
                    return redirect('admin/post/list')->with('message', 'Bài viết đã được xóa khỏi hệ thông');
                }
            }
        }

        $status = $request->input('status');
        if ($status == 'active') {
            $option = [
                'key1' => 'Xóa tạm thời',
                'key3' => 'Xóa vĩnh viễn'
            ];
            $post = Post::whereNull('deleted_at')->paginate(4);
        } else if ($status == 'deleted') {
            // dd("die");
            $option = [
                'key1' => 'Xóa vĩnh viễn',
                'key2' => 'Duyệt bài viết'
            ];
            $post = Post::onlyTrashed()->paginate(2);
        } else {

            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $post = Post::where('title', 'LIKE', '%' . $keyword . '%')->paginate(2);
        }

        return view('admin.post.list', compact('post', 'option', 'checkbox', 'totalScore', 'post_all'));
    }



    //Thêm bài viết
    public function add()
    {

        return view('admin.post.add');
    }

    public function store(Request $request)
    {

        // $validator = $request->validate([
        //     // 'thumbnail' => ['required'],
        //     'title' => ['required', 'string', 'max:50'],
        //     'categories' => ['required'],
        // ]);
        //Xác định hình ảnh 
        $post = new Post();
        if ($request->has('images')) {
            $file = $request->images;
            $file_name = $file->getClientoriginalName();
            $get_image = $file->move(public_path('uploads_image_post'), $file_name);
        }
        // $upload = me
        $input = $request->all();
        $post->thumbnail = $file_name;
        $post->title    = $input['title'];
        $post->content = $input['content'];
        $post->categories = '';

        $post->save();
        return redirect('admin/page/list')->with('message', 'Bài viết  được thêm thành công');
    }

    //Xóa 1 bài viết 
    public function delete(Request $request, $id)
    {
        Post::where('id', $id)->delete();
        return redirect('admin/post/list')->with('message', 'bạn đã xóa thành công bài viết');
    }

    public function edit($id)
    {
        $post  = Post::find($id);

        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = new Post();
        if ($request->has('images')) {
            $file = $request->images;
            $file_name = $file->getClientoriginalName();
            $get_image = $file->move(public_path('uploads_image_post'), $file_name);
        }

        $input = $request->all();

        // $upload = me
        DB::table('posts')
            ->where('id', $id)
            ->update([
                'thumbnail' => $file_name,
                'title'      => $input['title'],
                'content'      => $input['content'],
                'categories'    => ''

            ]);

        return redirect('admin/post/list')->with('message', 'Cập nhật Bài viết thành công');
    }

    public function categories(Request $request)
    {

        $post = Post::all();
        $category_name = $request->input('category_name');
        $checkbox = $request->input('check_box');
        if ($checkbox) {
            $post = DB::table('posts')->whereIn('id', $checkbox)->update(['categories' => $category_name]);
            return redirect('admin/post/list')->with('message', 'Cập nhật danh mục thành công');
        }

        return view('admin.post.cat.list', compact('post'));
    }
}
