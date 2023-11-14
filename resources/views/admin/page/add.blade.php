@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm danh mục
        </div>
        <div class="card-body">
            {{-- {!! Form::open(['url'=>'dmin/page/store','method'=>'POST','files'=>true]) !!} --}}
            <form action="{{url('admin/page/store')}}"method="POST"enctype="multipart/form-data">
                @csrf   
                <div class="form-group">
                    <label for="title">Hình ảnh bài viết</label>
                    <input type="file" class="form-control"name="images" id="name">
                    @error('thumbnail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="title">Tiêu đề</label>
                    <input class="form-control" type="text" name="title" id="title">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="text">Danh mục</label>
                    <input class="form-control" type="text" name="categories" id="categories">
                    @error('categories')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

             

                <button type="submit" class="btn btn-primary"name="btn-add_category" value="thêm mới danh muc">Thêm mới danh muc</button>
            </form>
        </div>
    </div>
</div>

@endsection 