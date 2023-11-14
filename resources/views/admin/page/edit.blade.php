@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật danh mục
        </div>
        <div class="card-body">
            <form action="{{route('page.update',$page->id)}}"method="POST"enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="title">Hình ảnh bài viết</label>
                    <input type="file" class="form-control"name="images" id="name"value=img width="60";height="60" src={{asset("uploads/$page->thumbnail")}}>
                    {{-- <img style="margin-top:20px;margin-bottom:20px" src={{asset("uploads_image_product/$page->thumbnai      l")}} alt=""width="150"height="100"> --}}
                    <img style="margin-top:20px" src={{asset("uploads_image_product/$page->thumbnail")}} alt=""width="150"height="100">

                    {{-- value={{asset("uploads/$category->thumbnail")}}> --}}
                    @error('thumbnail')
                    <img style="margin-top:20px" src={{asset("uploads_image_product/$page->thumbnail")}} alt=""width="150"height="100">

                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                                <div class="form-group">

                    <label for="title">Tiêu đề</label>
                    <input class="form-control" type="text" name="title" id="title"value={{$page->title}}>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                                </div>
                    <label for="text">Danh mục</label>
                    <input class="form-control" type="text" name="categories" id="categories"value={{$page->categories}}>
                    @error('categories')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div> --}}

                <button type="submit" name="btn-danhmuc"value="cap nhật danh mục" class="btn btn-primary">Cập nhật danh mục</button>
            </form>
        </div>
    </div>
</div>
@endsection