@extends('layouts.admin')
@section('title','Tạo mới quyền')
@section('content')

<div id="content" class="container-fluid">
    @if (\Session::has('message'))
    <div class="alert alert-success">
        {!! \Session::get('message') !!}
    </div>
    @else
            {!! \Session::get('not_delete_admin') !!}            
@endif
    <div class="row">
        <div class="col-4">
            <div class="card">
               
                <div class="card-header font-weight-bold">
                    Thêm quyền
                </div>
                <div class="card-body">
                    <form action="{{url('admin/permission/store')}}
                    "method="POST"enctype="multipart/form-data">
                    @csrf              
                              <div class="form-group">
                            <label for="name">Tên quyền</label>
                            <input class="form-control" type="text" name="name" id="name">
                            @error('name')
                             <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>                            
                            <input class="form-control" type="text" name="slug" id="slug">
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                               
                           @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" type="text" name="description" id="description"> </textarea>

                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách quyền
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên quyền</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Tác vụ</th>
                                <!-- <th scope="col">Mô tả</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($permissions as $moduleName => $modulePermission )
                          
                              
                            <tr>

                                <td></td>
                                <td class="col-4"><strong>Module {{Ucfirst($moduleName) }}</strong></td>
                            </tr>
                            @foreach ($modulePermission as $permission )
                            <tr>
                                <td >{{$i++}}</td>
                                <td>|---{{$permission->name}}</td>
                                <td>{{$permission->slug }}</td>
                                <td class="col-4">
                                    <a style="width:40px;margin-bottom:3px" href="{{route('permission.edit',$permission->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a style="width:40px;margin-bottom:3px" href="{{ route('permission.delete',$permission->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top"onclick="return confirm('Bạn có chắc chắn muốn xóa quyền này không ?')" title="Delete"><i class="fa fa-trash"></i></a>     
                                </td>                      
                                 </tr>
                            
                        

                            
                            @endforeach
                            @endforeach
                      

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection