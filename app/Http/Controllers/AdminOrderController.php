<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'order']);
            return $next($request);
        });
    }

    public function list(Request $request)
    {
        //Phần tìm kiếm
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $input = $request->all();
        $status = $request->input(['status']);


        $count_deleted = Order::onlyTrashed()->count();
        $count_active = DB::table('orders')->whereNull('deleted_at')->count();

        //name ô select của option(chứa các option trong đó)
        $select_option  = $request->input('select_option');

        //Các option lựa chọn 
        $option  = [
            'key1' => 'Đơn hàng đang xử lí',
            'key2' => 'Đơn hàng xóa tạm thời',
            'key3' => 'Đơn hàng xóa vĩnh viễn',
            'key4' => 'Cập nhật vào trang dashboard',
            'key5' => 'Đơn hàng đã được xử lí'
        ];

        $order = Order::where('name', 'LIKE', '%' . $keyword . '%')->paginate(2);
        $checkbox = $request->input('checkbox');

        if ($checkbox) {
            //Đơn hàng xóa tạm thời
            if ($select_option == $option['key2']) {
                Order::destroy($checkbox);
                return redirect('admin/order/list')->with('message', 'Đơn hàng đã được xóa tạm thời');

                //Đơn hàng đang được xử lí
            } else if ($select_option == $option['key1']) {
                DB::table('orders')->whereIn('id', $checkbox)->update(['status' => 'Đang xử lí']);

                return redirect('admin/order/list')->with('message', 'Đơn hàng đang chờ xử lí');

                //Đơn hàng xóa vĩnh viễn
            } else if ($select_option == $option['key3']) {
                DB::table('orders')->whereIn('id', $checkbox)->delete();
                return redirect('admin/order/list')->with('message', 'Đơn hàng đã được xóa khoi he thong');

                //Đơn hàng xử lí thành công 
            } else if ($select_option == $option['key5']) {
                DB::table('orders')->whereIn('id', $checkbox)->update(['status' => 'Hoàn thành']);
                return redirect('admin/order/list')->with('message', 'Đơn hàng đã được duyệt');

                //Chuyển về trang dashboard
            } else if ($select_option == $option['key4']) {
                $order = DB::table('orders')->where('id', $checkbox)->get();

                foreach ($order as $orders) {
                }
                DB::table('dashboard')
                    ->whereIn('id', $checkbox)
                    ->insert([
                        'order_id' => $orders->id,
                        'username'    => $orders->username,
                        'phone'      =>  $orders->phone,
                        'name'      =>  $orders->name,
                        'quantity'      => $orders->quantity,
                        'price'      => $orders->price,
                        'status'      =>  $orders->status,
                        'created_at' => $orders->created_at,
                    ]);
            }
            return redirect('dashboard')->with('message', 'Sản phẩm đã được cập nhật ');
        }


        if ($status == 'active') {
            $order = DB::table('orders')->whereNull('deleted_at')->paginate(5);
        }

        if ($status == 'deleted') {
            $order = Order::onlyTrashed()->paginate(2);
        }

        return view('admin.order.list', compact('order', 'option', 'count_active', 'count_deleted'));
    }

    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('admin/order/list')->with('message', 'Đơn hàng này đã được xóa');
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin/order/edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $order = DB::table('orders')
            ->where('id', $id)
            ->update([
                'username'      => $input['username'],
                'phone'      => $input['phone'],
                'name'      => $input['name'],
                'quantity'      => $input['quantity'],
                'price'      => $input['price'],
                'status'      => $input['status'],


            ]);
        return redirect('admin/order/list')->with('massage', 'Cập nhật đơn hàng thành công');
    }
}
