@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <div class="d-flex">

                    <input type="" class="form-control form-search" placeholder="Tìm kiếm"name="keyword"value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </div>
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
        <form action="#"method="">

            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}"class="text-primary">Đơn hàng đã xử lí<span class="text-muted">({{$count_active}})</span></a>


                <a href="{{request()->fullUrlWithQuery(['status'=>'deleted'])}}"                 class="text-primary">Đơn hàng bị xóa tạm thời<span class="text-muted">({{$count_deleted}})</span></a>
              
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id=""name="select_option">
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
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">Stt</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t=0;
                    @endphp
                    @foreach ($order as $orders )

                        @php
                            $t++;
                        @endphp
                    <tr>
                        <td>
                            <input type="checkbox"name="checkbox[]"value={{ (int)$orders->id }}>
                        </td>
                        <td>{{$t}}</td>
                        <td class="col-2">
                          {{$orders->username}} <br>                             
                          0{{$orders->phone}} <br>
                        </td>                     
                        <td class="col-2"><a href="#">{{$orders->name}}</a>                                          </td>
                        <td class="col-2">{{$orders->quantity}}</td>
                        <td class="col-2">{{number_format($orders->price)}} VNĐ</td>
                        <td class="col-2"><span class="badge badge-warning">{{ $orders->status }}</span></td>
                        <td>{{$orders->created_at}}</td>
                        <td>
                            <a style="width: 40px;margin-bottom:3px" href="{{route('order.edit',$orders->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a style="width: 40px" href="{{route('order.delete',$orders->id)}}"class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>       

                    @endforeach
                 
                </tbody>

            </table>
            {{ $order->appends(request()->all())->links() }}


        </form>


         
        </div>
    </div>
</div>
@endsection