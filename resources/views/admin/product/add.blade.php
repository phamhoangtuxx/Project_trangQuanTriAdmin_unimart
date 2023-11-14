@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/store')}}
            "method="POST"enctype="multipart/form-data">
            @csrf
            <div class="row">
                    <div class="col-12">

                        <div class="form-group">
                            <label for="name">ID người dùng</label>
                            <input class="form-control" type="text" name="userId" id="userId">
                        </div>


                        <div class="form-group">
                            <label for="title">Hình ảnh bài viết</label>
                            <input type="file" class="form-control"name="images" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{-- <label for="">Danh mục</label>
                    <select class="form-control" id="">
                        <option>Chọn danh mục</option>
                        <option>Danh mục 1</option>
                    </select> --}}

                    <label for="">Danh mục</label>

                    <select class="form-control mr-1 col-4" id="" name="select_category">
                        <option>Chọn danh mục</option>
                        @foreach ($options as $key => $option )
                        <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                    </select>






                </div>
                <div class="form-group">
                    <label for="name">Trạng thái</label>
                    <input class="form-control" type="text" name="status" id="status">
                </div>


                <button  type="submit" class="btn btn-primary"name="btn-add_product"value="thêm sản phẩm">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>

@endsection