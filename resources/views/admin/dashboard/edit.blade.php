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
            <form action="{{route('dashboard.update',$dashboard->id)}}"method="POST"enctype="multipart/form-data">
                @csrf
                {{-- <div class="form-group">
                    <label for="name">Mã số đặt hàng</label>
                    <input class="form-control" type="text" name="username" id="username"value="{{$dashboard->username}}">
                </div> --}}

                <div class="form-group">
                    <label for="name">ID bán hàng</label>
                    <input class="form-control" type="text" name="userId" id="userId"value="{{ $dashboard->id }}"readonly>
                </div>
                
                <div class="form-group">
                    <label for="name">Tên người đặt</label>
                    <input class="form-control" type="text" name="username" id="username"value="{{$dashboard->username}}"readonly>
                </div>

                <div class="form-group">
                    <label for="name">số điện người đặt</label>
                    <input class="form-control" type="text" name="phone" id="phone"value="0{{$dashboard->phone}}"readonly>
                </div>

              
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" id="name"value="{{$dashboard->name}}">
                </div> 

                <div class="form-group">
                    <label for="name">Sổ lượng sản phẩm</label>
                    <input class="form-control" type="text" name="quantity" id="quantity"value="{{$dashboard->quantity}}">
                </div>

                
                <div class="form-group">
                    <label for="name">Giá tiền sản phẩm</label>
                    <input class="form-control" type="text" name="price" id="price"value="{{$dashboard->price}}">
                </div>

                <div class="form-group">
                    <label for="name">Trạng thái sản phẩm</label>
                    <input class="form-control" type="text" name="status" id="status"value="{{$dashboard->status}}">
                </div>

                <button type="submit"name="btn-add-product"value="Thêm sản phẩm" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@endsection