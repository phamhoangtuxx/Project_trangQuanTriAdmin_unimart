@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách trang</h5>
            <div class="form-search form-inline">
            <form action="#" class="d-flex flex-row">
                    <input type="text" name="keyword"value="{{request()->input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
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
            {{-- Phan session thông bao --}}
                <form action="#"method="">

            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" 
                class="text-primary">Kích hoạt<span class="text-muted">({{ $Temporary_delete }})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'restore'])}}" 
                class="text-primary">Xóa tạm thời<span class="text-muted">({{$restore}})</span></a>
              
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1  col-3"name="check_option" id="">

                @foreach ($options as $option )
                <option value="{{$option}}">{{$option}}</option>
                @endforeach
                  
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">Stt</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày Tạo </th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=0
                @endphp
                    @foreach ($page as $pages )
                    @php
                    $i++
                @endphp
                    <tr>
                        <td>
                            <input type="checkbox"name="check_box[]"value={{$pages->id}}>
                        </td>
                        <td>{{$i}}</td>
                        <td><img width="60";height="60" src={{asset("uploads/$pages->thumbnail")}}/></td>

                        <td>{{$pages->title}}</td>
                        <td>{{$pages->categories}}</td>
                        <td>26:06:2020 14:00</td>
                        <td>
                            <a style="width: 40px" href="{{url('admin/page/edit',$pages->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a style="width:40px" href="{{url('admin/page/delete',$pages->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>       
                    @endforeach
                 
                    
                </tbody>
            </table>
            {{ $page->appends(request()->all())->links() }}

            </form>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </div>
</div>
@endsection