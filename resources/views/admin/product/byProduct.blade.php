@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            @if (\Session::has('message'))
            <div class="alert alert-success">
                {!! \Session::get('message') !!}
            </div>
            @else
                    {!! \Session::get('not_delete_admin') !!}            
        @endif
        <form action="{{url('admin/product/order',$product->id)}}
            "method="POST"enctype="multipart/form-data">
            @csrf
                 <div class="form-group">
                                <label for="name">ID người dùng</label>
                                <input class="form-control" type="text" name="userId" id="userId"value="{{ $userId }}"readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Tên người mua hàng</label>
                                <input class="form-control" type="text" name="user_name" id="user_name"value="{{$username }}" readonly>
                            </div>
                
                            <div class="form-group">
                                <label for="name">Số điện thoại</label>
                                <input class="form-control" type="number" name="phone" id="phone"value="{{ $phone }}" readonly>
                            </div>     


                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" id="name"value="{{ $product->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Sổ lượng</label>
                    <input class="form-control" type="text" name="quantity" id="quantity"value="{{ $product->quantity }}" readonly>
                </div>
               
                <div class="form-group">
                    <label for="name">Giá sản phẩm</label>
                    <input class="form-control" type="text" name="price" id="price"value="{{ $product->price }}" readonly>
                </div>


                <div class="form-group">
                    <label for="name">Trạng thái</label>
                    <input class="form-control" type="text" name="status" id="status">
                </div>
                <button type="submit"name="btn-add-product"value="Thêm sản phẩm" class="btn btn-primary">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>
@endsection