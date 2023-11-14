@extends('layouts.admin')
@section('title','Thêm vai trò')
@section('content')
<div id="content" class="container-fluid">
    @if (\Session::has('message'))
    <div class="alert alert-success">
        {!! \Session::get('message') !!}
    </div>
    @else
            {!! \Session::get('not_delete_admin') !!}            
@endif
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Thêm mới vai trò</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('admin/role/store')}}
            "method="POST"enctype="multipart/form-data">
            @csrf                         
              <div class="form-group">
                    <label class="text-strong" for="name">Tên vai trò</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>    
                   @enderror
                </div>
                <div class="form-group">
                    <label class="text-strong" for="description">Mô tả</label>
                    <textarea class="form-control" type="text" name="description" id="description"></textarea>
                </div>
                <strong>Vai trò này có quyền gì?</strong>
                <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn quyền.</small>
                <!-- List Permission  -->

                
                @foreach ($permissions as $moduleName => $modulePermission  )
                <div class="card my-4 border">          
                    <div class="card-header">
                        <input type="checkbox" class="check-all" name="" id="{{$moduleName}}">
                        <label for="{{$moduleName}}" class="m-0">Module {{ ucfirst($moduleName) }}</label>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($modulePermission as $permission   )
                            <div class="col-md-3">
                                <input type="checkbox" class="permission" value="{{$permission->id}}" name="permission_id[]" id="{{$permission->slug}}">
                                <label for="{{$permission->slug}}">{{$permission->name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>        
                @endforeach
                <input type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $('.check-all').click(function () {
        $(this).closest('.card').find('.permission').prop('checked', this.checked)
      })
</script>
@endsection
