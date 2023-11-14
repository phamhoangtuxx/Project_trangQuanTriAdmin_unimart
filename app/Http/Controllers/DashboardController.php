<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\Dashboard;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
    }
    //
    function show()
    {
        return view('dashboard');
    }

    public function list()
    {
        $dashboard = DB::table('dashboard')->paginate(2);
        $order_id = DB::table('dashboard')->get('id');
        $totalPrice = DB::table('dashboard')->sum('price');


        //Đơn hành đang xử lí
        $Processing = DB::table('dashboard')->where('status', 'Đang xử lí')->count();

        //Đơn hàng xử lí hoàn thành
        $sum_order = DB::table('dashboard')->where('status', 'Hoàn thành')->count();

        //Doanh số bán hàng 
        $totalPrice = Order::sum('price');

        //Thống kê số đơn hàng hủy trong trang bán hàng
        $totalCancel = Order::onlyTrashed()->count();

        return view('admin.dashboard.list', compact('dashboard', 'sum_order', 'Processing', 'totalPrice', 'totalCancel'));
    }

    public function edit(Request $request, $id)
    {
        $dashboard = Dashboard::find($id);
        return view('admin/dashboard/edit', compact('dashboard'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        DB::table('dashboard')
            ->update([
                'username'      => $input['username'],
                'phone'      => $input['phone'],
                'name'      => $input['name'],
                'quantity'      => $input['quantity'],
                'price'      => $input['price'],
                'status'      => $input['status'],


            ]);
        return redirect('dashboard')->with('message', 'Cập nhật đơn hàng thành công');
    }

    public function delete(Request $request, $id)
    {
        $id = Dashboard::find($id);
        dd($id);
        $dashboard = DB::table('dashboard')->delete();
        return redirect('admin.dashboard.list')->with('message', 'Bạn đã xóa thành côngx');
    }
}
