<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//Phần User
//Sinh ra từ lệnh authentication
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    //TRang dashboard(Bảng điều khiển) 
    Route::get('dashboard', [DashboardController::class, 'show'])->middleware('auth');
    // Route::get('product', [DashboardController::class, 'show'])->middleware('auth');
    Route::get('admin', [DashboardController::class, 'show'])->middleware('auth');

    Route::get('dashboard', [DashboardController::class, 'list']);


    Route::get('admin/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.edit');

    Route::post('admin/dashboard/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update');


    Route::get('admin/dashboard/delete/{id}', [DashboardController::class, 'delete'])->name('dashboard.delete');








    //TRang Admin user
    Route::get('admin/user/list', [AdminUserController::class, 'list']);

    //Ghép giao diện thêm thêm user vào admin/user/add
    Route::get('admin/user/add', [AdminUserController::class, 'add']);
    //Hiển thị dữ liệu thêm user  admin/user/store
    Route::get('admin/user/store', [AdminUserController::class, 'store']);

    //Xóa user người dùng ra hệ thống (lưu ý không được xóa admin )
    Route::get('admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('delete_user');


    //Xử lí check box xóa nhìu bản ghi một lúc vs thiết lập không xóa admin chính mình
    Route::get('admin/user/action', [AdminUserController::class, 'action'])->name('action');



    //Sửa thông tin người dùng 
    Route::get('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
    //Cập nhật thông tin người dùng 
    Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
});
//------------------End Phần user


//phần Page-------------------------------------------------------------------
//Danh Sách danh mục bài viết
Route::get('admin/page/list', [AdminPageController::class, 'list']);

//THêm Danh mục bài viết 
Route::get('admin/page/add', [AdminPageController::class, 'add']);
//------------------End Phần page----------------------------------------------------------

//Store xử lỉ chực năng thêm danh mục
Route::post('admin/page/store', [AdminPageController::class, 'store']);

//Xóa 1 dòng dữ liệu
Route::get('admin/page/delete/{id}', [AdminPageController::class, 'delete'])->name('page.delete');

//edit sử lại danh mục
Route::get('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('page.edit');
//update cập nhât lại thông tin danh muc sau khi edit
Route::post('admin/page/update/{id}', [AdminPageController::class, 'update'])->name('page.update');







//------------------------------------------------------------------------------------
//Phầm post bài viết

//Hển thị danh sách bài viết 

//THêm bài viết
Route::get('admin/post/add', [AdminPostController::class, 'add']);

//THêm danh mục con bài viết
Route::get('admin/post/list', [AdminPostController::class, 'list'])->name('post.list');

Route::post('admin/post/store', [AdminPostController::class, 'store']);

//XÓa 1 bài viêt

Route::get('admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('post.delete');


//edit bài viết 
Route::get('admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('post.edit');

//Câp nhật bài viết sau khi update
Route::post('admin/post/update/{id}', [AdminPostController::class, 'update'])->name('post.update');


//Xu li chuc nang
Route::get('admin/post/action', [AdminPostController::class, 'action'])->name('post.action');


//Tìm kiếm bài viêt chức năng seach 

// Route::get('admin/post/list', [AdminPostController::class, 'search'])->name('search');

//Danh mục bài viết
Route::get('admin/post/cat/list', [AdminPostController::class, 'categories']);







//Sản phẩm (product)-------------------------------------------------
//Danh sách sản phẩm 
Route::get('admin/product/list', [AdminProductController::class, 'list']);

//THêm sản phẩm 
Route::get('admin/product/add', [AdminProductController::class, 'add']);

//Hiển thị san phẩm
Route::post('admin/product/store', [AdminProductController::class, 'store']);


//Danh sách danh mục sản phẩm 

Route::get('admin/product/cat/list', [AdminProductController::class, 'cat_list']);

//Edit sản phẩm 
Route::get('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');

//Update lại sản phẩm khi đã edit
Route::post('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('product.update');

//Xóa 1 sản phẩm 
Route::get('admin/product/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');

//Form chứa id thức hiện nhiệm vụ
Route::get('admin/product/action', [AdminProductController::class, 'action'])->name('product.action');


//Đặt mua sản phẩm 

Route::get('admin/product/byProduct/{id}', [AdminProductController::class, 'byProduct'])->name('product.byProduct');


Route::post('admin/product/order/{id}', [AdminProductController::class, 'order'])->name('product.order');





//-------------------------------------------------
//Category_product (danh mục sản phẩm)
Route::get('admin/product/cat/list', [AdminProductController::class, 'categories']);

//=============================================================

//Tăng giảm số lượng 
//Tang
Route::post('increase', [AdminProductController::class, 'increaseQuantity'])->name('increase');
//Giam
Route::post('decrease', [AdminProductController::class, 'decreaseQuantity'])->name('decrease');


//Bán hàng  (Danh sách đặt hàng của khách hàng)-------------------------------------------------
Route::get('admin/order/list', [AdminOrderController::class, 'list']);
//--------------------------------------------------------------------


//Chỉnh sửa mục bán hàng
Route::get('admin/order/edit/{id}', [AdminOrderController::class, 'edit'])->name('order.edit');


//Update lại múc bán hàng  khi đã edit
Route::post('admin/order/update/{id}', [AdminOrderController::class, 'update'])->name('order.update');


//Xóa mục bán hàng 
Route::get('admin/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('order.delete');

//Chỉnh sửa đợn hàng
//Edit sản phẩm 
Route::get('admin/order/edit/{id}', [AdminOrderController::class, 'edit'])->name('order.edit');


//CẬp nhật đơn hàng
Route::post('admin/order/update/{id}', [AdminOrderController::class, 'update'])->name('order.update');


//===============================================================
//Trang dashboard 
Route::get('admin/dashboard/delete/{id}', [AdminDashboardController::class, 'delete'])->name('dashboard.delete');


Route::get('admin/dashboard/edit/{id}', [AdminDashboardController::class, 'edit'])->name('dashboard.edit');


//CẬp nhật đơn hàng
Route::post('admin/dashboard/update/{id}', [AdminDashboardController::class, 'update'])->name('dashboard.update');



//===============================================================
//Trang permission (Quyền)


//Route for permission
Route::get('admin/permission/add', [PermissionController::class, 'add'])->name('permission.add');



Route::post('admin/permission/store', [PermissionController::class, 'store'])->name('permission.store');


//Edit permission chỉnh sửa 
Route::get('admin/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');

//Update cập nhật 
Route::post('admin/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');


//Delete xóa 
Route::get('admin/permission/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');


//Trang Role (Vai trò)

//TRang index role
Route::get('admin/role/index', [RoleController::class, 'index'])->name('role.index');


//add  role
Route::get('admin/role/add', [RoleController::class, 'add'])->name('role.add');
Route::post('admin/role/store', [RoleController::class, 'store'])->name('role.store');


//Edit role
Route::get('admin/role/edit/{role}', [RoleController::class, 'edit'])->name('role.edit');

//Update cập nhật 
Route::post('admin/role/update/{role}', [RoleController::class, 'update'])->name('role.update');

//Delete role
Route::get('admin/role/delete/{role}', [RoleController::class, 'delete'])->name('role.delete');
