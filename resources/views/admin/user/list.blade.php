@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#" class="d-flex flex-row">
                    <input type="text"name="keyword"value="{{request()->input('keyword')}}"  class="form-control form-search"placeholder="Tìm kiếm">
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

        <div class="analytic">
            <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count[0]}})</span></a>
            <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count[1]}}) </span></a>
        </div>
        <form action="{{url('admin/user/action')}}"method="">
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" name="act"id="">
                    <option>Chọn</option>
                    @foreach ($list_act as $key =>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                    <option value="{{$key}}">Khôi phục</option>      

                  
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}

            </div>      
            @endif
            
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">Stt</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->total()>0)
                    @php
                        $t = 0;
                    @endphp
                    @foreach ($users as $user)
                    @php
                    $t  ++;
                     @endphp

                    <tr>
                        <td>
                            <input type="checkbox"name="list_check[] "value={{$user->id}}>
                        </td>
                        <th scope="row">{{$t}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        @if(Auth::id() != $user->id)
                        <td>User</td>
                        @else 
                        <td>Admintrator</td>
                        @endif
                        <td>{{$user->created_at}}</td>
                        <td>
                            @if(Auth::id() != $user->id)
                            <a style="width:40px;margin-bottom:3px" href="{{route('user.edit',$user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a style="width:40px" href="{{route('delete_user',$user->id)}}" 
                                onclick="return confirm('Bạn có chắc muốn xóa user này')"
                                
                                 class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>   
                             @else 
                                <a style="width: 40px" href="" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @endif
                           
                        </td>
                    </tr>      
                   
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7"><p>Không có giá trị tìm kiếm</p> </td>
                    </tr>
                    @endif 
                </tbody>
            </table>
        </form>
        {{ $users->appends(request()->all())->links() }}
    </div>
    </div>
</div>
@endsection