@extends('layouts.admin')
@section('content')
 

<div class="container-fluid py-5">
    @if (\Session::has('message'))
    <div class="alert alert-success">
        {!! \Session::get('message') !!}
    </div>
    @else
            {!! \Session::get('not_delete_admin') !!}            
@endif
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$sum_order}}</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$Processing}}</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($totalPrice)}} VNĐ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$totalCancel}}</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
          
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Stt</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian đặt hàng</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($dashboard as $dashboards)
                        @php
                            $i++;
                        @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>1212</td>
                        <td>
                            {{$dashboards->username}} <br>
                            0{{$dashboards->phone}}
                        </td>
                        <td><a href="#">{{$dashboards->name}}</a></td>
                        <td>{{$dashboards->quantity}}</td>
                        <td>{{number_format($dashboards->price)}}Đ</td>

                        <td><span class="badge badge-warning">{{$dashboards->status}}</span></td>
                        
                        <td>{{$dashboards->created_at}}</td>


                        <td>
                            <a style="width: 40px;margin-bottom:3px" href="{{route('dashboard.edit',$dashboards->id)}}" 
                                class="btn btn-success btn-sm rounded-0 text-white" 
                            type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>


                            <a style="width: 40px" href="{{route('dashboard.delete',$dashboards->id)}}"class="btn btn-danger btn-sm rounded-0 text-white" 
                            type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                   
                   
                </tbody>
            </table>
            {{ $dashboard->links() }}

        </div>
    </div>
</div>
@endsection