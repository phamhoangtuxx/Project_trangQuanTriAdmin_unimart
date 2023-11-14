@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#">     
                    @csrf
                    <div class="d-flex">
                    <input type="text" name="keyword"value="{{request()->input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">                                           
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </div>      
                </form>
                {{-- <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
                    <button type="submit">Tìm kiếm</button>
                </form> --}}
            </div>
        </div>
        <div class="card-body">
            @if (\Session::has('message'))
            <div class="alert alert-success">
                {!! \Session::get('message') !!}
            </div>
            @else
                    {!! \Session::get('not_delete_admin') !!}            
        @endif
        <form action="#"method="">

            <div class="analytic" name="all">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}"name="hello" 
                class="text-primary">Bài viết công khai<span class="text-muted">({{ $post_all }})</span></a>

                <a href="{{request()->fullUrlWithQuery(['status'=>'deleted'])}}" 
                 class="text-primary">Bài viết chờ duyệt<span class="text-muted">({{$totalScore}})</span></a>
                
            </div>
            <div class="form-action form-inline py-3">
                    
                <select class="form-control mr-1 " id=""name="check_option">
                <option>Chọn</option>
                @foreach ($option as $key =>$value)
                <option value="{{$value}}">{{$value}}</option>
                @endforeach

            </select>

                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                    <thead>

                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">Stt</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0
                    @endphp
                    @foreach ($post as $posts )
                    @php
                        $i++
                    @endphp

                    <tr>
                        <td>
                            <input type="checkbox"name="list_check[]"value={{ (int)$posts->id }}>
                        </td>
                        <td scope="row">{{$i}}</td>
                        <td><img src={{asset("uploads_image_post/$posts->thumbnail")}} alt=""width="50"height="50"></td>
                        <td><a href="">{{$posts->title}}</td>
                        {{-- Noi dung --}}
                        <td><a href="">{{$posts->content}}</td>

                        {{-- danh muc --}}
                        <td class="col-3"><a href="">{{$posts->categories}}</td>


                        <td>26:06:2020 14:00</td>
                        <td><a style="width: 40px;margin-bottom:3px" href="{{route('post.edit',$posts->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a style="width:40px" href="{{route('post.delete',$posts->id)}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $post->appends(request()->all())->links() }}
                
        </form>

       
        </div>
    </div>
</div>
@endsection