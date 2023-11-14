<?php

namespace App\Http\Controllers;

use App\Models\dashboard;
use App\Models\product;
use App\Models\order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard as HtmlDashboard;

class AdminDashboardController extends Controller
{
    //ghi chu


    public function list()
    {

        $order = Order::all();
        $order_id = DB::table('orders')->get('id');
        $totalPrice = DB::table('orders')->sum('price');


        //Đơn hành đang xử lí
        $Processing = DB::table('orders')->where('status', 'Đang xử lí')->count();

        //Đơn hàng xử lí hoàn thành
        $sum_order = DB::table('orders')->where('status', 'Hoàn thành')->count();

        //Doanh số bán hàng của sản phẩm
        $totalPrice = Order::sum('price');

        //Thống kê số đơn hàng hủy trong trang bán hàng
        $totalCancel = Order::where('deleted_at', true)->count();

        return view('dashboard', compact('order', 'sum_order', 'Processing', 'totalPrice', 'totalCancel'));
    }



    public function delete(Request $request, $id)
    {

        dashboard::where('id', $id)->delete();
        return redirect('dashboard')->with('message', 'Bạn đã xóa thành công');
    }

    public function edit(Request $request, $id)
    {
        $dashboard = Dashboard::find($id);

        return view('admin/dashboard/edit', compact('dashboard'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $dashboard = DB::table('dashboard')
            ->where('id', $id)
            ->update([
                'username'     => $input['username'],
                'phone'        => $input['phone'],
                'name'         => $input['name'],
                'quantity'     => $input['quantity'],
                'price'        => $input['price'],
                'status'       => $input['status'],


            ]);
        return redirect('dashboard')->with('message', 'Cập nhật đơn hàng thành công');
    }
}
